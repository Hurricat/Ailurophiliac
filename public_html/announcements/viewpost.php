<?php
	require("functions.php");

	if (!$_GET['id']) {
		error('No post specified.');
	} else {
		$stmt = $db->prepare('SELECT id, user_id, post_url, title, content, date FROM blog_posts WHERE post_url = :postURL');
		$stmt->execute(array(':postURL' => $_GET['id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt = $db->prepare('SELECT name FROM blog_members WHERE id = :userID');
		$stmt->execute(array(':userID' => $row['user_id']));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		$author = $user['name'];

		$stmt2 = $db->prepare('SELECT title, tag_url FROM blog_tags, blog_posts_tags WHERE blog_tags.id = blog_posts_tags.tag_id AND blog_posts_tags.post_id = :postID');
		$stmt2->execute(array(':postID' => $row['id']));
		$tags = $stmt2->fetchAll(PDO::FETCH_ASSOC);

		if($row['id'] == '') {
			error('Post does not exist.');
		} else {
			render("post.php", ['title' => $row['title'], 'position' => $row, 'author' => $author, 'tags' => $tags]);
		}
	}
?>
