<?php

include ('FrameWork/ClassCollection.php');

$result = Department::Delete($_GET["ID"]);

//echo $result;
if($result=='true')
{
    header("Location:DepartmentList.php");
}
else
{
    echo $result.'<br/>';
}



?>

<a style="color: white" href="DepartmentList.php">Back To List</a>
