<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPYNA - Pertanyaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Global Reset & Font */
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        /* Body & HTML Default */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            color: white;
            overflow: hidden; /* Mencegah scrollbar jika konten tidak pas */
        }

        /* Overlay / Main Container */
        .overlay {
            min-height: 100vh;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            
            /* Background akan diatur via JS */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            transition: background-image 0.5s ease-in-out; /* Smooth transition for background */
        }

        /* Logo Section */
        .logo {
            font-weight: bold;
            font-size: 30px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .logo img {
            height: 80px;
            margin-right: 10px;
        }

        /* Question Box */
        .question-box {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 12px;
            padding: 20px 30px;
            margin: 30px auto 10px;
            max-width: 700px;
            text-align: center;
            flex-shrink: 0;
        }

        .question {
            font-size: 24px;
            font-weight: bold;
            line-height: 1.4;
        }

        /* Options Grid */
        .options {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-gap: 16px;
            margin: 40px auto;
            max-width: 960px;
            flex-grow: 1;
            align-items: center;
            justify-items: center;
        }

        .option {
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid #fff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            position: relative;
            color: white;
            font-size: 18px;
            font-weight: bold;
            line-height: 1.3;
            display: flex;
            align-items: center;
            justify-content: center;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            border: none;
            outline: none;
            width: 100%;
            min-height: 80px;
        }

        .option:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Styling for selected option */
        .option.selected {
            background-color: rgba(255, 255, 255, 0.3);
            border-color: #87CEEB;
            box-shadow: 0 0 15px rgba(135, 206, 235, 0.7);
        }

        .option span.badge {
            position: absolute;
            top: -12px;
            left: -12px;
            color: #000;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 16px;
            min-width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Badge Colors */
        .option:nth-child(1) .badge { background-color: #F8C16F; } /* A */
        .option:nth-child(2) .badge { background-color: #EF761C; } /* B */
        .option:nth-child(3) .badge { background-color: #FB8257; } /* C */
        .option:nth-child(4) .badge { background-color: #6D9BA8; } /* D */
        .option:nth-child(5) .badge { background-color: #FCC78C; } /* E */
        .option:nth-child(6) .badge { background-color: #D2E7EC; } /* F */
        .option:nth-child(7) .badge { background-color: #AFA5A5; } /* G */
        .option:nth-child(8) .badge { background-color: #FEE2D7; } /* H */
        .option:nth-child(9) .badge { background-color: #EB7832; } /* I */
        .option:nth-child(10) .badge { background-color: #ABC760; } /* J */


        /* Navigation Buttons */
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            max-width: 960px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            flex-shrink: 0;
            padding-bottom: 20px;
        }

        .nav-btn {
            background-color: rgba(255, 255, 255, 0.15);
            border: 2px solid #fff;
            border-radius: 10px;
            padding: 12px 25px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .nav-btn:hover {
            background-color: rgba(255, 255, 255, 0.25);
        }

        .nav-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Validation Error Message Styling */
        .validation-errors {
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 600px;
            text-align: left;
            flex-shrink: 0;
        }
        .validation-errors ul {
            list-style: disc;
            margin-left: 20px;
            padding: 0;
        }

        /* Responsive Media Queries */
        @media screen and (max-width: 1024px) {
            .options {
                grid-template-columns: repeat(4, 1fr);
                max-width: 800px;
            }
        }

        @media screen and (max-width: 768px) {
            .overlay {
                padding: 20px;
            }
            .options {
                grid-template-columns: repeat(2, 1fr);
                margin-top: 20px;
                margin-bottom: 20px;
            }
            .question-box {
                padding: 16px;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .question {
                font-size: 20px;
            }
            .option {
                padding: 15px;
                font-size: 16px;
            }
            .logo {
                font-size: 24px;
            }
            .logo img {
                height: 60px;
            }
            .navigation-buttons {
                margin-top: 30px;
                font-size: 18px;
            }
            .nav-btn {
                padding: 10px 20px;
                font-size: 18px;
            }
        }

        @media screen and (max-width: 480px) {
            .options {
                grid-template-columns: 1fr;
            }
            .option {
                padding: 12px;
                font-size: 14px;
            }
            .navigation-buttons {
                flex-direction: column;
                gap: 15px;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay" id="quiz-overlay" style="background-image: url('{{ $currentQuestion->background ? Storage::url($currentQuestion->background) : asset('img/default-quiz-bg.png') }}');">
        <div class="logo">
            <img src="{{ Storage::url('images/Vector.png') }}" alt="SPYNA Logo">
            SPYNA
        </div>

        <div class="question-box">
            <div class="question" id="question-text-display">
                {{ $currentQuestion->number }}. {{ $currentQuestion->question }}
            </div>
        </div>

        <div class="options" id="options-container">
            {{-- Initial options will be rendered here by Blade --}}
            @php
                $alphabet = range('A', 'Z');
                $i = 0;
            @endphp
            @foreach($currentQuestion->answers as $answer)
                <button type="button" 
                        class="option {{ $selectedAnswerId == $answer->id ? 'selected' : '' }}" 
                        data-answer-id="{{ $answer->id }}" 
                        data-question-id="{{ $currentQuestion->id }}">
                    <span class="badge">{{ $alphabet[$i] }}</span>
                    {{ $answer->answer_text }}
                </button>
                @php $i++; @endphp
            @endforeach
        </div>

        <div id="error-message-area" class="validation-errors" style="display: none;">
            <ul></ul>
        </div>

        <div class="navigation-buttons">
            <button id="back-btn" class="nav-btn {{ $currentQuestionIndex == 0 ? 'disabled' : '' }}"
                    {{ $currentQuestionIndex == 0 ? 'disabled' : '' }}>
                &larr; Kembali
            </button>
            <button id="next-btn" class="nav-btn">
                Lanjut &rarr;
            </button>
        </div>
    </div>

    <script>
        const getQuestionDataUrl = "{{ route('user.quiz.get_question_data') }}";
        const submitAnswerUrl = "{{ route('user.quiz.submit_answer') }}";
        const quizResultUrl = "{{ route('user.quiz.result') }}";
        const csrfToken = "{{ csrf_token() }}";

        let currentQuestionIndex = {{ $currentQuestionIndex }};
        let totalQuestions = {{ $questions->count() }};
        // This will hold the current question ID shown on screen
        let currentQuestionId = {{ $currentQuestion->id }}; 
        let selectedAnswerId = {{ $selectedAnswerId ?? 'null' }}; // Initialize with currently selected answer

        const quizOverlay = document.getElementById('quiz-overlay');
        const questionTextDisplay = document.getElementById('question-text-display');
        const optionsContainer = document.getElementById('options-container');
        const backBtn = document.getElementById('back-btn');
        const nextBtn = document.getElementById('next-btn');
        const errorMessageArea = document.getElementById('error-message-area');

        const alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        // Function to update the quiz UI with new question data
        function updateQuizUI(data) {
            // Update Background
            quizOverlay.style.backgroundImage = `url('${data.question.background_url}')`;

            // Update Question Text
            questionTextDisplay.textContent = `${data.question.number}. ${data.question.text}`;
            currentQuestionId = data.question.id; // Update current question ID

            // Clear existing options
            optionsContainer.innerHTML = '';

            // Render new options
            data.answers.forEach((answer, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'option';
                button.dataset.answerId = answer.id;
                button.dataset.questionId = data.question.id;
                
                // Add 'selected' class if this answer was previously chosen
                if (answer.id === data.selected_answer_id) {
                    button.classList.add('selected');
                }

                const badge = document.createElement('span');
                badge.className = `badge`; // `option-${alphabet[index].toLowerCase()}` class was for static color
                badge.textContent = alphabet[index];
                
                // Set badge background color based on index
                if (index < 10) { // Apply specific colors for first 10 badges
                    const colors = ['#F8C16F', '#EF761C', '#FB8257', '#6D9BA8', '#FCC78C', '#D2E7EC', '#AFA5A5', '#FEE2D7', '#EB7832', '#ABC760'];
                    badge.style.backgroundColor = colors[index];
                } else {
                    // Default color for badges beyond J (if any)
                    badge.style.backgroundColor = '#cccccc'; 
                }

                button.appendChild(badge);
                button.appendChild(document.createTextNode(answer.answer_text)); // Use textNode for safety

                optionsContainer.appendChild(button);
            });

            // Re-attach event listeners to new option buttons
            attachOptionListeners();

            // Update navigation button states
            backBtn.disabled = data.is_first_question;
            backBtn.classList.toggle('disabled', data.is_first_question);

            // Next button is always active, but will redirect to result if it's the last question
        }

        // Function to attach click listeners to option buttons
        function attachOptionListeners() {
            document.querySelectorAll('.option').forEach(button => {
                button.removeEventListener('click', handleOptionClick); // Prevent duplicate listeners
                button.addEventListener('click', handleOptionClick);
            });
        }

        // Handler for option button clicks
        function handleOptionClick() {
            document.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            selectedAnswerId = parseInt(this.dataset.answerId); // Update selectedAnswerId
            
            // Clear any previous error messages
            hideErrorMessage();

            // Submit answer to server (async, no page reload)
            fetch(submitAnswerUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    question_id: parseInt(this.dataset.questionId),
                    answer_id: selectedAnswerId
                })
            })
            .then(response => response.json())
            .then(data => {
                // console.log('Answer saved:', data.message);
            })
            .catch(error => {
                console.error('Error submitting answer:', error);
                showErrorMessage('Terjadi kesalahan saat menyimpan jawaban. Silakan coba lagi.');
            });
        }

        // Function to navigate between questions (Next/Back)
        async function navigateQuiz(direction) {
            // Cek apakah ada opsi yang dipilih untuk pertanyaan saat ini SEBELUM navigasi ke next
            // Hanya berlaku jika tidak di pertanyaan terakhir dan arahnya 'next'
            if (direction === 'next' && currentQuestionIndex < totalQuestions - 1) {
                const selectedOption = document.querySelector('.option.selected');
                if (!selectedOption) {
                    showErrorMessage('Mohon pilih salah satu jawaban sebelum melanjutkan.');
                    return; // Hentikan navigasi
                }
            }
            
            // Increment/decrement currentQuestionIndex
            let newIndex = currentQuestionIndex;
            if (direction === 'next') {
                newIndex++;
            } else { // 'back'
                newIndex--;
            }

            // Batasi index
            newIndex = Math.max(0, Math.min(newIndex, totalQuestions - 1));
            
            // If navigating to the result page (reached end of quiz)
            if (newIndex === totalQuestions -1 && direction === 'next' && currentQuestionIndex === totalQuestions -1) {
                // If it's the last question and 'next' is pressed, redirect to result
                window.location.href = quizResultUrl;
                return;
            }

            // If we are trying to go back from the first question, do nothing
            if (newIndex < 0) return;


            // Fetch new question data via AJAX
            try {
                const response = await fetch(`${getQuestionDataUrl}?index=${newIndex}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Meskipun GET, tetap sertakan jika perlu
                    }
                });
                const data = await response.json();

                if (response.ok) {
                    currentQuestionIndex = newIndex; // Update the global index
                    selectedAnswerId = data.selected_answer_id; // Update selected answer for next question
                    updateQuizUI(data); // Update UI
                    hideErrorMessage(); // Clear any previous error
                } else {
                    console.error('Error fetching question data:', data.error);
                    showErrorMessage(data.error || 'Gagal memuat pertanyaan. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Network or parsing error:', error);
                showErrorMessage('Terjadi kesalahan jaringan atau server. Mohon periksa koneksi Anda.');
            }
        }

        // Helper functions for error messages
        function showErrorMessage(message) {
            errorMessageArea.innerHTML = `<ul><li>${message}</li></ul>`;
            errorMessageArea.style.display = 'block';
        }

        function hideErrorMessage() {
            errorMessageArea.style.display = 'none';
            errorMessageArea.innerHTML = '';
        }

        // Event Listeners for navigation buttons
        backBtn.addEventListener('click', () => navigateQuiz('back'));
        nextBtn.addEventListener('click', () => navigateQuiz('next'));

        // Initial setup when page loads
        window.onload = function() {
            // Attach listeners for initial options
            attachOptionListeners();
            // Ensure button states are correct on load
            backBtn.disabled = (currentQuestionIndex === 0);
            backBtn.classList.toggle('disabled', (currentQuestionIndex === 0));
        };
    </script>
</body>
</html>