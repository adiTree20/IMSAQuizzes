<!-- ID: 124167 -->
<!-- Quarter 2 Project -->

<!-- New Quiz Page Below -->
<!-- In this page, you can create a quiz of your own choice. You can add questions too if you would like by clicking the button 
on the left. The new quiz will show up on the home.php page once you click submit. -->

<!DOCTYPE html>
<html id="newQuizhtml">
    <head>
        <title>New Quiz</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&display=swap" rel="stylesheet">
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="newQuizBody">
        <?php
            // Start the session
            session_start();

            require "config.php";

            mysqli_select_db($conn, 'ismaquizzes');

            
            $count = 1;
            $scriptCount = 6;
        ?>
        <script type="text/javascript">var scriptCount = "<?= $scriptCount ?>";</script>
        <div id="newQuizLeft">
            <div id="newQuizContainer">
                <h1 id="newQuizBigHeader">ISMA<span id="newQuizBigHeaderChange">Quizzes</span></h1><br>
                <button type="submit" id="newQuizCreateQuestion" name="newQuestionSubmit" onclick="nqCreateNewQuestion()">Create New Question</button>
            </div>
        </div>

        <div id="newQuizRightOuter">
            <div id="newQuizRight">
                <h1 class='newQuizName'>Create a Quiz</h1>

                <?php
                    $check = 0;
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <span class="newQuizReq">You must have at least FIVE proper questions and answers</span><br>
                    <span class="newQuizReq">Please DO NOT use quotation marks</span><br><br><hr><br>
                    <span class="newQuizQuestion">Title: </span><input type='text' id='newQuizTitle' name='title' required><br><br>
                    <span class="newQuizQuestion">Description: </span><textarea type='text' id='newQuizExplanation' name='explanation' required></textarea><br><br><hr><br>

                    <span class="newQuizQuestion">Links to course material: </span><br><br>
                    <span class="newQuizQuestion">Link 1: </span><input type='text' id='newQuizLinkOne' name='linkone' required></input><br>
                    <span class="newQuizQuestion">Link 2: </span><input type='text' id='newQuizLinkTwo' name='linktwo' required></input><br>
                    <span class="newQuizQuestion">Link 3: </span><input type='text' id='newQuizLinkThree' name='linkthree' required></input><br><br><hr><br>

                    <?php
                        while ($count <= 5) {
                            echo "<span class='newQuizQuestion'>Question </span><span class='newQuizCircleNumbers'>&#93" . ($check+12) . "; </span><br>";
                            echo "<textarea type='text' name='question$count' class='newQuizInputQuestion' required></textarea><br>";
                            echo "<span class='newQuizQuestion'>Answer </span><span class='newQuizCircleNumbers'>&#93" . ($check+12) . "; </span><br>";
                            echo "<textarea type='text' name='answer$count' class='newQuizInputAnswer' required></textarea><br><br><hr><br>";
                            $count++;
                            $check++;
                        }
                    ?>

                    <div id="extraQuestions"></div>
                    <button type='submit' id='newQuizSubmit' name='newQuizSubmit'>Submit</button><br><br>

                    <?php
                        if (isset($_POST['newQuizSubmit'])) {
                            
                            $title = $_POST['title'];
                            $strippedTitle = str_replace(' ', '', $title);
                            $strippedTitle = strtolower($strippedTitle);

                            $explanation = $_POST['explanation'];

                            $sql = "INSERT INTO quizzes (quizname, explanation) VALUES ('$title', '$explanation')";
                            $sql2 = "SELECT * FROM quizzes";
                            $result = mysqli_query($conn, $sql2);
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['quizname'] == "$title") {
                                    break;
                                }
                                $count++;
                            }
                            if (mysqli_num_rows($result) == $count) {
                                mysqli_query($conn, $sql);

                                $linkone = $_POST['linkone'];
                                $linktwo = $_POST['linktwo'];
                                $linkthree = $_POST['linkthree'];

                                $sql6 = "INSERT INTO links (quizname, linkone, linktwo, linkthree) VALUES ('$title', '$linkone', '$linktwo', '$linkthree')";
                                mysqli_query($conn, $sql6);
                            }
                            else {
                                ?>
                                <script type="text/javascript">
                                    window.alert("Please type in a different title since the current title is already used.");
                                </script>
                                <?php
                            }

                            $sql3 = "CREATE TABLE IF NOT EXISTS $strippedTitle(
                                question VARCHAR(200),
                                answer VARCHAR(200)
                                )";

                            error_reporting(0);
                            ini_set('display_errors', 0);

                            if (mysqli_query($conn, $sql3)) {

                                $sql4 = "INSERT INTO $strippedTitle (question, answer) VALUES ";
                                $count = 1;

                                while ($count <= 20) {
                                    $question = $_POST["question$count"];
                                    if ($question == null) {
                                        break;
                                    }
                                    $answer = $_POST["answer$count"];
                                
                                    $line = "('$question', '$answer'), ";
                                    $sql4 = $sql4 . $line;

                                    $count++;
                                }

                                $sql4 = rtrim($sql4, ", ");

                                mysqli_query($conn, $sql4);
                            }
                            else {
                                echo "Error creating table: " . mysqli_error($conn);
                            }

                            $sql5 = "ALTER TABLE score
                            ADD highscore$strippedTitle INT(10),
                            ADD attempts$strippedTitle INT(10)";

                            if (mysqli_query($conn, $sql5)) {
                                // echo "Table 'information' created successfully";
                            }
                            else {
                                // echo "Error creating table: " . mysqli_error($conn);
                            }

                            ?>
                                <script type="text/javascript">
                                    window.location.href='home.php';
                                </script>
                            <?php
                        }
                    ?>
                </form>
                
            </div>
        </div>
            
    </body>
</html>