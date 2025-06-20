<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Spirit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class UserQuizController extends Controller
{
    /**
     * Tampilkan halaman awal kuis (start quiz).
     */
    public function startQuiz()
    {
        // Reset sesi kuis saat memulai
        session()->forget('quiz_progress');
        return view('user.quiz.show');
    }

    /**
     * Tampilkan halaman kuis dengan pertanyaan saat ini.
     * Metode ini akan menjadi entry point utama untuk tampilan kuis.
     */
    public function showQuiz(Request $request)
    {
        // Pastikan APP_DEBUG true saat pengembangan
        if (env('APP_DEBUG')) {
            Log::info('Entering showQuiz method');
            Log::info('Session quiz_progress at start: ' . json_encode(session('quiz_progress')));
        }

        $questions = Question::orderBy('number')->get();

        if ($questions->isEmpty()) {
            return redirect()->route('user.dashboard')->with('error', 'Belum ada pertanyaan kuis yang tersedia.');
        }

        // Inisialisasi progress kuis di session jika belum ada
        if (!$request->session()->has('quiz_progress')) {
            $request->session()->put('quiz_progress', [
                'current_question_index' => 0,
                'answers_given' => [] // question_id => answer_id
            ]);
            if (env('APP_DEBUG')) {
                Log::info('quiz_progress initialized.');
            }
        }

        $quizProgress = $request->session()->get('quiz_progress');
        $currentQuestionIndex = $quizProgress['current_question_index'];

        // Jika index melebihi jumlah pertanyaan, arahkan ke halaman hasil
        if ($currentQuestionIndex >= $questions->count()) {
            if (env('APP_DEBUG')) {
                Log::info('Redirecting to result: currentQuestionIndex ' . $currentQuestionIndex . ' >= ' . $questions->count());
            }
            return redirect()->route('user.quiz.result');
        }

        // Ambil pertanyaan saat ini
        $currentQuestion = $questions[$currentQuestionIndex];
        $currentQuestion->load(['answers.spirit']); // Load relasi jawaban dan spirit

        // Dapatkan jawaban yang mungkin sudah dipilih sebelumnya untuk pertanyaan ini
        $selectedAnswerId = $quizProgress['answers_given'][$currentQuestion->id] ?? null;

        if (env('APP_DEBUG')) {
            Log::info('Serving question index: ' . $currentQuestionIndex . ', ID: ' . $currentQuestion->id);
        }

        // Ini akan tetap mengembalikan view utama (shell) untuk kuis
        return view('user.quiz.show', compact('currentQuestion', 'currentQuestionIndex', 'questions', 'selectedAnswerId'));
    }

    /**
     * Mengambil data pertanyaan berdasarkan index (via AJAX).
     * Ini adalah metode baru yang akan dipanggil oleh JavaScript.
     */
    public function getQuestionData(Request $request)
    {
        $request->validate([
            'index' => 'required|integer|min:0',
        ]);

        $questions = Question::orderBy('number')->get();
        $totalQuestions = $questions->count();
        $requestedIndex = $request->input('index');

        if ($requestedIndex >= $totalQuestions || $requestedIndex < 0) {
            return response()->json(['error' => 'Question index out of bounds'], 404);
        }

        $question = $questions[$requestedIndex];
        $question->load(['answers.spirit']); // Load jawaban dan spirit terkait

        $quizProgress = $request->session()->get('quiz_progress', []);
        $selectedAnswerId = $quizProgress['answers_given'][$question->id] ?? null;

        $answersData = $question->answers->map(function($answer) {
            return [
                'id' => $answer->id,
                'answer_text' => $answer->answer_text,
                'spirit_id' => $answer->spirit_id,
                'code' => $answer->code // Pastikan kolom 'code' di Answer atau di-load dari spirit
            ];
        });

        if (env('APP_DEBUG')) {
            Log::info('Serving AJAX question data for index: ' . $requestedIndex . ', ID: ' . $question->id);
        }

        return response()->json([
            'question' => [
                'id' => $question->id,
                'number' => $question->number,
                'text' => $question->question,
                'background_url' => $question->background ? Storage::url($question->background) : asset('img/default-quiz-bg.png'),
            ],
            'answers' => $answersData,
            'current_question_index' => $requestedIndex,
            'total_questions' => $totalQuestions,
            'selected_answer_id' => $selectedAnswerId,
            'is_last_question' => ($requestedIndex === $totalQuestions - 1),
            'is_first_question' => ($requestedIndex === 0)
        ]);
    }


    /**
     * Menyimpan jawaban dari pengguna ke session (via AJAX).
     */
    public function submitAnswer(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_id' => 'required|exists:answers,id',
        ]);

        $quizProgress = $request->session()->get('quiz_progress');

        // Simpan jawaban yang diberikan untuk pertanyaan ini
        $quizProgress['answers_given'][$request->question_id] = $request->answer_id;

        $request->session()->put('quiz_progress', $quizProgress);

        if (env('APP_DEBUG')) {
            Log::info('Answer submitted via AJAX: QID ' . $request->question_id . ', AID ' . $request->answer_id);
            Log::info('Current answers_given: ' . json_encode($quizProgress['answers_given']));
        }

        return response()->json(['message' => 'Jawaban berhasil disimpan.']);
    }


    /**
     * Tampilkan hasil kuis.
     */
    public function showResult(Request $request)
    {
        $quizProgress = $request->session()->get('quiz_progress');

        if (!$quizProgress || empty($quizProgress['answers_given'])) {
            return redirect()->route('user.quiz.show')->with('error', 'Anda belum menyelesaikan kuis atau sesi telah berakhir.');
        }

        $answersGiven = $quizProgress['answers_given'];

        $spiritCounts = [];
        foreach ($answersGiven as $questionId => $answerId) {
            $answer = Answer::find($answerId);
            if ($answer) {
                $spiritId = $answer->spirit_id;
                $spiritCounts[$spiritId] = ($spiritCounts[$spiritId] ?? 0) + 1;
            }
        }

        $resultSpirit = null;
        if (!empty($spiritCounts)) {
            arsort($spiritCounts);
            $mostFrequentSpiritId = key($spiritCounts);

            $resultSpirit = Spirit::find($mostFrequentSpiritId);
        }

        // Hapus progress kuis dari session setelah hasil ditampilkan
        $request->session()->forget('quiz_progress');

        return view('user.quiz.result', compact('resultSpirit'));
    }
}