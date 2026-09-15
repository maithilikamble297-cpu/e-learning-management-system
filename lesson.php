<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$course = $_GET['course'] ?? '';
$lesson = intval($_GET['lesson'] ?? 1);

$lessonData = [

    "python" => [
        "name" => "Python Programming",
        "lessons" => [
            1 => [
                "title" => "Introduction to Python",
                "description" => "Learn what Python is, its features and where Python is used.",
                "video" => "https://www.youtube.com/embed/kqtD5dpn9C8"
            ],
            2 => [
                "title" => "Variables and Data Types",
                "description" => "Learn variables, strings, integers, floats and basic data types.",
                "video" => "https://www.youtube.com/embed/cQT33yu9pY8"
            ],
            3 => [
                "title" => "Operators",
                "description" => "Learn arithmetic, comparison and logical operators in Python.",
                "video" => "https://www.youtube.com/embed/v5MR5JnKcZI"
            ],
            4 => [
                "title" => "Conditional Statements",
                "description" => "Learn if, elif and else statements.",
                "video" => "https://www.youtube.com/embed/PqFKRqpHrjw"
            ],
            5 => [
                "title" => "Loops",
                "description" => "Learn for loop and while loop with examples.",
                "video" => "https://www.youtube.com/embed/OnDr4J2UXSA"
            ],
            6 => [
                "title" => "Functions",
                "description" => "Learn how to create and use functions in Python.",
                "video" => "https://www.youtube.com/embed/u-OmVr_fT4s"
            ],
            7 => [
                "title" => "Lists and Dictionaries",
                "description" => "Learn Python collections including lists and dictionaries.",
                "video" => "https://www.youtube.com/embed/ohCDWZgNIU0"
            ],
            8 => [
                "title" => "Python Revision",
                "description" => "Revise important Python concepts learned in previous lessons.",
                "video" => "https://www.youtube.com/embed/rfscVS0vtbw"
            ]
        ]
    ],

    "web" => [
        "name" => "Web Development",
        "lessons" => [
            1 => [
                "title" => "Introduction to HTML",
                "description" => "Learn the basics of HTML and structure of a web page.",
                "video" => "https://www.youtube.com/embed/qz0aGYrrlhU"
            ],
            2 => [
                "title" => "HTML Tags and Forms",
                "description" => "Learn important HTML tags, forms and input elements.",
                "video" => "https://www.youtube.com/embed/kUMe1FH4CHE"
            ],
            3 => [
                "title" => "Introduction to CSS",
                "description" => "Learn how CSS is used to style web pages.",
                "video" => "https://www.youtube.com/embed/1Rs2ND1ryYc"
            ],
            4 => [
                "title" => "CSS Selectors",
                "description" => "Learn CSS selectors, properties and styling.",
                "video" => "https://www.youtube.com/embed/l1mER1bV0N0"
            ],
            5 => [
                "title" => "JavaScript Basics",
                "description" => "Learn the basic concepts of JavaScript.",
                "video" => "https://www.youtube.com/embed/W6NZfCO5SIk"
            ],
            6 => [
                "title" => "Introduction to PHP",
                "description" => "Learn PHP syntax, variables and basic programming.",
                "video" => "https://www.youtube.com/embed/OK_JCtrrv-c"
            ],
            7 => [
                "title" => "PHP and MySQL",
                "description" => "Learn how PHP applications connect with MySQL databases.",
                "video" => "https://www.youtube.com/embed/7S_tz1z_5bA"
            ],
            8 => [
                "title" => "Web Project",
                "description" => "Understand how HTML, CSS, PHP and MySQL work together.",
                "video" => "https://www.youtube.com/embed/3JluqTojuME"
            ]
        ]
    ],

    "database" => [
        "name" => "Database Management",
        "lessons" => [
            1 => [
                "title" => "Introduction to Database",
                "description" => "Learn database concepts and why databases are important.",
                "video" => "https://www.youtube.com/embed/wR0jg0eQsZA"
            ],
            2 => [
                "title" => "MySQL Basics",
                "description" => "Learn the basics of MySQL database management system.",
                "video" => "https://www.youtube.com/embed/7S_tz1z_5bA"
            ],
            3 => [
                "title" => "CREATE and INSERT",
                "description" => "Learn how to create tables and insert records.",
                "video" => "https://www.youtube.com/embed/7S_tz1z_5bA"
            ],
            4 => [
                "title" => "SELECT and WHERE",
                "description" => "Learn how to retrieve and filter data using SQL.",
                "video" => "https://www.youtube.com/embed/7S_tz1z_5bA"
            ],
            5 => [
                "title" => "UPDATE and DELETE",
                "description" => "Learn how to update and delete records from a table.",
                "video" => "https://www.youtube.com/embed/7S_tz1z_5bA"
            ],
            6 => [
                "title" => "Primary and Foreign Keys",
                "description" => "Learn keys and relationships between database tables.",
                "video" => "https://www.youtube.com/embed/ztHopE5Wnpc"
            ],
            7 => [
                "title" => "SQL JOIN",
                "description" => "Learn how to combine data from multiple tables using JOIN.",
                "video" => "https://www.youtube.com/embed/9yeOJ0ZMUYw"
            ],
            8 => [
                "title" => "Database Project",
                "description" => "Apply database concepts to a simple project.",
                "video" => "https://www.youtube.com/embed/7S_tz1z_5bA"
            ]
        ]
    ],

    "cyber" => [
        "name" => "Cyber Security",
        "lessons" => [
            1 => [
                "title" => "Introduction to Cyber Security",
                "description" => "Learn what cyber security is and why it is important.",
                "video" => "https://www.youtube.com/embed/inWWhr5tnEA"
            ],
            2 => [
                "title" => "Common Cyber Threats",
                "description" => "Learn about common cyber threats and how to stay safe.",
                "video" => "https://www.youtube.com/embed/Dk-ZqQ-bzy4"
            ],
            3 => [
                "title" => "Password Security",
                "description" => "Learn how to create strong passwords and protect accounts.",
                "video" => "https://www.youtube.com/embed/aEmF3Iylvr4"
            ],
            4 => [
                "title" => "Phishing Awareness",
                "description" => "Learn how phishing attacks work and how to identify suspicious messages.",
                "video" => "https://www.youtube.com/embed/XBkzBrXlle0"
            ],
            5 => [
                "title" => "Malware Basics",
                "description" => "Learn about malware and basic protection methods.",
                "video" => "https://www.youtube.com/embed/n8mbzU0X2nQ"
            ],
            6 => [
                "title" => "Network Security Basics",
                "description" => "Learn basic concepts of network security.",
                "video" => "https://www.youtube.com/embed/qiQR5rTSshw"
            ],
            7 => [
                "title" => "Safe Internet Practices",
                "description" => "Learn safe and responsible internet practices.",
                "video" => "https://www.youtube.com/embed/yrln8nyVBLU"
            ],
            8 => [
                "title" => "Cyber Security Revision",
                "description" => "Revise important cyber security concepts.",
                "video" => "https://www.youtube.com/embed/inWWhr5tnEA"
            ]
        ]
    ],

    "java" => [
        "name" => "Java Programming",
        "lessons" => [
            1 => [
                "title" => "Introduction to Java",
                "description" => "Learn Java and its basic features.",
                "video" => "https://www.youtube.com/embed/eIrMbAQSU34"
            ],
            2 => [
                "title" => "Variables and Data Types",
                "description" => "Learn variables and data types in Java.",
                "video" => "https://www.youtube.com/embed/eIrMbAQSU34"
            ],
            3 => [
                "title" => "Operators",
                "description" => "Learn different operators in Java.",
                "video" => "https://www.youtube.com/embed/eIrMbAQSU34"
            ],
            4 => [
                "title" => "Conditional Statements",
                "description" => "Learn if, else and switch statements.",
                "video" => "https://www.youtube.com/embed/eIrMbAQSU34"
            ],
            5 => [
                "title" => "Loops",
                "description" => "Learn for, while and do-while loops.",
                "video" => "https://www.youtube.com/embed/eIrMbAQSU34"
            ],
            6 => [
                "title" => "Methods",
                "description" => "Learn methods and method parameters.",
                "video" => "https://www.youtube.com/embed/eIrMbAQSU34"
            ],
            7 => [
                "title" => "Classes and Objects",
                "description" => "Learn the basics of object-oriented programming.",
                "video" => "https://www.youtube.com/embed/eIrMbAQSU34"
            ],
            8 => [
                "title" => "Java Revision",
                "description" => "Revise important Java programming concepts.",
                "video" => "https://www.youtube.com/embed/eIrMbAQSU34"
            ]
        ]
    ],

    "c" => [
        "name" => "C Programming",
        "lessons" => [
            1 => [
                "title" => "Introduction to C",
                "description" => "Learn the basics of C programming.",
                "video" => "https://www.youtube.com/embed/KJgsSFOSQv0"
            ],
            2 => [
                "title" => "Variables and Data Types",
                "description" => "Learn variables and data types in C.",
                "video" => "https://www.youtube.com/embed/KJgsSFOSQv0"
            ],
            3 => [
                "title" => "Operators",
                "description" => "Learn operators used in C programming.",
                "video" => "https://www.youtube.com/embed/KJgsSFOSQv0"
            ],
            4 => [
                "title" => "Conditional Statements",
                "description" => "Learn if, else and switch statements.",
                "video" => "https://www.youtube.com/embed/KJgsSFOSQv0"
            ],
            5 => [
                "title" => "Loops",
                "description" => "Learn loops and repetition in C.",
                "video" => "https://www.youtube.com/embed/KJgsSFOSQv0"
            ],
            6 => [
                "title" => "Functions",
                "description" => "Learn functions and parameters in C.",
                "video" => "https://www.youtube.com/embed/KJgsSFOSQv0"
            ],
            7 => [
                "title" => "Arrays",
                "description" => "Learn one-dimensional and basic arrays.",
                "video" => "https://www.youtube.com/embed/KJgsSFOSQv0"
            ],
            8 => [
                "title" => "C Programming Revision",
                "description" => "Revise important C programming concepts.",
                "video" => "https://www.youtube.com/embed/KJgsSFOSQv0"
            ]
        ]
    ]
];


