<?php
$drills = new Drill();
$drillsContent = $drills->showAll();

$drillsArray [] = $drillsContent[0]->getResult();?>


<?php $this->setTitle('Home')?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<h1 class="text-center red"></h1>
<div class="col-md-6 col-md-offset-3 well">
    <form class="form"  method="post">

        <h3 class="text-center">Create training</h3>
        <div class="form-group">
            <label for="username">Date of training</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
        <div class="form-group">
            <label for="drill">Add drill</label>
        <select name="drills">

         <?php


        foreach($drillsArray as $key => $value){
            foreach ($value as $k => $v){
                echo'<option value="volvo">'.$v->drill_name . '</option>';
            }
        }
            ?>
        </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="remember_me">Remember me <input type="checkbox" name="remember_me" id="remember_me"></label>

        </div>



    </form>

</div>

<div class="col-md-9 col-md-offset-2 well">
    <button class="btn btn-info" >Show list of drills</button>
<div id="drills_content" style="display: none">
    <form id="drillAdd" class="form" action="<?=PROOT?>diary/createtraining" method="post">
    <div class="row">
        <?php //$drillsArray [] = $drillsContent[0]->getResult();


        foreach($drillsArray as $key => $value){
            foreach ($value as $k => $v){

                echo'<div class="col-sm-6 col-sm-offset-3 well">';
                echo'<div class="card bg-info">';
                echo'<div class="card-body">';
                echo '<h3 class="card-title text-center">'. $v->drill_name . '</h3>';
                echo'<p class="card-text text-center">'. $v->drill_description.'</p>';
                echo '<input type="submit" value="'.$v->id .'" name="tr'.$v->id .'" class="btn btn-primary">';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            }
        }

        ?>
    </div>
    </form>
</div>
</div>

<script>
    $(document).ready(function () {
        $('.btn-info').on('click', function () {
           // var btnDeny = $(this).attr('data-read');

            $('#drills_content').toggle();

        });
    })
</script>

<?php $this->end(); ?>
