<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Belajar PHP' ?></title>
</head>

<body>

<?php require base_path('views/partials/nav.php'); ?>

<?php require $content; ?>

<?php require base_path('views/partials/footer.php'); ?>

</body>

</html>