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
<div class="rounded-bord diary-back">
    <div class="row">

<a href="createtraining" class="btn btn-success" style="float: left"><span class="glyphicon glyphicon-plus"></span></a>

        <div class="col-md-10 col-md-offset-1 well " >
            <div class="col-md-2 col-md-offset-0 well" id="divTime1">
                <p class="text-center red">Today <?=(date('d.m Y'))?></p>
            </div>
            <div class="col-md-9 col-md-offset-1 well" id="divTime2">
            <h3 class="testcss text-center" id="divTime2">Today training</h3><br>
            </div>
            <h5><?php
                $count = 0;
                for($i = 0; $i < $nTr; $i++ ){

                    if((date('Y-m-d') == $userTr[$i]['date']) && !empty($userTr[$i]) ){

                            echo'<div class="col-md-10 col-md-offset-0 well">';
                            echo'<h4>'.htmlspecialchars($userTr[$i]['title']).'</h4>';
                            $drilListToday = $drill->showDrill($userTr[$i]['id']);
                            $nToday = count($drilListToday);
                            for ($k = 0; $k < $nToday; $k++){
                                echo'<div show-description="descrp'.$count.'" class="col-md-10 col-md-offset-0 well showdescription">';
                                echo'<h5>'.htmlspecialchars($drilListToday[$k]['title']).'</h5>';
                                echo'</div>';
                                echo'<div class="col-md-10 col-md-offset-0 well centered " id="descrp'.$count.'" style="display: none">';
                                echo'<h5>'.htmlspecialchars($drilListToday[$k]['description']).'</h5>';
                                echo'</div>';
                                $count++;
                                //
                            }
                            echo'</div>';
                        }
                }
                ?>
            </h5>
        </div>
        <div class="col-md-10 col-md-offset-1 well">
            <h3>Upcoming training</h3><br>
            <h5><?php
                for($i = 0; $i < $nTr; $i++ ){

                    if(date('Y-m-d') <  $userTr[$i]['date']) {
                        echo '<div class="col-md-2 col-md-offset-0 well" id="divTime1">';
                        echo '<p>'.$userTr[$i]['date'].'</p>';
                        echo '</div>';
                        echo'<div class="col-md-9 col-md-offset-1 well" id="divTime2">';
                        echo'<div class="rounded-bord" style="background-color: darkturquoise;">';
                        echo'<h4>'.htmlspecialchars($userTr[$i]['title']).'</h4>';
                        echo '</div>';
                        $drilListUpcoming = $drill->showDrill($userTr[$i]['id']);
                        $nUpcoming = count($drilListUpcoming);
                        for ($k = 0; $k < $nUpcoming; $k++){
                            echo'<div show-description="descrp'.$count.'" class="col-md-10 col-md-offset-0 well showdescription">';
                            echo'<h5>'.htmlspecialchars($drilListUpcoming[$k]['title']).'</h5>';
                            echo'</div>';
                            echo'<div class="col-md-10 col-md-offset-0 well centered " id="descrp'.$count.'" style="display: none">';
                            echo'<h5>'.htmlspecialchars($drilListUpcoming[$k]['description']).'</h5>';
                            echo'</div>';
                            $count++;
                        }
                        echo'</div>';
                    }
                }
                ?>
            </h5>

        </div>
        <div class="col-md-10 col-md-offset-1 well">
            <h3>Training done</h3><br>
            <h5><?php
                for($i = 0; $i < $nTr; $i++ ){

                if (date('Y-m-d') >  $userTr[$i]['date'] ){
                    echo'<div class="col-md-10 col-md-offset-0 well">';
                    echo'<div class="rounded-bord" style="background-color: seagreen">';
                    echo'<h4 id="divTime2">'.htmlspecialchars($userTr[$i]['title']).'</h4>';
                    echo'<button show-notes="notes'.$count.'" id="divTime1" style="float: right" class="shownotes"><span class="glyphicon glyphicon-eye-open"></span></button>';
                    echo'<div class="col-md-10 col-md-offset-0 well centered " id="notes'.$count.'" style="display: none">';

                    echo'<h5>'.htmlspecialchars($userTr[$i]['notes']).'</h5>';
                    echo'</div>';
                    echo'</div>';

                    $drilListDone = $drill->showDrill($userTr[$i]['id']);
                    $nUpcoming = count($drilListDone);
                    for ($k = 0; $k < $nUpcoming; $k++){
                        echo'<div show-description="descrp'.$count.'" class="col-md-10 col-md-offset-0 well showdescription" style="background-color:darkseagreen" >';

                        echo'<h5 >'.htmlspecialchars($drilListDone[$k]['title']).'</h5>';
                        echo'</div>';
                        echo'<div class="col-md-10 col-md-offset-0 well centered " id="descrp'.$count.'" style="display: none">';
                        echo'<h5>'.htmlspecialchars($drilListDone[$k]['description']).'</h5>';
                        echo'</div>';
                        $count++;

                    }
                    echo '<form action="mydiary" method="post">';
                    echo'<textarea class="form-control" placeholder="Add notes about training (performance, achievments etc.).." name="notes"></textarea> ';
                    echo '<button type="submit" name="add-notes" value="'.$userTr[$i]['id'] .'" class="btn btn-info myclas">Add notes</button>';
                    echo'</form>';
                    echo'</div>';
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
<script>
    $(document).ready(function () {
        $('.showdescription').on('click', function () {
            var showDscrp = $(this).attr('show-description');

            $('#'+ showDscrp).toggle();
        });


    })
    $(document).ready(function () {
        $('.shownotes').on('click', function () {
            var showNotes = $(this).attr('show-notes');

            $('#'+ showNotes).toggle();
        });
    })

</script>

<?php $this->end(); ?>



