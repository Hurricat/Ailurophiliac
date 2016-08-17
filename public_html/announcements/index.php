<?php
	require("functions.php");

	$authors = array();
	$tags = array(array());
	
	try {
		$stmt = $db->query('SELECT id, user_id, post_url, title, description, date FROM blog_posts ORDER BY id DESC');
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

	} catch(PDOException $e) {
        echo $e->getMessage();
    }
	
	render("home.php", ['title'=>'Announcements', 'positions' => $posts, 'authors' => $authors, 'tags' => $tags]);
?>