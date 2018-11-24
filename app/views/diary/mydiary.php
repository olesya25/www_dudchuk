<?php $this->setTitle('Home')?>
<?php
$training = new Training(currentUser()->id);
$drill = new TrainingDrill();
$userTr = $training->getTraining();
$nTr = count($userTr);
if(empty($userTr)) {
    $userTr = "You have no training for now";

}
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-10 col-md-offset-0 well">
    <div class="row">

        <div class="col-md-2 col-md-offset-0 well">
            <p class="text-center red">Today <?=(date('d-m-Y'))?></p>
        </div>
        <div class="col-md-10 col-md-offset-2 well">
            <h5><?php
                for($i = 0; $i < $nTr; $i++ ){

                    if(date('Y-m-d') == $userTr[$i]['date'] ){
                        echo '<h3>Today training</h3><br>';
                        echo'<h5>'.htmlspecialchars($userTr[$i]['title']).'</h5>';
                        $drilList = $drill->showDrill($userTr[$i]['id']);
                        $n = count($drilList);

                    }elseif (date('Y-m-d') >  $userTr[$i]['date'] ){
                        echo '<h3>Training done</h3><br>';
                        echo'<h5>'.htmlspecialchars($userTr[$i]['title']).'</h5>';
                        $drilList = $drill->showDrill($userTr[$i]['id']);

                    }else{
                        echo '<h3>Upcoming training</h3><br>';
                        echo'<h5>'.htmlspecialchars($userTr[$i]['title']).'</h5>';
                        $drilList = $drill->showDrill($userTr[$i]['id']);
                        $n = count($drilList);

                    }
                }
                ?>
            </h5>

        </div>

    </div>

<div class="tab-pane">

</div>
    </div>
</div>
<!--<h1 class="text-center red">--><?//
//
//    if(is_array($userTr)){
//     echo $userTr[0]->training_notes;
//    }
//    else{
//        echo $userTr;
//    }?>
<!---->
<!--   </h1>-->
<!--<a href="createtraining" class="btn-primary"> Create a new training</a>-->



<?php $this->end(); ?>



