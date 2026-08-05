<nav>

    <a href="/">Home</a>

    <a href="/posts">Posts</a>

    <?php if (isset($_SESSION['user'])) : ?>

        <form method="POST" action="/logout">

            <button>Logout</button>

        </form>

    <?php else : ?>

        <a href="/login">Login</a>

    <?php endif; ?>

</nav>