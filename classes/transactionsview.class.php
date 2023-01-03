<?php

class TransactionsView extends Transactions{
    public function initTransactions(){
        $results = $this->getTransactions();
        ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">#</th>
                <th style="text-align: left; padding-left: 10px">Table</th>
                <th style="text-align: left; padding-left: 10px">Start</th>
                <th style="text-align: left; padding-left: 10px">End</th>
                <th style="text-align: left; padding-left: 10px">Duration</th>
                <th style="max-width: 10px;">Orders</th>
                <th style="text-align: left; padding-left: 10px; min-width: 75px">Total</th>
                <th style="text-align: left; padding-left: 10px">Status</th>
                <th style="text-align: left">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['id'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['table_id'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
echo gmdate("h:i:s", $row['start_time']);
?>
</td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
$date = new DateTime($row['reg_date']);
$end_time = $date->format('h:i:s');
echo $end_time;
?>
</td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
$date = new DateTime($row['reg_date']);
$end_time = $date->format('h:i:s');
$start_time_second = $row['start_time'];
$arr = explode(':', $end_time);

if (count($arr) === 3) {
    $end_time_second = $arr[0] * 3600 + $arr[1] * 60 + $arr[2];
    $duration = intval($end_time_second) - intval($start_time_second);
    $end_time = $date->format('h:i:s');
    // echo $end_time_second . "<br>";
    // echo $start_time_second;
    $seconds = $duration;
    $H = floor($seconds / 3600);
    $i = ($seconds / 60) % 60;
    $s = $seconds % 60;
    echo sprintf("%02d:%02d:%02d", $H, $i, $s);
}

?></td>
                <td class="pad10" style="text-align: left; padding-left: 10px; min-width: 400px">
                    <?php 
                        $result = explode("|",$row['order']);
                        $result2 = explode("|",$row['quantity']);
                        $order = "";
                    ?>
                        <?php
                        for ($i=0; $i < (count($result)); $i++) { 
                            if ($result[$i] != "") {
                                $order .= $result[$i] ."(".$result2[$i]."),";  
                            }
                         ?>
                       <?php
                       
                        }
                        echo $order;
                    ?>          
                </td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
                <?php 
                    $result = explode("|",$row['price']);
                    $total = 0;
                    for ($i=0; $i < (count($result)); $i++) { 
                        $total += (int)$result[$i];
                    }

                    echo "₱ " . $total;
                ?>    
                </td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php if ($row['paid'] == 0) {
                    echo "<span class='pending'>Pending</span>";
                }
                elseif($row['paid'] == 1){
                    echo "<span class='completed'>Completed</span>";
                }
                elseif($row['paid'] == 3){
                    echo "<span class='cancelled'>Cancelled</span>";
                }?></td>
                <td valign="top" class="action-td status-action-col pad10">
                    <form action="./includes/transactions-contr.inc.php" method="POST">
                        <input type="text" name="id" value=<?php echo $row['id'] ?> id="" hidden>   
                        <?php
                        if ($row['paid'] != 1 && $row['paid'] != 3) {
                            ?>
                        <input type="submit" name="process" value="Process">
                            <?php
                        }
                        else{
                        ?>
                        <input type="submit" name="process" value="Process" disabled="disabled">
                        <?php
                        }
                        ?>
                    </form>
                </td>
            </tr>
        </tbody>
        <?php
        }
    }

    public function initTransactionsDate($date, $date2){
        $results = $this->getTransactionsDate($date, $date2);
        ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">#</th>
                <th style="text-align: left; padding-left: 10px">Table</th>
                <th style="text-align: left; padding-left: 10px">Start</th>
                <th style="text-align: left; padding-left: 10px">End</th>
                <th style="text-align: left; padding-left: 10px">Duration</th>
                <th style="min-width: 90px">Orders</th>
                <th style="text-align: left; padding-left: 10px; min-width: 75px">Total</th>
                <th style="text-align: left; padding-left: 10px">Status</th>
                <th class="status-action-col">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['id'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['table_id'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
echo gmdate("h:i:s", $row['start_time']);
?>
</td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
$date = new DateTime($row['reg_date']);
$end_time = $date->format('h:i:s');
echo $end_time;
?>
</td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
$date = new DateTime($row['reg_date']);
$end_time = $date->format('h:i:s');
$start_time_second = $row['start_time'];
$arr = explode(':', $end_time);

if (count($arr) === 3) {
    $end_time_second = $arr[0] * 3600 + $arr[1] * 60 + $arr[2];
    $duration = intval($end_time_second) - intval($start_time_second);
    $end_time = $date->format('h:i:s');
    // echo $end_time_second . "<br>";
    // echo $start_time_second;
    $seconds = $duration;
    $H = floor($seconds / 3600);
    $i = ($seconds / 60) % 60;
    $s = $seconds % 60;
    echo sprintf("%02d:%02d:%02d", $H, $i, $s);
}

?></td>
                <td class="pad10" style="text-align: left; padding-left: 10px; min-width: 200px">
                    <?php 
                        $result = explode("|",$row['order']);
                        $result2 = explode("|",$row['quantity']);
                        $order = "";
                    ?>
                        <?php
                        for ($i=0; $i < (count($result)); $i++) { 
                            if ($result[$i] != "") {
                                $order .= $result[$i] ."(".$result2[$i]."),";  
                            }
                         ?>
                       <?php
                       
                        }
                        echo $order;
                    ?>          
                </td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
                <?php 
                    $result = explode("|",$row['price']);
                    $total = 0;
                    for ($i=0; $i < (count($result)); $i++) { 
                        $total += (int)$result[$i];
                    }

                    echo "₱ " . $total;
                ?>    
                </td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php if ($row['paid'] == 0) {
                    echo "<span class='pending'>Pending</span>";
                }
                elseif($row['paid'] == 1){
                    echo "<span class='completed'>Completed</span>";
                }
                elseif($row['paid'] == 3){
                    echo "<span class='cancelled'>Cancelled</span>";
                }?></td>
                <td valign="top" class="action-td status-action-col pad10">
                    <form action="./includes/transactions-contr.inc.php" method="POST">
                        <input type="text" name="id" value=<?php echo $row['id'] ?> id="" hidden>   
                        <?php
                        if ($row['paid'] != 1 && $row['paid'] != 3) {
                            ?>
                        <input type="submit" name="process" value="Process">
                            <?php
                        }
                        else{
                        ?>
                        <input type="submit" name="process" value="Process" disabled="disabled">
                        <?php
                        }
                        ?>
                    </form>
                </td>
            </tr>
        </tbody>
        <?php
        }
    }

    public function initInvoice($id){
        $results = $this->getInvoice($id);
        ?>
        <?php
        foreach ($results as $row) {
        ?>
        <nav class="flex-row">
            <div class="bill-details flex-column">
                <span>Order #</span>
                <span><?php echo $row['id'] ?></span>
            </div>
            <div class="bill-details flex-column">
                <span>Table #</span>
                <span><?php echo $row['table_id'] ?></span>
            </div>
            <div class="bill-details flex-column">
                <span>Date</span>
                <span><?php echo $newDate = date("Y-m-d h:i:s", strtotime($row['reg_date'])); ?></span>
            </div>
            <div class="bill-details flex-column" style="margin-left: auto; align-content: flex-start;">
                <span>Input bill</span>
                
                <input type="text" name="" id="bill-input">

            </div>
        </nav>
        <table class="tables-table bill-order-tbl table">
            <thead >
                <tr>
                    <th style="width:50%; text-align:left; padding-left: 20px">Item</th>
                    <th style="width:20%; text-align: left; padding-left: 10px">₱ Price</th>
                    <th style="width:10%; text-align: left; padding-left: 10px">Amount</th>
                    <th style="width:20%; text-align: left; padding-left: 10px">₱ Total price</th>
                </tr>
            </thead>
            <tbody>
                <?php
$result = explode("|",$row['order']);
$result2 = explode("|",$row['quantity']);
$result3 = explode("|",$row['price']);
$result4 = explode("|",$row['original_price']);
$total = 0;
for ($i=0; $i < (count($result)); $i++) { 
    $total += (int)$result3[$i];
                ?>
                <tr>
                    <?php if ($result[$i] != "") {
                        ?>
                    <td style="text-align: left;padding-left: 20px"><?php echo $result[$i] ?></td>
                        <?php
                    } ?>
                    <?php if ($result4[$i] != "") {
                        ?>
                    <td style="text-align: left;padding-left: 20px"><?php echo $result4[$i] ?></td>
                        <?php
                    } ?>
                    <?php if ($result2[$i] != "") {
                        ?>
                    <td style="text-align: left; padding-left: 10px"><?php echo $result2[$i]; ?> </td>
                        <?php
                    } ?>
                    <?php if ($result3[$i] != "") {
                        ?>
                    <td style="text-align: left; padding-left: 10px">₱ <?php echo $result3[$i]; ?> </td>
                        <?php
                    } ?>
                </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="bill-final-span" style="text-align: left; padding-left: 10px"><span class="bill-final-span">Total:</span></td>
                    <td style="text-align: left; padding-left: 10px">₱ <span id="amount-total"><?php echo $total; ?></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: left; padding-left: 10px"> <span class="bill-final-span" >Payment:</span></td>
                    <td style="text-align: left; padding-left: 10px">₱ <span id="amount-paid">0</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="bill-final-span" style="text-align: left; padding-left: 10px"><span class="bill-final-span">Change:</span></td>
                    <td style="text-align: left; padding-left: 10px">₱ <span id="amount-change">0</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="bill-td-submit" >
                        <input type="text" name="total" id="total" hidden>
                        <input type="text" name="payment" id="payment" hidden>
                        <input type="text" name="change" id="change" hidden>
                        <input type="text" name="id" id="id" value="<?php echo $row['id'] ?>" hidden>
                        <input type="text" name="table" id="table" value="<?php echo $row['table_id'] ?>" hidden>
                        <button class="btn btn-primary" id="print">Print</button>
                        <input class="btn btn-primary" type="button" name="save" id="save" value="Save">  
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            
        </div>
        <?php
        }
    }   

    public function initReceipt($id, $changeNumeric, $paymentNumeric, $totalNumeric){
        $results = $this->getInvoice($id);
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    *{
        margin: 0%;
        padding 0%;
        box-sizing: border-box;
    }
    h1 {
    font-family: "Nunito Sans", sans-serif !important;
    }

    .receipt-container {
    display: flex;
    flex-direction: column;
    width: 100%;
    border: 1px solid black;
    }

    hr {
    width: 100%;
    }

    table {
    width: 100%;
    }

    .payment-div {
    justify-content: space-between;
    }

    .receipt-padding {
    padding: 10px;
    }

    .receipt-header{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .receipt-header img{
        border-radius: 50%;
        margin-left: 10px;
    }
    .text-center{
        text-align: center;
    }

    .text-left{
        text-align: left;
    }

    .text-right{
        text-align: right;
    }

    .payment-div{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    </style>
    <title>Document</title>
</head>
<body>
        <div class="receipt-container">
            <div class="receipt-header receipt-padding">
                <h1 class="text-center">Dad'z Grillhouse</h1>
                <img src="./img/icons/logo.jpg" height="50px" width="50px" alt="">
            </div>
            <hr>
            <span class="receipt-padding text-center">CASH RECEIPT</span>
            <hr>
            <div class="receipt-body">
                <table class="receipt-padding">
                    <thead>
                        <tr>
                            <th class="text-left">
                                Item
                            </th>
                            <th class="text-right">
                                Quantity
                            </th>
                            <th class="text-right">
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($results as $row) {
$result = explode("|",$row['order']);
$result2 = explode("|",$row['quantity']);
$result3 = explode("|",$row['original_price']);
for ($i=0; $i < (count($result)); $i++) { 
                    ?>
                    <tr>
                        <td><?php echo $result[$i] ?></td>
                        <td class="text-right"><?php echo $result2[$i] ?></td>
                        <td class="text-right"><?php echo $result3[$i] ?></td>
                    </tr>
                    <?php }} ?>
                    </tbody>
                </table>
                <hr>
                <div class="payment-section receipt-padding">
                    <div class="total-div flex-row payment-div">
                        <h3>Total</h3>
                        <span><?php echo $totalNumeric ?></span>
                    </div>
                    <div class="cash-div flex-row payment-div">
                        <span>Received payment of</span>
                        <span><?php echo $paymentNumeric ?></span>
                    </div>
                    <div class="change-div flex-row payment-div">
                        <span>Change</span>
                        <span><?php echo $changeNumeric ?></span>
                    </div>
                </div>
                <hr>
                <h2 class="receipt-padding" style="text-align: center">Thank you!</h2>
            </div>
        </div>
        </body>
</html>
        <?php
    }

    public function exportTransactions(){
        $results = $this->getTransactions();
        ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">#</th>
                <th style="text-align: left; padding-left: 10px">Table</th>
                <th style="text-align: left; padding-left: 10px">Start</th>
                <th style="text-align: left; padding-left: 10px">End</th>
                <th style="text-align: left; padding-left: 10px">Duration</th>
                <th style="min-width: 100px">Orders</th>
                <th style="text-align: left; padding-left: 10px; min-width: 75px">Total</th>
                <th style="text-align: left; padding-left: 10px">Status</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['id'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['table_id'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
echo gmdate("h:i:s", $row['start_time']);
?>
</td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
$date = new DateTime($row['reg_date']);
$end_time = $date->format('h:i:s');
echo $end_time;
?>
</td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
$date = new DateTime($row['reg_date']);
$end_time = $date->format('h:i:s');
$start_time_second = $row['start_time'];
$arr = explode(':', $end_time);

if (count($arr) === 3) {
    $end_time_second = $arr[0] * 3600 + $arr[1] * 60 + $arr[2];
    $duration = intval($end_time_second) - intval($start_time_second);
    $end_time = $date->format('h:i:s');
    // echo $end_time_second . "<br>";
    // echo $start_time_second;
    $seconds = $duration;
    $H = floor($seconds / 3600);
    $i = ($seconds / 60) % 60;
    $s = $seconds % 60;
    echo sprintf("%02d:%02d:%02d", $H, $i, $s);
}

?></td>
                <td class="pad10" style="text-align: left; padding-left: 10px; width: 200px">
                    <?php 
                        $result = explode("|",$row['order']);
                        $result2 = explode("|",$row['quantity']);
                        $order = "";
                    ?>
                        <?php
                        for ($i=0; $i < (count($result)); $i++) { 
                            if ($result[$i] != "") {
                                $order .= $result[$i] ."(".$result2[$i]."),";  
                            }
                         ?>
                       <?php
                       
                        }
                        echo $order;
                    ?>          
                </td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
                <?php 
                    $result = explode("|",$row['price']);
                    $total = 0;
                    for ($i=0; $i < (count($result)); $i++) { 
                        $total += (int)$result[$i];
                    }

                    echo $total;
                ?>    
                </td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php if ($row['paid'] == 0) {
                    echo "<span class='pending'>Pending</span>";
                }
                elseif($row['paid'] == 1){
                    echo "<span class='completed'>Completed</span>";
                }
                elseif($row['paid'] == 3){
                    echo "<span class='cancelled'>Cancelled</span>";
                }?></td>

            </tr>
        </tbody>
        <?php
        }
    }

    public function exportTransactionsDate($date, $date2){
        $results = $this->getTransactionsDate($date, $date2);
        ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">#</th>
                <th style="text-align: left; padding-left: 10px">Table</th>
                <th style="text-align: left; padding-left: 10px">Start</th>
                <th style="text-align: left; padding-left: 10px">End</th>
                <th style="text-align: left; padding-left: 10px">Duration</th>
                <th style="min-width: 100px">Orders</th>
                <th style="text-align: left; padding-left: 10px">Total</th>
                <th style="text-align: left; padding-left: 10px">Status</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['id'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['table_id'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
echo gmdate("h:i:s", $row['start_time']);
?>
</td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
$date = new DateTime($row['reg_date']);
$end_time = $date->format('h:i:s');
echo $end_time;
?>
</td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
<?php
$date = new DateTime($row['reg_date']);
$end_time = $date->format('h:i:s');
$start_time_second = $row['start_time'];
$arr = explode(':', $end_time);

if (count($arr) === 3) {
    $end_time_second = $arr[0] * 3600 + $arr[1] * 60 + $arr[2];
    $duration = intval($end_time_second) - intval($start_time_second);
    $end_time = $date->format('h:i:s');
    // echo $end_time_second . "<br>";
    // echo $start_time_second;
    $seconds = $duration;
    $H = floor($seconds / 3600);
    $i = ($seconds / 60) % 60;
    $s = $seconds % 60;
    echo sprintf("%02d:%02d:%02d", $H, $i, $s);
}

?></td>
                <td class="pad10" style="text-align: left; padding-left: 10px; width: 200px">
                    <?php 
                        $result = explode("|",$row['order']);
                        $result2 = explode("|",$row['quantity']);
                        $order = "";
                    ?>
                        <?php
                        for ($i=0; $i < (count($result)); $i++) { 
                            if ($result[$i] != "") {
                                $order .= $result[$i] ."(".$result2[$i]."),";  
                            }
                         ?>
                       <?php
                       
                        }
                        echo $order;
                    ?>          
                </td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px">
                <?php 
                    $result = explode("|",$row['price']);
                    $total = 0;
                    for ($i=0; $i < (count($result)); $i++) { 
                        $total += (int)$result[$i];
                    }

                    echo $total;
                ?>    
                </td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php if ($row['paid'] == 0) {
                    echo "<span class='pending'>Pending</span>";
                }
                elseif($row['paid'] == 1){
                    echo "<span class='completed'>Completed</span>";
                }
                elseif($row['paid'] == 3){
                    echo "<span class='cancelled'>Cancelled</span>";
                }?></td>
            </tr>
        </tbody>
        <?php
        }
    }
}
?>