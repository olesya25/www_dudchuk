<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/www_dudchuk/css/bootstrap.min.css" media="screen" title="no title" charset="UTF-8">
    <link rel="stylesheet" href="/www_dudchuk/css/custom.css" media="screen" title="no title" charset="UTF-8">
    <script src="/www_dudchuk/javascript/jQuery-2.2.4.min.js"></script>
    <script src="/www_dudchuk/javascript/bootstrap.min.js"></script>

    <?= $this->getContent('head'); ?>
    <title><?= $this->title ?></title>
</head>
<body>
<?php include ('main_menu.php')?>
<div class="container-fluid" style="min-height:cal(100% - 125px);">
    <?= $this->getContent('body'); ?>
</div>

</body>
</html>