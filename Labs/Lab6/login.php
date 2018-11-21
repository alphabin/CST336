<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart - Admin</title>
    </head>
    <body>
        <h1> OtterMart - Admin</h1>
        
        <form method="POST" action="loginProcess.php">
            Username : <input type="text" name="username"/></br>
            Password : <input type="password" name="password"/></br>  
            <input type="submit" name="submitForm" value="login"/>
        </form>
        <?php
            if($_SESSION['incorrect'])
            {
                echo "<p class='lead' id='error' style='color:red'>";
                echo "<strong>Incorrect Username or Password</strong>";
                echo "</p>";
            }
        ?>
    </body>
</html>