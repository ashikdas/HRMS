<html>
<head>
    <?php
    session_start();
    $message='';

    if(!isset($_SESSION["UserName"]))
    {
        header("Location:Login.php");
    }

    if($_SESSION["UserType"]!='Admin')
    {
        header("Location:EmployeeIndex.php");
    }
    include('Shared/Link.php');
    include('FrameWork/ClassCollection.php');

    if(isset($_POST["btnSave"]))
    {
        $obj = new Employee();
        $obj->ID = $_POST["empID"];
        $obj->DepartmentID = $_POST["DepartmentID"];
        $obj->Skills = $_POST["Skills"];
        $obj->DOB = $_POST["dob"];
        $obj->UserName = $_POST["username"];
        $obj->Password = $_POST["Password"];
        $obj->UserType = 'Employee';
        $obj->UserStatus = $_POST["UserStatus"];


        $result = Employee::Save($obj);

        if(is_string($result))
            $message = $message;

        header("Location:EmployeeList.php");
    }
    else
    {
        if(!isset($_GET["ID"]))
        {
            header("Location:EmployeeList.php");
        }

        $id = $_GET["ID"];


        $obj = Employee::GetByID($id);

        if(is_string($obj))
            $message = $obj;
        if(is_null($obj))
        {
            $obj = new Employee();
            $obj->ID=-1;
        }
    }


    ?>
</head>
<body style="padding: 10px" class="container">
    <?php
    if(!empty($message))
    {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Error!</strong> <?php echo $message; ?>
        </div>
        <?php
    }
    ?>
    <form class="form-horizontal" action="#" method="post">
        <fieldset>
            <legend>
                Edit Employee &nbsp;
                <a class="btn btn-sm" href="EmployeeList.php">Back To List</a>
            </legend>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputID">ID</label>
                <div class="col-lg-10">
                    <input class="form-control" name="empID" id="inputID" value="<?php echo $obj->ID;?>" type="text" readonly="readonly">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputun">User Name</label>
                <div class="col-lg-10">
                    <input class="form-control" name="username" id="inputun" value="<?php echo $obj->UserName;?>" type="text" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputun">DOB</label>
                <div class="col-lg-10">
                    <input class="form-control" name="dob" id="inputun" value="<?php echo $obj->DOB;?>" type="text" placeholder="dd/MM/yyyy">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputun">Department</label>
                <div class="col-lg-10">
                    <input class="form-control" name="DepartmentID" id="inputun" value="<?php echo $obj->DepartmentID;?>" type="text" placeholder="dd/MM/yyyy">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputpass">Password</label>
                <div class="col-lg-10">
                    <input class="form-control" name="Password" id="inputpass" value="<?php echo $obj->Password;?>" type="password" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputus">User Status</label>
                <div class="col-lg-10">
                    <select name="UserStatus" class="form-control">
                        <?php
                            if($obj->UserStatus=='Active')
                            {
                                echo '<option value="Active" selected="selected">Active</option>';
                            }
                            else
                            {
                                echo '<option value="Active">Active</option>';
                            }
                            if($obj->UserStatus=='Inactive')
                            {
                                echo '<option value="Inactive" selected="selected">Inactive</option>';
                            }
                            else
                            {
                                echo '<option value="Inactive">Inactive</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputTitle">Skills</label>
                <div class="col-lg-10">
                    <textarea class="form-control" name="Skills" placeholder="Description"><?php echo $obj->Skills;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <input type="submit" class="btn btn-primary" name="btnSave" onclick="return ValidateData();">
                </div>
            </div>
        </fieldset>
    </form>
</body>

<script>

    function ValidateData() {

        if($("#inputTitle").val()=='')
        {
            alert("Invalid Title");
            return false;
        }

        return true;
    }

</script>

</html>