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
<script>
    function deny() {
        alert("Sure you want to deny the request?");
    }
    function accept() {
        var role = <?php $user->assignCoach(2)?>
       return false;
    }
</script>
<body>

<div class="container"><!-- main container-->
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
                    echo '<td>'. htmlspecialchars($request->name_of_pdf). '</td>';
                    echo '<td><a data-read="read'. $btn .'" type="button" class="btn btn-warning">Read</a></td>';
                    echo '<td><button data-accept="accept'. $btn .'" type="button" onclick="accept()"class="btn btn-success">Accept</button></td>';
                    echo '<td><button data-deny="deny'. $btn .'" type="button" onclick="deny()" class="btn btn-danger">Deny</button></td>';
                    echo '</tr>';
                    $btn++;
                    echo'<div style="display: none" id="info" class="container">';
                    echo'<div class="row">';
                    echo'<div class="col-sm-6">';
                    echo'<div class="card bg-info">';
                    echo' <div class="card-body">';
                    echo'<h5 class="card-title">Message</h5>';
                    echo'<h5 class="card-text">'. htmlspecialchars($request->message_to_admin ). '</h5>';
                    echo'</div>';
                    echo'</div>';
                    echo'</div>';
                    echo'</div>';
                    echo'</div>';
                }
            }else{
                echo '<tr>';
                echo '<td>'. htmlspecialchars($usersRequests->u_name) . '</td>';
                echo '<td>'. htmlspecialchars($usersRequests->u_email). '</td>';
                echo '<td>'. htmlspecialchars($usersRequests->name_of_pdf). '</td>';
                echo '<div class="w3-bar">';
                echo '<td><a data-read="read1" type="button" class="btn btn-warning">Read</a></td>';
                echo '<td><button  data-accept ="accept1" type="button"  class="btn btn-success">Accept</button></td>';
                echo '<td><button data-deny ="deny1" type="button"  class="btn btn-danger">Deny</button></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>

    </div>
</div> <!-- /container -->

</body>

<div style="display: none" id="info" class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card bg-info">
                <div class="card-body">
                    <h5 class="card-title">'. $v->drill_name . '</h5>
                    <p class="card-text">'. $v->drill_description.'</p>
                    <a href="#" class="btn btn-primary btn-xs">Close</a>
                </div>
            </div>
        </div>

    </div>
</div>
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
            var btnDeny = $(this).attr('data-read');

            $('#info').toggle();

        });
    })
</script>

<?php $this->end(); ?>

