<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Template</title>

        <!-- Core CSS - Include with every page -->
        <?= css('bootstrap.css'); ?>
        <?= css('font-awesome.css'); ?>

        <!-- Apps CSS - Include with every page -->
        <?= css('apps.css'); ?>

    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 2">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url(); ?>">Application Internal</a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <!-- 
                    <li class="dropdown">
                       
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>

                    <!-- /.dropdown-messages 
                </li>
                    -->
                   
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?= site_url('auth/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

            </nav>
            <!-- /.navbar-static-top -->

            <!-- /.navbar-static-side -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <li class="divider"></li>
                        <h1 class="page-header">
                            <?php
                            $str = $this->router->fetch_class();
                            echo " Dashboard ".ucwords($str);
                            ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active"><i class="fa fa-dashboard"></i> BREADCRUMB</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php
                $this->load->view($module . '/' . $view);
                ?>

                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; 2013 Zentralink Otoparts, PT</p>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- /#container -->
        </div>
        <!-- /#wrapper -->

        <!-- Core Scripts - Include with every page -->
        <?= js('jquery-1.10.2.js') ?>
        <?= js('bootstrap.js') ?>

        <!-- Page-Level Plugin Scripts - Blank -->

        <!-- SB Admin Scripts - Include with every page -->
        <?= js('apps.js') ?>

        <!-- Page-Level Demo Scripts - Blank - Use for reference -->

    </body>

</html>
