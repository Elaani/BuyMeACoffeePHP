<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $title ?>
    </title>
</head>

<body>

    <?php include 'messages.inc.html.php' ?>

    <!-- all clear -->
    <?php if (! empty($isLoggedIn) && $isLoggedIn === true) : ?>
        <?php include 'user-menu.inc.html.php' ?>
    <?php endif ?>