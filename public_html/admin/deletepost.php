<?php
    require("functions.php");

    if (!$_GET['id']) {
        error('No post specified.');
    } else {
        $stmt = $db->prepare('SELECT id, user_id, title, content, date FROM blog_posts WHERE id = :postID');
        $stmt->execute(array(':postID' => $_GET['id']));
        $row = $stmt->fetch();

        if($row['id'] == '') {
            error('Post does not exist.');
        } else if($_SESSION['id'] == $row['user_id'] || $_SESSION['id'] == 1) {
            $stmt = $db->prepare('DELETE FROM blog_posts WHERE id = :postID');
            $stmt->execute(array(':postID' => $_GET['id']));
            $stmt = $db->prepare('DELETE FROM blog_posts_tags WHERE post_id = :postID');
            $stmt->execute(array(':postID' => $_GET['id']));
            $db->exec('ALTER TABLE blog_posts AUTO_INCREMENT=1');
            $db->exec('ALTER TABLE blog_posts_tags AUTO_INCREMENT=1');
            redirect("/admin/index.php");
        } else {
            error('Only the author can delete a post.');
        }
    }
?>
