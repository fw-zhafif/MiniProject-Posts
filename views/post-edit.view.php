<form action="/post/update" method="POST">
    <label for="">Edit Your Post</label>
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
    <label for="">Blogmu berisi:</label>
        <textarea name="body" id=""><?= $post['body'] ?></textarea>
    <button type="submit">Update</button>

</form>