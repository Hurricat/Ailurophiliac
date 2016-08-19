<?php
    require("functions.php"); 

    $_SESSION = [];
    if (!empty($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time() - 42000);
    }
    session_destroy();

    redirect("/admin/login.php");
?>
