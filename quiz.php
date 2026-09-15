<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Login check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "config/db.php";

// Course
$course = $_GET['course'] ?? 'python';

$courseNames = [
    "python" => "Python Programming",
    "web" => "Web Development",
    "database" => "Database Management",
    "cyber" => "Cyber Security"
];

if (!isset($courseNames[$course])) {
    $course = "python";
}

$courseName = $courseNames[$course];


// Questions
$questions = [

    "python" => [
        [
            "q" => "Which language is Python?",
            "options" => [
                "A" => "Programming Language",
                "B" => "Database",
                "C" => "Operating System",
                "D" => "Web Browser"
            ],
            "answer" => "A"
        ],
        [
            "q" => "Which symbol is used for comments in Python?",
            "options" => [
                "A" => "//",
                "B" => "#",
                "C" => "/*",
                "D" => "<!--"
            ],
            "answer" => "B"
        ],
        [
            "q" => "Which function displays output in Python?",
            "options" => [
                "A" => "echo()",
                "B" => "printf()",
                "C" => "print()",
                "D" => "display()"
            ],
            "answer" => "C"
        ],
        [
            "q" => "Which data type stores True or False?",
            "options" => [
                "A" => "String",
                "B" => "Boolean",
                "C" => "Integer",
                "D" => "Float"
            ],
            "answer" => "B"
        ],
        [
            "q" => "Which keyword is used to define a function?",
            "options" => [
                "A" => "function",
                "B" => "define",
                "C" => "def",
                "D" => "fun"
            ],
            "answer" => "C"
        ]
    ],

    "web" => [
        [
            "q" => "What does HTML stand for?",
            "options" => [
                "A" => "Hyper Text Markup Language",
                "B" => "High Text Machine Language",
                "C" => "Hyper Tool Multi Language",
                "D" => "Home Text Markup Language"
            ],
            "answer" => "A"
        ],
        [
            "q" => "Which tag creates the largest heading?",
            "options" => [
                "A" => "<h6>",
                "B" => "<head>",
                "C" => "<h1>",
                "D" => "<heading>"
            ],
            "answer" => "C"
        ],
        [
            "q" => "Which language is used for webpage styling?",
            "options" => [
                "A" => "HTML",
                "B" => "CSS",
                "C" => "PHP",
                "D" => "SQL"
            ],
            "answer" => "B"
        ],
        [
            "q" => "Which language is used for webpage interactivity?",
            "options" => [
                "A" => "JavaScript",
                "B" => "SQL",
                "C" => "CSS",
                "D" => "XML"
            ],
            "answer" => "A"
        ],
        [
            "q" => "Which tag is used to create a hyperlink?",
            "options" => [
                "A" => "<link>",
                "B" => "<a>",
                "C" => "<href>",
                "D" => "<url>"
            ],
            "answer" => "B"
        ]
    ],

    "database" => [
        [
            "q" => "What does SQL stand for?",
            "options" => [
                "A" => "Structured Query Language",
                "B" => "Simple Query Language",
                "C" => "System Query Language",
                "D" => "Standard Question Language"
            ],
            "answer" => "A"
        ],
        [
            "q" => "Which command retrieves data?",
            "options" => [
                "A" => "INSERT",
                "B" => "UPDATE",
                "C" => "SELECT",
                "D" => "DELETE"
            ],
            "answer" => "C"
        ],
        [
            "q" => "Which command adds new data?",
            "options" => [
                "A" => "INSERT",
                "B" => "SELECT",
                "C" => "DROP",
                "D" => "ALTER"
            ],
            "answer" => "A"
        ],
        [
            "q" => "Which key uniquely identifies a record?",
            "options" => [
                "A" => "Foreign Key",
                "B" => "Primary Key",
                "C" => "Normal Key",
                "D" => "Secondary Key"
            ],
            "answer" => "B"
        ],
        [
            "q" => "Which database are we using in this project?",
            "options" => [
                "A" => "MongoDB",
                "B" => "Oracle",
                "C" => "MySQL",
                "D" => "SQLite"
            ],
            "answer" => "C"
        ]
    ],

    "cyber" => [
        [
            "q" => "What does CIA stand for in cybersecurity?",
            "options" => [
                "A" => "Confidentiality, Integrity, Availability",
                "B" => "Computer, Internet, Access",
                "C" => "Cyber, Information, Authentication",
                "D" => "Control, Internet, Availability"
            ],
            "answer" => "A"
        ],
        [
            "q" => "What is phishing?",
            "options" => [
                "A" => "A programming language",
                "B" => "A fraudulent attempt to obtain information",
                "C" => "A database",
                "D" => "A web browser"
            ],
            "answer" => "B"
        ],
        [
            "q" => "Which is a strong password?",
            "options" => [
                "A" => "123456",
                "B" => "password",
                "C" => "abc123",
                "D" => "T9#kL7@pQ2"
            ],
            "answer" => "D"
        ],
        [
            "q" => "What is malware?",
            "options" => [
                "A" => "Malicious Software",
                "B" => "Database Software",
                "C" => "Web Design Tool",
                "D" => "Operating System"
            ],
            "answer" => "A"
        ],
        [
            "q" => "What is a firewall?",
            "options" => [
                "A" => "Programming Language",
                "B" => "Security system that monitors network traffic",
                "C" => "Database",
                "D" => "Web page"
            ],
            "answer" => "B"
        ]
    ]
];


