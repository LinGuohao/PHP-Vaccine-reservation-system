<?php
session_start();
require_once("./storage.inc.php");
require_once("./auth.inc.php");
$userStorage = new Storage(new JsonIO("./data/users.json"));
$auth = new Auth($userStorage);
$availableStorage = new Storage(new JsonIO("./data/available.json"));
if (!isset($_SESSION["month"])) {
    $_SESSION["month"] = "2";
}
if (isset($_GET["month"])) {
    $_SESSION["month"] = $_GET["month"];
}
function get_date($num)
{
    if ($num == 1) {
        $date = [];
        for ($i = 1; $i <= 31; $i++) {
            $tmp = "2021-1-";
            $tmp = $tmp . $i;
            $date[] = $tmp;
        }
        return $date;
    }
    if ($num == 2) {
        $date = [];
        for ($i = 1; $i <= 28; $i++) {
            $tmp = "2021-2-";
            $tmp = $tmp . $i;
            $date[] = $tmp;
        }
        return $date;
    }
    if ($num == 3) {
        $date = [];
        for ($i = 1; $i <= 31; $i++) {
            $tmp = "2021-3-";
            $tmp = $tmp . $i;
            $date[] = $tmp;
        }
        return $date;
    }
}
$date = get_date($_SESSION["month"]);

function Can_booked($date)
{
    global $availableStorage;
    $data = $availableStorage->findOne(["date" => $date]);
    if ($data == null) {
        return false;
    }
    if ($data != null) {
        $istrue = false;
        foreach ($data["times"] as $time) {
            if ($time[2] - $time[1] > 0) {
                return true;
            }
        }
        if ($istrue == false) {
            return false;
        }
    }
}

//var_dump(Can_booked("2021-2-5"));
function Can_booked_time($date)
{
    global $availableStorage;
    $data = $availableStorage->findOne(["date" => $date]);
    $result = [];
    if ($data == null) {
        return null;
    }
    if ($data != null) {
        foreach ($data["times"] as $time) {
            $tmp = [];
            if ($time[2] - $time[1] > 0) {
                $tmp[] = $time[0];
                $tmp[] = true;
                $tmp[] = $time[1];
                $tmp[] = $time[2];
            } else {
                $tmp[] = $time[0];
                $tmp[] = false;
                $tmp[] = $time[1];
                $tmp[] = $time[2];
            }
            $result[] = $tmp;
        }
        return $result;
    }
}
//var_dump(Can_booked_time("2021-2-5"));
function Generate_td($bookedtimes, $date)
{
    $result = "";
    if ($bookedtimes != null) {
        foreach ($bookedtimes as $bookedtime) {
            if ($bookedtime["1"] == true) {
                $tmp = '<a href="reservation.php?date=' . $date . '&time=' . $bookedtime[0] . '" class="badge badge-success">' . $bookedtime[0] . " " . $bookedtime[2] . "/" . $bookedtime[3] . '</a><br>';
                $result = $result . $tmp;
            } else {
                $tmp = '<div class="badge badge-warning">' . $bookedtime[0] . " " . $bookedtime[2] . "/" . $bookedtime[3] . '</div><br>';
                $result = $result . $tmp;
            }
        }
        return $result;
    }
}
//var_dump()
//var_dump(Generate_td(Can_booked_time($date[4]),$date[4]));
?>
<?php require_once("header.php"); ?>
<?php if ($auth->authorize(["admin"])) : ?>
    <?php require_once("index_admin.php")?>
<?php else : ?>
    <?php if ($auth->is_authenticated()) : ?>
        <?php if ($auth->authenticated_user()["taken"] == 1) : ?>
            <?php require_once("index_Login_taken.php"); ?>
        <?php elseif ($auth->authenticated_user()["taken"] == 0) : ?>
            <?php require_once("index_Login.php"); ?>
        <?php endif; ?>
    <?php else : ?>
        <?php require_once("index_not_Login.php"); ?>
    <?php endif; ?>
<?php endif; ?>
<button style="float:left" class="btn btn-primary" id="Pervious">Previous</button><button style="float:right" class="btn btn-primary" id="Next">Next</button></div>

<div class="card">
    <div class="card-header">
        Vaccine appointment
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p>COVID-19 has been going on for a long time, and the vaccine is now available in Budapest. If you travel frequently or have long-term external activities, the vaccine will allow you to avoid many risks. You can log in and choose the available time for vaccination.</p>
            <footer class="blockquote-footer">Budapest Hungary</footer>
        </blockquote>
    </div>
</div>
<div id="sessionMonth" style="visibility: hidden;"><?= $_SESSION["month"] ?></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="./list.js"></script>
</body>

</html>