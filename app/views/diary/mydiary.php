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

<h1 class="text-center red"><?=$userTr[0]->training_notes?></h1>

<?php $this->end(); ?>



