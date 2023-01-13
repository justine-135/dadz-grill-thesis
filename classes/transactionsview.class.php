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
                <th style="text-align: left; padding-left: 10px; min-width: 75px">Total ₱ </th>
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

    if ($row['paid'] == 4) {
        echo "00:00:00";
    }
    else if ($row['paid'] == 1){
        echo sprintf("%02d:%02d:%02d", $H, $i, $s);

    }
    else{
        echo sprintf("%02d:%02d:%02d", $H, $i, $s);
    }
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
                        $total += (float)$result[$i];
                    }
                    ?>
                    <span>
                    <?php
                    echo number_format($total, 2);
                    ?>
                    </span>
                    <?php
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
                }
                else{
                    echo "<span class='cancelled'>Cancelled</span>";
                }
                ?></td>
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
                <th style="text-align: left; padding-left: 10px; min-width: 75px">Total ₱ </th>
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
    if ($row['paid'] == 4) {
        echo "00:00:00";
    }
    else if ($row['paid'] == 1){
        echo sprintf("%02d:%02d:%02d", $H, $i, $s);

    }
    else{
        echo sprintf("%02d:%02d:%02d", $H, $i, $s);
    }
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
                        $total += (float)$result[$i];
                    }

                    ?>
                    <span class="add-zero">
                        <?php
                         echo number_format($total, 2)
                         ?>
                    
                    </span>
                    <?php
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
                }
                else{
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
                <input type="text" name="" id="bill-input" value=0 style="height: 38px">
            </div>
        </nav>
        <table class="tables-table bill-order-tbl table">
            <thead >
                <tr>
                    <th style="width:20%; text-align:left; padding-left: 20px">Item</th>
                    <th style="width:15%; text-align: left; padding-left: 10px">₱ Price</th>
                    <th style="width:15%; text-align: left; padding-left: 10px">Amount</th>
                    <th style="width:22%; text-align: left; padding-left: 10px">Discount</th>
                    <th style="width:20%; text-align: left; padding-left: 10px">₱ Total price</th>
                    <th style=" text-align: left; padding-left: 10px">₱ Discounts</th>
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
    $total += (float)$result3[$i];
                ?>
                <tr>
                    <?php if ($result[$i] != "") {
                        ?>
                    <td style="text-align: left;padding-left: 20px"><?php echo $result[$i] ?></td>
                        <?php
                    } ?>
                    <?php if ($result4[$i] != "") {
                        ?>
                    <td style="text-align: left;padding-left: 20px">
                    <input style="border:none; color: black;" disabled class="ms-1 add-zero" type="text" value=<?php echo $result4[$i] ?>>
                    </td>
                        <?php
                    } ?>
                    <?php if ($result2[$i] != "") {
                        ?>
                    <td class="quantity" style="text-align: left; padding-left: 10px"><?php echo $result2[$i]; ?> </td>
                        <?php
                    } ?>

                    <?php if ($result[$i] != "") {
                        ?>
                    <td style="text-align: left; padding-left: 10px">

                    <?php 
                    $set = "Set";
                    if (strpos($result[$i], $set) !== false) {
                        ?>
                    <div>
                        <div class="discount-div">
                            <div class="flex-row">
                                <select class="form-select form-select select-discount select-discount-0 mb-1" name="discount-select[]" id="0">
                                    <option value="0">None</option>
                                    <option value="1">Person with disability</option>
                                    <option value="2">Senior</option>
                                    <?php
                                    if (strpos($result[$i], "Set C") !== false) {
                                    ?>
                                    <option value="3">Birthday celebrant</option>
                                    <?php } ?>
                                    <option value="4">3 yrs old below</option>
                                    <option value="5">4-6 yrs old</option>
                                </select>
                                <input class="new-price new-price-0" type="text" name="" id="" value=<?php echo $result4[$i] ?> hidden>
                                <!-- <input class="discount-quantity" type="text"> -->
                            </div>
                        </div>

                        <button class="btn btn-primary add-discount">Add more discount</button>
                    </div>
                        <?php
                    }
                    else{
                        echo "Not applicable";
                    }
                    ?>
                    </td>
                        <?php
                    } ?>

                    <?php if ($result3[$i] != "") {
                        ?>
                    <td style="text-align: left; padding-left: 10px">
                    <span class="item-prices"><?php echo $result3[$i]; ?> </span>
                    </td>
                        <?php
                    } ?>
                    <?php if ($result3[$i] != "") {
                        ?>
                    <td class="hide" style="text-align: left; padding-left: 10px"><span class="item-prices2"><?php echo $result4[$i]; ?> </span></td>
                        <?php
                    } ?>
                    <?php if ($result3[$i] != "") {
                        ?>
                    <td class="" style="text-align: left; padding-left: 10px">
                    <?php
                    for ($j=0; $j < $result2[$i]; $j++) { 
                        ?>
                        <input style="border:none; color: black;" disabled class="ms-1 add-zero price-input-tmp price-input-tmp-<?php echo $j?>" type="text" value=<?php echo $result4[$i] ?>>
                    
                        <?php
                    }
                    ?>
                    </td>
                        <?php
                    } ?>
                </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="bill-final-span" style="text-align: left; padding-left: 10px"><span class="bill-final-span">Total:</span></td>
                    <td style="text-align: left; padding-left: 10px">₱ <span id="amount-total"></span></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: left; padding-left: 10px"> <span class="bill-final-span" >Payment:</span></td>
                    <td style="text-align: left; padding-left: 10px">₱ <span id="amount-paid">0</span></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="bill-final-span" style="text-align: left; padding-left: 10px"><span class="bill-final-span">Change:</span></td>
                    <td style="text-align: left; padding-left: 10px">₱ <span id="amount-change">0</span></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="bill-td-submit" >
                        <input type="text" name="discount" id="discount" hidden>
                        <input type="text" name="total" id="total" hidden>
                        <input type="text" name="payment" id="payment" hidden>
                        <input type="text" name="change" id="change" hidden>
                        <input type="text" name="id" id="id" value="<?php echo $row['id'] ?>" hidden>
                        <input type="text" name="table" id="table" value="<?php echo $row['table_id'] ?>" hidden>
                        <button class="btn btn-primary" id="print">Print</button>
                        <input class="btn btn-primary" type="button" name="save" id="save" value="Save">  
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div>
            
        </div>
        <?php
        }
    }   

    public function initReceipt($id, $changeNumeric, $paymentNumeric, $totalNumeric, $discounts){
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
                                Price (₱)
                            </th>
                            <th class="text-right">
                                Total (₱)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($results as $row) {
$result = explode("|",$row['order']);
$result2 = explode("|",$row['quantity']);
$result3 = explode("|",$row['original_price']);
$origPrice = 0;
for ($i=0; $i < (count($result)); $i++) { 
                    ?>
                    <tr>
                        <td><?php echo $result[$i] ?></td>
                        <td class="text-right"><?php echo $result2[$i] ?></td>
                        <td class="text-right">
                            <span class="s-to-float"><?php echo $result3[$i] ?></span>
                        </td>
                        <td class="text-right">
                            <?php
                             $origPrice += $result3[$i] * $result2[$i]; 
                             ?>
                             <span class="s-to-float"><?php echo $result3[$i] * $result2[$i]; ?></span>
                             <?php
                             ?>
                        </td>
                    </tr>
                    <?php }} ?>
                    </tbody>
                </table>
                <hr>
                <?php 
                    $d1 = 0;
                    $d2 = 0;
                    $d3 = 0;
                    $d4 = 0;
                    $d5 = 0;
                    foreach ($discounts as $discount) {
                        if ($discount == 1) {
                            $d1 += 1;
                        }if ($discount == 2) {
                            $d2 += 1;
                        }if ($discount == 3) {
                            $d3 += 1;
                        }if ($discount == 4) {
                            $d4 += 1;
                        }if ($discount == 5) {
                            $d5 += 1;
                        }
                    }
                    ?>
                <div class="payment-section receipt-padding">
                    <div class="total-div flex-row payment-div">
                        <h3>Total</h3>
                        <h2>₱ <span class="s-to-float"><?php echo $totalNumeric ?></span></h2>
                    </div>
                    <?php
                    if ($d1 > 0 || $d2 > 0 || $d3 > 0 || $d4 > 0 || $d5 > 0) {
                    ?>
                    <div class="total-div flex-row payment-div">
                        <h3></h3>
                        <span style="-webkit-text-decoration-line: line-through; text-decoration-line: line-through;"><?php echo $origPrice ?></span>
                    </div>
                    <?php } ?>
                    <?php
                    if ($d1 > 0 || $d2 > 0 || $d3 > 0 || $d4 > 0 || $d5 > 0) {
                    ?>
                    <div class="total-div flex-row payment-div" style="align-items: flex-start">
                        <span>Discounts</span>
                        <?php 
                         ?>
                        <ul>
                            <?php
                            if ($d1 != 0) {
                                echo "<li>" . "Person with disability (" . $d1 . ")</li>";
                            }
                            if ($d2 != 0) {
                                echo "<li>" . "Senior (" . $d2 . ")</li>";
                            }
                            if ($d3 != 0) {
                                echo "<li>" . "Birthday celebrant (" . $d3 . ")</li>";
                            }
                            if ($d4 != 0) {
                                echo "<li>" . "3 years old below (" . $d4 . ")</li>";
                            }
                            if ($d5 != 0) {
                                echo "<li>" . "4-6 years old below (" . $d5 . ")</li>";
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="cash-div flex-row payment-div">
                        <span>Received payment of</span>
                        <span>₱ <span class="s-to-float"><?php echo $paymentNumeric ?></span></span>
                    </div>
                    <div class="change-div flex-row payment-div">
                        <span>Change</span>
                        <span>₱ <span class="s-to-float"><?php echo $changeNumeric ?></span></span>
                    </div>
                </div>
                <hr>
                <h2 class="receipt-padding" style="text-align: center">Thank you!</h2>
            </div>
        </div>
        <script>
            const toNumbers = document.querySelectorAll(".s-to-float");
            console.log(toNumbers);
            toNumbers.forEach(element => {
                let toFloat = parseFloat(element.innerHTML).toFixed(2)
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          element.innerHTML = toFloat;

            });
        </script>
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
                        $total += (float)$result[$i];
                    }

                    echo number_format($total, 2);
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
                }
                else{
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
                        $total += (float)$result[$i];
                    }

                    echo number_format($total, 2);
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
                }
                else{
                    echo "<span class='cancelled'>Cancelled</span>";
                }?></td>
            </tr>
        </tbody>
        <?php
        }
    }
}
?>