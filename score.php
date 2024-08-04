<!-- ID: 124167 -->
<!-- Quarter 2 Project -->

<!-- Score Page Below -->
<!-- This page will calculate the score you recieve after filling out the test on quiz.php. If you score a 3/5 or less, it
will provide you with some links to help you study for your next attempt. -->

<!DOCTYPE html>
<html id="scorehtml">
    <head>
        <title>Score</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&display=swap" rel="stylesheet">
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="scoreBody">
        <?php
            // Start the session
            session_start();
        ?>
        <div id="scoreLeft">
            <div id="scoreContainer">
                <h1 id="scoreBigHeader">ISMA<span id="scoreBigHeaderChange">Quizzes</span></h1>
                <?php
                    require "config.php";

                    mysqli_select_db($conn, 'ismaquizzes');
                
                    $quizName = $_SESSION['quizName'];
                    $strippedQuizName = str_replace(' ', '', $quizName);
                    $strippedQuizName = strtolower($strippedQuizName);

                    echo "<h1 class='scoreName'>$quizName</h1>";

                    $sql = "SELECT * FROM quizzes";
                    $result = mysqli_query($conn, $sql);
                    $explanation = "";

                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['quizname'] == $quizName) {
                            $explanation = $row['explanation'];
                        }
                    }

                    echo "<p id='scoreExplanation'>$explanation</p>";
                ?>
            </div>
        </div>

        <div id="scoreRightOuter">
            <div id="scoreRight">                
                <form action="home.php" method="POST">
                    <?php
                        if (isset($_POST['quizSubmit'])) {
                            $sql2 = "SELECT * FROM $strippedQuizName";
                            $result2 = mysqli_query($conn, $sql2);

                            $randomNumbers = $_SESSION['randomNumbers'];
                            
                            $count = 1;
                            $check = 0;
                            $score = 0;

                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                if ($check < 5 && $count == $randomNumbers[$check]) {
                                    $answer = $_POST["answer$check"];
                                    if ($row2['answer'] == $answer) {
                                        $score++;
                                    }
                                    $check++;
                                }
                                $count++;
                            }

                            $sql4 = "SELECT * FROM links WHERE quizname='$quizName'";
                            $result4 = mysqli_query($conn, $sql4);
                            $row4 = mysqli_fetch_assoc($result4);

                            echo "<br><h1>You got $score/5 correct<br></h1><br>";
                            if ($score <= 1) {
                                echo "<h2>Try again next time! Make sure to prepare!</h2><br>";
                                echo "<h3>Make sure to check out these links to study before taking the test again:</h3>";
                                echo "<h3>Link One: <a href='" . $row4['linkone']  . "' target='_blank'>" . $row4['linkone'] . "</a></h3>";
                                echo "<h3>Link Two: <a href='" . $row4['linktwo']  . "' target='_blank'>" . $row4['linktwo'] . "</a></h3>";
                                echo "<h3>Link Three: <a href='" . $row4['linkthree']  . "' target='_blank'>" . $row4['linkthree'] . "</a></h3>";
                            }
                            else if ($score < 4 && $score > 1) {
                                echo "<h2>Not bad, but could be better! Try again!</h2>";
                                echo "<h3>You might want to check out the following links to study before your next attempt: </h3>";
                                echo "<h3>Link One: <a href='" . $row4['linkone']  . "' target='_blank'>" . $row4['linkone'] . "</a></h3>";
                                echo "<h3>Link Two: <a href='" . $row4['linktwo']  . "' target='_blank'>" . $row4['linktwo'] . "</a></h3>";
                                echo "<h3>Link Three: <a href='" . $row4['linkthree']  . "' target='_blank'>" . $row4['linkthree'] . "</a></h3>";
                            }
                            else {
                                echo "<h2>Wow, you are awesome! No need to take this test again!</h2>";
                            }

                            $email = $_SESSION["email"];
                            $sql3 = "SELECT * FROM score WHERE email='$email'";
                            $result3 = mysqli_query($conn, $sql3);
                            $row3 = mysqli_fetch_assoc($result3);

                            $attempts = $row3["attempts$strippedQuizName"];
                            $attempts++;

                            if ($row3["attempts$strippedQuizName"] == 0) {
                                mysqli_query($conn, "UPDATE score SET attempts$strippedQuizName='1' WHERE email='$email'");
                            }
                            else {
                                mysqli_query($conn, "UPDATE score SET attempts$strippedQuizName='$attempts' WHERE email='$email'");
                            }

                            if ($row3["highscore$strippedQuizName"] < $score) {
                                mysqli_query($conn, "UPDATE score SET highscore$strippedQuizName='$score' WHERE email='$email'");
                            }
                        }
                        ?>
                    <br><br><button type="submit" id="scoreSubmit" name="scoreSubmit">Go Back</button><br>
                </form>
            </div>
        </div>
    </body>
</html>