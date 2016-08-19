<?php
    require("functions.php");

    if (!$_SESSION['id']) {
        redirect('/admin/login');
    }

    try {
        $stmt = $db->query('SELECT id, title FROM blog_tags ORDER BY id DESC');
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    try {
        $stmt = $db->prepare('SELECT name FROM blog_members WHERE id = :userID');
        $stmt->execute(array(':userID' => $_SESSION['id']));
        $user = $stmt->fetch(PDO::FETCH_ASSOC)['name'];
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    render("admin/tags.php", ['title'=>'Admin', 'positions' => $posts, 'userName' => $user]);
?>
