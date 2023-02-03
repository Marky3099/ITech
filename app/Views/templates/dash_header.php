<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if($_SESSION['position'] == USER_ROLE_ADMIN || $_SESSION['position'] == USER_ROLE_EMPLOYEE || $_SESSION['position'] == USER_ROLE_SECRETARY):?>
        <title>Task and Schedule Management System</title>
    <?php else:?>
        <title>Appointment System</title>
    <?php endif;?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>    
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboardstyle.css')?>">   
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
</head>

<body>
    
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <img src="<?= base_url('assets/image/iicon.png');?>">
            </div>
            <i class="fas fa-bars" id="btn"></i>
        </div>
        <ul class="nav_list">
        <?php if($_SESSION['position'] == USER_ROLE_ADMIN || $_SESSION['position'] == USER_ROLE_EMPLOYEE || $_SESSION['position'] == USER_ROLE_SECRETARY):?>
            <li>
                <a href="<?= base_url('/dashboard')?>">
                    <i class="fa fa-th" aria-hidden="true"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
        <?php endif;?>
        <?php if($_SESSION['position'] == USER_ROLE_ADMIN || $_SESSION['position'] == USER_ROLE_SECRETARY):?>
            <li>
                <a href="<?= base_url('/calendar')?>">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="links_name">Calendar</span>
                </a>
                <span class="tooltip">Calendar</span>
            </li>
            <li>
                <a href="<?= base_url('/calllogs')?>">
                    <i class="fa-solid fa-square-phone"></i>
                    <span class="links_name">Call Logs</span>
                </a>
                <span class="tooltip">Call Logs</span>
            </li>
            <li class="apptmnt">
                <a href="<?=base_url('/admin-appointment')?>">
                    <i class="fas fa-folder"></i>
                    <span class="links_name">Appointment</span>
                </a>
                <span class="tooltip">Appointment</span>
            </li>
              <button class = "dropdown-btn">
                                    <i class="fa-solid fa-file-invoice"></i> <span class="links_name">&nbsp;&nbsp;&nbsp;&nbsp;Reports</span>
                                    <i class = "fa fa-caret-down down2"></i>
                                    <span class="tooltip4">Reports</span>
                                </button>

            <div class = "dropdown-container">
                <li class="nav-item">
                    <a href="<?= base_url('/reports/accomplished')?>">
                        <!-- <i class="fa-solid fa-file-pdf"></i> -->
                        <span class="links_name">Accomplished</span>
                    </a>
                    <!-- <span class="tooltip3">Accomplished</span> -->
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/reports/exception')?>">
                        <!-- <i class="fa-solid fa-file-pdf"></i> -->
                        <span class="links_name">Pending</span>
                    </a>
                    <!-- <span class="tooltip3">Exception</span> -->
                </li>
            </div>
            <?php if($_SESSION['position'] != USER_ROLE_SECRETARY):?>
                <button class = "dropdown-btn">
                                    <i class = "fa-solid fa-user-pen"></i> <span class="links_name">&nbsp;&nbsp;Manage Data</span>
                                    <i class = "fa fa-caret-down down2"></i>
                                    <span class="tooltip2">Manage Data</span>
                                </button>

                                <div class = "dropdown-container">
                                     <li class="nav-item">
                                        <a href="<?= base_url('/aircon');?>">
                                            <!-- <i class="fas fa-box"></i> -->
                                        <span class="links_name">&nbsp;&nbsp;Aircons</span>
                                        </a>
                                        <!-- <span class="tooltip3">Aircons</span> -->
                                    </li>
                                    <li class="nav-item">
                                        <a href = "<?= base_url('/client')?>"> 
                                        <!-- <i class = "fa-solid fa-user"></i>  -->
                                        <span class="links_name">&nbsp;&nbsp;Clients</span> </a> 
                                        <!-- <span class="tooltip3">Clients</span> -->
                                   </li>

                                   <li class="nav-item">
                                        <a href = "<?= base_url('/emp');?>">
                                        <!-- <i class = "fa-solid fa-user"></i> -->
                                        <span class="links_name">&nbsp;&nbsp;Technicians</span></a>
                                        <!-- <span class="tooltip3">Employees</span> -->
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('/serv')?>">
                                            <!-- <i class="fa fa-server" aria-hidden="true"></i> -->
                                            <span class="links_name">&nbsp;&nbsp;Services</span>
                                        </a>
                                        <!-- <span class="tooltip3">Services</span> -->
                                    </li>

                                </div>
            <li class="apptmnt">
                <a href="<?= base_url('/user');?>">
                    <i class = "fa-solid fa-user"></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>
                <?php endif;?>
        <?php elseif($_SESSION['position'] == USER_ROLE_EMPLOYEE):?>
            <li>
                <a href="<?= base_url('/calendar/emp')?>">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="links_name">Calendar</span>
                </a>
                <span class="tooltip">Calendar</span>
            </li>
            <li>
                <a href='<?=base_url('/calendar/emp-events')?>'>
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span class="links_name">Assigned Task</span>
                </a>
                <span class="tooltip">Assigned Task</span>
            </li>
        <?php else:?>
            <li>
                <a href="<?=base_url("/client-dashboard")?>">
                    <i class="fa fa-th"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="<?=base_url("/appointment")?>">
                    <i class="fa-regular fa-rectangle-list"></i>
                    <span class="links_name">Appointment</span>
                </a>
                <span class="tooltip">Appointment</span>
            </li>
        <?php endif;?>
            
            
        </ul>
    </div>
    <div class="sidebar-header">
        <div class="text1">
            <?php if($_SESSION['position'] == USER_ROLE_ADMIN || $_SESSION['position'] == USER_ROLE_EMPLOYEE || $_SESSION['position'] == USER_ROLE_SECRETARY):?>
                    Task and Schedule Monitoring System
            <?php else:?>
                    Appointment System
            <?php endif;?>
            <div class="drop-content">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Hi, <?php echo $_SESSION['username']?></a>
                    <ul class="dropdown-menu">
                        <?php if($_SESSION['position'] != USER_ROLE_CLIENT):?>
                        <li><a class="dropdown-item" href="<?= base_url('/profile/'.$_SESSION['user_id'] )?>">Account Settings</a></li>
                    <?php else:?>
                        <li><a class="dropdown-item" href="<?= base_url('/profile-bdo/'.$_SESSION['user_id'] )?>">Account Settings</a></li>
                    <?php endif;?>
                        <li><a class="dropdown-item" href="<?= base_url('/logout')?>">Sign out</a></li>
                    </ul>
                </li>
            </div>
        </div>

    
<script src = "https://kit.fontawesome.com/0df98348d7.js" crossorigin = "anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js">
</script>
<script type="text/javascript" src="<?=base_url('assets/js/dash_header.js')?>"></script>





