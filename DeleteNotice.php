<?php

include ('FrameWork/ClassCollection.php');

$result = Notice::Delete($_GET["ID"]);

//echo $result;
if($result=='true')
{
    header("Location:NoticeList.php");
}
else
{
    echo $result.'<br/>';
}



?>

<a style="color: white" href="NoticeList.php">Back To List</a>
