<?php
    require("functions.php");

    if (!$_SESSION['id']) {
        redirect('/admin/login.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!$_GET['id']) {
            error('No post specified.');
        } else {
            $stmt = $db->prepare('SELECT id, user_id, title, description, content, date FROM blog_posts WHERE id = :postID');
            $stmt->execute(array(':postID' => $_GET['id']));
            $row = $stmt->fetch();

            if($row['id'] == '') {
                error('Post does not exist.');
            }

            $stmt = $db->query('SELECT id, title FROM blog_tags ORDER BY title');
            $tags = $stmt->fetchAll();

            $stmt = $db->prepare('SELECT tag_id FROM blog_posts_tags WHERE post_id = :postID');
            $stmt->execute(array(':postID' => $_GET['id']));
            $fetchedtags = $stmt->fetchAll();

            $i = 0;
            $curtags = array();
            foreach ($fetchedtags as $fetchtag) {
                $curtags[$i] = $fetchtag['tag_id'];
                $i++;
            }

            if($_SESSION['id'] == $row['user_id'] || $_SESSION['id'] == 1) {
                render('admin/edit.php', ['title' => 'Edit Post', 'postID' => $row['id'], 'postTitle' => $row['title'], 'postDesc' => $row['description'], 'postCont' => $row['content'], 'tags' => $tags, 'curtags' => $curtags]);
            } else {
                error('Only the author can edit a post.');
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['title'])) {
            error('No post title');
        } else if (empty($_POST['description'])) {
            error('No description entered');
        } else if (empty($_POST['content'])) {
            error('No post content');
        }

        try {
            $stmt = $db->prepare('UPDATE blog_posts SET title = :postTitle, post_url = :postURL, description = :postDesc, content = :postCont WHERE id = :postID');
            $stmt->execute(array(
                ':postID' => $_POST['id'],
                ':postURL' => blogURL($_POST['title']),
                ':postTitle' => $_POST['title'],
                ':postDesc' => $_POST['description'],
                ':postCont' => $_POST['content']
            ));
            $stmt = $db->prepare('DELETE FROM blog_posts_tags WHERE post_id = :postID');
            $stmt->execute(array(':postID' => $_POST['id']));
            $db->exec('ALTER TABLE blog_posts_tags AUTO_INCREMENT=1');

            $tagID = array();
            if(is_array($tagID)){
                foreach($_POST['tagID'] as $tagID){
                    $stmt = $db->prepare('INSERT INTO blog_posts_tags (post_id, tag_id) VALUES (:postID,:tagID)');
                    $stmt->execute(array(
                        ':postID' => $_POST['id'],
                        ':tagID' => $tagID
                    ));
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        redirect("/admin/index.php");
    }
?>
