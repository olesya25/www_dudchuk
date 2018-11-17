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
        alert("Accept the request? ");
    }
</script>
<h1 class="text-center red">Here will be a list of users that have sent a request</h1>
<body>
<div class="container">
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
            <tbody>
            <?php
            if(is_array($usersRequests)){
                foreach ($usersRequests as $request) {

                    echo '<tr>';
                    echo '<td>'. $request->u_name . '</td>';
                    echo '<td>'. $request->u_email. '</td>';
                    echo '<td>'. $request->name_of_pdf. '</td>';
                    echo '<td><a type="button" class="btn btn-warning">Read</a></td>';
                    echo '<td><button type="button" onclick="accept()"class="btn btn-success">Accept</button></td>';
                    echo '<td><button type="button" onclick="deny()" class="btn btn-danger">Deny</button></td>';
                    echo '</tr>';
                }
            }else{
                echo '<tr>';
                echo '<td>'. $usersRequests->u_name . '</td>';
                echo '<td>'. $usersRequests->u_email. '</td>';
                echo '<td>'. $usersRequests->name_of_pdf. '</td>';
                echo '<div class="w3-bar">';
                echo '<td><a type="button" class="btn btn-warning">Read</a></td>';
                echo '<td><button  type="button" onclick="accept()" class="btn btn-success">Accept</button></td>';
                echo '<td><button type="button" onclick="deny()" class="btn btn-danger">Deny</button></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
</body>

<?php $this->end(); ?>

