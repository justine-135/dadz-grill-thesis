<?php

class UsersView extends Users{
    public function initGetUsers(){
        $results = $this->getUsers();
        ?>
        <thead>
            <tr>
                <th>Id</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Online</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>

        <?php
            foreach ($results as $row) {
        ?>

        <tbody>
            <tr id ="<?php echo $row['id']; ?>">
                <td><?php echo $row['id']; ?></td>
                <td class="name"><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <?php
                    if ($row['is_active'] == 1) {
                ?>
                <td class="isactive_user"> <span class="yesactive">Yes</span> </td>
                <?php
                    }
                    else{
                ?>
                <td class="isactive_user"> <span class="noactive">No</span> </td>
                <?php
                    }
                ?>
                <td>
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
                    <button class="update-item-btn" type="button">Edit</button>
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
            <div class="info-text flex-column">
                <div class="span">Name: </div>
                <span><?php echo $row["fullname"]; ?></span>
            </div>
            <div class="info-text flex-column">
                <div class="span">Email: </div>
                <span><?php echo $row["email"]; ?></span>
            </div>
            <div class="info-text flex-column">
                <div class="span">Contact: </div>
                <span><?php echo $row["contact"]; ?></span>
            </div>
            <div class="info-text flex-column">
                <div class="span">Birth date: </div>
                <span><?php echo $row["birth_date"]; ?></span>
            </div>
            <div class="info-text flex-column">
                <div class="span">Address: </div>
                <span><?php echo $row["location_address"]; ?></span>
            </div>
        <?php
    }
    }
}
?>