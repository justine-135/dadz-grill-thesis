<?php

class FoodsView extends Foods{
    public function initReadFoods(){
        $results = $this->getFoods();   
    ?>
        <thead>
            <tr>
                <th>Item #</th>
                <th>Image</th>
                <th>Name</th>
                <th>Group</th>
                <th>Price</th>
                <th>Show</th>
                <th>Actions</th>
            </tr>
        </thead>
    <?php

    foreach ($results as $row) {
    ?>
        <tbody>
            <tr id ="<?php echo $row['fid']; ?>">
                <td><?php echo $row['fid']; ?></td>
                <td>
                    <img name="item-img" class="tbl-img-data" src="./img/temp/<?php echo $row['photo']; ?>" alt="">    
                </td>
                <td class="name"><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['item_group']; ?></td>
                <td><?php echo $row['cost']; ?></td>
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

                <td class="action-td">
                    <button class="update-item-btn" type="button">Edit</button>
                    <button class="delete-item-btn" type="button">Delete</button>
                </td>
            </tr>
        </tbody>
        
<?php
        }
    }

    public function initReadAll(){
        $results = $this->getFoods();
        foreach ($results as $row) {
            if($row['order_status'] == "Yes"){
        ?>
        <button>
            <div class="image" style='background-image: url("./img/temp/<?php echo $row['photo']; ?>")'></div>
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                    </div>
                </div>
            </div>
        </button>
        <?php
            }
        }
    }
    public function initReadSets(){
        $results = $this->getSets();
        foreach ($results as $row) {
            if($row['order_status'] == "Yes"){
        ?>
        <button>
            <div class="image" style='background-image: url("./img/temp/<?php echo $row['photo']; ?>")'></div>
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                    </div>
                </div>
            </div>
        </button>
        <?php
            }
        }
    }
    public function initReadSides(){
        $results = $this->getSides();
        foreach ($results as $row) {
            if($row['order_status'] == "Yes"){
        ?>
        <button>
            <div class="image" style='background-image: url("./img/temp/<?php echo $row['photo']; ?>")'></div>
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                    </div>
                </div>
            </div>
        </button>
        <?php
            }
        }
    }    
    public function initReadDrinks(){
        $results = $this->getDrinks();
        foreach ($results as $row) {
            if($row['order_status'] == "Yes"){
        ?>
        <button>
            <div class="image" style='background-image: url("./img/temp/<?php echo $row['photo']; ?>")'></div>
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                    </div>
                </div>
            </div>
        </button>
        <?php
            }
        }
    }    
    public function initReadAddons(){
        $results = $this->getAddons();
        foreach ($results as $row) {
            if($row['order_status'] == "Yes"){
        ?>
        <button>
            <div class="image" style='background-image: url("./img/temp/<?php echo $row['photo']; ?>")'></div>
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                    </div>
                </div>
            </div>
        </button>
        <?php
            }
        }
    }

}
?>

