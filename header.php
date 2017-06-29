<?php

require_once('class/Database.php');
require_once('helpers/functions.php');

$db = new Database();

$approved = $db->retriveData(' SELECT COUNT( approved ) AS approved FROM posts WHERE approved = 1 ');
$notapproved = $db->retriveData(' SELECT COUNT( approved ) AS notapproved FROM posts WHERE approved = 0 ');
$approved = $approved->fetch(PDO::FETCH_OBJ);
$notapproved = $notapproved->fetch(PDO::FETCH_OBJ);
?>

<p> Created by : paleksa95@gmail.com / <a href="https://github.com/paleksa95">GitHub</a></p>
<p>Currently we have <?php echo $approved->approved ?> approved posts & <?php echo $notapproved->notapproved ?>  posts waiting for approval! </p>
<p> If you are Admin, click here : <a href="adminlogin.php"><input type="button" value="Admin login"> </a></p>

<!-- Style for header -->

<style> p {
        text-align: center;
        background: wheat;
        font-size: 33px;
    }
</style>