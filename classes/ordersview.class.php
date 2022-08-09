<?php

class OrdersView extends Orders{
    public function initGetOrder($oid){
        $results = $this->getOrder($oid);
        ?>

        <table class="tables-table order-table">
            <thead>
                <th>Crew</th>
                <th>Order</th>
            </thead>
            <?php
            foreach ($results as $row) {
            ?>
            <tbody>
                <?php 
                    if($row['is_ready'] == 1 ) {
                    ?>
                <tr>
                    <td><?php echo $row["waiter"]; ?></td>
                    <td><?php echo $row["order"] . " x " . $row["quantity"]; ?></td>
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