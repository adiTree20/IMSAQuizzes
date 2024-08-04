<!-- ID: 124167 -->
<!-- Quarter 2 Project -->

<!-- Quiz Page Below -->
<!-- This page will be where you take the test. It gives you five random questions to answer and once you click the submit button,
you will be taken to score.php where you will recieve your score. -->

<!DOCTYPE html>
<html id="quizhtml">
    <head>
        <title>Quiz</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&display=swap" rel="stylesheet">
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="quizBody">
        <?php
            // Start the session
            session_start();
        ?>
        <div id="quizLeft">
            <div id="quizContainer">
                <h1 id="quizBigHeader">ISMA<span id="quizBigHeaderChange">Quizzes</span></h1>
                <?php
                    require "config.php";

                    mysqli_select_db($conn, 'ismaquizzes');
                
                    $quizName = $_POST['quizName'];
                    $_SESSION['quizName'] = $quizName;
                    $strippedQuizName = str_replace(' ', '', $quizName);
                    $strippedQuizName = strtolower($strippedQuizName);

                    $email = $_SESSION["email"];
                    $sqlF = "SELECT * FROM score WHERE email='$email'";
                    $resultF = mysqli_query($conn, $sqlF);
                    $rowF = mysqli_fetch_assoc($resultF);

                    if ($rowF["attempts$strippedQuizName"] >= 3) {
                        ?>
                            <script type="text/javascript">
                                window.alert("Sorry, you have exceeded the testing attempts allowed for this quiz. Please try another quiz.");
                                window.location.href='home.php';
                            </script>
                        <?php
                        exit();
                    }

                    echo "<h1 class='quizName'>$quizName</h1>";

                    $sql = "SELECT * FROM quizzes";
                    $result = mysqli_query($conn, $sql);
                    $explanation = "";

                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['quizname'] == $quizName) {
                            $explanation = $row['explanation'];
                        }
                    }

                    echo "<p id='quizExplanation'>$explanation</p>";
                ?>
                <h1 id="quizGL">Good Luck!</h1>
                <img id="quizGLImg" src="goodLuck.jpg" alt="GOOD LUCK!">
            </div>
        </div>

        <div id="quizRightOuter">
            <div id="quizRight">
                <form action="score.php" method="POST">
                    <?php
                        $sql2 = "SELECT * FROM $strippedQuizName";
                        $result2 = mysqli_query($conn, $sql2);
                        $numOfQuestions = mysqli_num_rows($result2);

                        function randomGen($min, $max, $quantity) {
                            $numbers = range($min, $max);
                            shuffle($numbers);
                            return array_slice($numbers, 0, $quantity);
                        }
                        
                        $randomNumbers = randomGen(1,$numOfQuestions,5); //generates 5 unique random numbers
                        sort($randomNumbers);
                        $_SESSION['randomNumbers'] = $randomNumbers;

                        echo "<h1 class='quizName'>$quizName</h1>";
                        $count = 1;
                        $check = 0;

                        while ($row = mysqli_fetch_assoc($result2)) {
                            if ($check < 5 && $count == $randomNumbers[$check]) {
                                echo "<span class='quizCircleNumbers'>&#931" . ($check+2) . "; </span><span class=quizQuestion>" . $row['question'] . "</span><br>";
                                echo "<input type='text' name='answer$check' class='quizInputAnswer' required><br><br>";
                                $check++;
                            }
                            $count++;
                        }
                    ?>
                    <button type="submit" id="quizSubmit" name="quizSubmit">Submit</button><br>
                </form>
            </div>
        </div>
    </body>
</html>