/* CHECK COURSE */

if (!isset($lessonData[$course])) {
    die("Invalid course selected.");
}


/* CHECK LESSON */

if (!isset($lessonData[$course]["lessons"][$lesson])) {
    die("Invalid lesson selected.");
}


$courseName = $lessonData[$course]["name"];

$currentLesson = $lessonData[$course]["lessons"][$lesson];

$totalLessons = count($lessonData[$course]["lessons"]);

$previousLesson = $lesson - 1;
$nextLesson = $lesson + 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
<?php echo htmlspecialchars($currentLesson["title"]); ?>
- E-Learning LMS
</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;

    font-family: Arial, sans-serif;

    background: #f3f4f6;

    color: #1f2937;
}


/* NAVBAR */

.navbar {

    background: #2563eb;

    color: white;

    padding: 16px 35px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    flex-wrap: wrap;
}

.logo {

    font-size: 23px;

    font-weight: bold;
}

.navbar a {

    color: white;

    text-decoration: none;

    margin-left: 20px;
}

.navbar a:hover {

    text-decoration: underline;
}


/* MAIN */

.container {

    width: 90%;

    max-width: 1000px;

    margin: 40px auto;
}


/* COURSE TITLE */

.course-title {

    background: #2563eb;

    color: white;

    padding: 25px;

    border-radius: 12px;

    margin-bottom: 25px;
}

