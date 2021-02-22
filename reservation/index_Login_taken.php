<?php

function Generate_td_taken($bookedtimes, $date)
{
    $result = "";
    if ($bookedtimes != null) {
        foreach ($bookedtimes as $bookedtime) {
            if ($bookedtime["1"] == true) {
                $tmp = '<div class="badge badge-success">' . $bookedtime[0] . " " . $bookedtime[2] . "/" . $bookedtime[3] . '</div><br>';
                $result = $result . $tmp;
            } else {
                $tmp = '<div class="badge badge-warning">' . $bookedtime[0] . " " . $bookedtime[2] . "/" . $bookedtime[3] . '</div><br>';
                $result = $result . $tmp;
            }
        }
        return $result;
    }
}


function Get_Information()
{
    $reservationStorage = new Storage(new JsonIO("./data/reservation.json"));
    $id = 0;
    $dateindex = 0;
    $isfound = false;
    $reservation = $reservationStorage->findAll();
    global $auth;
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
                    //var_dump($reservation);
                    $set = $set + 1;
                }
            }
        }
    }
    //var_dump($set);
    $tmp = $reservationStorage->findById($id);
    return ["date"=>$tmp["date"],"time" => $dateindex];
}

?>
<div class="card text-center">
  <div class="card-header">
  Your appointment
  </div>
  <div class="card-body">
    <h5 class="card-title">Your appointment details</h5>
    <p class="card-text">Date: <?=Get_Information()["date"]?>  Time: <?=Get_Information()["time"] ?> </p>
    <p class="text-danger">You can cancel the booking using the "Cancel" button below</p>
    <a href="cancel.php" class="btn btn-primary">Cancel</a>
  </div>
<table class="table table-bordered">
    <thead>
        <tr>
            <?php if ($_SESSION["month"] == "1") : ?>
                <th scope="col">January</th>
            <?php endif ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <th scope="col">February</th>
            <?php endif ?>
            <?php if ($_SESSION["month"] == "3") : ?>
                <th scope="col">March</th>
            <?php endif ?>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            <th scope="col">Saturday</th>
            <th scope="col">Sunday</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Week1</th>

            <?php if ($_SESSION["month"] == "1") : ?>
                <td style="background-color:#FF0000">unavailable</td>
                <td style="background-color:#FF0000">unavailable</td>
                <td style="background-color:#FF0000">unavailable</td>
                <td style="background-color:#FF0000">unavailable</td>
                <?php for ($i = 1; $i < 4; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 1; $i < 8; $i++) : ?>
                    <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 1; $i < 8; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row">Week2</th>
            <?php if ($_SESSION["month"] == "1") : ?>
                <?php for ($i = 4; $i < 11; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 8; $i < 15; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>

            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 8; $i < 15; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row">Week3</th>
            <?php if ($_SESSION["month"] == "1") : ?>
                <?php for ($i = 11; $i < 18; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 15; $i < 22; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 15; $i < 22; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
        </tr>

        <tr>
            <th scope="row">Week4</th>
            <?php if ($_SESSION["month"] == "1") : ?>
                <?php for ($i = 18; $i < 25; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 22; $i < 29; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 22; $i < 29; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row">Week5</th>
            <?php if ($_SESSION["month"] == "1") : ?>
                <?php for ($i = 25; $i < 32; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 1; $i < 8; $i++) : ?>
                    <td style="background-color:#FF0000">unavailable</td>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 29; $i < 32; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td_taken(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
                <td style="background-color:#FF0000">unavailable</td>
                <td style="background-color:#FF0000">unavailable</td>
                <td style="background-color:#FF0000">unavailable</td>
                <td style="background-color:#FF0000">unavailable</td>
            <?php endif; ?>
        </tr>

    </tbody>
</table>

</div>