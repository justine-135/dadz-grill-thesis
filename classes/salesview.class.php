<?php

class SalesView extends Sales{
    public function initSalesReport(){
        $results = $this->getSalesReport();
        ?>
        <thead>
            <tr>
                <th>Success Orders</th>
                <th style="text-align: left; padding-left: 10px">Item</th>
                <th style="text-align: left; padding-left: 10px">Group</th>
                <th style="text-align: left; padding-left: 10px">Date</th>
                <th style="text-align: left; padding-left: 10px">Price</th>
                <th style="text-align: left; padding-left: 10px">Quantity</th>
                <th style="text-align: left; padding-left: 10px">Total</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['item_name'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['item_group'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['date_time'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cost'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['success'] ?></td>
                <td class="pad10 total-success-count" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['success'] * $row['cost'] ?></td>
            </tr>
        </tbody>
        <?php
        }
        ?>
        <tfoot>
        <tr>
            <td></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <th class="pad10" valign="top" style="text-align: left">Total Sum</>
            <td class="pad10" valign="top" style="text-align: left">
                <span class="total-sold-success"></span>
            </td>
        </tr>
        </tfoot>

        <tr>
        <tr>

        <thead>
            <tr>
                <th>Cancelled Orders</th> 
                <th style="text-align: left; padding-left: 10px">Item</th>
                <th style="text-align: left; padding-left: 10px">Group</th>
                <th style="text-align: left; padding-left: 10px">Date</th>
                <th style="text-align: left; padding-left: 10px">Price</th>
                <th style="text-align: left; padding-left: 10px">Quantity</th>
                <th style="text-align: left; padding-left: 10px">Total</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['item_name'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['item_group'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['date_time'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cost'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cancel'] ?></td>
                <td class="pad10 total-cancel-count" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cancel'] * $row['cost'] ?></td>
            </tr>
        </tbody>
        <?php
        }
        ?>
        <tfoot>
        <tr>
            <td></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <th class="pad10" valign="top" style="text-align: left">Total Sum</>
            <td class="pad10" valign="top" style="text-align: left">
                <span class="total-sold-cancel"></span>
            </td>
        </tr>
        </tfoot>
        <?php
    }
    public function initSalesReportDate($date){
        $results = $this->getSalesReportDate($date);
        ?>
        <thead>
            <tr>
                <th>Success Orders</th>
                <th style="text-align: left; padding-left: 10px">Item</th>
                <th style="text-align: left; padding-left: 10px">Group</th>
                <th style="text-align: left; padding-left: 10px">Date</th>
                <th style="text-align: left; padding-left: 10px">Price</th>
                <th style="text-align: left; padding-left: 10px">Quantity</th>
                <th style="text-align: left; padding-left: 10px">Total</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['item_name'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['item_group'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['date_time'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cost'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['success'] ?></td>
                <td class="pad10 total-success-count" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['success'] * $row['cost'] ?></td>
            </tr>
        </tbody>
        <?php
        }
        ?>
        <tfoot>
        <tr>
            <td></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <th class="pad10" valign="top" style="text-align: left">Total Sum</>
            <td class="pad10" valign="top" style="text-align: left">
                <span class="total-sold-success"></span>
            </td>
        </tr>
        </tfoot>

        <tr>
        <tr>

        <thead>
            <tr>
                <th>Cancelled Orders</th> 
                <th style="text-align: left; padding-left: 10px">Item</th>
                <th style="text-align: left; padding-left: 10px">Group</th>
                <th style="text-align: left; padding-left: 10px">Date</th>
                <th style="text-align: left; padding-left: 10px">Price</th>
                <th style="text-align: left; padding-left: 10px">Quantity</th>
                <th style="text-align: left; padding-left: 10px">Total</th>
            </tr>
        </thead>
        <?php
        foreach ($results as $row) {
        ?>
        <tbody>
            <tr>
                <td></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['item_name'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['item_group'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['date_time'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cost'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cancel'] ?></td>
                <td class="pad10 total-cancel-count" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cancel'] * $row['cost'] ?></td>
            </tr>
        </tbody>
        <?php
        }
        ?>
        <tfoot>
        <tr>
            <td></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <td class="pad10" valign="top" style="text-align: left"></td>
            <th class="pad10" valign="top" style="text-align: left">Total Sum</>
            <td class="pad10" valign="top" style="text-align: left">
                <span class="total-sold-cancel"></span>
            </td>
        </tr>
        </tfoot>
        <?php
    }
}