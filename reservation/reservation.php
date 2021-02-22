<?php
session_start();
require_once("./storage.inc.php");
require_once("./auth.inc.php");
$userStorage = new Storage(new JsonIO("./data/users.json"));
$auth = new Auth($userStorage);
$errors = [];
if (!$auth->is_authenticated() && !"http://webprogramming.inf.elte.hu/students/iw3xv9/PHPHW/index.php" ==$_SERVER['HTTP_REFERER'] ) {
    echo "Permission denied";
    exit(0);
}
if($auth->is_authenticated()&& $auth ->authenticated_user()["taken"]==1)
{
    echo "Permission denied";
    exit(0);
}


require_once("header.php");


?>


<div class="card-group">
    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">Detail</div>
        <div class="card-body">
            <h5 class="card-title">Name:</h5>
            <p class="card-text"><?= $auth->authenticated_user()["fullname"] ?></p>
            <h5 class="card-title">Address:</h5>
            <p class="card-text"><?= $auth->authenticated_user()["address"] ?></p>
            <h5 class="card-title">SSN number:</h5>
            <p class="card-text"><?= $auth->authenticated_user()["SSN"] ?></p>
        </div>
    </div>
    <div class="card text-center">
        <div class="card-header">
            Reservation
        </div>
        <div class="card-body">
            <h5 class="card-title">Appointment details</h5>
            <p class="card-text">Date and time: <?= $_GET["date"] ?> <?= $_GET["time"] ?></p>
            <p class="text-danger">It is mandatory to show up on the appointment after booking it</p>
            <p class="text-danger">There may be side effects of vaccination</p>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">I accept the above terms and have confirmed that all information is correct</label>
            </div>
            <button class="btn btn-primary" id="btn" disabled="true">Confirm</button>
        </div>

    </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="./reservation.js"></script>
</body>

</html>