
<?php foreach($posts as $post) : ?>
    <h2><?= $post['title']; ?></h2>
        <p><?= $post['body']; ?></p>
    <hr>
<?php endforeach ; ?>