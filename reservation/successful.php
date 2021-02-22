<?php
    session_start();
    require_once("./storage.inc.php");
    require_once("./auth.inc.php");
    $userStorage = new Storage(new JsonIO("./data/users.json"));
    $auth = new Auth($userStorage);
    $errors = [];
    if(!$auth->is_authenticated())
    {
        echo "Permission denied";
        exit(0);
    }
    if ($auth->authorize(["admin"])) {
        echo "Your role information is not user!";
        exit(0);
    }
    if($auth->authenticated_user()["taken"] == 0){
    $auth -> Modify_taken($auth->authenticated_user()["username"]);
    $availableStorage = new Storage(new JsonIO("./data/available.json"));

    function booked()
    {
        global $availableStorage;
        $tmp = $availableStorage -> findOne(["date"=> $_GET["date"]]);
        $id = $tmp["id"];
        $timeindex = 0;
        $isfound = false;
        foreach($tmp["times"] as $time)
        {
            if($time[0]!=$_GET["time"] && $isfound ==false)
            {
               $timeindex = $timeindex+1;
                
            }
            if($time[0] == $_GET["time"])
            {
                $isfound = true;
            }
        }
        $tmp["times"][$timeindex][1] = $tmp["times"][$timeindex][1] + 1;
        if($tmp["times"][$timeindex][1]> $tmp["times"][$timeindex][2])
        {
            global $auth;
            $tmp["times"][$timeindex][1] = $tmp["times"][$timeindex][1] -1;
            $auth -> Modify_taken($auth->authenticated_user()["username"]);
            echo "The number of people is full at that time";
            exit(0);
        }
        $availableStorage -> update($id,$tmp);

    }

    $reservationStorage = new Storage(new JsonIO("./data/reservation.json"));
    $find = false;
    $reservationDetail = $reservationStorage->findAll();
    foreach($reservationDetail as $detail)
    {
        if($detail["date"] == $_GET["date"])
        {
            $find = true;
        }
    }
    if($find == false)
    {
        $tmp = [
            "date" => $_GET["date"],
            "data"=>[$_GET["time"] => [[$auth->authenticated_user()["fullname"],  $auth->authenticated_user()["SSN"],$auth->authenticated_user()["username"]]]]
        ];
        $reservationStorage -> add($tmp);
        booked();
    }else
    {
        $tmp = $reservationStorage -> findOne(["date"=>$_GET["date"]]);
        if(!array_key_exists($_GET["time"],$tmp["data"]))
        {
            $tmp["data"][$_GET["time"]] = [[$auth->authenticated_user()["fullname"],  $auth->authenticated_user()["SSN"],$auth->authenticated_user()["username"]]];
            $id = $tmp["id"];
            $reservationStorage -> update($id,$tmp); 
            booked();
        }else
        {
            $tmp["data"][$_GET["time"]][] = [ $auth->authenticated_user()["fullname"],  $auth->authenticated_user()["SSN"],$auth->authenticated_user()["username"]];
            $id = $tmp["id"];
            $reservationStorage -> update($id,$tmp); 
            booked();

        }
    }
    
    }
    require_once("header.php");

    //var_dump($auth->authenticated_user());
?>
<h1>Successful</h1>
<br>
<p>You have successfully booked!</p>
<a href="index.php" class="btn btn-primary">View my appointment</a>

<?php require_once("footer.php")?>