.course-title h1 {

    margin: 0 0 8px 0;
}

.course-title p {

    margin: 0;

    opacity: 0.9;
}


/* LESSON CARD */

.lesson-card {

    background: white;

    padding: 30px;

    border-radius: 12px;

    box-shadow:
        0 4px 15px rgba(0,0,0,0.08);

    margin-bottom: 25px;
}

.lesson-card h2 {

    color: #2563eb;

    margin-top: 0;
}

.description {

    color: #4b5563;

    font-size: 17px;

    line-height: 1.7;
}


/* VIDEO */

.video-section {

    background: white;

    padding: 30px;

    border-radius: 12px;

    box-shadow:
        0 4px 15px rgba(0,0,0,0.08);

    margin-bottom: 25px;
}

.video-section h2 {

    color: #2563eb;

    margin-top: 0;
}

.video-container {

    position: relative;

    width: 100%;

    padding-bottom: 56.25%;

    height: 0;

    overflow: hidden;

    border-radius: 10px;
}

.video-container iframe {

    position: absolute;

    top: 0;

    left: 0;

    width: 100%;

    height: 100%;

    border: 0;
}


/* STUDY MATERIAL */

.material {

    background: white;

    padding: 30px;

    border-radius: 12px;

    box-shadow:
        0 4px 15px rgba(0,0,0,0.08);

    margin-bottom: 25px;
}

.material h2 {

    color: #2563eb;

    margin-top: 0;
}

.material ul {

    line-height: 2;

    padding-left: 25px;
}


/* NAVIGATION */

.lesson-navigation {

    display: flex;

    justify-content: space-between;

    gap: 15px;

    margin-top: 25px;

    flex-wrap: wrap;
}

.btn {

    display: inline-block;

    padding: 12px 20px;

    background: #2563eb;

    color: white;

    text-decoration: none;

    border-radius: 7px;
}

