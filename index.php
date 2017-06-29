<?php
session_start();

$status = isset($_SESSION['status']) ? $_SESSION['status'] : [];
$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Leave Post</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <?php
    require_once('class/Database.php');
    require_once('helpers/functions.php');

    $db = new Database();
    $posts = $db->retriveData('SELECT name , email , title , body , date FROM posts WHERE approved = 1 ');
    ?>

    <!-- Top Page header -->
    <?php include('header.php'); ?>
    <body>

    <!-- Main div -->
    <div id="main">
        <header>
            <h1>Feel free to post any message here..</h1>
        </header>

        <!-- Messages -->

        <div id="messages">
            <?php if ($posts) : ?>
            <?php while ($post = $posts->fetch(PDO::FETCH_OBJ)): ?>
            <ul>


                <li class="post">Submited at :<span> <?php echo formatDate($post->date) ?> </span><br>Submited from
                    :<span> <?php echo e($post->name) ?></span> <br>Email:
                    <span> <?php echo e($post->email) ?> </span>
                    <br>Title: <span> <?php echo e($post->title) ?></span>
                    <br>
                    Message: <span>  <?php echo e($post->body) ?></span>

                </li>
                <?php endwhile; ?>
                <?php else : ?>
                    <p>Nothing to show!</p>
                <?php endif; ?>

            </ul>

        </div>

        <!-- Form starts here -->

        <div id="form">
            <?php if (!empty($status)) : ?>
                <?php echo '<p>' , implode('<br>', $status) , '</p>'; ?>

            <?php endif; ?>
            <form action="postmessage.php" method="post">
                <input type="text" name="name"
                       placeholder="Enter your name." <?php echo isset($fields['name']) ? ' value="' . e($fields['name']) . '"' : '' ?> >
                <input type="email" name="email" placeholder="Enter your e-mail." <?php echo isset($fields['email']) ? ' value="' . e($fields['email']) . '"' : '' ?>>
                <br>
                <br>
                <br>

                <div class="titletextbutton">
                    <input type="text" name="title" placeholder="Enter message title." <?php echo isset($fields['title']) ? ' value="' . e($fields['title']) . '"' : '' ?>>
                    <br>
                    <br>
                    <textarea name="body" rows="15" cols="70" placeholder="Write your message here"><?php echo isset($fields['body']) ? '' . e($fields['body']) .'' : '' ?></textarea>
                    <br>
                    <br>
                    <input class="button" type="submit" name="submit"><br> If your message does't show immediately that
                    means that Administrator of the site didn' allowed it , so please wait. Thanks !
                </div>
            </form>


        </div>

    </div>

    </body>


    </html>

<?php
unset($_SESSION['status']);
unset($_SESSION['fields']);
?>