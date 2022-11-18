<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task and Scheduling Management System</title>

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
        <?php if($_SESSION['position'] == USER_ROLE_ADMIN || $_SESSION['position'] == USER_ROLE_EMPLOYEE):?>
            <li>
                <a href="<?= base_url('/dashboard')?>">
                    <i class="fa fa-th" aria-hidden="true"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
        <?php endif;?>
        <?php if($_SESSION['position'] == USER_ROLE_ADMIN):?>
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
            <li>
                <a href="<?=base_url('/admin-appointment')?>">
                    <i class="fas fa-folder"></i>
                    <span class="links_name">Appointment</span>
                </a>
                <span class="tooltip">Appointment</span>
            </li>
            <h4>Reports</h4><hr>
            <li class="ar">
                <a href="<?= base_url('/reports/accomplished')?>">
                    <i class="fa-solid fa-file-pdf"></i>
                    <span class="links_name">Accomplished Reports</span>
                </a>
                <span class="tooltip">Accomplished</span>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/reports/exception')?>">
                    <i class="fa-solid fa-file-pdf"></i>
                    <span class="links_name">Exception Reports</span>
                </a>
                <span class="tooltip">Exception</span>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/service-reports')?>">
                    <i class="fa-solid fa-file-import"></i>
                    <span class="links_name">Upload Reports</span>
                </a>
                <span class="tooltip">Upload</span>
            </li>
            <h4>Manage Data</h4><hr>
            <li class="nav-item">
                <a href="<?= base_url('/aircon');?>">
                    <i class="fas fa-box"></i>
                    <span class="links_name">Aircons</span>
                </a>
                <span class="tooltip">Aircons</span>
            </li>
            <li class="nav-item">
                <a href = "<?= base_url('/client')?>" >
                    <i class = "fa-solid fa-user"></i>
                    <span class="links_name">Clients</span> 
                </a> 
                <span class="tooltip">Clients</span>
            </li>                      
            <li class="nav-item">
                <a href = "<?= base_url('/emp');?>" >
                    <i class = "fa-solid fa-user"></i>
                    <span class="links_name">Employees</span>
                </a>
                <span class="tooltip">Employees</span>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/serv')?>">
                    <i class="fa fa-server" aria-hidden="true"></i>
                    <span class="links_name">Services</span>
                </a>
                <span class="tooltip">Services</span>
            </li>
            <h4>Manage Accounts</h4><hr>
            <li class="nav-item">
                <a href = "<?= base_url('/client-users');?>" >
                    <i class = "fa-solid fa-user"></i>
                    <span class="links_name">User Requests</span>
                </a>
                <span class="tooltip">User Requests</span>
            </li>
            <li class="nav-item">
                <a href = "<?= base_url('/user');?>" >
                    <i class = "fa-solid fa-user"></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>
                                
            
            
        <?php elseif($_SESSION['position'] == USER_ROLE_EMPLOYEE):?>
            <li>
                <a href="<?= base_url('/calendar/emp')?>">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="links_name">Calendar</span>
                </a>
                <span class="tooltip">Calendar</span>
            </li>
        <?php else:?>
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
        <div class="text">Tasks and Schedule Monitoring System
            <div class="drop-content">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Hi, Admin</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('/profile/'.$_SESSION['user_id'] )?>">Account Settings</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/logout')?>">Sign out</a></li>
                    </ul>
                </li>
            </div>
        </div>

    
<script src = "https://kit.fontawesome.com/0df98348d7.js" crossorigin = "anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<script type="text/javascript" src="<?=base_url('assets/js/dash_header.js')?>"></script>





