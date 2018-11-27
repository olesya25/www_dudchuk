<?php $this->start('head')?>

<?php $this->end()?>

<?php $this->start('body')?>
<div class="centered rounded-bord" style="background-color: yellowgreen">
    <h3 class="text-center">Get started!</h3><hr>
    <form class="form" action="<?=PROOT?>register/register" method="post">
        <div class="bg-danger"><?=$this->displayErrors ?></div>
        <div class="form-group">
            <label for="u_name">First Name</label>
            <input type="text" name="u_name" id="u_name" class="form-control" value="<?= $this->post['u_name'] ?>">
        </div>
        <div class="form-group">
            <label for="u_surname">Last Name</label>
            <input type="text" name="u_surname" id="u_surname" class="form-control" value="<?= $this->post['u_surname'] ?>">
        </div>
        <div class="form-group">
            <label for="u_email">Email</label>
            <input type="email" name="u_email" id="u_email" class="form-control" value="<?= $this->post['u_email'] ?>">
        </div>
        <div class="form-group">
            <label for="u_username">Username</label>
            <input type="text" name="u_username" id="u_username" class="form-control" value="<?= $this->post['u_username'] ?>">
        </div>
        <div class="form-group">
            <label for="u_password">Password</label>
            <input type="password" name="u_password" id="u_password" class="form-control" value="<?= $this->post['u_password'] ?>">
        </div>
        <div class="form-group">
            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm" id="confirm" class="form-control" value="<?= $this->post['confirm'] ?>">
        </div>
        <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Register">
        </div>

    </form>
</div>
<?php $this->end()?>
