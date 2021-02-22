<h1>Vaccine appointment</h1>
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
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 1; $i < 8; $i++) : ?>
                    <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 1; $i < 8; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row">Week2</th>
            <?php if ($_SESSION["month"] == "1") : ?>
                <?php for ($i = 4; $i < 11; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 8; $i < 15; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>

            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 8; $i < 15; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row">Week3</th>
            <?php if ($_SESSION["month"] == "1") : ?>
                <?php for ($i = 11; $i < 18; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 15; $i < 22; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 15; $i < 22; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
        </tr>

        <tr>
            <th scope="row">Week4</th>
            <?php if ($_SESSION["month"] == "1") : ?>
                <?php for ($i = 18; $i < 25; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($_SESSION["month"] == "2") : ?>
                <?php for ($i = 22; $i < 29; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>

            <?php endif; ?>
            <?php if ($_SESSION["month"] == "3") : ?>
                <?php for ($i = 22; $i < 29; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row">Week5</th>
            <?php if ($_SESSION["month"] == "1") : ?>
                <?php for ($i = 25; $i < 32; $i++) : ?>
                     <?php if (Can_booked($date[$i - 1])) : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
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
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#28B463;"><?= $date[$i - 1] ?><br><?=Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
                    <?php else : ?>
                        <td id="<?= $date[$i - 1] ?>" style="background-color:#FF0000;"><?= $date[$i - 1] ?><br><?= Generate_td(Can_booked_time($date[$i - 1]), $date[$i - 1]) ?></td>
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