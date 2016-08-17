<script>
	function deletePost(id, title) {
		if (confirm('Do you really want to delete: "' + title + '"?')) {
			window.location.href = '/admin/deletepost.php?id=' + id;
		}
	}
</script>
<table class="table">
	<thead>
		<tr>
			<th>Title</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
	</thead>
<?php
	foreach($positions as $position) {
		echo '<tr>';
		echo '<td>' . $position['title'] . '</td>';
		echo '<td>' . date('F j Y g:iA', strtotime($position['date'])) . '</td>';
		echo '<td>';
		?>

		<a href="/admin/editpost.php?id=<?php echo $position['id']; ?>">Edit</a> &#47;
		<a href="javascript:deletePost(<?php echo $position['id']; ?>, '<?php echo $position['title']; ?>')">Delete</a>

		<?php
		echo'</td>';
		echo '</tr>';
	}
?>
</table>
