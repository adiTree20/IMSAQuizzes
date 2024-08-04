<!-- ID: 124167 -->
<!-- Quarter 2 Project -->

<!-- Edit Page Below -->
<!-- This page allows you to edit your profile. You can change your name or password to your email that is in the database here. -->

<!DOCTYPE html>
<html>
    <head>
        <title>Edit</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="editBody">
        <?php
            // Start the session
            session_start();
        ?>
        <h1 id="editHeader">Edit Your Profile</h1>
        <?php
            require "config.php";

            mysqli_select_db($conn, 'ismaquizzes');
            

            if (isset($_POST['update'])) {    
                $id = $_POST['id'];
                
                $name = $_POST['name'];
                $email = $_POST['email'];
                $pword = $_POST['pword'];
                $encryptedPword = md5($pword);
                
                if(empty($name) || empty($email) || empty($pword)) {            
                    if(empty($name)) {
                        echo "<font color='red'>Name field is empty.</font><br><br>";
                    }
                    
                    if(empty($email)) {
                        echo "<font color='red'>Email field is empty.</font><br><br>";
                    }
                    
                    if(empty($pword)) {
                        echo "<font color='red'>Password field is empty.</font><br><br>";
                    }        
                } else {    
                    $result = mysqli_query($conn, "UPDATE account SET fname='$name',email='$email',pword='$encryptedPword' WHERE id=$id");
                    $_SESSION['fname'] = $name;
                    $_SESSION['pword'] = $pword;
                    
                    header("Location: home.php");
                }
            }
            else {
                $id = $_GET['id'];
            
                $sql = "SELECT * FROM account WHERE id=$id";
                $result = mysqli_query($conn, $sql);
    
                $pword = $_SESSION['pword'];
    
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['fname'];
                    $email = $row['email'];
                }
            }
        ?>
            
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <table id="editTable">
                <tr class="editTableTr"> 
                    <td class="editTableTd">Full Name</td>
                    <td class="editTableTd"><input type="text" name="name" value="<?php echo $name;?>"></td>
                </tr>
                <tr class="editTableTr"> 
                    <td class="editTableTd">Email (Unalterable)</td>
                    <td class="editTableTd"><input type="text" name="email" value="<?php echo $email;?>" readonly></td>
                </tr>
                <tr class="editTableTr"> 
                    <td class="editTableTd">Password</td>
                    <td class="editTableTd"><input type="text" name="pword" value="<?php echo $pword;?>"></td>
                </tr>
            </table>

            <input type="hidden" name="id" value=<?php echo $id;?>><br><br>
            <input type="submit" id="editButton" name="update" value="Update"></td>
        </form>
    </body>
</html>