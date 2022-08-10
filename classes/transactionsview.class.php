<?php

class TransactionsView extends Transactions{
    public function initTransactions(){
        $results = $this->getTransactions();
        ?>
        <thead>
            <tr>
                <th>Order number</th>
                <th>Table number</th>
                <th>Time</th>
                <th>Order</th>
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
                    <table class="orders-table">
                        <tbody>
                            <?php echo $row['order'] ?>
                        </tbody>
                    </table></td>
                <td class="pad10" valign="top"><?php echo $row['total'] ?></td>
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
                        <input type="text" name="table" value=<?php echo $row['table_id'] ?> id="" hidden>
                        <input type="submit" name="paid" value="Paid">
                        <input type="submit" name="print" value="Print">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </td>
            </tr>
        </tbody>
        <?php
        }
    }
}

?>