.btn:hover {

    background: #1d4ed8;
}

.disabled {

    background: #9ca3af;

    pointer-events: none;
}


/* PROGRESS */

.progress-box {

    background: white;

    padding: 20px;

    border-radius: 10px;

    margin-bottom: 25px;

    box-shadow:
        0 4px 15px rgba(0,0,0,0.06);
}

.progress-text {

    margin-bottom: 10px;

    font-weight: bold;
}

.progress {

    width: 100%;

    height: 12px;

    background: #e5e7eb;

    border-radius: 20px;

    overflow: hidden;
}

.progress-bar {

    height: 100%;

    background: #2563eb;

    width:
    <?php echo ($lesson / $totalLessons) * 100; ?>%;
}

footer {

    margin-top: 50px;

    background: #111827;

    color: white;

    text-align: center;

    padding: 20px;
}


/* MOBILE */

@media (max-width: 600px) {

    .navbar {

        padding: 15px 20px;
    }

    .navbar a {

        margin-left: 10px;

        font-size: 14px;
    }

    .container {

        width: 94%;
    }

    .lesson-card,
    .video-section,
    .material {

        padding: 20px;
    }

}

</style>

</head>


<body>


<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">
        📚 E-Learning LMS
    </div>

    <div>

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="course.php">
            Courses
        </a>

        <a href="result.php">
            My Results
        </a>

        <a href="logout.php">
            Logout
        </a>

    </div>

</div>


<!-- MAIN -->

<div class="container">


    <!-- COURSE -->

    <div class="course-title">

        <h1>
            <?php echo htmlspecialchars($courseName); ?>
        </h1>

        <p>
            Lesson <?php echo $lesson; ?>
            of <?php echo $totalLessons; ?>
        </p>

    </div>


    <!-- PROGRESS -->

    <div class="progress-box">

        <div class="progress-text">

            Course Progress:
            <?php echo round(($lesson / $totalLessons) * 100); ?>%

        </div>

        <div class="progress">

            <div class="progress-bar"></div>

        </div>

    </div>


    <!-- LESSON -->

    <div class="lesson-card">

        <h2>
            📖 Lesson <?php echo $lesson; ?>:
            <?php echo htmlspecialchars($currentLesson["title"]); ?>
        </h2>

        <p class="description">

            <?php
            echo htmlspecialchars(
                $currentLesson["description"]
            );
            ?>

        </p>

    </div>


    <!-- VIDEO LEARNING -->

    <div class="video-section">

        <h2>
            🎥 Video Learning
        </h2>

        <p>
            Watch the educational video to understand
            this lesson better.
        </p>

        <div class="video-container">

            <iframe
                src="<?php echo htmlspecialchars($currentLesson["video"]); ?>"
                title="Educational Video"
                allowfullscreen>
            </iframe>

        </div>

    </div>


    <!-- STUDY MATERIAL -->

    <div class="material">

        <h2>
            📚 Study Material
        </h2>

        <ul>

            <li>
                Read the lesson description carefully.
            </li>

            <li>
                Watch the complete educational video.
            </li>

            <li>
                Practice the concepts covered in this lesson.
            </li>

            <li>
                Revise important points before moving
                to the next lesson.
            </li>

            <li>
                Take the course quiz after completing
                the lessons.
            </li>

        </ul>

    </div>


    <!-- NAVIGATION -->

    <div class="lesson-navigation">


        <?php if ($previousLesson >= 1) { ?>

            <a
                href="lesson.php?course=<?php echo urlencode($course); ?>&lesson=<?php echo $previousLesson; ?>"
                class="btn"
            >
                ← Previous Lesson
            </a>

        <?php } else { ?>

            <span class="btn disabled">
                ← Previous Lesson
            </span>

        <?php } ?>


        <?php if ($nextLesson <= $totalLessons) { ?>

            <a
                href="lesson.php?course=<?php echo urlencode($course); ?>&lesson=<?php echo $nextLesson; ?>"
                class="btn"
            >
                Next Lesson →
            </a>

        <?php } else { ?>

            <a
                href="quiz.php?course=<?php echo urlencode($course); ?>"
                class="btn"
            >
                🎯 Take Quiz
            </a>

        <?php } ?>

    </div>


    <div style="text-align:center; margin-top:25px;">

        <a
            href="course.php"
            class="btn"
        >
            ← Back to Courses
        </a>

    </div>


</div>


<footer>

    <p>
        © 2026 E-Learning Management System
    </p>

</footer>


</body>

</html>