<?php
session_start();
require_once("./storage.inc.php");
require_once("./auth.inc.php");
$userStorage = new Storage(new JsonIO("./data/users.json"));
$auth = new Auth($userStorage);
$errors = [];
$successes = [];
if (
    isset($_POST["username"]) && isset($_POST["SSN"]) && isset($_POST["address"]) && isset($_POST["fullname"]) &&
    isset($_POST["password"]) && isset($_POST["confirm-password"])
) {
    $username = trim($_POST["username"]);
    $SSN = $_POST["SSN"];
    $address = trim($_POST["address"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];
    $fullname = trim($_POST["fullname"]);
    if (empty($username)) {
        $errors[] = "Email address must not be empty";
    }
    if (!empty($username) && !filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email address is invalid";
    }
    if ($auth->user_exists($username)) {
        $errors[] = "Email address already taken";
    }
    if (empty($SSN)) {
        $errors[] = "SSN must not be empty";
    }
    if (!empty($SSN) && !is_numeric($SSN)) {
        $errors[] = "SSN must be numbers";
    }
    if (!empty($SSN) && is_numeric($SSN)) {
        if (strlen((int)($SSN)) != 9) {
            $errors[] = "SSN must be nine digits";
        }
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    if (empty($fullname)) {
        $errors[] = "Full name must not be empty";
    }
    if (empty($address)) {
        $errors[] = "Address must not be empry";
    }

    if (empty($errors)) {
        $successes[] = "Registration successful. Please log in.";

        // Register the new user
        $auth->register([
            "e-mail"  => $username,
            "password"  => $password,
            "fullname"  => $fullname,
            "address" => $address,
            "SSN" => $SSN,
        ]);
        header("Location: Login.php");
    }
}

?>

<?php  require_once("header.php")?>
        <h1>Sign up</h1>
        <form class="col-md-6 col-xs-12" method="post">
            <div class="form-group">
                <label for="username">Email</label>
                <input class="form-control" type="email" name="username" id="username" value="<?= $username ?? "" ?>">
            </div>
            <div class="form-group">
                <label for="SSN">SSN number</label>
                <input class="form-control" type="text" maxlength="9" name="SSN" id="SSN" value="<?= $SSN ?? "" ?>">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" type="text" name="address" id="address" value="<?= $address ?? "" ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm password</label>
                <input class="form-control" type="password" name="confirm-password" id="confirm-password">
            </div>
            <div class="form-group">
                <label for="fullname">Full name</label>
                <input class="form-control" type="text" name="fullname" id="fullname" value="<?= $fullname ?? "" ?>">
            </div>
            <button class="btn btn-primary">Submit</button>
            <a href="Login.php">If you already have a user yet, you can log in here</a>

            <?php require("errors.inc.php") ?>
        </form>
 <?php require_once("footer.php")?>