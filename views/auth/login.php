<?php if ($message = error('auth')) : ?>

    <p><?= $message ?></p>

<?php endif; ?>
<form method="POST" action="/login">
    <input
        type="email"
        name="email"
        value="<?= old('email') ?>">
        <?php if ($message = error('email')) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>

    <input
        type="password"
        name="password"
        placeholder="Password">
        <?php if ($message = error('password')) : ?>
        <p><?= $message ?></p>
        <?php endif; ?>

    <button>Login</button>
</form>