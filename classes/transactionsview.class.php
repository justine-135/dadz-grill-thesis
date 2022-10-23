<?php

class TransactionsView extends Transactions{
    public function initTransactions(){
        $results = $this->getTransactions();
        ?>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Table #</th>
                <th>Time</th>
                <th>Orders</th>
                <th>Total</th>
                <th>Status</th>
                <th class="status-action-col">Status Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td class="pad10" valign="top"><span><?php echo $row['id'] ?></span></td>
                <td class="pad10" valign="top"><?php echo $row['table_id'] ?></td>
                <td class="pad10" valign="top"><?php echo $row['reg_date'] ?></td>
                <td>
                    <?php 
                        $result = explode("|",$row['order']);
                        $result2 = explode("|",$row['quantity']);
                    ?>
                    <p style="width: 200px; text-align: left;" >
                        <?php
                        for ($i=0; $i < (count($result) - 1); $i++) { 
                    echo $result[$i] . "(" . $result2[$i] . ")"; ?>
                       <?php
                        }
                    ?>
                    </p>
                                     
                </td>
                <td class="pad10" valign="top">
                <?php 
                    $result = explode("|",$row['price']);
                    $total = 0;
                    for ($i=0; $i < (count($result) - 1); $i++) { 
                        $total += $result[$i];
                    }

                    echo $total;
                ?>    
                </td>
                <td class="pad10" valign="top"><?php if ($row['paid'] == 0) {
                    echo "Not paid";
                }
                elseif($row['paid'] == 1){
                    echo "Paid";
                }
                elseif($row['paid'] == 3){
                    echo "Cancelled";
                }?></td>
                <td valign="top" class="action-td status-action-col pad10">
                    <form action="./includes/transactions-contr.inc.php" method="POST">
                        <input type="text" name="id" value=<?php echo $row['id'] ?> id="" hidden>   
                        <input type="submit" name="process" value="Process">
                        <input type="submit" name="delete" value="Delete">
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
                <span><?php echo $row['reg_date'] ?></span>
            </div>
            <div class="bill-details flex-column" style="margin-left: auto; align-content: flex-start;">
                <span>Input bill</span>
                
                <input type="text" name="" id="bill-input">

            </div>
        </nav>
        <table class="tables-table bill-order-tbl">
            <thead >
                <tr>
                    <th style="width:50%; text-align:left; padding-left: 20px">Item</th>
                    <th style="width:10%">Amount</th>
                    <th style="width:20%">₱ Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
$result = explode("|",$row['order']);
$result2 = explode("|",$row['quantity']);
$result3 = explode("|",$row['price']);
$total = 0;
for ($i=0; $i < (count($result) - 1); $i++) { 
    $total += $result3[$i];
                ?>
                <tr>
                    <td style="text-align: left;padding-left: 20px"><?php echo $result[$i] ?></td>
                    <td><?php echo $result2[$i] ?></td>
                    <td>₱ <?php echo $result3[$i] ?></td>
                </tr>
                <?php } ?>
                <tr style="border-bottom: none">
                    <td></td>
                    <td class="bill-final-span" style="text-align:left"><span class="bill-final-span">Total:</span></td>
                    <td>₱ <span id="amount-total"><?php echo $total; ?></span></td>
                </tr>
                <tr style="border-bottom: none">
                    <td></td>
                    <td style="text-align:left"> <span class="bill-final-span">Payment:</span></td>
                    <td>₱ <span id="amount-paid">0</span></td>
                </tr>
                <tr style="border-bottom: none">
                    <td></td>
                    <td class="bill-final-span" style="text-align:left"><span class="bill-final-span">Change:</span></td>
                    <td>₱ <span id="amount-change">0</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="bill-td-submit">
                    <!-- <form action="./includes/transactions-view.inc.php" id="form-save-receipt" method="POST">
                        
                    </form> -->
                        <input type="text" name="total" id="total" hidden>
                        <input type="text" name="payment" id="payment" hidden>
                        <input type="text" name="change" id="change" hidden>
                        <input type="text" name="id" id="id" value="<?php echo $row['id'] ?>" hidden>
                        <input type="text" name="table" id="table" value="<?php echo $row['table_id'] ?>" hidden>
                        <button id="print">Print</button>
                        <input type="button" name="save" id="save" value="Save">  
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
    /* @media print and (width: 70cm) and (height: 11in) {
        @page {
            margin: 1in;
        }
} */

    </style>
    <title>Document</title>
</head>
<body>
        <div class="receipt-container">
            <div class="receipt-header receipt-padding">
                <h1 class="text-center">Dad'z Grillhouse</h1>
                <span class="text-center">Address: </span>
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
for ($i=0; $i < (count($result) - 1); $i++) { 
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
}
?>