<?php
$drills = new Drill();
$drillsContent = $drills->showAll();

?>
<?php $this->setTitle('Home')?>

<?php $this->start('head'); ?>
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<?php $this->end(); ?>

<?php $this->start('body'); ?>



    <?php $drillsArray [] = $drillsContent[0]->getResult();
    foreach($drillsArray as $key => $value){
        foreach ($value as $k => $v){
            //dump_die($v);
            echo'<div class="w3-container">';
            echo '<div class="w3-card" style="alignment-baseline: center"  >';
            echo' <header class="w3-container w3-blue style="align-items: flex-end"">';
            echo '<h1>'. $v->drill_name . '<button class="btn-success"> Add </button></h1>';
            echo '</header>';
            echo '<div class="w3-container">';
            echo '<p>'. $v->drill_description.'</p>';
            echo '</div>';
            echo '<footer class="w3-container w3-blue">';
            echo '<h5>Footer</h5>';
        echo '</footer>';
    echo '</div>';
echo '</div>';
        }

    }
//
    ?>








<?php $this->end(); ?>




