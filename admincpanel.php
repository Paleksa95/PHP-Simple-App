<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Messages</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<?php
session_start();

/**
 * Checking if session variables exist on server.
 * If session variable don't exist , redirecting to index.php
 *
 */


if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: index.php");
}

require_once('class/Database.php');
require_once('helpers/functions.php');

$db = new Database();

$posts = $db->retriveData('SELECT id , name , email , title , body , date FROM posts WHERE approved = 0 ');

$db->updatePost('id', 'name', 'email', 'title', 'body');

?>

<body>
<p><a href="logout.php"> Log out! </a></p>
<header><h1> Approve messages / Edit messages </h1></header>

<!-- Form starts here -->

<div id="form">
    <?php if ($posts) : ?>
        <?php while ($post = $posts->fetch(PDO::FETCH_OBJ)) : ?>
            <form action="admincpanel.php" method="post">
                <br>
                <br>

                <input type="text" name="name" value="<?php echo e($post->name) ?>">
                <input type="email" name="email" value="<?php echo e($post->email) ?>">
                <br>
                <br>
                <br>

                <div class="titletextbutton">
                    <input type="text" name="title" value="<?php echo e($post->title) ?>">
                    <br>
                    <br>
                    <textarea name="body" rows="15" cols="70"><?php echo e($post->body) ?></textarea>
                    <br>
                    <br>
                    <input type="hidden" name="id" value="<?php echo e($post->id); ?>">
                    <input class="button" type="submit" name="submit"><br>
                </div>
                <hr>
            </form>
        <?php endwhile; ?>
    <?php else : ?>
        <p> No new messages !</p>
    <?php endif; ?>
</div>

<style> p {
        text-align: center;
        background: wheat;
        font-size: 33px;
    }
</style>

</body>




























































































































