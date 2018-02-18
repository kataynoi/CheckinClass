<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo version();?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url()?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/dist/css/sb-admin-2.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" charset="utf-8">
        var site_url = '<?php echo site_url()?>';
        var base_url = '<?php echo base_url()?>';

        var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/freeow/freeow.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/apps/css/app.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="<?php echo base_url()?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url()?>assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url()?>assets/vendor/raphael/raphael.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url()?>assets/heighcharts/js/highcharts.js"></script>
    <!-- load library -->
    <script src="<?php echo base_url()?>assets/js/underscore.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.blockUI.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.cookie.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.freeow.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.maskedinput.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.numeric.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.paging.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/numeral.min.js"></script>

    <!-- load application -->
    <script src="<?php echo base_url()?>assets/apps/js/apps.js"></script>
    <style type="text/css">
        .bgimg {
            background-image: url('<?php echo base_url()?>assets/img/logo_web.png');
        }
    </style>

</head>

<body>

<div id="wrapper">
    <div id="freeow" class="freeow freeow-bottom-right"></div>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top bgimg" role="navigation"
         style="margin-bottom: 0; height: 105px;width: 100%;  background-repeat: no-repeat;margin-top: 20px;margin-left: 10px; background-color: #ffffff;">
        <br>
        <!-- /.navbar-header -->
        <?php
        if(!$this->session->userdata("name")){
            echo '<ul class="nav navbar-top-links navbar-right">';
            echo "<li class='dropdown'> <a href=".site_url('users/login')."><i class=' fagit fa-user'></i> Login </a></li></ul>";
        }else{
            ?>
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <?php if($this->session->userdata("name")){?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i> <?php echo $this->session->userdata('name');?>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('users/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                <?php }else{ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo site_url('users/login')?>">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i> Loginsdfsdfs
                        </a>
                        <!-- /.dropdown-user -->
                    </li>
                <?php }?>
                <!-- /.dropdown -->
            </ul>
        <?php }?>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="<?php echo site_url('student/mg_student')?>"><i class="fa fa-dashboard fa-fw"></i> จัดการข้อมูลนักศึกษา</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('student/report_student_checkin')?>"><i class="fa fa-table fa-fw"></i>ตรวจสอบการเข้าเรียน</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('users/logout')?>"><i class="fa fa-table fa-fw"></i>ออกจากระบบ</a>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- /.navbar-top-links -->

    <div id="page-wrapper">
        <?php echo $content_for_layout?>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



</body>

</html>
