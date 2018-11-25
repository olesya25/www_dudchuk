<?php
$drills = new Drill();
$drillsContent = $drills->showAll();

$drillsArray [] = $drillsContent[0]->getResult();?>


<?php $this->setTitle('Create training')?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<h1 class="text-center red"></h1>
<div class="col-md-6 col-md-offset-3 well">
    <form class="form"  action="<?=PROOT?>diary/createtraining" method="post">
        <div class="bg-danger"><?=$this->displayErrors ?></div>
        <h3 class="text-center">Create training</h3>
        <div class="form-group">
            <label for="username">Date of training</label>
            <input type="date" name="training_date" id="date" class="form-control">
        </div>
         <?php

         $btn = 1;
        foreach($drillsArray as $key => $value){
            foreach ($value as $k => $v){
                echo '<div class="form-group">';
                echo '<textarea style="display: none" id="dscrp'.$btn.'" class="form-control" name="description[]"></textarea><input type="checkbox" class="form-control" name="drills[]" value="'.$v->id. '" />'.$v->drill_name .'<br/>';
                echo '<a add-descript="dscrp'.$btn.'" type="button" class="btn btn-info myclas">Add description</a>';
                echo '</div>';
                $btn++;
            }
        }
            ?>
        <div class="form-group">
            <label for="training_aim">Aim</label>
            <textarea placeholder="What your aim to achieve in this training?" name="training_aim" id="tr_aim" class="form-control"></textarea>
        </div>
        <input type="submit" value="Create" name="training" class="btn btn-primary">

    </form>

</div>

<div class="col-md-9 col-md-offset-2 well">
    <button class="btn btn-info" >Show list of drills</button>
<div id="drills_content" style="display: none">
    <div class="row">
        <?php
        foreach($drillsArray as $key => $value){
            foreach ($value as $k => $v){

                echo'<div class="col-sm-6 col-sm-offset-3 well">';
                echo'<div class="card bg-info">';
                echo'<div class="card-body">';
                echo '<h3 class="card-title text-center">'. $v->drill_name . '</h3>';
                echo'<p class="card-text text-center">'. $v->drill_description.'</p>';
                echo '<a href="'. $v->drill_url . '" class="card-title text-center">Watch video</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            }
        }

        ?>
    </div>
</div>
</div>

<script>
    $(document).ready(function () {
        $('.btn-info').on('click', function () {
            $('#drills_content').toggle();
        });
    })
</script>
<script>
    $(document).ready(function () {
        $('.myclas').on('click', function () {
             var btnDscrp = $(this).attr('add-descript');
            $('#'+ btnDscrp).toggle();
        });
    })
</script>

<?php $this->end(); ?>
