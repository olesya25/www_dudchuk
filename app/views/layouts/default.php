<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
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