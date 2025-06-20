<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Spirit;
use App\Models\Answer;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all(); // ambil semua data
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $spirits = Spirit::all(); // ambil semua spirit
        return view('admin.questions.create', compact('spirits'));
    }

    /**
     * Store a newly created question in storage.
     */
    public function store(Request $request)
{
    $request->validate([
    'number' => 'required|integer',
    'question' => 'required|string',
    'background' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    'answers' => 'required|array',
]);


    // Proses upload gambar jika ada
    $backgroundPath = null;

if ($request->hasFile('background')) {
    $backgroundPath = $request->file('background')->store('backgrounds', 'public');
}


    // Simpan pertanyaan
    $question = Question::create([
    'number' => $request->number,
    'question' => $request->question,
    'background' => $backgroundPath,
]);


    // Simpan jawaban untuk masing-masing spirit
    foreach ($request->answers as $spiritId => $answerText) {
        Answer::create([
            'question_id' => $question->id,
            'spirit_id' => $spiritId,
            'answer_text' => $answerText,
            'code' => Spirit::find($spiritId)?->code ?? '-', // ambil kode spirit
        ]);

    }

    return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil disimpan.');

}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
{
    $question->load('answers');         // Load jawaban terkait pertanyaan
    $spirits = \App\Models\Spirit::all(); // Ambil semua spirit

    return view('admin.questions.edit', compact('question', 'spirits'));
}




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
{
    $request->validate([
        'number' => 'required|integer',
        'question' => 'required|string',
        'background' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'answers' => 'required|array',
    ]);

    // Upload gambar baru jika ada
    if ($request->hasFile('background')) {
        $backgroundPath = $request->file('background')->store('backgrounds', 'public');
    } else {
        $backgroundPath = $question->background;
    }

    // Update pertanyaan
    $question->update([
        'number' => $request->number,
        'question' => $request->question,
        'background' => $backgroundPath,
    ]);

    // Update jawaban
    foreach ($request->answers as $spiritId => $answerText) {
        \App\Models\Answer::updateOrCreate(
            [
                'question_id' => $question->id,
                'spirit_id' => $spiritId,
            ],
            [
                'answer_text' => $answerText,
                'code' => \App\Models\Spirit::find($spiritId)?->code ?? '-',
            ]
        );
    }

    return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil diupdate.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
