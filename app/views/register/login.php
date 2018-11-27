<?php $this->start('head')?>
<?php $this->end()?>
<?php $this->start('body')?>
<div class="centered rounded-bord gold">
    <form class="form" action="<?=PROOT?>register/login" method="post">
        <div class="bg-danger"><?=$this->displayErrors ?></div>
        <h3 class="text-center">Log in!</h3>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="remember_me">Remember me <input type="checkbox" name="remember_me" id="remember_me"></label>

        </div>
        <div class="form-group">
            <input type="submit" value="Log in!" class="btn btn-large btn-primary">

        </div>
        <div class="text-right">
            <a href="<?=PROOT?>register/register">Create an accout!</a>
        </div>

    </form>
</div>

<?php $this->end()?>
