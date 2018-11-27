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
<div class="col-sm-2 col-sm-offset-5" style="margin-bottom: 10px">
<a href="createtraining" class="btn" style="background-color: #122b40; color: white"  ><span class="glyphicon glyphicon-plus"></span> Add new training</a>
</div>
        <div class="col-md-10 col-md-offset-1 well" >
            <div class="col-md-2 col-md-offset-0 well" >
                <p class="text-center red">Today <?=(date('d.m Y'))?></p>
            </div>
            <div class="col-md-9 col-md-offset-1 well" style="border: 2px solid #122b40" id="divTime2">
            <h3 class="testcss text-center" id="divTime2">Today training</h3><br>
            </div>
            <h5><?php
                $count = 0;
                for($i = 0; $i < $nTr; $i++ ){

                    if((date('Y-m-d') == $userTr[$i]['date']) && !empty($userTr[$i]) ){

                            echo'<div class="col-md-10 col-md-offset-0 well" ">';
                            echo'<h4>'.htmlspecialchars($userTr[$i]['title']).'</h4>';
                            $drilListToday = $drill->showDrill($userTr[$i]['id']);
                            $nToday = count($drilListToday);
                            for ($k = 0; $k < $nToday; $k++){
                                echo'<div show-description="descrp'.$count.'" class="col-md-10 col-md-offset-0 well showdescription" style="background-image: linear-gradient(to right, white, #31708f)>';
                                echo'<h5>'.htmlspecialchars($drilListToday[$k]['title']).'</h5><h8 style="float: right; color: darkgray">click to see the description</h8>';
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
        <div class="col-md-10 col-md-offset-1 well" style="border: 2px solid #122b40">
            <h3>Upcoming training</h3><br>
            <h5><?php
                for($i = 0; $i < $nTr; $i++ ){

                    if(date('Y-m-d') <  $userTr[$i]['date']) {
                        echo '<div class="col-md-2 col-md-offset-0 well" id="divTime1">';
                        echo '<p>'.$userTr[$i]['date'].'</p>';
                        echo '</div>';
                        echo'<div class="col-md-9 col-md-offset-1 well" id="divTime2">';
                        echo'<div class="rounded-bord" style="background-image: linear-gradient(to right, white, #1b6d85)">';
                        echo'<h4>'.htmlspecialchars($userTr[$i]['title']).'</h4>';
                        echo '</div>';
                        $drilListUpcoming = $drill->showDrill($userTr[$i]['id']);
                        $nUpcoming = count($drilListUpcoming);
                        for ($k = 0; $k < $nUpcoming; $k++){
                            echo'<div show-description="descrp'.$count.'" class="col-md-10 col-md-offset-0 well showdescription" style="background-image: linear-gradient(to right, white, #31708f)">';
                            echo'<h5>'.htmlspecialchars($drilListUpcoming[$k]['title']).'</h5><h8 style="float: right; color: darkgray">click to see the description</h8>';
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
                    echo'<div class="rounded-bord" style="background-image: linear-gradient(to right, white, forestgreen)">';
                    echo'<h4 id="divTime2">'.htmlspecialchars($userTr[$i]['title']).'</h4>';
                    echo'<button show-notes="notes'.$count.'" id="divTime1" style="float: right" class="shownotes"><span class="glyphicon glyphicon-eye-open"></span>show notes</button>';
                    echo'<div class="col-md-10 col-md-offset-0 well centered " id="notes'.$count.'" style="display: none">';

                    echo'<h5>'.htmlspecialchars($userTr[$i]['notes']).'</h5>';
                    echo'</div>';
                    echo'</div>';

                    $drilListDone = $drill->showDrill($userTr[$i]['id']);
                    $nUpcoming = count($drilListDone);
                    for ($k = 0; $k < $nUpcoming; $k++){
                        echo'<div show-description="descrp'.$count.'" class="col-md-10 col-md-offset-0 well showdescription" style="background-image: linear-gradient(to right, white,yellowgreen)" >';

                        echo'<h5 >'.htmlspecialchars($drilListDone[$k]['title']).'</h5><h8 style="float: right; color: darkgray">click to see the description</h8>';
                        echo'</div>';
                        echo'<div class="col-md-10 col-md-offset-0 well centered " id="descrp'.$count.'" style="display: none">';
                        echo'<h5>'.htmlspecialchars($drilListDone[$k]['description']).'</h5>';
                        echo'</div>';
                        $count++;

                    }
                    echo '<form action="mydiary" method="post">';
                    echo'<textarea class="form-control" placeholder="Add notes about training (performance, achievments etc.).." name="notes"></textarea> ';
                    echo '<button type="submit" name="add-notes" value="'.$userTr[$i]['id'] .'" class="btn myclas" style="background-color: #122b40; color: white; margin-top: 10px">Add notes</button>';
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



