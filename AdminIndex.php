<html>
    <?php
        session_start();

        if(!isset($_SESSION["UserName"]))
        {
            header("Location:Login.php");
        }

        if($_SESSION["UserType"]!='Admin')
        {
            header("Location:EmployeeIndex.php");
        }

    ?>
<head>
    <?php include('Shared/Link.php'); ?>
</head>
<body class="container-fluid">
<?php include('Shared/AdminMenu.php'); ?>
<div>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-3">
            <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="block-Menu" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Common
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <a class="list-group-item" href="#navbar" onclick="AddTab('Department','DepartmentList.php')">
                                <span class="glyphicon glyphicon-th"></span> &nbsp;Department
                            </a>
                            <a class="list-group-item" href="#navbar" onclick="AddTab('Notice','NoticeList.php')">Notice</a>
                            <a class="list-group-item" href="#navbar" onclick="AddTab('Designation','DesingnationList.php')">Designation</a>
                            <a class="list-group-item" href="#navbar" onclick="AddTab('Payroll','PayrollList.php')">Payroll</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="block-Menu" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Human Resource
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <a class="list-group-item" href="#navbar" onclick="AddTab('Employee','EmployeeList.php')">Employee</a>
                            <a class="list-group-item" href="#navbar">Attendance</a>
                            <a class="list-group-item" href="#navbar">Salary</a>
                            <a class="list-group-item" href="#navbar">Payslip</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="block-Menu" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                User Manager
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <a class="list-group-item" href="#navbar">Admin</a>
                            <a class="list-group-item" href="#navbar">Credential</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myTab" class="col-md-9" style="border-left: 1px solid gray;min-height: 450px">
            <ul class="nav nav-tabs" id="tabMenu" role="tablist">
                <li id="li1" class="active"><a href="#div1" role="tab" data-toggle="tab">Dashboard</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" id="tabDiv">
<!--                <div class="tab-pane active" id="home">...</div>-->
                <div  class="tab-pane active" id="div1">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="Images/1.jpg" class="img-thumbnail" style="width: 100%;height: 220px">
                        </div>
                        <div class="col-md-6">
                            <img src="Images/2.jpg" class="img-thumbnail" style="width: 100%;height: 220px">
                        </div>
                        <div class="col-md-6">
                            <img src="Images/3.jpg" class="img-thumbnail" style="width: 100%;height: 220px">
                        </div>
                        <div class="col-md-6">
                            <img src="Images/4.jpg" class="img-thumbnail" style="width: 100%;height: 220px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include('Shared/Footer.php'); ?>
</body>

<script>

    $(document).ready(function () {

        $('.carousel').carousel({
            interval: 2000
        });

        $('#homeMenu').addClass('active');

    });

    var i=2;
    function AddTab(tabName,link) {
        var height = $(document).height()-180;
        $('#tabMenu').append('<li id="li'+i+'"><a href="#div'+i+'" role="tab" data-toggle="tab">'+tabName+'&nbsp;&nbsp;<span class="glyphicon glyphicon-remove-sign" style="cursor: pointer" onclick="removeTab('+i+')"></span></a></li>');
        $('#tabDiv').append('<div class="tab-pane" id="div'+i+'"><iframe src="'+link+'" width="100%" height="'+height+'px" frameborder="1"></iframe></div>');
        $('#myTab a:last').tab('show');
        i++;
    }

    function removeTab(index) {

        var prevLI = $('#li'+index).prev();
        var prevDiv = $('#div'+index).prev();

        if($('#li'+index).hasClass('active'))
        {
            prevLI.addClass('active');
            prevDiv.addClass('active');
        }


        $('#li'+index).remove();
        $('#div'+index).remove();
    }

</script>
</html>