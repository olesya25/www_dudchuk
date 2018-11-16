<?php
$menu = Router::getMenu('menu_acl');
$currentPage = currentPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main_menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><?=WEB_NAME?></a>
        </div>
        <div class="collapse navbar-collapse" id="main_menu">
            <ul class="nav navbar-nav">
                <?php foreach ($menu as $key =>$value):
                    $active = ''; ?>
                <?php if(is_array($value)): ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$key?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($value as $k => $v):
                                $active = ($v == $currentPage)? 'active': ''; ?>
                            <?php if($k == 'separator'): ?>
                                <li role="separator" class="divider"></li>
                            <?php else: ?>

                                <li><a class="<?=$active?>" href="<?=$v?>"><?=$k?></a></li>
                            <?php endif;?>

                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else:
                    $active = ($value == $currentPage)? 'active': ''; ?>
                    <?php if($key == 'Login'): ?>
                    <?php $html = '<li><a href="'.$value.'"><span class="glyphicon glyphicon-log-in"></span>' .$key.'</a></li>'?>
                    <?php endif; ?>
                    <?php if($key == 'Logout'): ?>
                    <?php $html = '<li><a href="'.$value.'"><span class="glyphicon glyphicon-log-in"></span>' .$key.'</a></li>'?>
                <?php endif; ?>
                    <?php if($key == 'Signup'): ?>
                    <?php $html = '<li><a href="'.$value.'"><span class="glyphicon glyphicon-log-in"></span>' .$key.'</a></li>'?>
                <?php endif; ?>

                    <li><a class="<?=$active?>" href="<?=$value?>"><?=$key?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (currentUser()): ?>
                <li><a href="#">Hello <?=currentUser()->u_name?></a></li>
                <?php endif; ?>
                <?=$html?>
<!--                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
<!--               // <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
            </ul>
        </div>
    </div>
</nav>
</body>
</html>
