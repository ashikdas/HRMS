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

        $key="";
        if(isset($_GET["key"]))
            $key=$_GET["key"];

        $list = Notice::GetAll($key);


        if(is_string($list))
            $message = $list;
        ?>
    </head>
    <body class="container-fluid">

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
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-8">
            <input type="text" id="searchText" value="<?php echo $key; ?>" placeholder="Search">
            <a class="btn btn-sm btn-info" href="#" onclick="SearchNotice()">
                <span class="glyphicon glyphicon-search"></span> &nbsp;Search
            </a>
            <a class="btn btn-sm btn-info" href="EditNotice.php?ID=-1">
                <span class="glyphicon glyphicon-plus"></span> &nbsp;Add
            </a>
        </div>
    </div>

    <br/>
    <?php
        if(is_array($list))
        {
            ?>
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    <?php

                        foreach ($list as $obj)
                        {
                            ?>
                            <tr>
                                <td><?php echo $obj->ID; ?></td>
                                <td><?php echo $obj->Title; ?></td>
                                <td>
                                    <a class="btn btn-sm" href="EditNotice.php?ID=<?php echo $obj->ID; ?>">
                                        <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit
                                    </a>
                                    |
                                    <a class="btn btn-sm" href="#" onclick="DeleteClick('DeleteNotice.php?ID=<?php echo $obj->ID; ?>')">
                                        <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Delete
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            <?php
        }
        ?>
    </body>

<script>

    function DeleteClick(url) {

        if(confirm("Are you Sure?"))
        {
            window.location.href = url;
        }

    }
    function SearchNotice() {

        window.location.href= "NoticeList.php?key="+$("#searchText").val()

    }

</script>

</html>