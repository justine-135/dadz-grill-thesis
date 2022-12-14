<?php

include "header.php";

?>

<nav class="dashboard-nav nav-page flex-row">
    <div class="title flex-row">
        <div class="circle-svg">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="th-large" class="sidelink-svg svg-inline--fa fa-th-large fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path>
            </svg>
        </div>
        <h4>Dashboard</h4>
    </div>
    <div class="dropdown date-dashboard ">
        <button class="btn dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Select date
        </button>
        <ul class="dropdown-menu">
            <li class="ps-2">
                <span>Start time:</span>
                <input type="date" name="" id="" class="search-dashboard" placeholder="start date">
            </li>
            <li class="ps-2 mt-2">
                <span>End time:</span>
                <input type="date" name="" id="" class="search-dashboard-2" placeholder="start date">
            </li>
        </ul>
    </div>
</nav>

<div class="main-content dashboard-container">

    <div class="dashboard">
        <div class="sales-overview overview">
            <h4>Orders</h4>
            <div class="stats-container">
                <div class="stats sales flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Total Sales
                        </span>
                        <span class="sales-number number">0</span>
                    </div>
                </div>
                <div class="stats rev flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Total Orders
                        </span>
                        <span class="order-number number">0</span>
                    </div>
                </div>
                <div class="stats cost flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Cancelled Orders
                        </span>
                        <span class="cancelled-number number">0</span>
                    </div>
                </div>
                <div class="stats profs flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Success Orders
                        </span>
                        <span class="success-number number">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="purchase-overview overview">

            <h4>Table status</h4>
            <div class="stats-container">
                <div class="stats sales purchase flex-row">
                    <div class="table-color">
                        <div class="table-circle red"></div>
                    </div>
                    <div class="label-number flex-column">
                        <span class="label">
                            Occupied
                        </span>
                        <span class="occupied-number number">0</span>
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
                        <span class="unoccupied-number number">0</span>
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
                        <span class="call-number number">0</span>
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
                        <span class="dirty-number number">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-overview overview">
        <h4>Registered Crews</h4>
            <div class="stats-container">
                <div class="stats sales purchase flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            Total crew
                        </span>
                        <span class="total-crews-number number">0</span>
                    </div>
                </div>
                <div class="stats rev cancel flex-row">

                    <div class="label-number flex-column">
                        <span class="label">
                            Active crew
                        </span>
                        <span class="total-active-crews-number number">0</span>
                    </div>
                </div>
                <div class="stats cost flex-row">

                    <div class="label-number flex-column">
                        <span class="label user-compliances">
                            Total served
                        </span>
                        <span class="total-served-number number">0</span>
                    </div>
                </div>
                <div class="stats profs returns flex-row">
                    <div class="label-number flex-column">
                        <span class="label">
                            My role
                        </span>
                        <span class="crew-role number">-</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script src="js/dashboard.js?v=<?php echo time(); ?>"></script>