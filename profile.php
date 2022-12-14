<?php include "header.php" ?>
<nav class="inventory-nav nav-page flex-row">
    <div class="title flex-row">
        <div class="circle-svg">
            <svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M0 96C0 60.65 28.65 32 64 32H448C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96zM64 160H128V96H64V160zM448 96H192V160H448V96zM64 288H128V224H64V288zM448 224H192V288H448V224zM64 416H128V352H64V416zM448 352H192V416H448V352z" />
            </svg>
        </div>
        <h4>Your profile</h4>
    </div>
</nav>

<div class="main-content tables-container">
    <div class="tables flex-row edit-profile-div">
        <div class="body flex-column edit-profileinfo-div">
            <ul style="margin-left: -20px !important">
                <li class="">
                    <div class="profile-li flex-row">
                        <h5>Name</h5>
                        <span><?php echo $_SESSION["fullname"] ?></span>
                        <button class="edit-show flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                            <span>Edit</span>
                        </button>
                    </div>
                    <form class="flex-column profile-form hide" action="includes/admin-contr.inc.php" method="POST"  >
                        <div>
                            <span>First</span>
                            <input type="text" name="fname" id="" placeholder="Enter new first name">
                        </div>
                        <div>
                            <span>Last</span>
                            <input type="text" name="lname" id="" placeholder="Enter new last name">
                        </div>
                        <input type="text" name="id-value" id="id-value" value="<?php echo $_SESSION["uid"] ?>" hidden>
                        <button type="submit" type="submit" name="name-change" value="Change" class="save-change">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>    
                            <span>Change</span>
                        </button>
                    </form>
                </li>
                <li class="">
                    <div class="profile-li flex-row">
                        <h5>Username</h5>
                        <span><?php echo $_SESSION["username"] ?></span>
                        <button class="edit-show flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                            <span>Edit</span>
                        </button>
                    </div>
                    <form class="flex-column profile-form hide" action="includes/admin-contr.inc.php" method="POST">
                        <div>
                            <span>Username</span>
                            <input type="text" name="username" id="" placeholder="Enter new username">
                        </div>
                        <input type="text" name="id-value" id="id-value" value="<?php echo $_SESSION["uid"] ?>" hidden>
                        <button type="submit" type="submit" name="username-change" value="Change" class="save-change">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>    
                            <span>Change</span>
                        </button>
                    </form>
                </li>
                <li class="">
                    <div class="profile-li flex-row">
                        <h5>Email</h5>
                        <span><?php echo $_SESSION["email"] ?></span>
                        <button class="edit-show flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                            <span>Edit</span>
                        </button>
                    </div>
                    <form class="flex-column profile-form hide" action="includes/admin-contr.inc.php" method="POST">
                        <div>
                            <span>Contact</span>
                            <input type="text" name="email" id="" placeholder="Enter new email">
                        </div>
                        <input type="text" name="id-value" id="id-value" value="<?php echo $_SESSION["uid"] ?>" hidden>
                        <button type="submit" type="submit" name="email-change" value="Change" class="save-change">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>    
                            <span>Change</span>
                        </button>
                    </form>
                </li>
                <li class="">
                    <div class="profile-li flex-row">
                        <h5>Contact</h5>
                        <span><?php echo $_SESSION["contact"] ?></span>
                        <button class="edit-show flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                            <span>Edit</span>
                        </button>
                    </div>
                    <form class="flex-column profile-form hide" action="includes/admin-contr.inc.php" method="POST">
                        <div>
                            <span>Contact</span>
                            <input type="text" name="contact" id="" placeholder="Enter new contact">
                        </div>
                        <input type="text" name="id-value" id="id-value" value="<?php echo $_SESSION["uid"] ?>" hidden>
                        <button type="submit" type="submit" name="contact-change" value="Change" class="save-change">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>    
                            <span>Change</span>
                        </button>
                    </form>
                </li>
                <li class="">
                    <div class="profile-li flex-row">
                        <h5>Password</h5>
                        <span>Set password</span>
                        <button class="edit-show flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                            <span>Edit</span>
                        </button>
                    </div>
                    <form class="flex-column profile-form hide" action="includes/admin-contr.inc.php" method="POST">
                        <div>
                            <span>Old password</span>
                            <input type="password" name="old-pwd" id="" placeholder="Enter old password">
                        </div>
                        <div>
                            <span>New password</span>
                            <input type="password" name="new-pwd" id="" placeholder="Enter new password">
                        </div>
                        <div>
                            <span>Re-type password</span>
                            <input type="password" name="retype-pwd" id="" placeholder="Re-type password">
                        </div>
                        <input type="text" name="id-value" id="id-value" value="<?php echo $_SESSION["uid"] ?>" hidden>
                        <button type="submit" type="submit" name="pwd-change" value="Change" class="save-change">
                            <svg xmlns="http://www.w3.org/2000/svg" class="sidelink-svg-sm" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>    
                            <span>Change</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="alert-div">
    <?php
    if (isset($_GET["message"])) {
        $alert = $_GET["message"];
        if ($alert == "success") {
            ?>
            <div class="alert alert-success d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Changes submitted successfully. 
            </div>
                <?php
        } elseif ($alert == "emptyinput") {
            ?>
            <div class="alert alert-danger d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Fill up inputs. 
            </div>
            <?php
        } elseif ($alert == "invalidformat") {
            ?>
            <div class="alert alert-danger d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Invalid format. 
            </div>
            <?php
        } elseif ($alert == "notmatch") {
            ?>
            <div class="alert alert-danger d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" style="z-index: 5; height: 10px" role="alert">
            Password not match. 
            </div>
            <?php
        } else {
            echo "<span></span>";
        }
    }
    ?>
</div>

<script src="js/profile.js?v=<?php echo time(); ?>"></script>
