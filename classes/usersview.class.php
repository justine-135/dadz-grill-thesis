<?php

class UsersView extends Users{
    public function initGetUsers(){
        $results = $this->getUsers();
        ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">#</th>
                <th style="text-align: left; padding-left: 10px">Full name</th>
                <th style="text-align: left; padding-left: 10px">Username</th>
                <th style="text-align: left; padding-left: 10px">Contact</th>
                <th style="text-align: left; padding-left: 10px">Role</th>
                <th>Actions</th>
            </tr>
        </thead>

        <?php
            foreach ($results as $row) {
        ?>

        <tbody>
            <tr id ="<?php echo $row['id']; ?>">
                <td style="text-align: left; padding-left: 10px"><?php echo $row['id']; ?></td>
                <td class="name" style="text-align: left; padding-left: 10px"><?php echo $row['fullname']; ?></td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['username']; ?></td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['contact']; ?></td>
                <td style="text-align: left; padding-left: 10px">
                    <?php
                        if ($row['is_superuser'] == 1) {
                    ?>
                    <span>Manager</span>
                    <?php
                        }
                        elseif ($row['is_cashier'] == 1){
                    ?>
                        <span>Cashier</span>
                    <?php
                        }
                        elseif ($row['is_waiter'] == 1){
                    ?>
                        <span>Waiter</span>
                    <?php
                        }
                        elseif ($row['is_cook'] == 1){
                    ?>
                        <span>Cook</span>
                    <?php
                        }
                        elseif ($row['is_cleaner'] == 1){
                    ?>
                        <span>Cleaner</span>
                    <?php
                        }
                    ?>
                </td>
                <td class="action-td">
                    <button class="view-info-btn view-account-btn">View</button>
                    <button class="delete-item-btn delete-account-btn" type="button">Delete</button>
                </td>   
            </tr>
        </tbody>
        <?php
        }
    }

    public function initGetUser($uid){
        $results = $this->getUser($uid);
        foreach ($results as $row) {
        ?>
            <div class="info-text flex-row">
                <div class="span">Name: </div>
                <span><?php echo $row["fullname"]; ?></span>
            </div>
            <div class="info-text flex-row">
                <div class="span">Email: </div>
                <span><?php echo $row["email"]; ?></span>
            </div>
            <div class="info-text flex-row">
                <div class="span">Contact: </div>
                <span><?php echo $row["contact"]; ?></span>
            </div>
            <div class="info-text flex-row">
                <div class="span">Birth date: </div>
                <span><?php echo $row["birth_date"]; ?></span>
            </div>
            <div class="info-text flex-row">
                <div class="span">Address: </div>
                <span><?php echo $row["location_address"]; ?></span>
            </div>
            <div class="info-text flex-row">
                <div class="span">Role: </div>
                <button type="button" class="user-edit-btn edit-show" id="edit-role">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                    <span>Edit</span>
                </button>
            </div>
            <form class="info-text flex-column role-select-div hide" action="./includes/admin-contr.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="id-value" id="id-value" value="<?php echo $row['id'] ?>" hidden>
                <div>
                    <span>New role</span>
                    <input hidden type="text" name="role" id="role" value="<?php 
                    if ($row["is_cashier"] == 1) {
                        echo "Cashier";
                    } 
                    elseif ($row["is_waiter"] == 1) {
                        echo "Waiter";
                    }
                    elseif ($row["is_cook"] == 1) {
                        echo "Cook";
                    }
                    elseif ($row["is_cleaner"] == 1) {
                        echo "Cleaner";
                    }
                ?>">
                    <select class="form-select role-input" aria-label="Default select example">
                    <option selected><?php 
                        if ($row["is_cashier"] == 1) {
                            echo "Cashier";
                        } 
                        elseif ($row["is_waiter"] == 1) {
                            echo "Waiter";
                        }
                        elseif ($row["is_cook"] == 1) {
                            echo "Cook";
                        }
                        elseif ($row["is_cleaner"] == 1) {
                            echo "Cleaner";
                        }
                    ?></option>
                    <option value="Cashier">Cashier</option>
                    <option value="Waiter">Waiter</option>
                    <option value="Cook">Cook</option>
                    <option value="Cleaner">Cleaner</option>
                    </select>
                </div>
                <button type="submit" type="submit" name="change-role" value="Change" class="save-change">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>    
                    <span>Change</span>
                </button>
            </form>
            <div class="info-text flex-row">
                <div class="span">Password: </div>
                <button type="button" class="user-edit-btn edit-show" id="edit-pwd">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                    <span>Edit</span>
                </button>
            </div>
            <form class="info-text flex-column pwd-div hide" action="./includes/admin-contr.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="id-value" id="id-value" value="<?php echo $row['id'] ?>" hidden>
                <div class="flex-column">
                    <span>New password</span>
                    <input type="password" name="new-pwd" id="" placeholder="Enter new password">
                </div>
                <div class="flex-column">
                    <span>Re-type password</span>
                    <input type="password" name="retype-pwd" id="" placeholder="Re-type password">
                </div>
                <button type="submit" type="submit" name="change-pass" value="Change" class="save-change">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>    
                    <span>Change</span>
                </button>
            </form>

        <?php
        }
    }

