<?php include "header.php" ?>
<nav class="inventory-nav nav-page flex-row">
    <div class="title flex-row">
        <div class="circle-svg">
            <svg class="sidelink-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M0 96C0 60.65 28.65 32 64 32H448C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96zM64 160H128V96H64V160zM448 96H192V160H448V96zM64 288H128V224H64V288zM448 224H192V288H448V224zM64 416H128V352H64V416zM448 352H192V416H448V352z" />
            </svg>
        </div>
        <h3>Your profile</h3>
    </div>
</nav>

<div class="main-content tables-container">
    <div class="tables flex-row edit-profile-div">
        <div class="body flex-column edit-profileinfo-div">
            <form action="includes/admin-contr.inc.php" class="flex-column" method="POST">
                <div class="admin-info flex-row spacing">
                    <div class="register-input edit-admin-input fullname-email-input flex-column">
                        <span>Full name</span>
                        <input type="text" name="fullname" id="" placeholder="Enter new name"  required>
                    </div>
                    <div class="register-input edit-admin-input fullname-email-input flex-column">
                        <span>Email</span>
                        <input type="text" name="email" id="" placeholder="sample@gmail.com"  required>
                    </div>
                </div>
                <div class="admin-contacts flex-row spacing">
                    <div class="register-input edit-admin-input flex-column">
                        <span>Contact</span>
                        <input type="text" name="contact" id="" placeholder="09XXXXXXXXX"  required>
                    </div>
                    <div class="register-input edit-admin-input flex-column">
                        <span>Birth date</span>
                        <input type="date" name="bdate" id=""  required>
                    </div>
                    <div class="register-input edit-admin-input flex-column">
                        <span>Address</span>
                        <input type="text" name="address" id="" placeholder="Enter new address"  required>
                    </div>
                </div>
                <input type="text" name="id-value"  hidden>
                <button class="ml-auto-btn" name="edit">Save</button>
            </form>
            
            <form class="admin-userpass flex-row spacing">
                <div class="register-input edit-admin-input flex-column">
                    <span>Username</span>
                    <input type="text" name="uname" id="" placeholder="Enter new username" required>
                </div>
                <div class="register-input edit-admin-input flex-column">
                    <span>Password</span>
                    <input type="password" name="pwd" id="" required>
                </div>
                <div class="register-input edit-admin-input flex-column">
                    <span>Confirm Password</span>
                    <input type="password" name="cpwd" id="" required>
                </div>
            </form>
            <button class="ml-auto-btn">Save</button>
        </div>
    </div>
</div>