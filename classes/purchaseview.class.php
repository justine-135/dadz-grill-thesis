<?php

class PurchaseView extends Purchase{
    public function initGetPurchases(){
        $results = $this->getPurchases();
        ?>
        <table class="tables-table ing-tbl">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Table number</th>
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
                            <table class="orders-table">
                                <tbody>
                                    <?php echo $row['item_name']; ?>
                                </tbody>
                            </table>
                        </td>
                        <td class="pad10" valign="top"><?php echo $row['total_purchase']; ?></td>
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
                    <tbody>
                        <?php echo $row['item_name']; ?>
                    </tbody>
                </table>
            </ul>
        </div>
        <?php
        }
    }

}

?>