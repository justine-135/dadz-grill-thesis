<?php

class PurchaseView extends Purchase{
    public function initGetPurchases(){
        $results = $this->getPurchases();
        ?>
        <table class="tables-table ing-tbl">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Table #</th>
                    <th>Orders</th>
                    <th>Total</th>
                    <th>Waiter</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            foreach ($results as $row) {
            ?>
            <tbody>
                    <tr id ="<?php echo $row['sales_id']; ?>">
                        <td class="pad10" valign="top"><?php echo $row['sales_id']; ?></td>
                        <td class="pad10" valign="top"><?php echo $row['table_id']; ?></td>
                        <td>
                            <?php 
                                $result = explode("|",$row['item_name']);
                                $result2 = explode("|",$row['quantity']);
                                $result3 = explode("|",$row['quantity']);
                            ?>
                        <table class="orders-table">
                            <tbody>
                                <?php
                                    for ($i=0; $i < (count($result) - 1); $i++) { 
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                                echo $result[$i];
                                            ?>
                                        </td>
                                        <td class="order-x-col">
                                            x
                                        </td>
                                        <td>
                                            <?php
                                                echo $result2[$i];
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        </td>
                        <td class="pad10" valign="top">
                            <?php 
                                $result = explode("|",$row['total_purchase']);
                                $total = 0;
                                for ($i=0; $i < (count($result) - 1); $i++) { 
                                    $total += $result[$i];
                                }

                                echo $total;
                            ?>
                        </td>
                        <td class="pad10" valign="top"><?php echo $row['waiter']; ?></td>
                        <td valign="top" class="action-td pad10">
                            <button class="finish-btn">Finish</button>
                            <button class="cancel-btn">Cancel</button>
                        </td>
                    </tr>
                    <?php
                            }
                    ?>
            </tbody>
        </table>
        <?php
    }

    public function initGetPurchase($id){
        $results = $this->getPurchase($id);
        ?>
        <div class="confirm-order">
             <?php
            foreach ($results as $row) {
            ?>
            <p>Table <?php echo $row['table_id']; ?></p>
            <span>-</span>
            <ul>
                <table class="modal-orders-table">
                    <?php 
                        $result = explode("|",$row['item_name']);
                        $result2 = explode("|",$row['quantity']);
                    ?>
                    <tbody>
                        <?php
                            for ($i=0; $i < (count($result) - 1); $i++) { 
                        ?>
                            <tr>
                                <td>
                                    <?php
                                        echo $result[$i];
                                    ?>
                                </td>
                                <td class="order-x-col">
                                    x
                                </td>
                                <td>
                                    <?php
                                        echo $result2[$i];
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </ul>
        </div>
        <?php
        }
    }

}

?>