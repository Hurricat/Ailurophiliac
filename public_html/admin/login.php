<?php
    require("functions.php");

    if ($_SESSION['id']) {
        redirect('/admin/index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        render('admin/loginform.php', ['title' => 'Log In']);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // validate submission
        if (empty($_POST['username'])) {
            error('Username cannot be empty');
        } else if (empty($_POST['password'])) {
            error('Password cannot be empty');
        }

        $stmt = $db->prepare('SELECT id, username, password FROM blog_members WHERE username = :username');
        $stmt->execute(array(':username' => $_POST['username']));
        $row = $stmt->fetch();

        // compare hash of user's input against hash that's in database
        if (password_verify($_POST['password'], $row['password'])) {
            // remember that user's now logged in by storing user's ID in session
            $_SESSION['id'] = $row['id'];

            // redirect to admin home
            redirect('/admin/index.php');
        }

        // else apologize
        error('Invalid username and/or password');
    }
?>
