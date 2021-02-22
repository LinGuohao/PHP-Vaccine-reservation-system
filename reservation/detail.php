<?php
session_start();
require_once("./storage.inc.php");
require_once("./auth.inc.php");
$userStorage = new Storage(new JsonIO("./data/users.json"));
$auth = new Auth($userStorage);
$errors = [];
if (!$auth->authorize(["admin"])) {
    echo "Permission denied";
    exit(0);
}

function Getnum($date, $time)
{
    $reservationStorage = new Storage(new JsonIO("./data/reservation.json"));
    $tmp = $reservationStorage->findOne(["date" => $date]);
    if ($tmp == null) {
        return 0;
    } else {
        $isfound = false;
        foreach ($tmp["data"] as $timeIndex => $data) {
            if ($timeIndex == $time) {
                $isfound = true;
            }
        }

        if ($isfound == true) {
            return count($tmp["data"][$time]);
        } else {
            return 0;
        }
    }
}
function GenerateTable($date,$time)
{
    
    $num = Getnum($date,$time);
    $reservationStorage = new Storage(new JsonIO("./data/reservation.json"));
    $tmp = $reservationStorage->findOne(["date" => $date]);
    $index = 1;
    $tablebody = "";
    foreach($tmp["data"][$time]as $people)
    {
        $tablebody = $tablebody."<tr>\n";
        $tablebody = $tablebody.'<th scope="row">'.$index.'</th>'."\n";
        $tablebody = $tablebody."<td>".$people[0]."</td>"."\n";
        $tablebody = $tablebody."<td>".$people[1]."</td>"."\n";
        $tablebody = $tablebody."<td>".$people[2]."</td>"."\n";
        $tablebody = $tablebody."</tr>\n";
    }
    return $tablebody;

}


require_once("header.php");
$num =0;
if (isset($_GET["date"]) && isset($_GET["time"])) {
    $date = $_GET["date"];
    $time = $_GET["time"];
    $num = Getnum($date,$time);
    



    
}
?>

<?php if($num == 0):?>
    <h1>No reservation at this time</h1>
<?php elseif(isset($_GET["date"]) && isset($_GET["time"])): ?>
    <h1 class="text-info">Date: <?=$_GET["date"]?>    Time:<?=$_GET["time"]?></h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">SSN</th>
      <th scope="col">Email address</th>
    </tr>
  </thead>
  <tbody>
    <?= GenerateTable($_GET["date"],$_GET["time"])?>
  </tbody>
</table>
<?php endif;?>


<a href="index.php" class="btn btn-primary">Go Back</a>
<?php require_once("footer.php") ?>