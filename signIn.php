<!-- ID: 124167 -->
<!-- Quarter 2 Project -->

<!-- Sign-In Page Below -->
<!-- This page will allow you to sign in to your account after filling out the sign-up form. -->

<!DOCTYPE html>
<html>
    <head>
        <title>Sign-In</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&display=swap" rel="stylesheet">
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="siBody">
        <?php
            // Start the session
            session_start();
        ?>
        <div id="siBox">
            <div id="siHeader1">
                <h1>
                    Welcome to ISMAQuizzes!
                </h1>
            </div>
            
            <hr>

            <table>
                <tr>
                    <td id="si">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                            <br>
                            <h2 id="siHeader2">Sign In</h2><br>
                            <label>
                                <span>EMAIL ADDRESS</span><br>
                                <input class="siFields" type="email" name="siEmail" required>
                            </label><br><br>
                            <label>
                                <span>PASSWORD</span><br>
                                <input class="siFields" type="password" name="siPassword" required>
                            </label><br><br>
                            <p id="siFound"></p><br>
                            <button type='submit' id="siSubmit" name="siButton">SIGN IN</button><br>
                            <p id="siCheck">Forgot Password?</p>
                            <br>

                            <?php
                                require "config.php";
                                
                                // Create database
                                $sql = "CREATE DATABASE IF NOT EXISTS ismaquizzes";
                                if (mysqli_select_db($conn, 'ismaquizzes')) {
                                    // echo "Database created successfully<br>";
                                }
                                else {
                                    // echo "Database does not exist";
                                    if (mysqli_query($conn, $sql)) {
                                        // echo "Database created<br>";
                                    }
                                    else {
                                        // echo "Error creating database:<br>";
                                        mysqli_connect_error();
                                    }
                                    echo "Error creating database: " . mysqli_error($conn) . "<br>";
                                }
                                mysqli_select_db($conn, 'ismaquizzes');

                                $sql2 = "CREATE TABLE IF NOT EXISTS account (
                                    id int(11) NOT NULL auto_increment PRIMARY KEY,
                                    fname VARCHAR(50),
                                    email VARCHAR(50),
                                    pword VARCHAR(50)
                                    )";
                                
                                if (mysqli_query($conn, $sql2)) {
                                    // echo "Table 'information' created successfully";
                                }
                                else {
                                    // echo "Error creating table: " . mysqli_error($conn);
                                }

                                $sql3 = "CREATE TABLE IF NOT EXISTS score (
                                    email VARCHAR(30)
                                    )";
                                
                                if (mysqli_query($conn, $sql3)) {
                                    // echo "Table 'information' created successfully";
                                }
                                else {
                                    // echo "Error creating table: " . mysqli_error($conn);
                                }

                                // Test_Input Function
                                function test_input($data) {
                                    $data = trim($data);
                                    $data = stripslashes($data);
                                    $data = htmlspecialchars($data);
                                    return $data;
                                }

                                if (isset($_POST['siButton'])) {
                                    $try_email = test_input($_POST['siEmail']);
                                    $try_password = test_input($_POST['siPassword']);
                                    $encrypt_try_password = md5($try_password);
                                    $query1 = "SELECT fname, email, pword FROM account";
                                    $result = mysqli_query($conn, $query1);
                                    $count = 0;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($try_email == test_input($row["email"]) && $encrypt_try_password == test_input($row["pword"])) {
                                            $_SESSION["fname"] = $row["fname"];
                                            $_SESSION["email"] = $row["email"];
                                            $_SESSION["pword"] = $try_password;

                                            $sql4 = "INSERT INTO score (email) VALUES ('$try_email')";
                                            $sql5 = "SELECT * FROM score";
                                            $result2 = mysqli_query($conn, $sql5);
                                            $count2 = 0;
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                if ($row2['email'] == $try_email) {
                                                    break;
                                                }
                                                $count2++;
                                            }
                                            if (mysqli_num_rows($result2) == $count2) {
                                                mysqli_query($conn, $sql4);
                                            }
                                            ?>
                                                <script type="text/javascript">
                                                    window.location.href='loader.html';
                                                </script>
                                            <?php
                                            break;
                                        }
                                        $count++;
                                    }
                                    if ($count == mysqli_num_rows($result)) {
                                        ?>
                                            <script type="text/javascript">
                                                siLoginCheck();
                                            </script>
                                        <?php
                                    }
                                }
                            ?>
                        </form>
                    </td>

                    <td id="si2">
                        <div id="si2Content">
                            <form action="signUp.php" method="POST">
                                <h2 id="siHeader3">Hello Friend!</h2>
                                <p>Enter your personal details and start your journey with us</p>
                                <button id="si2Submit" name="si2Button">Sign Up</button>
                                <br><br>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
            
        </div>
        
    </body>
</html>