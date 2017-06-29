<?php

session_start();

require_once('class/Database.php');
$db = new Database();

//Status array is used to collect and display errors or success in inserting post.
$status = [];

/**
 *
 * Validating input from index.php page.
 *
 */


if (isset($_POST['name'], $_POST['email'], $_POST['title'], $_POST['body'])) {


    $fields = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'title' => $_POST['title'],
        'body' => $_POST['body']
    ];

    if (strlen($fields['name']) < 2 || !ctype_alpha($fields['name']) || empty($fields['name'])) {
        $status[] = 'Please enter a valid name.';
    }
    if ((!filter_var($fields['email'], FILTER_VALIDATE_EMAIL) || empty($fields['email']))) {
        $status[] = 'Please enter a valid email.';
    }
    if (strlen($fields['title']) < 2 || empty($fields['title'])) {
        $status[] = 'Please enter a valid title.';
    }
    if (empty($fields['body'])) {
        $status[] = 'Please enter a valid body message.';
    }
    if (empty($status)) {
        if ($db->insertPost($_POST['name'], $_POST['email'], $_POST['title'], $_POST['body'])) {
            $status[] = 'Post is submitted , please wait for approval.';
            $fields = NULL;
        } else {
            $status[] = 'Database problems , please try again later.';
        }

    }

} else {
    $status[] = 'Fields are not set';
}

//Super global sessions are used to transfer $status array and $fields value to index.php page

$_SESSION['status'] = $status;
$_SESSION['fields'] = $fields;

header('location:index.php');










































































































































































