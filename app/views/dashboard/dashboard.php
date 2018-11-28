<?php $this->setTitle('Home')?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<?php
$user = new Users();
$usersRequests = $user->showAllUsers();
//dump_die($usersRequests);
?>


<div class="container rounded-bord" style="background-color: white">
    <h1 class="text-center red">Dashboard</h1>
    <div class="table">
        <table id="myTable" class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th>Registration date</th>
                <th>Name</th>
                <th>Email Address</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $btn = 1;
                foreach ($usersRequests as $request) {
                        $requestAr[] = $request->getResult();
                        foreach ($requestAr as $key => $value){
                            foreach ($value as $k => $v){
                                echo '<tr id="btn'. $btn .'">';
                                echo '<td>'. htmlspecialchars($v->u_registration_date ). '</td>';
                                echo '<td>'.htmlspecialchars( $v->u_name .' '. $v->u_surname ).'</td>';
                                echo '<td>'. htmlspecialchars($v->u_email). '</td>';
                                echo '</tr>';

                                $btn++;
                            }
                        }
                }

            ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->end(); ?>


