<?php
session_start();
require_once("./storage.inc.php");
require_once("./auth.inc.php");
$userStorage = new Storage(new JsonIO("./data/users.json"));
$auth = new Auth($userStorage);
$errors = [];
if (!$auth->is_authenticated()) {
    echo "Permission denied";
    exit(0);
}
if ($auth->authorize(["admin"])) {
    echo "Your role information is not user!";
    exit(0);
}

if ($auth->authenticated_user()["taken"] == "1") {
    $auth->Modify_taken($auth->authenticated_user()["username"]);
    $reservationStorage = new Storage(new JsonIO("./data/reservation.json"));
    $id = 0;
    $dateindex = 0;
    $isfound = false;
    $reservation = $reservationStorage->findAll();
    $availableStorage = new Storage(new JsonIO("./data/available.json"));
    foreach ($reservation as $res) {
        foreach ($res["data"] as $date => $data) {
            $set = 0;
            foreach ($data as $info) {
                if ($info[0] == $auth->authenticated_user()["fullname"]) {
                    $isfound = true;
                    $id = $res["id"];
                    $dateindex = $date;
                    break(3);
                } else {
                    $set = $set + 1;
                }
            }
        }
    }

    //var_dump($set);
    $tmp = $reservationStorage->findById($id);
    $tmparray = $tmp["data"][$dateindex];
    array_splice($tmparray,$set,1);
    $tmp["data"][$dateindex] = $tmparray;
    //var_dump($tmp);
    $reservationStorage->update($id, $tmp);
    function unbooked()
    {
        global $availableStorage;
        global $id;
        global $reservationStorage;
        global $dateindex;
        $tmp = $availableStorage->findOne(["date" => $reservationStorage->findById($id)["date"]]);
        $id = $tmp["id"];
        $timeindex = 0;
        $isfound = false;
        foreach ($tmp["times"] as $time) {
            if ($time[0] != $dateindex && $isfound == false) {
                $timeindex = $timeindex + 1;
            }
            if ($time[0] == $dateindex) {
                $isfound = true;
            }
        }
        $tmp["times"][$timeindex][1] = $tmp["times"][$timeindex][1] - 1;
        $availableStorage->update($id, $tmp);
    }

    unbooked();
}



require_once("header.php");


//var_dump($auth->authenticated_user());
?>
<h1>Reservation cancelled</h1>
<br>
<p>Your reservation has been cancelled!</p>
<a href="index.php" class="btn btn-primary">View my appointment</a>

<?php require_once("footer.php") ?>