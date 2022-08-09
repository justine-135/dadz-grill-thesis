
<?php 

    include "header.php";
    // session_start();
    // if (empty($_SESSION["username"])) {
    //     header("location: login.php?message=");
    // }
?>

<nav class="dashboard-nav nav-page flex-row">
    <div class="title flex-row">
        <div class="circle-svg">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-large" class="sidelink-svg svg-inline--fa fa-th-large fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path></svg>
        </div> 
        <h3>Dashboard</h3>
    </div>
    <button class="export-btn">Export</button>
</nav>

<div class="main-content dashboard-container">
    
    <div class="dashboard">
        <div class="sales-overview overview">
            <h2>Orders</h2>
            <div class="stats-container">
                <div class="stats sales flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Total Sales
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>
                <div class="stats rev flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Total Orders
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>     
                <div class="stats cost flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Cancelled Orders
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>         
                <div class="stats profs flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Success Orders
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="purchase-overview overview">
            <h2>Registered Crews</h2>
            <div class="stats-container">
                <div class="stats sales purchase flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Total crew
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>
                <div class="stats rev cancel flex-row">

                    <div class="label-number flex-column">
                        <span class="label">
                            Active crew
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>          
                <div class="stats cost flex-row">

                    <div class="label-number flex-column">
                        <span class="label">
                            Total served
                        </span> 
                        <span class="number">0</span>
                    </div>
                </div>           
                <div class="stats profs returns flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            My role
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-overview overview">
            <h2>Table status</h2>
            <div class="stats-container">
                <div class="stats sales purchase flex-row">
                    <div class="table-color">
                        <div class="table-circle red"></div>
                    </div>
                    <div class="label-number flex-column">
                        <span class="label">
                            Occupied
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>
                <div class="stats rev cancel flex-row">
                    <div class="table-color">
                        <div class="table-circle green"></div>
                    </div>
                    <div class="label-number flex-column">
                        <span class="label">
                            Unoccupied
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>          
                <div class="stats cost flex-row">
                    <div class="table-color">
                        <div class="table-circle yellow"></div>
                    </div>
                    <div class="label-number flex-column">
                        <span class="label">
                            Need assistance
                        </span> 
                        <span class="number">0</span>
                    </div>
                </div>           
                <div class="stats profs returns flex-row">
                    <div class="table-color">
                        <div class="table-circle blue"></div>
                    </div>
                    <div class="label-number flex-column">
                        <span class="label">
                            Dirty
                        </span>
                        <span class="number">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/dashboard.js"></script>
