<form action="/posts" method="POST">
    <label for="">Judul</label>
        <input type="text" name="title" value="<?= old('title')  ?>">

        <?php if ($message = error('title')) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>

    <label for="">Blogmu berisi:</label>
        <textarea name="body"><?= old('body') ?></textarea>

        <?php if ($message = error('body')) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>

    <button type="submit">Kirim</button>

</form>