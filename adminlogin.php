<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Administrator</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<?php

require_once('class/User.php');
$user = new User();
$user->logIn('username' , 'password')

?>



<body>
<div id="main">


    <header><h1>Welcome Administrator !</h1></header>

    <!-- Form starts here -->

<?php  if(!empty($user->errors))  : ?>
    <?php echo '<p>' , $user->errors , '</p>';   ?>
<?php endif; ?>
    <div id="form">
        <form id="adminlogin" action="adminlogin.php" method="post">

            <br>
            <br>
            <input type="text" name="username" placeholder="Enter your username.">
            <br>
            <br>
            <input type="password" name="password" placeholder="Enter your password.">
            <br>
            <br>
            <br>

            <div class="titletextbutton">

                <input class="button" type="submit" name="submit" value="login"><br>
            </div>
        </form>


    </div>
    <style> p {
            text-align: center;
            background: wheat;
            font-size: 33px;
        }
    </style>
    </body>
</html>