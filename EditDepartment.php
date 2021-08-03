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
        $obj = new Department();
        $obj->ID = $_POST["deptID"];
        $obj->Title = $_POST["Title"];

        $result = Department::Save($obj);

        if(is_string($result))
            $message = $message;

        header("Location:DepartmentList.php");
    }
    else
    {
        if(!isset($_GET["ID"]))
        {
            header("Location:DepartmentList.php");
        }

        $id = $_GET["ID"];


        $obj = Department::GetByID($id);

        if(is_string($obj))
            $message = $obj;
        if(is_null($obj))
        {
            $obj = new Department();
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
                Edit Department &nbsp;
                <a class="btn btn-sm" href="DepartmentList.php">Back To List</a>
            </legend>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputID">ID</label>
                <div class="col-lg-10">
                    <input class="form-control" name="deptID" id="inputID" value="<?php echo $obj->ID;?>" type="text" readonly="readonly">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="inputTitle">Title</label>
                <div class="col-lg-10">
                    <input class="form-control" name="Title" id="inputTitle" value="<?php echo $obj->Title;?>" type="text" placeholder="Title">
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