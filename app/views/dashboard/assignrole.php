<?php $this->setTitle('Home')?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<?php
$user = new Users();
$usersRequests = $user->find([
        'condition' => 'coach_permission',
        'bind' => 1
    ]);

?>

<body>

<div class="container rounded-bord centered" style="background-color: white"><!-- main container-->
    <div class="">
        <h3 class="text-center">Requests from users</h3>
    </div>
    <div class="table">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>CV</th>
                <th>Information</th>
                <th>Accept</th>
                <th>Deny</th>
            </tr>
            </thead>
            <?php
            if(is_array($usersRequests)){
                $btn = 1;
                foreach ($usersRequests as $request) {
                    echo '<tr id="btn'. $btn .'">';
                    echo '<td>'. htmlspecialchars($request->u_name) . '</td>';
                    echo '<td>'. htmlspecialchars($request->u_email). '</td>';
                    echo '<td><a href="'.PROOT.'app/library/helpers/download.php?uploads='. htmlspecialchars($request->name_of_pdf). '">Download file</a> </td>';
                    echo '<td><a data-read="read'. $btn .'" type="button" class="btn btn-warning">Read</a></td>';
                    echo'<td><form action="'.PROOT.'dashboard/assignrole" method="post">
                           <button type="submit" name="accept" value="'.$request->id.'" class="btn btn-success">Accept</button>
                           </form></td>';
                    echo '<td><button data-deny="deny'. $btn .'" type="button" onclick="deny()" class="btn btn-danger">Deny</button></td>';
                    echo '</tr>';

                    echo'<div style="display: none" id="read'.$btn. '" class=" col-sm-6 col-md-offset-3 rounded-bord"">';
                    echo'<div class="row">';
                    echo'<div class="col-sm-6">';
                    echo'<div class="card">';
                    echo' <div class="card-body">';
                    echo'<h5 class="card-title">Message</h5>';
                    echo'<h10>By '. htmlspecialchars($request->u_name). ' </h10>';
                    echo'<h5 class="card-text">'. htmlspecialchars($request->message_to_admin ). '</h5>';
                    echo'</div>';
                    echo'</div>';
                    echo'</div>';
                    echo'</div>';
                    echo'</div>';
                    $btn++;
                }
            }
            ?>

        </table>

    </div>
</div>

</body>


<script>
    $(document).ready(function () {
        $('.btn-success ').on('click', function () {
            var btnAccept = $(this).attr('data-accept');



        });
    })
    $(document).ready(function () {
        $('.btn-danger ').on('click', function () {
            var btnDeny = $(this).attr('data-deny');

            alert(btnDeny);

        });
    })
    $(document).ready(function () {
        $('.btn-warning').on('click', function () {
            var btnRead = $(this).attr('data-read');

            $('#' + btnRead).toggle();

        });
    })
</script>

<?php $this->end(); ?>

