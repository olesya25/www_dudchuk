<?php
$category = new Category();
$categoryContent = $category->showAll();


$categoryArray [] = $categoryContent[0]->getResult();
//dump_die($categoryArray);
?>


<?php $this->setTitle('Add drill')?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<h1 class="text-center red"></h1>
<div class="col-md-6 col-md-offset-3 well">
    <form class="form"  action="<?=PROOT?>diary/adddrill" method="post">
        <div class="bg-danger"><?=$this->displayErrors ?></div>
        <h3 class="text-center">Add drill</h3>
        <div class="form-group">
            <label for="username">Category</label>

                <?php
                foreach ($categoryArray as $key => $value){
                    foreach ($value as $v){
                        echo'<input type="checkbox" class="form-control" name="categories[]" value="'.$v->id. '" />'.$v->category_name .'<br/>';
                    }
                }?>

        </div>
        <div class="form-group">
            <label for="drill_name">Name</label>
            <input placeholder="Name" name="drill_name" id="drill_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="drill_description">URL</label>
            <textarea placeholder="URL.." name="drill_url" id="drill_url" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="drill_description">Desctiption</label>
            <textarea placeholder="Add description.." name="drill_description" id="drill_description" class="form-control"></textarea>
        </div>
        <input type="submit" value="Create" name="drill" class="btn btn-primary">

    </form>

</div>

<?php $this->end(); ?>
