<?php

class FoodsView extends Foods{
    public function initReadFoods(){
        $results = $this->getFoods();   
    ?>
        <thead>
            <tr>
                <th style="text-align: left; padding-left: 10px">Name</th>
                <th>Image</th>
                <th style="text-align: left; padding-left: 10px">Group</th>
                <th style="text-align: left; padding-left: 10px">Price (₱)</th>
                <th style="text-align: left; padding-left: 10px">Quantity</th>
                <th style="text-align: left; padding-left: 10px">Show</th>
                <th>Actions</th>
                <th class="hide" style="text-align: left; padding-left: 10px">Name 2</th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach ($results as $row) {
    ?>
            <tr id ="<?php echo $row['fid']; ?>">
                <td class="name" style="text-align: left; padding-left: 10px"><?php echo $row['item_name']; ?></td>
                <td>
                    <img name="item-img" class="tbl-img-data" height="40px" width="40px" src="./img/temp/<?php echo $row['photo']; ?>" alt="">    
                </td>
                <td style="text-align: left; padding-left: 10px"><?php echo $row['item_group']; ?></td>
                <td style="text-align: left; padding-left: 10px">
                <?php echo "<span class='prices'>" . $row['cost'] . "</span>"; ?>
                </td>
                <td style="text-align: left; padding-left: 10px">
                <?php
                if ($row['item_group'] == "Meat") {
                    echo "<span class='grams'>" . $row['grams'] . "</span>" . "g";
                }
                else{
                    echo "<span class='grams'>" . $row['grams'] . "</span>";
                }
                ?>
                </td>
                <?php
                    if($row['order_status'] == 'Active'){
                ?>
                    <td style="text-align: left; padding-left: 10px"><span class="success"><?php echo $row['order_status']; ?></span></td>
                <?php
                    }
                    elseif($row['order_status'] == 'Cancel'){
                ?>
                    <td style="text-align: left; padding-left: 10px"><span class="cancel"><?php echo $row['order_status']; ?></span></td>
                <?php
                    }
                    else{
                ?>
                    <td style="text-align: left; padding-left: 10px"><span><?php echo $row['order_status']; ?></span></td>
                <?php
                    }
                ?>

                <td class="action-td">
                    <button class="update-item-btn" type="button">Edit</button>
                    <button class="delete-item-btn" type="button">Delete</button>
                </td>
                <td class="name2 hide" style="text-align: left; padding-left: 10px"><?php echo $row['item_name2']; ?></td>

            </tr>
        
<?php
        }
        ?>
        </tbody>

        <?php
    }

    public function initReadAll(){
        $results = $this->getFoods();
        foreach ($results as $row) {
            if($row['order_status'] == "Yes"){
        ?>
        <button>
            <img class="image" src="./img/temp/<?php echo $row['photo']; ?>" alt="">
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                        <input class="serving" type="text" value=<?php echo $row['serving'] ?> hidden>
                    </div>
                </div>
                <ul style="font-size: 10px; text-align: left; margin: 5px 0 5px 0">
                <?php
                    $results2 = $this->getInclusions();   
                    foreach ($results2 as $row2) {
                        if ($row['item_name2'] == $row2['foreign_name']) {
                            ?>
                            <li>
                                <?php echo "Unlimited " . $row2['name'] ?>
                                <input type="text" name="inclusion_name[]" value="<?php echo $row2['name'] ?>" hidden>
                                <input type="text" name="inclusion_id[]" value=<?php echo $row2['id'] ?> hidden>
                                <input type="text" name="inclusion_serving[]" value=<?php echo $row2['servings'] ?> hidden>
                            </li>
                            <?php
                        }
                    }
                ?>
                </ul>
                <input type="text" value=<?php echo $row['grams'] ?> hidden>
            </div>
        </button>
        <?php
            }
        }
    }
    public function initReadMeats(){
        $results = $this->getMeats();
        foreach ($results as $row) {
            if($row['order_status'] == "Yes"){
        ?>
        <button>
            <img class="image" src="./img/temp/<?php echo $row['photo']; ?>" alt="">
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                        <input class="serving" type="text" value=<?php echo $row['serving'] ?> hidden>
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
            <img class="image" src="./img/temp/<?php echo $row['photo']; ?>" alt="">
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                        <input class="serving" type="text" value=<?php echo $row['serving'] ?> hidden>
                    </div>
                </div>
                <ul style="font-size: 10px; text-align: left; margin: 5px 0 5px 0">
                <?php
                    $results2 = $this->getInclusions();   
                    foreach ($results2 as $row2) {
                        if ($row['item_name'] == $row2['foreign_name']) {
                            ?>
                            <li>
                                <?php echo "Unlimited " . $row2['name'] ?>
                                <input class="inclusion-info" type="text" name="inclusion_name[]" value="<?php echo $row2['name'] ?>" hidden>
                                <input class="inclusion-info" type="text" name="inclusion_id[]" value=<?php echo $row2['id'] ?> hidden>
                                <input class="inclusion-info" type="text" name="inclusion_serving[]" value=<?php echo $row2['servings'] ?> hidden>
                            </li>
                            <?php
                        }
                    }
                ?>
                </ul>
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
            <img class="image" src="./img/temp/<?php echo $row['photo']; ?>" alt="">
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                        <input class="serving" type="text" value=<?php echo $row['serving'] ?> hidden>
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
            <img class="image" src="./img/temp/<?php echo $row['photo']; ?>" alt="">
            <div class="text">
                <span><?php echo $row['item_name']; ?></span>
                <input value="<?php echo $row['fid']; ?>" type="text" name="" id="" hidden>

                <div class="item-info flex-column">
                    <div class="flex-row price">
                        <span>P</span>
                        <span> <?php echo $row['cost']; ?></span>
                        <input class="serving" type="text" value=<?php echo $row['serving'] ?> hidden>
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
            <img class="image" src="./img/temp/<?php echo $row['photo']; ?>" alt="">
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

    public function initReadSelect(){
        $results = $this->getFoods();
        ?>
        <select name="inclusions[]" class="form-select orig-select inclusion-select">
        <?php
        foreach ($results as $row) {
            if ($row['item_group'] != "Sets") {            
            ?>
              <option disabled selected value>Select </option>
        <option value=<?php echo $row['fid']; ?> id="<?php echo $row['item_name'] ?>"> <?php echo $row['item_name'] ?></option>
            <?php
            }
        }
        ?>
        </select>
        <?php
    }

    public function initEditInclusions($name){
        $results = $this->getEditInclusions($name);
        ?>
        <table class="table">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Servings</th>
            </thead>
            <tbody>
                <?php
            foreach ($results as $row) {
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['servings'] ?></td>
                </tr>
                <?php
            }
                ?>
            </tbody>
        </table>
        <?php
    }
}
?>

