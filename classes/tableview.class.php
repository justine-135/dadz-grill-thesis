<?php

class TableView extends Table{
    public function initTableCa(){
        $results = $this->getTables();
        ?>
        <thead>
            <tr>
                <th>Table</th>
                <th class="tbl-status">Status</th>
                <th>Time</th>
                <th>Payment</th>
                <th class="hide">Date</th>
                <th>Order</th>
                <th class="status-action-col">Status Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tr>
            <td><span><?php echo $row['id'] ?></span></td>
            <td class="flex-row tbl-status">
            <?php
                if ($row['table_status'] == "Occupied") {
            ?>
            <span class="table-data-status red"></span><?php echo $row['table_status'] ?>
                
            <?php
                }elseif ($row['table_status'] == "Unoccupied") {
            ?>
                <span class="table-data-status green"></span><?php echo $row['table_status'] ?>
            <?php
                }elseif ($row['table_status'] == "Calling") {
            ?>
                <span class="table-data-status yellow"></span>Need assistance
            <?php
                }elseif ($row['table_status'] == "Dirty") {
            ?>
                <span class="table-data-status blue"></span><?php echo $row['table_status'] ?>
            <?php
            }
            ?>
            </td>
            <td class="table-timer-col table-<?php echo $row['id'] ?>-time"><?php 
                $time = $row["timer"];

                $hh = floor($time / 3600) . ':';
                $time = $time % 3600;
                $mm = floor($time / 60) . ':';
                $time = $time % 60;
                $ss = $time;
        
                $hh_length = strlen((string)$hh);
                $mm_length = strlen((string)$mm);
                $ss_length = strlen((string)$ss);
        
                $showHour;
                if ($hh_length == 2) {
                    $showHour = "0" . (string)$hh;
                }
                else{
                    $showHour = $hh;
                }
        
                $showMinutes;
                if ($mm_length == 2) {
                    $showMinutes = "0" . (string)$mm;
                }
                else{
                    $showMinutes = $mm;
                }
        
                $showSeconds;
                if ($ss_length == 1) {
                    $showSeconds = "0" . $ss;
                }
                else{
                    $showSeconds = $ss;
                }
            
                $finalTime = $showHour . $showMinutes . $showSeconds;
                if ($row["is_started"] != 0) {
                    if ($row['timer'] >= 7200) {
                        $endtime = "endtime";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";
                    
                    }
                    elseif ($row['timer'] >= 6300) {
                        $endtime = "warningtime";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";        }
                    else{
                        $endtime = "running";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";
            
                    }
                }
                else{
                    if ($row["timer"] != 0) {
                        echo $finalTime;
                    }
                    else{
                        echo "00:00:00";
                    }
                }
            
            ?></td>
            <td><?php echo $row['payment'] ?></td>
            <td class="table-date hide"><?php echo date($row['date']) ?></td>
            <td class="hide "><?php echo $row['is_started'] ?></td>
            <td class="action-td">
                <form action="./includes/transactions-contr.inc.php" method="POST">
                    <input type="text" name="id" value=<?php echo $row['id'] ?> id="" hidden>
                    <button type="button" class="view-order-btn">View</button>
                    <input type="submit" name="bill" value="Bill out">
                </form>
            </td>
            <td class="action-td status-action-col">
                <form action="./phpincludes/table_status.php" method="POST">
                    <input type="text" name="id" value=<?php echo $row['id'] ?> id="" hidden>
                    <input type="submit" name="occupy" value="Occupy">
                    <input type="submit" name="unoccupy" value="Unoccupy">
                    <input type="submit" name="call" value="Call">
                </form>
            </td>
        </tr>
        <?php
        }
    }
    public function initTableWa(){
        $results = $this->getTables();
        ?>
        <thead>
            <tr>
                <th>Table</th>
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
            <td class="waiter-tbl-status-col">
                <div class="flex-row statul">
                <?php
                    if ($row['table_status'] == "Occupied") {
                    ?>
                    <span class="table-data-status red"></span><?php echo $row['table_status'] ?>
                        
                    <?php
                        }elseif ($row['table_status'] == "Unoccupied") {
                    ?>
                        <span class="table-data-status green"></span><?php echo $row['table_status'] ?>
                    <?php
                        }elseif ($row['table_status'] == "Calling") {
                    ?>
                        <span class="table-data-status yellow"></span>Need assistance
                    <?php
                        }elseif ($row['table_status'] == "Dirty") {
                    ?>
                        <span class="table-data-status blue"></span><?php echo $row['table_status'] ?>
                    <?php
                    }
                    ?>
                </div>
            </td>
            <td class="table-<?php echo $row["id"]; ?>-time">
                <?php
                $time = $row["timer"];
                $hh = floor($time / 3600) . ':';
                $time = $time % 3600;
                $mm = floor($time / 60) . ':';
                $time = $time % 60;
                $ss = $time;
                $hh_length = strlen((string)$hh);
                $mm_length = strlen((string)$mm);
                $ss_length = strlen((string)$ss);
        
                $showHour;
                if ($hh_length == 2) {
                    $showHour = "0" . (string)$hh;
                }
                else{
                    $showHour = $hh;
                }
        
                $showMinutes;
                if ($mm_length == 2) {
                    $showMinutes = "0" . (string)$mm;
                }
                else{
                    $showMinutes = $mm;
                }
                $showSeconds;
                if ($ss_length == 1) {
                    $showSeconds = "0" . $ss;
                }
                else{
                    $showSeconds = $ss;
                }
                $finalTime = $showHour . $showMinutes . $showSeconds;
                if ($row["is_started"] != 0) {
                    if ($row['timer'] >= 7200) {
                        $endtime = "endtime";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";
                    
                    }
                    elseif ($row['timer'] >= 6300) {
                        $endtime = "warningtime";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";        }
                    else{
                        $endtime = "running";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";
                    }
                }
                else{
                    if ($row["timer"] != 0) {
                        echo $finalTime;
                    }
                    else{
                        echo "00:00:00";
                    }
                }
                ?>
            </td>
            <td><?php echo $row['payment'] ?></td>
            <td><?php echo $row['order_status'] ?></td>
            <td class="action-td">
                <span class="hide"><?php echo $row['id']; ?></span>
                <button class="show-btn">Show</button>
            </td>
        </tr>
        <?php
        }   
    }

