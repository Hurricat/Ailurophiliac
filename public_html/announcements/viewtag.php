<?php
    require("functions.php");

    if (!$_GET['id']) {
        error('No tag specified.');
    } else {
        $stmt = $db->prepare('SELECT id, title FROM blog_tags WHERE tag_url = :tagURL');
        $stmt->execute(array(':tagURL' => $_GET['id']));
        $pagetag = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $db->prepare('
            SELECT
                blog_posts.id, blog_posts.user_id, blog_posts.post_url,
                blog_posts.title, blog_posts.description, blog_posts.date
            FROM
                blog_posts, blog_posts_tags
            WHERE
                blog_posts.id = blog_posts_tags.post_id
                AND blog_posts_tags.tag_id = :tagID
            ORDER BY
                id DESC
        ');
        $stmt->execute(array(':tagID' => $pagetag['id']));
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $stmt = $db->prepare('SELECT name FROM blog_members WHERE id = :userID');
            $stmt->execute(array(':userID' => $post['user_id']));
            $users = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt2 = $db->prepare('SELECT title, tag_url FROM blog_tags, blog_posts_tags WHERE blog_tags.id = blog_posts_tags.tag_id AND blog_posts_tags.post_id = :postID');
            $stmt2->execute(array(':postID' => $post['id']));
            $cats = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $authors[$post['id']] = $users['name'];
            $tags[$post['id']] = $cats;
        }
        render("tag.php", ['title'=>'Tagged as ' . $pagetag['title'], 'positions' => $posts, 'authors' => $authors, 'tags' => $tags, 'pagetag' => $pagetag]);
    }
?>
