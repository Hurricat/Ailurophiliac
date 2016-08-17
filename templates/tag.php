<?php
	$i = 0;
	foreach($positions as $position) {
		if($i > 0) {
			echo '<hr>';
		}
		echo '<article>';
		echo '<h2><a href="/announcements/' . $position['post_url'] . '">' . $position['title'] . '</a></h2>';
		echo '<p class="text-muted">' . date('l, F jS, Y \a\t g:iA', strtotime($position['date'])) . '<br>';
		echo 'Tags: ';

		$j = 0;
		foreach($tags[$position['id']] as $tag) {
			echo '<a href="/tagged/' . $tag['tag_url'] . '">' . $tag['title'] . '</a>';
			if ($j != count($tags[$position['id']]) - 1) {
				echo ', ';
			}
			$j++;
		}

		echo '</p>';
		echo '<p>' . $position['description'] . '</p>';
		echo '<p><a href="/announcements/' . $position['post_url'] . '">Read More</a></p>';
		echo '</article>';

		$i++;
	}
?>
