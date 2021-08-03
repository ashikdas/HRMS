<html>
<head>
    <?php include('Shared/Link.php'); ?>
    <?php
        include('FrameWork/ClassCollection.php');
        session_start();

        if(isset($_SESSION["UserName"]))
        {
            if($_SESSION["UserType"]=='Admin')
            {
                header("Location:AdminIndex.php");
            }
            else
            {
                header("Location:EmployeeIndex.php");
            }
        }
        $message="";
        if(isset($_POST["login"]))
        {
            $result = UserInfo::Login($_POST["UserName"],$_POST["Password"]);

            if(is_null($result))
            {
                $message="Invalid Username or Password";
            }
            else if(is_string($result))
            {
                $message = $result;
            }
            else
            {

                $_SESSION["UserName"] = $result->UserName;
                $_SESSION["UserType"] = $result->UserType;

                if($result->UserType=='Admin')
                {
                    header("Location:AdminIndex.php");
                }
                else
                {
                    header("Location:EmployeeIndex.php");
                }
            }

        }
    ?>
</head>
<body class="container-fluid">
<?php include('Shared/Menu.php'); ?>
<div style="min-height: 600px">
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-6 col-sm-6 box-Shadow">

            <form action="#" method="post" class="form-horizontal">
                <fieldset>
                    <legend>Login</legend>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="inputEmail">Email</label>
                        <div class="col-lg-10">
                            <input class="form-control" onblur="CheckUserName()" id="inputUserName" name="UserName" type="text" placeholder="User Name">
                            <span style="color: red" id="errorUserName"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="inputPassword">Password</label>
                        <div class="col-lg-10">
                            <input class="form-control" id="inputPassword" name="Password" type="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-primary" name="login" onclick="return CheckValidation();" type="submit">Login</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <?php
                            if(!empty($message))
                            {
                                ?>
                                <span class="alert alert-danger">
                                    <?php echo $message; ?>
                                </span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </fieldset>

            </form>

        </div>
        <div class="col-md-3 col-sm-3"></div>
    </div>
</div>
<?php include('Shared/Footer.php'); ?>
</body>
<script>
    var isValid=true;
    function CheckValidation()
    {
        if($('#inputUserName').val()=='' || !isValid)
        {
            alert('Invalid UserName');
            return false;
        }

        if($('#inputPassword').val()=='')
        {
            alert('Invalid Password');
            return false;
        }

        return true;
    }

    $(document).ready(function () {

        $('#logMenu').addClass('active');


    });

    function CheckUserName() {

        $.ajax({
            url:"UsernameCheckAjax.php",
            method:"GET",
            data:"userName="+$('#inputUserName').val(),
            datatype:"text",
            success:function (result) {
                if(result!='')
                {
                    $('#errorUserName').text(result);
                    isValid=false;
                }
                else
                {
                    isValid=true;
                    $('#errorUserName').text("");
                }
            },
            error:function () {
                alert('something Went Wrong');
            }
        });

    }

</script>
</html>