<?php $this->setTitle('Home')?>
<?php
$training = new Training(currentUser()->id);
$userTr = $training->getTraining();

if(!empty($userTr)){
    $userTr = $training->getTraining();
}else{
    $userTr = "You have no training for now";
}
?>
<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<h1 class="text-center red"><?

    if(is_array($userTr)){
     echo $userTr[0]->training_notes;
    }
    else{
        echo $userTr;
    }?>

   </h1>

<?php $this->end(); ?>



