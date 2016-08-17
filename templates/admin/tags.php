<script>
	function deleteTag(id, title) {
		if (confirm('Do you really want to delete: "' + title + '"?')) {
			window.location.href = '/admin/deletetag.php?id=' + id;
		}
	}
</script>
<table class="table">
	<thead>
		<tr>
			<th>Tag</th>
			<th>Action</th>
		</tr>
	</thead>
	<?php
		foreach($positions as $position) {
			echo '<tr>';
			echo '<td>' . $position['title'] . '</td>';
			echo '<td>';
			?>

			<a href="/admin/edittag.php?id=<?php echo $position['id']; ?>">Edit</a> &#47;
			<a href="javascript:deleteTag(<?php echo $position['id']; ?>, '<?php echo $position['title']; ?>')">Delete</a>

			<?php
			echo'</td>';
			echo '</tr>';
		}
	?>
</table>
