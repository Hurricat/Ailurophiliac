<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
tinymce.init({
	selector: 'textarea',
	plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
    ],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<form action="/admin/newpost.php" method="post">
	<div class="form-group">
		<label for="title">Title</label>
		<input type='text' name='title' class="form-control input-lg" required>
	</div>
	<div class="form-group">
		<label for="description">Description</label>
		<textarea name='description' class="form-control input-lg" rows="5"></textarea>
	</div>
	<div class="form-group">
		<label for="content">Content</label>
		<textarea name='content' class="form-control input-lg" rows="5"></textarea>
	</div>
	<label>Tags</label>
	<?php
		foreach ($tags as $tag) {
			echo "<div class='checkbox'>";
			echo "<label><input type='checkbox' name='tagID[]' value='" . $tag['id'] . "'>";
			echo $tag['title'] . "</label>";
			echo "</div>";
		}
	?>
	<button type="submit" class="btn btn-default form-control input-lg">Submit</button>
</form>