// Submit quiz
$submitted = false;
$score = 0;
$total = 5;
$percentage = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $submitted = true;

    $quiz = $questions[$course];

    foreach ($quiz as $index => $question) {

        $selected = $_POST["q" . $index] ?? "";

        if ($selected === $question["answer"]) {
            $score++;
        }
    }

    $percentage = ($score / $total) * 100;

    // Save result
    $sql = "INSERT INTO quiz_results
            (user_id, course, score, total, percentage)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "isiid",
            $_SESSION['user_id'],
            $courseName,
            $score,
            $total,
            $percentage
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Online Quiz</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f3f4f6;
}

.container {
    width: 90%;
    max-width: 800px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    color: #2563eb;
    margin-bottom: 30px;
}

.question {
    background: #f9fafb;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
}

.question h3 {
    margin-top: 0;
    color: #111827;
}

.option {
    display: block;
    background: white;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #d1d5db;
    border-radius: 7px;
    cursor: pointer;
}

.option:hover {
    background: #eef2ff;
}

.option input {
    margin-right: 10px;
}

.submit-btn {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    font-size: 18px;
    cursor: pointer;
}

.submit-btn:hover {
    background: #1d4ed8;
}

.result {
    text-align: center;
    background: #ecfdf5;
    padding: 30px;
    border-radius: 10px;
}

.result h2 {
    color: #059669;
}

.btn {
    display: inline-block;
    padding: 11px 18px;
    margin: 8px;
    background: #2563eb;
    color: white;
    text-decoration: none;
    border-radius: 6px;
}

.back {
    background: #6b7280;
}

</style>

</head>

<body>

<div class="container">

<h1>📝 <?php echo htmlspecialchars($courseName); ?> Quiz</h1>


<?php if (!$submitted): ?>

<form method="POST" action="quiz.php?course=<?php echo urlencode($course); ?>">

<?php foreach ($questions[$course] as $index => $question): ?>

<div class="question">

<h3>
<?php echo ($index + 1) . ". " . htmlspecialchars($question["q"]); ?>
</h3>

<?php foreach ($question["options"] as $key => $option): ?>

<label class="option">

<input
    type="radio"
    name="q<?php echo $index; ?>"
    value="<?php echo $key; ?>"
    required
>

<?php echo $key . ". " . htmlspecialchars($option); ?>

</label>

<?php endforeach; ?>

</div>

<?php endforeach; ?>


<button type="submit" class="submit-btn">
    Submit Quiz
</button>

</form>


<?php else: ?>

<div class="result">

<h2>🎉 Quiz Completed!</h2>

<h3>
Score: <?php echo $score; ?> / <?php echo $total; ?>
</h3>

<h3>
Percentage: <?php echo number_format($percentage, 2); ?>%
</h3>

<a href="result.php" class="btn">
    View My Results
</a>

<a href="course.php" class="btn back">
    Back to Courses
</a>

</div>

<?php endif; ?>

</div>

</body>

</html>