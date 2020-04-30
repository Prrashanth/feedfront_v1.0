<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    
    <script src="js/jquery-3.1.1.min.js"></script>
<!--    <script type="text/javascript" src="http://demo.itsolutionstuff.com/plugin/clockface.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/clockface.css">-->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
     
     
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <script src="js/plugins/toastr/toastr.min.js"></script>
    
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    
    <script type="text/javascript" src="./js/excel/jszip.js"></script>
    <script src="./js/excel/xlsx.full.min.js"></script>
    <script type="text/javascript" src="./js/excel/FileSaver.js"></script>
    
    <script src="js/plugins/chartJs/Chart.min.js"></script>
    
    <link href="css/plugins/c3/c3.min.css" rel="stylesheet">
    <script src="js/plugins/d3/d3.min.js"></script>
    <script src="js/plugins/c3/c3.min.js"></script>
    
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>
    <style>
        .clockpicker-popover {
    z-index: 999999;
}
.dataTables_wrapper .dataTables_paginate {
float: right;
text-align: right;
padding-top: 0.25em;
}
/*.textcomplete-dropdown {
    z-index: 999999;
}*/
    </style>
    <script type="text/javascript">
        toastr.options = {
  "closeButton": true,
  "debug": false,
  "progressBar": true,
  "preventDuplicates": false,
  "positionClass": "toast-top-right",
  "onclick": null,
  "showDuration": "400",
  "hideDuration": "1000",
  "timeOut": "10000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
    </script>
</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
        <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">
            <!--<div class="navbar-header">-->
<!--                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>-->

                <a href="#" class="navbar-brand">feedfront.ai</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-reorder"></i>
                </button>

            <!--</div>-->
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav mr-auto">
                    <li class="<?php if($page == 'dashboard') echo 'active'; else echo ''?>">
                        <a aria-expanded="false" role="button" href="Dashboard"> Dashboard</a>
                    </li>
                    <li class="<?php if($page == 'list') echo 'active'; else echo '' ?>" >
                        <a aria-expanded="false" role="button" href="List"> Customer List</a>
                    </li>
                    <li class="<?php if($page == 'campaign') echo 'active'; else echo '' ?>">
                        <a aria-expanded="false" role="button" href="Campaign"> Campaign</a>
                    </li>
<!--                    <li class="dropdown <?php if($page == 'campaign') echo 'active'; else echo '' ?>">
                        <a aria-expanded="true" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Campaign</a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="Campaign">Add Campaign</a></li>
                            <li><a href="Viewcampaign">View Campaign</a></li>
                        </ul>
                    </li>-->
                    <li class="<?php if($page == 'analytics') echo 'active'; else echo '' ?>">
                        <a aria-expanded="false" role="button" href="Analytics"> Analytics</a>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="Logout">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>