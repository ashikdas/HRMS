<?php
    include ('FrameWork/ClassCollection.php');
    $u = $_GET["userName"];
    $user = UserInfo::GetByUserName($u);

    if(is_null($user) || is_string($user))
        echo 'Invalid UserName';
    else
        echo '';

?>