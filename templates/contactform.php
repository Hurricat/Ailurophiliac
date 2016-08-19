<form role="form" action="contact.php" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control input-lg" required>
    </div>
    <div class="form-group">
        <label for="email">E-Mail</label>
        <input name="email" type="email" class="form-control input-lg" required>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" class="form-control input-lg" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-default form-control input-lg">Submit</button>
</form>
