<?php
	echo '<article>';
	echo '<p class="text-muted">' . date('l, F jS, Y \a\t g:iA', strtotime($position['date'])) . '<br>';
	echo 'Tags: ';

	$j = 0;
	foreach($tags as $tag) {
		echo '<a href="/tagged/' . $tag['tag_url'] . '">' . $tag['title'] . '</a>';
		if ($j != count($tags) - 1) {
			echo ', ';
		}
		$j++;
	}
	echo '</p>';
	echo '<p>' . $position['content'] . '</p>';
	echo '</article>';
?>

<article>
	<div id="disqus_thread"></div>
	<script>
		var disqus_config = function () {
			this.page.url = '<?php echo 'http://ailurophiliac.com/announcements/' . $position['post_url']; ?>';
			this.page.identifier = '<?php echo $position['id']; ?>';
		};
		(function() {
			var d = document, s = d.createElement('script');
			s.src = '//ailurophiliac.disqus.com/embed.js';
			s.setAttribute('data-timestamp', +new Date());
			(d.head || d.body).appendChild(s);
		})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
</article>
