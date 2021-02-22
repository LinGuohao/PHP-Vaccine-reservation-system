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
function checkdate2($data)
{
    $date = strtotime($data);
    if ($data == (date("Y-m-d", $date)) || $data == (date("Y-m-j", $date)) || $data == (date("Y-n-d", $date)) || $data == (date("Y-n-j", $date)))
        return true;
    else
        return false;
}
function sortbytime($a,$b)
{
    if(strtotime($a[0]) == strtotime($b[0]))
    {
        return 0;
    }
    return strtotime($a[0]) < strtotime($b[0]) ? -1 : 1;
}

function checkinMonth($data)
{
    $data = strtotime($data);
    $start = strtotime("2021-1-1");
    $end = strtotime("2021-3-31");
    if($data<$start || $data>$end)
    {
        return false;
    }else
    {
        return true;
    }
}
function checktime($date,$time)
{
    $testStorage = new Storage(new JsonIO("./data/available.json"));
    $tmp = $testStorage -> findOne(["date"=>date('Y-n-j',strtotime($date))]);
    if($tmp == null)
    {
        return true;
    }else
    {
        $isfound = false;
        foreach($tmp["times"] as $tim)
        {
            if($time==$tim)
            {
               
                return false;
            }
        }
        if($isfound == false)
        {
            
            return true;
        }
    }
}

if(isset($_POST["date"]) && isset($_POST["time"])&& isset($_POST["slots"]))   
{
    $date = $_POST["date"];
    $time = $_POST["time"];
    $slots = $_POST["slots"];
    if(checkdate2($date)==false)
    {
        $errors[] = "Illegal date";
    }else
    {
        if(checkinMonth($date)==false)
        {
            $errors[] = "The date must be between January 2021 and March 2021";
        }
    }

    if(checktime($date,$time)==false)
    {
        $errors[]="This time already exists";
    }

    if((int)$slots<=0)
    {
        $errors[]="The number of available slots must be greater than 0";
    }

    if(empty($errors))
    {
        $availableStorage = new Storage(new JsonIO("./data/available.json"));
        $tmp = $availableStorage -> findOne(["date"=>date('Y-n-j',strtotime($date))]);
        if($tmp == null)
        {
            $new =[
                "date" => date('Y-n-j',strtotime($date)),
                "times" => [[$time,0,(int)$slots]]
            ];
            $availableStorage ->add($new);
        }else
        {
            $timesarray= $tmp["times"];
            $id = $tmp["id"];
            $timesarray[]= [$time,0,(int)$slots];
            usort($timesarray,"sortbytime");
            $tmp["times"] = $timesarray;
            $availableStorage -> update($id,$tmp);
        }
        header("Location: index.php");
    }


}



require_once("header.php");


?>
<h1>Add new date and time</h1>
<form class="col-md-6 col-xs-12" method="post">
    <div class="form-group">
        <label for="date">Date</label>
        <input class="form-control" type="date" name="date" id="date" value="<?= $date ?? "" ?>">
    </div>
    <div class="form-group">
        <label for="description">Time</label>
        <input class="form-control" type="time" name="time" id="time" value="<?= $time ?? "" ?>">
    </div>
    <div class="form-group">
        <label for="description">Total slots</label>
        <input class="form-control" type="number" name="slots" id="slots" value="<?= $slots ?? "" ?>">
    </div>
    <button class="btn btn-primary">Submit</button>

    <?php require("errors.inc.php") ?>
</form>

<?php require_once("footer.php") ?>