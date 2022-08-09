<?php

class PurchaseView extends Purchase{
    public function initGetPurchases(){
        $results = $this->getPurchases();
        ?>
        <table class="inventory-table ing-tbl">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Table number</th>
                    <th>Orders</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Waiter</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            foreach ($results as $row) {
            ?>
            <tbody>
                    <tr id ="<?php echo $row['sales_id']; ?>">
                        <td><?php echo $row['sales_id']; ?></td>
                        <td><?php echo $row['table_id']; ?></td>
                        <td class="name"><?php echo $row['item_name']; ?></td>
                        <td><?php echo $row['total_purchase']; ?></td>
                        <?php
                            if($row['order_status'] == 'Active'){
                        ?>
                            <td><span class="success"><?php echo $row['order_status']; ?></span></td>
                        <?php
                            }
                            elseif($row['order_status'] == 'Cancel'){
                        ?>
                            <td><span class="cancel"><?php echo $row['order_status']; ?></span></td>
                        <?php
                            }
                            else{
                        ?>
                            <td><span><?php echo $row['order_status']; ?></span></td>
                        <?php
                            }
                        ?>
                        <td><?php echo $row['waiter']; ?></td>
                        <td class="action-td">
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
                <li><?php echo $row['item_name'] ?></li>
            </ul>
        </div>
        <?php
        }
    }

}

?>