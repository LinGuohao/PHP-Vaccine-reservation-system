<!doctype html>
<html>

<head>
    <style>

    </style>
    <meta chatset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Reservation</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Reservation</a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Date</a>
                </li>
            </ul>
        </div>
        
        <?php if ($auth->is_authenticated()): // If there is a user logged in ?>
        <a class="btn btn-primary" href="Logout.php">Log out (<?= $auth->authenticated_user()["fullname"] ?>)</a>
      <?php else: ?>
        <a class="btn btn-primary" href="Login.php">Log in</a>
      <?php endif; ?>

       


    </nav>
    <div class="container py-3">