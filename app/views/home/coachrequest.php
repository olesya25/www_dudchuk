<?php $this->setTitle('Home')?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-6 col-md-offset-3 well">
    <form class="form" action="<?=PROOT?>home/coachrequest" method="post" enctype="multipart/form-data">
        <div class="bg-danger"><?=$this->displayErrors ?></div>
        <h3 class="text-center">Ask a permission to be a coach</h3>
        <h5 class="text-info text-center">If you have already sent the request, than the previous CV will be overwritten</h5>
        <div class="form-group">
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div class="form-group">
            <label for="intro">Brief intro</label>
            <input type="text" name="intro" id="intro" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Send request" name="send_cv" class="btn btn-large btn-primary">
        </div>
    </form>
</div>

<?php $this->end(); ?>
