<?php
$root = "../";
include $root . 'db.php';

session_start();
error_reporting(0);
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>MY V Bike Rental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="<?php echo $root; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="<?php echo $root; ?>assets/css/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo $root; ?>assets/css/main.css" rel="stylesheet">
    <!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo $root; ?>assets/css/all-themes.css" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

</head>

<body class="theme-green">
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Morphing Search  -->
    <!-- Top Bar -->
    <nav class="navbar clearHeader">
        <div class="col-12">
            <div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand" href="../index.php">MY V Bike Rental</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li>
                    <a data-placement="bottom" title="Full Screen" href="<?php echo $root; ?>account/logout.php"><i class="zmdi zmdi-sign-in"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <?php
            if (isset($_SESSION['adminID'])) {
            ?>
                <!--Admin Menu -->
                <div class="menu">
                    <ul class="list" style="overflow: hidden; width: auto; height: calc(-184px + 100vh);">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active open">
                            <a href="<?php echo $root; ?>account/adminAccount.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Admins</span> </a>
                            <ul class="ml-menu">
                                <li><a href="<?php echo $root; ?>account/adminProfile.php">Admin Profile</a></li>
                                <li><a href="<?php echo $root; ?>account/adminChangePassword.php">Change Password</a></li>
                                <li><a href="<?php echo $root; ?>account/admin.php">Add Admin</a></li>
                                <li><a href="<?php echo $root; ?>account/viewAdmin.php">View Admin</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Reservations</span> </a>
                            <ul class="ml-menu">
                                <li><a href="<?php echo $root; ?>account/rent">New Reservation</a></li>
                                <li><a href="<?php echo $root; ?>account/viewReservationAdmin.php">View Reservation</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Users</span> </a>
                            <ul class="ml-menu">
                                <li><a href="<?php echo $root; ?>account/users.php">Add User</a></li>
                                <li><a href="<?php echo $root; ?>account/viewUsers.php">View User Records</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Bikes</span> </a>
                            <ul class="ml-menu">
                                <li><a href="<?php echo $root; ?>account/addBikes.php">Add Bikes</a></li>
                                <li><a href="<?php echo $root; ?>account/viewBikes.php">View Bikes</a></li>
                                <li><a href="<?php echo $root; ?>account/viewModels.php">View Models</a></li>
                            </ul>
                        </li>
                        </li>
                    </ul>
                </div>
                <!-- Admin Menu -->
            <?php } ?>

            <!-- users Menu -->
            <?php
            if (isset($_SESSION['userID'])) {
            ?>
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active open"><a href="<?php echo $root; ?>account/userAccount.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>

                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                            <ul class="ml-menu">
                                <li><a href="<?php echo $root; ?>account/userProfile.php">View Profile</a></li>
                                <li><a href="<?php echo $root; ?>account/userChangePassword.php">Change Password</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Reservations</span> </a>
                            <ul class="ml-menu">
                                <li><a href="<?php echo $root; ?>rent">Add Reservation</a></li>
                                <li><a href="<?php echo $root; ?>account/viewReservation.php">Reservations History</a></li>
                            </ul>
                        </li>
                    </ul>
                    </li>
                    </ul>
                </div>

            <?php }; ?>
            <!-- patient Menu -->
        </aside>
        <!-- #END# Left Sidebar -->

    </section>
    <section class="content home">