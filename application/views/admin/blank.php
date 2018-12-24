<!DOCTYPE html>
<html lang="en" dir="rtl">
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title> Kwtevent Dashboard </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon.ico" /> 
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
	    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" />
        
        <link href="<?= base_url() ?>assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/global/css/components-rtl.min.css" rel="stylesheet" id="style_components" />
        <link href="<?= base_url() ?>assets/global/css/plugins-rtl.min.css" rel="stylesheet" />

        <link href="<?= base_url() ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" />

        <link href="<?= base_url() ?>assets/layouts/layout2/css/layout-rtl.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/layouts/layout2/css/themes/blue-rtl.min.css" rel="stylesheet" id="style_color" />

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?= base_url() ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" rel="stylesheet" />
        <!-- END PAGE LEVEL PLUGINS -->
    
<?php if (@$css_files): ?>
<?php foreach($css_files as $file): ?>
        <link href="<?= $file; ?>" rel="stylesheet" />
<?php endforeach; ?>
<?php endif ?>
        <link href="<?= base_url() ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/admin-custom.css" rel="stylesheet" />

        <script src="<?= base_url() ?>assets/grocery_crud/js/jquery-2.1.0.min.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>

<?php if (@$js_files): ?>
<?php foreach($js_files as $file): ?>
        <script src="<?= $file; ?>"></script>
<?php endforeach; ?>
<?php endif ?>
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url() ?>assets/global/scripts/app.min.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
        <script src="<?= base_url() ?>assets/pages/scripts/ui-sweetalert.min.js"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js"></script>

        <script src="<?= base_url() ?>assets/global/plugins/select2/js/select2.full.min.js"></script>
        <script src="<?= base_url() ?>assets/pages/scripts/components-select2.min.js"></script>

        <script src="<?= base_url() ?>assets/pages/scripts/ui-modals.min.js"></script>

        <script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js"></script>
        <script src="<?= base_url() ?>assets/layouts/layout2/scripts/layout.min.js"></script>
        <script src="<?= base_url() ?>assets/layouts/layout2/scripts/demo.min.js"></script>
        <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js"></script>
        <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-nav.min.js"></script>
        
        <script src="<?= base_url() ?>assets/global/scripts/datatable.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/datatables/datatables.min.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"></script>
        <script src="<?= base_url() ?>assets/pages/scripts/table-datatables-editable.min.js"></script>

        <script src="<?= base_url() ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/typeahead/handlebars.min.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/typeahead/typeahead.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/pages/scripts/components-bootstrap-tagsinput.min.js"></script>

    </head>
    <!-- END HEAD -->
    <body class="page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-static-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/img/logo255.png" alt="logo" width="100" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?= base_url() ?>assets/uploads/admins/<?=$this->session->user->pic?>" />
                                    <span class="username username-hide-on-mobile"> 
                                        <?=$this->session->user->name?> 
                                    </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?=base_url()?>backend/admins/profile/<?=$this->session->user->id?>">
                                            <i class="icon-user"></i> صفحتى الشخصية </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="<?=base_url()?>backend/users/logout">
                                            <i class="icon-key"></i> خروج </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <!-- <i class="icon-logout"></i> -->
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu page-sidebar-menu-compact" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item ">
                            <a href="<?=base_url()?>backend/dashboard/" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">الرئيسية</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?=base_url()?>backend/halls/" class="nav-link nav-toggle">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                                <span class="title"> القاعات</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?=base_url()?>backend/artists/" class="nav-link nav-toggle">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                <span class="title">الفنانين </span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?=base_url()?>backend/buffets/" class="nav-link nav-toggle">
                            <i class="fa fa-cutlery" aria-hidden="true"></i>
                                <span class="title">البوفيهات </span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?=base_url()?>backend/decors/" class="nav-link nav-toggle">
                            <i class="fa fa-object-group " aria-hidden="true"></i>
                            <span class="title"> الديكورات</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?=base_url()?>backend/flowers/" class="nav-link nav-toggle">
                            <i class="fa fa-leaf" aria-hidden="true"></i>
                            <span class="title"> الزهور</span>
                            <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item ">
                             <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-coffee" aria-hidden="true"></i>
                                <span class="title"> التقديم</span>
                                <span class="arrow open"></span>
                             </a>
                             <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?=base_url()?>backend/foods/" class="nav-link ">
                                        <span class="title">كل الأقسام </span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=base_url()?>backend/foods/others" class="nav-link ">
                                        <span class="title">قسم الطلبات الاخرى  </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?=base_url()?>backend/cards/" class="nav-link nav-toggle">
                                <i class="fa fa-vcard-o"></i>
                                <span class="title">البطاقات</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item ">
                             <a href="<?=base_url()?>backend/photos/" class="nav-link nav-toggle">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                                <span class="title"> التصوير</span>
                                <span class="arrow open"></span>
                             </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=base_url()?>backend/orders/" class="nav-link nav-toggle">
                                <i class="fa fa-file-text-o"></i>
                                <span class="title">الطلبات</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <?php if ( $this->session->user->role == 1 ) { ?>
                        <li class="nav-item">
                            <a href="<?=base_url()?>backend/admins/" class="nav-link nav-toggle">
                            <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="title">المستخدمين</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item ">
                            <a href="<?=base_url()?>backend/dashboard/cities/" class="nav-link nav-toggle">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            <span class="title"> المدن</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?=base_url()?>backend/dashboard/contact/" class="nav-link nav-toggle">
                            <i class="fa fa-black-tie" aria-hidden="true"></i>
                            <span class="title"> تواصل معنا </span>
                            <span class="arrow open"></span>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="<?=base_url()?>backend/dashboard/about/" class="nav-link nav-toggle">
                                <i class="fa fa-compress"></i>
                                <span class="title"> عن التطبيق</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <h1 class="page-title"> لوحة التحكم</h1>
                    <div class="page-bar">
                        <div class="page-toolbar"></div>
                    </div>
                     <!-- END PAGE HEADER-->
                     <div class="row">
                         <div class="col-sm-12 col-xs-12">
                                <?= ($output)?$output:''; ?>
                                <?php if (@$main_content) { $this->load->view($main_content); } ?>
                         </div>
                     </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
            <!-- END QUICK SIDEBAR -->
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2018 &copy; Metronic Theme By
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div> 
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip({container:'body'})
            });
        </script>     
    </body>
</html>