<?php

class OrdersView extends Orders{
    public function initGetOrder($oid){
        $results = $this->getOrder($oid);
        ?>

        <table class="tables-table order-table" style="height: 300px">
            <thead>
                <th style="width:15%">Crew</th>
                <th>Order</th>
            </thead>
            <?php
            ?>
            <tbody>
                <?php 
                    foreach ($results as $row) {
                    if($row['is_ready'] == 1 ) {
?>
                <tr style="overflow-y:hidden;">
                    <td style="width:150px"><?php echo $row["waiter"]; ?></td>
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
}

?>