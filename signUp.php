<!-- ID: 124167 -->
<!-- Quarter 2 Project -->

<!-- Sign-In Page Below -->
<!-- This page is where you first create an account to get started. After properly filling out all the fields, you will be sent
back to the signIn.php page where you can sign into your account. -->

<!DOCTYPE html>
<html>
    <head>
        <title>Sign-Up</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&display=swap" rel="stylesheet">
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="suBody">
        <div id="suBox">
            <div id="su2Header1">
                <h1>
                    Welcome to ISMAQuizzes!
                </h1>
            </div>
            
            <hr>

            <table>
                <tr>
                    <td id="su">
                        <div id="suContent">
                            <form action="signIn.php">
                                <h2 id="su2Header3">Welcome Back!</h2>
                                <p>To stay connected with us, please login with your personal info</p>
                                <button id="suSubmit" name="suButton">Sign In</button>
                                <br><br>
                            </form>
                        </div>
                    </td>

                    <td id="su2">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                            <br>
                            <h2 id="su2Header2">Sign Up</h2><br>
                            <label>
                                <span>FULL NAME</span><br>
                                <input id="su2Fields" type="text" name="newName" required>
                            </label><br><br>
                            <label>
                                <span>EMAIL ADDRESS</span><br>
                                <input id="su2Fields" type="email" name="newEmail" required>
                            </label><br><br>
                            <label>
                                <span>PASSWORD</span><br>
                                <input id="su2Fields" type="password" name="newPassword" required>
                            </label><br><br>
                            <label>
                                <span>CONFIRM PASSWORD</span><br>
                                <input id="su2Fields" type="password" name="cPassword" required>
                            </label><br><br>
                            <p id="suFound"></p><br>
                            <button id="su2Submit" name="su2Button">SIGN UP</button><br>
                            <br>

                            <?php
                                require "config.php";
                                                    
                                // Create database
                                $sql = "CREATE DATABASE ismaquizzes";
                                if (mysqli_select_db($conn, 'ismaquizzes')) {
                                    // echo "Database created successfully<br>";
                                }
                                else {
                                    echo "Database does not exist";
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

                                // Test_Input Function
                                function test_input($data) {
                                    $data = trim($data);
                                    $data = stripslashes($data);
                                    $data = htmlspecialchars($data);
                                    return $data;
                                }

                                if (isset($_POST['su2Button'])) {
                                    $new_name = test_input($_POST['newName']);
                                    $new_email = test_input($_POST['newEmail']);
                                    $new_password = test_input($_POST['newPassword']);
                                    $confirm_password = test_input($_POST['cPassword']);
                                    $query2 = "SELECT email FROM account";
                                    $result2 = mysqli_query($conn, $query2);
                                    $count = 0;
                                    $identical = false;

                                    while ($row = mysqli_fetch_assoc($result2)) {
                                        if ($new_password == $confirm_password) {
                                            if ($row['email'] == $new_email) {
                                                ?>
                                                    <script type="text/javascript">
                                                        suLoginFound();
                                                    </script>
                                                <?php
                                                $count = 1;
                                                break;
                                            }
                                        }
                                        else {
                                            ?>
                                                <script type="text/javascript">
                                                    suLoginCheck();
                                                </script>
                                            <?php
                                            $identical = true;
                                            break;
                                        }
                                    }

                                    if ($count != 1 && $identical != true) {
                                        $encrypt_password = md5($new_password);
                                        $query3 = "INSERT INTO account (fname, email, pword) VALUES ('$new_name', '$new_email', '$encrypt_password')";
                                        mysqli_query($conn, $query3);
                                        ?>
                                            <script type="text/javascript">
                                                suSuccess();
                                            </script>
                                        <?php
                                    }
                                }
                                
                            ?>
                        </form>
                    </td>
                </tr>
            </table>
            
        </div>
    </body>
</html>