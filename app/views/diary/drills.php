<?php
$drills = new Drill();
$drillsContent = $drills->showAll();

?>
<?php $this->setTitle('Home')?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="col-md-9 col-md-offset-2 well">
        <div class="row">
    <?php $drillsArray [] = $drillsContent[0]->getResult();


    foreach($drillsArray as $key => $value){
        foreach ($value as $k => $v){

            echo'<div class="col-sm-6 col-sm-offset-2 well">';
            echo'<div class="card bg-info">';
            echo'<div class="card-body">';
            echo '<h3 class="card-title text-center">'. $v->drill_name . '</h3>';
            echo'<p class="card-text text-center">'. $v->drill_description.'</p>';
            echo'<a href="'. $v->drill_url.'" class="card-text text-center">Watch video</a>';
            //echo '<button href="#" class="btn btn-primary "></button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }
    }

    ?>
            </div>
        </div>



<?php $this->end(); ?>




