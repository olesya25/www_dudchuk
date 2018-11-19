<?php $this->setTitle('Home')?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<?php
$user = new Users();
$usersRequests = $user->showAllUsers();
//dump_die($usersRequests);
?>

<h1 class="text-center red">Dashboard</h1>
<div class="container">
    <div class="">
        <h3 class="text-center">Requests from users</h3>
    </div>
    <div class="table">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th>Registration date</th>
                <th>Name</th>
                <th>Email Address</th>

                <th>Information</th>

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
                                echo '<td>'. $v->u_registration_date . '</td>';
                                echo '<td>'. $v->u_name .' '. $v->u_surname .'</td>';
                                echo '<td>'. $v->u_email. '</td>';

                                echo '<td><a type="button" class="btn btn-warning">Read</a></td>';
                                echo '</tr>';
                                $btn++;

                            }
                        }
                }

            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->


<?php $this->end(); ?>


