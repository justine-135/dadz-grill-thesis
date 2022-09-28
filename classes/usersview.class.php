<?php

class UsersView extends Users{
    public function initGetUsers(){
        $results = $this->getUsers();
        ?>
        <thead>
            <tr>
                <th>Account #</th>
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
            <input type="text" name="id-value" id="id-value" value="<?php echo $row['id'] ?>" hidden>
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
                <div class="user-role-div">
                    <input type="text" name="role" id="role" value="<?php 
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
                        ?>" 
                    hidden>
                    <button type="button" class="roles-btn flex-row"> 
                        <span>Role</span> 
                        <svg class="sidelink-svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>
                    </button>
                    
                    <ul>
                        <li><input class="role-input" type="button" name="cashier" value="Cashier"></li>
                        <li><input class="role-input" type="button" name="waiter" value="Waiter"></li>
                        <li><input class="role-input" type="button" name="cook" value="Cook"></li>
                        <li><input class="role-input" type="button" name="cleaner" value="Cleaner"></li>
                    </ul>
                </div>

            </div>
        <?php
    }
    }
}
?>