    public function initTableCl(){
        $results = $this->getTables();
        ?>
        <thead>
            <tr>
                <th>Table</th>
                <th class="tbl-status">Status</th>
                <th>Time</th>
                <th>Payment</th>
                <th class="hide">Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tr>
            <td><span><?php echo $row['id'] ?></span></td>
            <td class="flex-row tbl-status">
            <?php
                if ($row['table_status'] == "Occupied") {
            ?>
            <span class="table-data-status red"></span><?php echo $row['table_status'] ?>
                
            <?php
                }elseif ($row['table_status'] == "Unoccupied") {
            ?>
                <span class="table-data-status green"></span><?php echo $row['table_status'] ?>
            <?php
                }elseif ($row['table_status'] == "Calling") {
            ?>
                <span class="table-data-status yellow"></span>Need assistance
            <?php
                }elseif ($row['table_status'] == "Dirty") {
            ?>
                <span class="table-data-status blue"></span><?php echo $row['table_status'] ?>
            <?php
            }
            ?>
            </td>
            <td class="table-timer-col table-<?php echo $row['id'] ?>-time"><?php 
                $time = $row["timer"];

                $hh = floor($time / 3600) . ':';
                $time = $time % 3600;
                $mm = floor($time / 60) . ':';
                $time = $time % 60;
                $ss = $time;
        
                $hh_length = strlen((string)$hh);
                $mm_length = strlen((string)$mm);
                $ss_length = strlen((string)$ss);
        
                $showHour;
                if ($hh_length == 2) {
                    $showHour = "0" . (string)$hh;
                }
                else{
                    $showHour = $hh;
                }
        
                $showMinutes;
                if ($mm_length == 2) {
                    $showMinutes = "0" . (string)$mm;
                }
                else{
                    $showMinutes = $mm;
                }
        
                $showSeconds;
                if ($ss_length == 1) {
                    $showSeconds = "0" . $ss;
                }
                else{
                    $showSeconds = $ss;
                }
            
                $finalTime = $showHour . $showMinutes . $showSeconds;
                if ($row["is_started"] != 0) {
                    if ($row['timer'] >= 7200) {
                        $endtime = "endtime";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";
                    
                    }
                    elseif ($row['timer'] >= 6300) {
                        $endtime = "warningtime";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";        }
                    else{
                        $endtime = "running";
                        echo "<span class='" . $endtime . "'>" . $finalTime . "</span>";
            
                    }
                }
                else{
                    if ($row["timer"] != 0) {
                        echo $finalTime;
                    }
                    else{
                        echo "00:00:00";
                    }
                }
            
            ?></td>
            <td><?php echo $row['payment'] ?></td>
            <td class="table-date hide"><?php echo date($row['date']) ?></td>
            <td class="hide "><?php echo $row['is_started'] ?></td>
            <td class="action-td status-action-col">
                <form action="./phpincludes/table_status.php" method="POST">
                    <input type="text" name="id" value=<?php echo $row['id'] ?> id="" hidden>
                    <input type="submit" name="clean" value="Clean table">
                </form>
            </td>
        </tr>
        <?php
        }
    }
}

?>