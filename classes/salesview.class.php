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
        $total = 0;
        foreach ($results as $row) {
            $tmp = 0;

            $tmp += $row['success'] * $row['cost']; 
            $total += $tmp;
        ?>
        <tbody>
            <tr>
                <td></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['item_name'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['item_group'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['date_time'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cost'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['success'] ?></td>
                <td class="pad10 total-success-count" valign="top" style="text-align: left; padding-left: 10px"><?php echo $tmp ?></td>
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
                <span class="total-sold-success"><?php echo $total; ?>
                </span>
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
            $total2 = 0;
            foreach ($results as $row) {
                $tmp2 = 0;
    
                $tmp2 += $row['cancel'] * $row['cost']; 
                $total2 += $tmp2;
        ?>
        <tbody>
            <tr>
                <td></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['item_name'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['item_group'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['date_time'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cost'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cancel'] ?></td>
                <td class="pad10 total-cancel-count" valign="top" style="text-align: left; padding-left: 10px"><?php echo $tmp2 ?></td>
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
                <span class="total-sold-cancel"><?php echo $total2 ?></span>
            </td>
        </tr>
        </tfoot>
        <?php
    }
    public function initSalesReportDate($date, $date2){
        $results = $this->getSalesReportDate($date, $date2);
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
        $total = 0;
        foreach ($results as $row) {
            $tmp = 0;

            $tmp += $row['success'] * $row['cost']; 
            $total += $tmp;
        ?>
        <tbody>
            <tr>
                <td></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['item_name'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['item_group'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['date_time'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cost'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['success'] ?></td>
                <td class="pad10 total-success-count" valign="top" style="text-align: left; padding-left: 10px"><?php echo $tmp ?></td>
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
                <span class="total-sold-success"><?php echo $total ?></span>
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
        $total2 = 0;
        foreach ($results as $row) {
            $tmp2 = 0;

            $tmp2 += $row['cancel'] * $row['cost']; 
            $total2 += $tmp2;
        ?>
        <tbody>
            <tr>
                <td></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><span><?php echo $row['item_name'] ?></span></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['item_group'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['date_time'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cost'] ?></td>
                <td class="pad10" valign="top" style="text-align: left; padding-left: 10px"><?php echo $row['cancel'] ?></td>
                <td class="pad10 total-cancel-count" valign="top" style="text-align: left; padding-left: 10px"><?php echo $tmp2 ?></td>
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
                <span class="total-sold-cancel"><?php echo $total2 ?></span>
            </td>
        </tr>
        </tfoot>
        <?php
    }
}