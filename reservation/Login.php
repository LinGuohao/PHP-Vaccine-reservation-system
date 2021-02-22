<?php
session_start();
require_once("./storage.inc.php");
require_once("./auth.inc.php");
$userStorage = new Storage(new JsonIO("./data/users.json"));
$auth = new Auth($userStorage);
$errors = [];

if (isset($_POST["username"], $_POST["password"])) {
  $username = trim($_POST["username"]);
  $password = $_POST["password"];

  // Look for the user with this username and password
  $user = $auth->authenticate($username, $password);
  // If the user is not found
  if ($user === NULL) {
    $errors[] = "Invalid username or password";
  }

  // If there were no errors...
  if (empty($errors)) {
    // Log in the user
    if (isset($_GET["date"]) && isset($_GET["time"])) {
      $auth->login($user);
      $date = $_GET["date"];
      $time = $_GET["time"];
      header("Location: reservation.php?date=".$date."&time=".$time);
    } else {
      $auth->login($user);
      header("Location: index.php");
    }
  }
}

?>


<?php require_once("header.php") ?>

<h1>Log in</h1>

<form class="col-md-6 col-xs-12" method="post">
  <div class="form-group">
    <label for="username">Email</label>
    <input class="form-control" type="text" name="username" id="username" value="<?= $username ?? "" ?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" id="password">
  </div>
  <button class="btn btn-primary">Log in</button>
  <a href="signup.php">If you don't have a user yet, you can sign up here</a>

  <?php require("errors.inc.php") ?>
</form>

<?php require_once("footer.php") ?>