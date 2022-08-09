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
                <th>Paid</th>
                <th class="status-action-col">Status Action</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td><span><?php echo $row['id'] ?></span></td>
                <td><?php echo $row['table_id'] ?></td>
                <td ><?php echo $row['reg_date'] ?></td>
                <td><?php echo $row['order'] ?></td>
                <td><?php echo $row['total'] ?></td>
                <td><?php if ($row['paid'] == 0) {
                    echo "No";
                }
                else{
                    echo "Yes";
                }?></td>
                <td class="action-td status-action-col">
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