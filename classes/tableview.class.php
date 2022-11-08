<?php

class TableView extends Table
{
    public function initTableCa()
    {
        $results = $this->getTables();
?>
        <thead>
            <tr>
                <th>Table #</th>
                <th class="">Status</th>
                <th>Time</th>
                <th>Payment</th>
                <th>Order</th>
                <th class="status-action-col">Status Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
            <tr>
                <td><span><?php echo $row['id'] ?></span></td>
                <td class="flex-row ">
                    <?php
                    if ($row['table_status'] == "Occupied") {
                    ?>
                        <span class="table-data-status red"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    } elseif ($row['table_status'] == "Unoccupied") {
                    ?>
                        <span class="table-data-status green"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    } elseif ($row['table_status'] == "Call") {
                    ?>
                        <span class="table-data-status yellow"></span>
                        <span>Need assistance</span>
                    <?php
                    } elseif ($row['table_status'] == "Dirty") {
                    ?>
                        <span class="table-data-status blue"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    }
                    ?>
                </td>
                <?php 
                $to_sec_warning = gmdate("H:i:s", $row['warning_time']);
                $to_sec_end = gmdate("H:i:s", $row['end_time']);
                $local_time = date("h:i:s");;
                if ($row['is_started'] == 1) {
                    if ($row['timer'] > 0) {
                        if ($to_sec_end <= $local_time) {
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time endtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                        elseif($to_sec_warning <= $local_time){
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time warningtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                        else{
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time runningtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                    }
                }
                else{
                    if ($row['timer'] == 0) {
                        ?>
                        <td class="table-timer-col table-<?php echo $row['id'] ?>-time" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                        <?php
                    }
                    elseif ($row['timer'] > 0){
                        ?>
                        <td class="table-timer-col table-<?php echo $row['id'] ?>-time runningtimeend" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                        <?php
                    }
                }
                ?>
            <td><?php
                    if ($row['payment'] == "Requesting") {
                        ?>
                    <span class="requesting"> Requesting</span>
                        <?php
                    } elseif ($row['payment'] == "Bill out"){
                        ?>
                    <span class="completed">Completed</span>
                        <?php
                    } elseif ($row['payment'] == "Pending"){
                        ?>
                    <span class="pending">Pending</span>
                        <?php
                    }
                    else{
                        ?>
                    <span class="noorder">No order</span>
                        <?php
                    }
                    ?>
                </td>
                <td class="hide "><?php echo $row['is_started'] ?></td>
                <td class="action-td">
                    <form action="./includes/transactions-contr.inc.php" method="POST">
                        <input type="text" name="id" value=<?php echo $row['id'] ?> id="" hidden>
                        <button type="button" class="view-order-btn">View</button>
                        <input type="submit" name="bill" value="Bill out">
                    </form>
                </td>
                <td class="action-td status-action-col">
                    <form action="./includes/table-contr.inc.php" method="POST">
                        <input type="text" name="table-id" value=<?php echo $row['id'] ?> id="" hidden>
                        <input type="submit" name="occupy" value="Occupy">
                        <input type="submit" name="unoccupy" value="Unoccupy">
                        <input type="submit" name="call" value="Call">
                    </form>
                </td>
            </tr>
        <?php
        }
    }
    public function initTableWa()
    {
        $results = $this->getTables();
        ?>
        <thead>
            <tr>
                <th>Table #</th>
                <th>Status</th>
                <th>Time</th>
                <th>Payment</th>
                <th>Order status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
            <tr>
                <td><span><?php echo $row['id'] ?></span></td>
                <td class="flex-row ">
                    <?php
                    if ($row['table_status'] == "Occupied") {
                    ?>
                        <span class="table-data-status red"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    } elseif ($row['table_status'] == "Unoccupied") {
                    ?>
                        <span class="table-data-status green"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    } elseif ($row['table_status'] == "Call") {
                    ?>
                        <span class="table-data-status yellow"></span>
                        <span>Need assistance</span>
                    <?php
                    } elseif ($row['table_status'] == "Dirty") {
                    ?>
                        <span class="table-data-status blue"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    }
                    ?>
                </td>
                <?php 
                $to_sec_warning = gmdate("H:i:s", $row['warning_time']);
                $to_sec_end = gmdate("H:i:s", $row['end_time']);
                $local_time = date("h:i:s");;
                if ($row['is_started'] == 1) {
                    if ($row['timer'] > 0) {
                        if ($to_sec_end <= $local_time) {
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time endtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                        elseif($to_sec_warning <= $local_time){
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time warningtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                        else{
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time runningtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                    }
                }
                else{
                    if ($row['timer'] == 0) {
                        ?>
                        <td class="table-timer-col table-<?php echo $row['id'] ?>-time" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                        <?php
                    }
                    elseif ($row['timer'] > 0){
                        ?>
                        <td class="table-timer-col table-<?php echo $row['id'] ?>-time runningtimeend" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                        <?php
                    }
                }
                ?>
                
                <td>
                <?php
                    if ($row['payment'] == "Requesting") {
                        ?>
                    <span class="requesting"> Requested</span>
                        <?php
                    } elseif ($row['payment'] == "Bill out"){
                        ?>
                    <span class="completed">Completed</span>
                        <?php
                    } elseif ($row['payment'] == "Pending"){
                        ?>
                    <span class="pending">Pending</span>
                        <?php
                    }
                    else{
                        ?>
                    <span class="noorder">No order</span>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php 
                        if ($row['pending_orders'] == 0 && $row['payment'] == 'Pending' && $row['done_orders'] == 0) {
                            ?>
                        <span class="completed">Completed</span>
                            <?php               
                        }
                        elseif ($row['done_orders'] > 0) {
                            ?>
                        <span class="requesting"><?php echo "Pick Up (" . $row['done_orders'] . ")" ?></span>
                            <?php               
                        }
                        elseif ($row['pending_orders'] > 0) {
                           ?>
                        <span class="pending"><?php echo "Pending (" . $row['pending_orders'] . ")"; ?></span>
                           <?php
                        }
                        else{
                            ?>
                        <span class="noorder">No order</span>
                            <?php
                        }
                    ?>
                </td>
                <td class="action-td">
                    <span class="hide"><?php echo $row['id']; ?></span>
                    <button class="show-btn">Show</button>
                    <!-- <button class="show-btn">Menu</button>
                    <button class="show-btn">Request bill</button> -->
                </td>
            </tr>
        <?php
        }
    }

    public function initTableCl()
    {
        $results = $this->getTables();
        ?>
        <thead>
            <tr>
                <th>Table #</th>
                <th class="">Status</th>
                <th>Time</th>
                <th>Payment</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
            <tr>
                <td><span><?php echo $row['id'] ?></span></td>
                <td class="flex-row ">
                    <?php
                    if ($row['table_status'] == "Occupied") {
                    ?>
                        <span class="table-data-status red"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    } elseif ($row['table_status'] == "Unoccupied") {
                    ?>
                        <span class="table-data-status green"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    } elseif ($row['table_status'] == "Call") {
                    ?>
                        <span class="table-data-status yellow"></span>
                        <span>Need assistance</span>
                    <?php
                    } elseif ($row['table_status'] == "Dirty") {
                    ?>
                        <span class="table-data-status blue"></span>
                        <span><?php echo $row['table_status'] ?></span>
                    <?php
                    }
                    ?>
                </td>
                <?php 
                $to_sec_warning = gmdate("H:i:s", $row['warning_time']);
                $to_sec_end = gmdate("H:i:s", $row['end_time']);
                $local_time = date("h:i:s");;
                if ($row['is_started'] == 1) {
                    if ($row['timer'] > 0) {
                        if ($to_sec_end <= $local_time) {
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time endtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                        elseif($to_sec_warning <= $local_time){
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time warningtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                        else{
                            ?>
                            <td class="table-timer-col table-<?php echo $row['id'] ?>-time runningtime" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                            <?php
                        }
                    }
                }
                else{
                    if ($row['timer'] == 0) {
                        ?>
                        <td class="table-timer-col table-<?php echo $row['id'] ?>-time" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                        <?php
                    }
                    elseif ($row['timer'] > 0){
                        ?>
                        <td class="table-timer-col table-<?php echo $row['id'] ?>-time runningtimeend" started=<?php echo $row['is_started'] ?> starttime=<?php echo $row['timer'] ?> endtime=<?php echo $row['end_time'] ?>>
                        <?php
                    }
                }
                ?>
                <td>
                <?php
                    if ($row['payment'] == "Requesting") {
                        ?>
                    <span class="requesting"> Requested</span>
                        <?php
                    } elseif ($row['payment'] == "Bill out"){
                        ?>
                    <span class="completed">Completed</span>
                        <?php
                    } elseif ($row['payment'] == "Pending"){
                        ?>
                    <span class="pending">Pending</span>
                        <?php
                    }
                    else{
                        ?>
                    <span class="noorder">No order</span>
                        <?php
                    }
                    ?>
                </td>
                <td class="hide "><?php echo $row['is_started'] ?></td>
                <td class="action-td status-action-col">
                    <form action="./includes/table-contr.inc.php" method="POST">
                        <input type="text" name="table-id" value=<?php echo $row['id'] ?> id="" hidden>
                        <input type="submit" name="clean" value="Clean table">
                    </form>
                </td>
            </tr>
<?php
        }
    }
}

?>