    public function initGetHistory(){
        $results = $this->getHistory();
        ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">Name</th>
                <th style="text-align: left; padding-left: 10px">Browser</th>
                <th style="text-align: left; padding-left: 10px">Login</th>
                <th style="text-align: left; padding-left: 10px">Logout</th>
                <th style="text-align: left; padding-left: 10px">Status</th>
            </tr>
        </thead>

        <?php
            foreach ($results as $row) {
        ?>

        <tbody>
            <tr id ="<?php echo $row['id']; ?>" >
                <td style="text-align: left; padding-left: 10px"><?php echo $row['fullname']; ?></td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['browser']; ?></td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['last_login']; ?></td>
                <td style="text-align: left; padding-left: 10px">
                    <?php
                    if ($row['last_logout'] != null) {
                        echo $row['last_logout'];
                    }
                    else{
                        echo "-";
                    }
                       ?>
                </td>
                <td style="text-align: left; padding-left: 10px">
                    <?php
                    if ($row['last_logout'] == null) {
                        ?>
                        <div class="flex-row" >
                            <span style="margin-right: 3px">Logged in </span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="sidelink-svg"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill:green;" d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="flex-row" >
                            <span style="margin-right: 3px">Logged out </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill:red;" d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>                        </div>
                        <?php                    }
                       ?>
                </td>
            </tr>
        </tbody>
        <?php
        }
    }

    public function initGetHistoryDate($date, $date2){
        $results = $this->getHistoryDate($date, $date2);
        ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">Name</th>
                <th style="text-align: left; padding-left: 10px">Browser</th>
                <th style="text-align: left; padding-left: 10px">Login</th>
                <th style="text-align: left; padding-left: 10px">Logout</th>
                <th style="text-align: left; padding-left: 10px">Status</th>
            </tr>
        </thead>

        <?php
            foreach ($results as $row) {
        ?>

        <tbody>
            <tr id ="<?php echo $row['id']; ?>" >
                <td style="text-align: left; padding-left: 10px"><?php echo $row['fullname']; ?></td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['browser']; ?></td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['last_login']; ?></td>
                <td style="text-align: left; padding-left: 10px">
                    <?php
                    if ($row['last_logout'] != null) {
                        echo $row['last_logout'];
                    }
                    else{
                        echo "-";
                    }
                       ?>
                </td>
                <td style="text-align: left; padding-left: 10px">
                    <?php
                    if ($row['last_logout'] == null) {
                        ?>
                        <div class="flex-row" >
                            <span style="margin-right: 3px">Logged in </span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="sidelink-svg"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill:green;" d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="flex-row" >
                            <span style="margin-right: 3px">Logged out </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill:red;" d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>                        </div>
                        <?php                    }
                       ?>
                </td>
            </tr>
        </tbody>
        <?php
        }
    }

    public function initUserCompliance($date, $date2){
        $results = $this->getUserCompliance($date, $date2);

        ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">User #</th>
                <th style="text-align: left; padding-left: 10px">Date</th>
                <th style="text-align: left; padding-left: 10px">Name</th>
                <th style="text-align: left; padding-left: 10px">Role</th>
                <th style="text-align: left; padding-left: 10px">Service</th>
            </tr>
        </thead>
        <?php
            foreach ($results as $row) {
        ?>
        <tbody>
            <tr id ="<?php echo $row['id']; ?>" >
                <td style="text-align: left; padding-left: 10px"><?php echo $row['id']; ?></td>
                <td style="text-align: left; padding-left: 10px"><?php $dt = new DateTime($row['date_time']);
echo $dt->format('Y-m-d');
$interval = $dt->diff(new DateTime()); ?></td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['username']; ?></td>
                <td style="text-align: left; padding-left: 10px"><?php if ($row["is_superuser"] == 1) {
                    echo "Manager";
                }elseif ($row["is_cashier"]) {
                    echo "Cashier";
                }elseif ($row["is_waiter"]) {
                    echo "Waiter";
                }elseif ($row["is_cook"]) {
                    echo "Cook";
                }elseif ($row["is_cleaner"]) {
                    echo "Cleaner";
                } ?></td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['SUM(served.served)']; ?></td>
            </tr>
        </tbody>
        <?php
        }
    }
}
?>