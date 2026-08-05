<form method="POST" action="/post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">

    <button type="submit">
        Delete
    </button>
</form>