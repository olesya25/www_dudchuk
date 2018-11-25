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
                                echo '<td>'. htmlspecialchars($v->u_registration_date ). '</td>';
                                echo '<td>'.htmlspecialchars( $v->u_name .' '. $v->u_surname ).'</td>';
                                echo '<td>'. htmlspecialchars($v->u_email). '</td>';
                                echo '<td><a data-read="info'.$btn .'" type="button" class="btn btn-warning">Read</a></td>';
                                echo '</tr>';
                                echo '<div style="display: none" id="info' . $btn .'" class="container">';
                                echo'<div class="row">';
                                echo'<div class="col-sm-6">';
                                echo'<div class="card bg-info">';
                                echo' <div class="card-body">';
                                echo'<h5 class="card-title">Message</h5>';
                                echo'<h5 class="card-text">'. htmlspecialchars($v->message_to_admin ). '</h5>';
                                echo'</div>';
                                echo'</div>';
                                echo'</div>';
                                echo'</div>';
                                echo'</div>';
                                $btn++;
                            }
                        }
                }

            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
<script>
    $(document).ready(function () {
        $('.btn-warning').on('click', function () {
            var btnRead = $(this).attr('data-read');
            $('#' + btnRead).toggle();

        });
    })
</script>


<?php $this->end(); ?>


