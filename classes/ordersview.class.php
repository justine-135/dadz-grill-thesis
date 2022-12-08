<?php

class OrdersView extends Orders{
    public function initGetOrder($oid){
        $results = $this->getOrder($oid);
        ?>

        <table class="tables-table order-table table" style="height: 300px">
            <thead>
                <th>Crew</th>
                <th style="min-width:100px">Order</th>
            </thead>
            <?php
            ?>
            <tbody>
                <?php 
                    foreach ($results as $row) {
                    if($row['is_ready'] == 1 ) {
?>
                <tr style="overflow-y:hidden;">
                    <td ><?php echo $row["waiter"]; ?></td>
                    <?php
                     
                        ?>
                    <td style="text-align: left;"><?php 
                    $result2 = explode("|",$row['order']);
                    $result3 = explode("|",$row['quantity']);
                    for ($i=0; $i < (count($result2) - 1); $i++) {
                    echo $result2[$i] . "(" . $result3[$i] . ")"; 
                    }
                    ?></td>
                </tr>
                <?php
                }
            }
                ?>
            </tbody>
        </table>
        <?php
    }
    public function initGetOrderAttend($oid){
        $results = $this->getOrder($oid);
        ?>

        <table class="tables-table order-table" style="height: 300px">
            <thead>
                <th>Order</th>
                <th>Action</th>
            </thead>
            <?php
            ?>
            <tbody>
                <?php 
                    foreach ($results as $row) {
                    if($row['is_attended'] == 0 ) {
                ?>
                <tr style="overflow-y:hidden;">
                    <td style="text-align: left;"><?php 
                    $result2 = explode("|",$row['order']);
                    $result3 = explode("|",$row['quantity']);
                    for ($i=0; $i < (count($result2) - 1); $i++) {
                    echo $result2[$i] . "(" . $result3[$i] . ")"; 
                    }
                    ?></td>
                    <td><input type="submit" name="attend" value="Attend"></td>
                </tr>
                <?php
                }
            }
                ?>
            </tbody>
        </table>
        <?php
    }
    public function initPendingOrders($oid){
        $results = $this->getOrder($oid);
        $count = 0;
        foreach ($results as $row) {
            if ($row["is_attended"] == 0) {
                $count += 1;
            };
        }
        echo $count;
    }
}

?>