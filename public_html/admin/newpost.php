<?php
    require("functions.php");

    if (!$_SESSION['id']) {
        redirect('/admin/login.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $stmt = $db->query('SELECT id, title FROM blog_tags ORDER BY title');
        $tags = $stmt->fetchAll();
        render('admin/new.php', ['title' => 'New Post', 'tags' => $tags]);
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['title'])) {
            error('No post title');
        } else if (empty($_POST['description'])) {
            error('No description entered');
        } else if (empty($_POST['content'])) {
            error('No post content');
        }

        try {
            $stmt = $db->prepare('INSERT INTO blog_posts (user_id, post_url, title, description, content, date) VALUES (:userID, :postURL, :postTitle, :postDesc, :postCont, :postDate)');
            $stmt->execute(array(
                ':userID' => $_SESSION['id'],
                ':postURL' => blogURL($_POST['title']),
                ':postTitle' => $_POST['title'],
                ':postDesc' => $_POST['description'],
                ':postCont' => $_POST['content'],
                ':postDate' => date('Y-m-d H:i:s')
            ));
            $postID = $db->lastInsertId();

            $tagID = array();
            //add categories
            if(is_array($tagID)){
                foreach($_POST['tagID'] as $tagID){
                    $stmt = $db->prepare('INSERT INTO blog_posts_tags (post_id, tag_id) VALUES (:postID,:tagID)');
                    $stmt->execute(array(
                        ':postID' => $postID,
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
