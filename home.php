<!-- ID: 124167 -->
<!-- Quarter 2 Project -->

<!-- Home Page Below -->
<!-- This page is the home page where you can locate all the different quizzes available. You may also create your own quiz by 
clicking the button on the bottom left. If you hover over your name in the top left of the screen, you should see a dropdown
menu which will take you to edit.php where you can change and update your profile. -->

<!DOCTYPE html>
<html id="homehtml">
    <head>
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&display=swap" rel="stylesheet">
        <script src="script.js"></script>
        <?php
            // Start the session
            session_start();
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="homeBody">
        <div id="homeLeft">
            <div id="homeContainer">
                <h1 id="homeBigHeader">ISMA<span id="homeBigHeaderChange">Quizzes</span></h1>

                <?php
                    require "config.php";
                    mysqli_select_db($conn, 'ismaquizzes');
                    $email = $_SESSION["email"];

                    $sql12 = "SELECT * FROM account WHERE email='$email'";
                    $result12 = mysqli_query($conn, $sql12);
                    $row12 = mysqli_fetch_assoc($result12);
                    $id = $row12['id'];
                    echo "<h1 id='homeWelcome'>Welcome, <div id='homeDropDown'><span id='homeWelcomeName'>" . $_SESSION["fname"] .  "</span!><div id='homeDropDownContent'><a href='edit.php?id=$id'>Edit Profile</a></div></div></h1>";
                ?>
                    
                <h3 id="homeInfo">To the right are various different quizzes for you to take! Scroll down if possible, look at each topic, and choose one that interests you the most!</h3><br><br>
                <div id="homeCreateQuiz">
                    <form action="newQuiz.php" method="POST">
                        <h2 id="homeCreateQuizTitle">Want to create your own quiz?</h2>
                        <button id="homeCreateQuizButton">Click Here!</button>
                    </form><br><br>
                </div><br><br><br>

                <form action="signIn.php" method="POST">
                    <button id="homeSO">Sign Out</button>
                </form>
            </div>
        </div>

        <div id="homeRight">
            <table id="homeContainer2"></table>
        </div>

        <?php
            $sql2 = "CREATE TABLE IF NOT EXISTS MARVEL(
                question VARCHAR(200),
                answer VARCHAR(200)
                )";
            
            if (mysqli_query($conn, $sql2)) {
                // echo "Table 'information' created successfully";
            }
            else {
                // echo "Error creating table: " . mysqli_error($conn);
            }

            $sql13 = "CREATE TABLE IF NOT EXISTS simplemath(
                question VARCHAR(200),
                answer VARCHAR(200)
                )";
            
            if (mysqli_query($conn, $sql13)) {
                // echo "Table 'information' created successfully";
            }
            else {
                // echo "Error creating table: " . mysqli_error($conn);
            }

            $sql6 = "INSERT INTO MARVEL (question, answer) VALUES ('Who made Captain America’s shield?', 'Howard Stark'), 
            ('Unlike the comics, who created Ultron in Avengers: Age of Ultron?', 'Tony Stark'), 
            ('Which beloved comic book writer cameoed in every Marvel film up to Avengers: Endgame?', 'Stan Lee'), 
            ('Who is the arch-nemesis of crime-fighting vigilante Daredevil?', 'Kingpin'), 
            ('What is Captain America’s shield made out of?', 'Vibranium'), 
            ('Which infamous aquatic bird has made cameo appearances in Guardians of the Galaxy Vol. 1 and 2?', 'Howard the Duck'), 
            ('What is Black Widow’s real name?', 'Natasha Romanoff'), 
            ('On what planet was the Soul Stone hidden in Infinity War?', 'Vormir'), 
            ('Which former Doctor Who companion plays cyborg assassin Nebula?', 'Karen Gillan'), 
            ('What was the final film in Marvel Studios’ “Phase Three”?', 'Spider-Man: Far From Home'), 
            ('Which Marvel film did Kenneth Branagh direct?', 'Thor'), 
            ('Which Hollywood A-lister made a cameo in Thor: Ragnarok playing Loki in an Asgardian play?', 'Matt Damon'), 
            ('In which film’s post-credit scene did Thanos first appear?', 'The Avengers'), 
            ('Director Taika Waititi also plays which comedic Thor: Ragnarok character?', 'Korg'), 
            ('What is the name of Bruce Banner’s love interest in The Incredible Hulk?', 'Betty Ross'), 
            ('Who was the first female superhero to appear in the title of an MCU film?', 'Wasp'), 
            ('What is the name of Black Panther’s home country?', 'Wakanda'), 
            ('What species is Loki revealed to be?', 'Frost Giant'), 
            ('What country does Wanda Maximoff come from?', 'Sokovia'), 
            ('What is the name of the organisation revealed to have taken over S.H.I.E.L.D. in Captain America: The Winter Soldier?', 'HYDRA')";
            
            $sql7 = "SELECT * FROM MARVEL";
            $result2 = mysqli_query($conn, $sql7);
            if (mysqli_num_rows($result2) != 20) {
                mysqli_query($conn, $sql6);
            }

            $sql14 = "INSERT INTO simplemath (question, answer) VALUES ('6+4', '10'), 
            ('5-3', '2'),
            ('8-2', '6'),
            ('3*4', '12'),
            ('9*8', '72'),
            ('4/2', '2'),
            ('15*10', '150'),
            ('36/6', '6'),
            ('3*9', '27'),
            ('7*8', '56'),
            ('15/5', '3'),
            ('30-3', '27'),
            ('90/9', '10'),
            ('18*3', '54'),
            ('17*5', '85'),
            ('99/11', '9'),
            ('21+5', '26'),
            ('43+21', '64'),
            ('9*19', '171'),
            ('81-27', '54')";

            $sql15 = "SELECT * FROM simplemath";
            $result15 = mysqli_query($conn, $sql15);
            if (mysqli_num_rows($result15) != 20) {
                mysqli_query($conn, $sql14);
            }

            $sql8 = "ALTER TABLE score
            ADD highscoremarvel INT(10),
            ADD attemptsmarvel INT(10)";

            if (mysqli_query($conn, $sql8)) {
                // echo "Table 'information' created successfully";
            }
            else {
                // echo "Error creating table: " . mysqli_error($conn);
            }

            $sql16 = "ALTER TABLE score
            ADD highscoresimplemath INT(10),
            ADD attemptssimplemath INT(10)";

            if (mysqli_query($conn, $sql16)) {
                // echo "Table 'information' created successfully";
            }
            else {
                // echo "Error creating table: " . mysqli_error($conn);
            }

            $sql9 = "CREATE TABLE IF NOT EXISTS links (
                quizname VARCHAR(100),
                linkone VARCHAR(600),
                linktwo VARCHAR(600),
                linkthree VARCHAR(600)
                )";
                
            if (mysqli_query($conn, $sql9)) {
                // echo "Table 'information' created successfully";
            }
            else {
                // echo "Error creating table: " . mysqli_error($conn);
            }

            $sql10 = "INSERT INTO links (quizname, linkone, linktwo, linkthree) VALUES ('MARVEL', 'https://www.marvel.com/explore', 'https://www.thisisbarry.com/film/all-marvel-movies-explained-in-order-of-story-timeline/', 'https://www.fanbyte.com/trending/complete-marvel-movie-timeline/')";
            
            $sql11 = "SELECT * FROM links";
            $result3 = mysqli_query($conn, $sql11);
            $count3 = 0;
            while ($row3 = mysqli_fetch_assoc($result3)) {
                if ($row3['quizname'] == 'MARVEL') {
                    break;
                }
                $count3++;
            }
            if (mysqli_num_rows($result3) == $count3) {
                mysqli_query($conn, $sql10);
            }


            $sql17 = "INSERT INTO links (quizname, linkone, linktwo, linkthree) VALUES ('Simple Math', 'https://www.ixl.com/?partner=google&campaign=252752705&adGroup=20113101305&gclid=Cj0KCQiA2NaNBhDvARIsAEw55hh3t2Rhx0nAlspRWJ_YaAuxn4uLFa8zfLrXW96Ak84bEPeJYiCA5wwaAoS3EALw_wcB', 'https://www.ipracticemath.com/learn/basicmath', 'https://www.adaptedmind.com/Math-Worksheets-Adaptive-v89.html?campaignId=710818003&gclid=Cj0KCQiA2NaNBhDvARIsAEw55hjvHwlDbiGyX7K3p5osgDrdhLalLA8_qYIxFLHrctxSkX2uMr78i98aAoa4EALw_wcB')";

            $sql18 = "SELECT * FROM links";
            $result18 = mysqli_query($conn, $sql18);
            $count18 = 0;
            while ($row18 = mysqli_fetch_assoc($result18)) {
                if ($row18['quizname'] == 'Simple Math') {
                    break;
                }
                $count18++;
            }
            if (mysqli_num_rows($result18) == $count18) {
                mysqli_query($conn, $sql17);
            }


            $sql3 = "CREATE TABLE IF NOT EXISTS quizzes (
                quizname VARCHAR(100),
                explanation VARCHAR(300)
                )";

            if (mysqli_query($conn, $sql3)) {
                // echo "Table 'information' created successfully";
            }
            else {
                // echo "Error creating table: " . mysqli_error($conn);
            }

            $sql4 = "INSERT INTO quizzes (quizname, explanation) VALUES ('MARVEL', 'This test will quiz your knowledge on the MCU.')";
            $sql5 = "SELECT * FROM quizzes";
            $result = mysqli_query($conn, $sql5);
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['quizname'] == 'MARVEL') {
                    break;
                }
                $count++;
            }
            if (mysqli_num_rows($result) == $count) {
                mysqli_query($conn, $sql4);
            }

            $sql19 = "INSERT INTO quizzes (quizname, explanation) VALUES ('Simple Math', 'This test will quiz your adding, subtracting, multiplying, and dividing skills.')";
            $result19 = mysqli_query($conn, $sql5);
            $count19 = 0;
            while ($row = mysqli_fetch_assoc($result19)) {
                if ($row['quizname'] == 'Simple Math') {
                    break;
                }
                $count19++;
            }
            if (mysqli_num_rows($result19) == $count19) {
                mysqli_query($conn, $sql19);
            }


            $a = array();
            $b = array();
            $result = mysqli_query($conn, $sql5);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($a, $row['quizname']);
                array_push($b, $row['explanation']);
            }

            $sqlF = "SELECT * FROM score WHERE email='$email'";
            $resultF = mysqli_query($conn, $sqlF);
            $rowF = mysqli_fetch_assoc($resultF);
        ?>
        <script type="text/javascript">
            var array = <?php echo json_encode($a); ?>;
            var array2 = <?php echo json_encode($b); ?>;
            var rowF = <?php echo json_encode($rowF); ?>;

            length = array.length;
            
            html = "";
            for (i=0; i<length; i++) {
                if ((i+2)%2 == 0) {
                    rgbColor = newColor();
                    html += "<tr>";
                    html += "<td style='background-color: " + rgbColor + "'>";
                    html += "<form action='quiz.php' method='POST'>";
                    html += "<input style='background-color: " + rgbColor + "; border: none; text-decoration: underline' class='tdHeaders' name='quizName' value='" + array[i] + "' readonly/>";
                    html += "<h2 class='tdExplanation'>" + array2[i] + "</h2>"; 

                    strippedQuizName = array[i];
                    strippedQuizName = strippedQuizName.replace(/ /g, "");
                    strippedQuizName = strippedQuizName.toLowerCase();
                    attempts = rowF['attempts' + strippedQuizName];
                    attemptsLeft = 3 - attempts;

                    score = rowF['highscore' + strippedQuizName];
                    score = score/5*100;

                    if (attemptsLeft > 0 && attemptsLeft < 3) {
                        if (score <= 70) {
                            html += "<p>Attempts Left: " + attemptsLeft + "</p>";
                        }
                        html += "<p>Highest Score: " + score + "%</p>";
                        if (score <= 70) {
                            html += "<br><button type='submit' class='tdButton'>Click Me</button><br>";
                        }
                    }
                    else if (attemptsLeft == 0) {
                        html += "<p>Highest Score: " + score + "%</p>";
                    }
                    else {
                        html += "<p>Attempts Left: 3</p>";
                        html += "<p>Highest Score: TBD</p>";
                        html += "<br><button type='submit' class='tdButton'>Click Me</button><br>";
                    }

                    html += "</form>";
                    html += "</td>";
                }
                if ((i+2)%2 == 1) {
                    rgbColor = newColor();
                    html += "<td style='background-color: " + rgbColor + "'>";
                    html += "<form action='quiz.php' method='POST'>";
                    html += "<input style='background-color: " + rgbColor + "; border: none; text-decoration: underline' class='tdHeaders' name='quizName' value='" + array[i] + "' readonly/>";
                    html += "<h2 class='tdExplanation'>" + array2[i] + "</h2>";

                    strippedQuizName = array[i];
                    strippedQuizName = strippedQuizName.replace(/ /g, "");
                    strippedQuizName = strippedQuizName.toLowerCase();
                    attempts = rowF['attempts' + strippedQuizName];
                    attemptsLeft = 3 - attempts;

                    score = rowF['highscore' + strippedQuizName];
                    score = score/5*100;

                    if (attemptsLeft > 0 && attemptsLeft < 3) {
                        if (score <= 70) {
                            html += "<p>Attempts Left: " + attemptsLeft + "</p>";
                        }
                        html += "<p>Highest Score: " + score + "%</p>";
                        if (score <= 70) {
                            html += "<br><button type='submit' class='tdButton'>Click Me</button><br>";
                        }
                    }
                    else if (attemptsLeft == 0) {
                        html += "<p>Highest Score: " + score + "%</p>";
                    }
                    else {
                        html += "<p>Attempts Left: 3</p>";
                        html += "<p>Highest Score: TBD</p>";
                        html += "<br><button type='submit' class='tdButton'>Click Me</button><br>";
                    }

                    html += "</form>";
                    html += "</td>";
                    html += "</tr>";
                }
            }

            document.getElementById("homeContainer2").innerHTML = html;
        </script>
    </body>
</html>