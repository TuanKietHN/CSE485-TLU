<?php
// Đọc và xử lý file câu hỏi
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$quiz_data = [];
$current_question = [];
$question_count = 0;

foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            $quiz_data[] = $current_question;
        }
        $current_question = ['question' => $line, 'options' => [], 'answer' => ''];
        $question_count++;
    } elseif (strpos($line, "ANSWER:") !== false) {
        $current_question['answer'] = trim(substr($line, strpos($line, ":") + 1));
    } else {
        $current_question['options'][] = $line;
    }
}
if (!empty($current_question)) {
    $quiz_data[] = $current_question;
}

// Xử lý form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    $results = [];
    
    foreach ($quiz_data as $index => $question) {
        $question_key = "question" . ($index + 1);
        $user_answer = $_POST[$question_key] ?? '';
        
        if ($user_answer === $question['answer']) {
            $score++;
        }
        
        $results[] = [
            'question' => $question['question'],
            'options' => $question['options'],
            'user_answer' => $user_answer,
            'correct_answer' => $question['answer']
        ];
    }
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kết quả Quiz</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Kết quả của bạn</h2>
                            
                            <!-- Hiển thị điểm -->
                            <div class="text-center mb-4">
                                <div class="display-1 fw-bold <?php echo $score > count($quiz_data)/2 ? 'text-success' : 'text-danger'; ?>">
                                    <?php echo $score; ?>/<?php echo count($quiz_data); ?>
                                </div>
                                <div class="h5 text-muted">
                                    (<?php echo round(($score/count($quiz_data))*100); ?>%)
                                </div>
                            </div>

                            <!-- Chi tiết từng câu -->
                            <div class="accordion mb-4" id="quizResults">
                                <?php foreach ($results as $index => $result): ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed <?php echo $result['user_answer'] === $result['correct_answer'] ? 'bg-success bg-opacity-10' : 'bg-danger bg-opacity-10'; ?>" 
                                                    type="button" data-bs-toggle="collapse" 
                                                    data-bs-target="#collapse<?php echo $index; ?>">
                                                <?php echo $result['question']; ?>
                                                <?php if ($result['user_answer'] === $result['correct_answer']): ?>
                                                    <i class="bi bi-check-circle-fill text-success ms-2"></i>
                                                <?php else: ?>
                                                    <i class="bi bi-x-circle-fill text-danger ms-2"></i>
                                                <?php endif; ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <?php foreach ($result['options'] as $option): ?>
                                                    <?php 
                                                        $option_letter = substr($option, 0, 1);
                                                        $is_user_answer = ($option_letter === $result['user_answer']);
                                                        $is_correct = ($option_letter === $result['correct_answer']);
                                                    ?>
                                                    <div class="mb-2 p-2 rounded <?php 
                                                        if ($is_user_answer && $is_correct) echo 'bg-success bg-opacity-10';
                                                        elseif ($is_user_answer) echo 'bg-danger bg-opacity-10';
                                                        elseif ($is_correct) echo 'bg-success bg-opacity-10';
                                                    ?>">
                                                        <?php echo $option; ?>
                                                        <?php if ($is_user_answer): ?>
                                                        <?php endif; ?>
                                                        <?php if ($is_correct): ?>
                                                            <i class="bi bi-check-circle-fill text-success ms-2"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="text-center">
                                <a href="quiz.php" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-arrow-repeat me-2"></i>Làm lại bài quiz
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .option-label {
            display: block;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .option-label:hover {
            background-color: #f8f9fa;
        }
        .form-check-input:checked + .option-text {
            font-weight: 500;
            color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Bài Quiz</h1>
                        <form method="POST" action="" id="quizForm">
                            <?php foreach ($quiz_data as $index => $question): ?>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <strong><?php echo $question['question']; ?></strong>
                                    </div>
                                    <div class="card-body">
                                        <?php foreach ($question['options'] as $option): ?>
                                            <label class="option-label">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" 
                                                        name="question<?php echo $index + 1; ?>" 
                                                        value="<?php echo substr($option, 0, 1); ?>"
                                                        id="q<?php echo $index + 1; ?>_<?php echo substr($option, 0, 1); ?>">
                                                    <span class="option-text">
                                                        <?php echo $option; ?>
                                                    </span>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                            <div class="text-center">
                                <button type="button" class="btn btn-primary btn-lg px-5" id="submitBtn">
                                    Nộp bài
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xác nhận -->
    <div class="modal fade" id="submitConfirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title">Xác nhận nộp bài</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-4">
                        <i class="bi bi-question-circle text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="mb-3">Bạn chắc chắn muốn nộp bài?</h4>
                    <div id="unansweredWarning" class="alert alert-warning mt-3 d-none">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Bạn còn <span id="unansweredCount">0</span> câu chưa trả lời!
                    </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-arrow-left me-2"></i>Kiểm tra lại
                    </button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">
                        <i class="bi bi-send-fill me-2"></i>Nộp bài
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('quizForm');
            const submitBtn = document.getElementById('submitBtn');
            const confirmSubmitBtn = document.getElementById('confirmSubmit');
            const modal = new bootstrap.Modal(document.getElementById('submitConfirmModal'));
            const unansweredWarning = document.getElementById('unansweredWarning');
            const unansweredCount = document.getElementById('unansweredCount');

            submitBtn.addEventListener('click', function() {
                const totalQuestions = <?php echo count($quiz_data); ?>;
                const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked').length;
                const unanswered = totalQuestions - answeredQuestions;

                if (unanswered > 0) {
                    unansweredCount.textContent = unanswered;
                    unansweredWarning.classList.remove('d-none');
                } else {
                    unansweredWarning.classList.add('d-none');
                }

                modal.show();
            });

            confirmSubmitBtn.addEventListener('click', function() {
                form.submit();
            });
        });
    </script>
</body>
</html>
