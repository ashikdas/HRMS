<?php

class UserInfo{

    var $ID;
    var $UserName;
    var $Password;
    var $UserType;
    var $UserStatus;

    static function GetAll()
    {
        try
        {
            $connection = mysqli_connect("localhost","root","","hrmsdb");

            if(mysqli_connect_errno())
                return mysqli_connect_error();

            $result = mysqli_query($connection,"select * from userinfo");

            if($result)
            {
                $users = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    $u = UserInfo::MapData($row);
                    $users[] = $u;
                }

                return $users;
            }
            else
            {
                return "Something Went Wrong";
            }
        }
        catch(mysqli_sql_exception $e)
        {
            return $e;
        }
    }

    static function GetByID($id)
    {
        $connection = mysqli_connect("localhost","root","","hrmsdb");

        if(mysqli_connect_errno())
            return mysqli_connect_error();

        $result = mysqli_query($connection,"select * from userinfo where ID="+$id);

        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $u = UserInfo::MapData($row);
                return $u;
            }

            return null;
        }
        else
        {
            return "Something Went Wrong";
        }
    }

    static function GetByUserName($un)
    {
        $connection = mysqli_connect("localhost","root","","hrmsdb");

        if(mysqli_connect_errno())
            return mysqli_connect_error();

        $result = mysqli_query($connection,"select * from userinfo where UserName='{$un}'");

        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $u = UserInfo::MapData($row);
                return $u;
            }

            return null;
        }
        else
        {
            return "Something Went Wrong";
        }
    }

    static function Login($un,$pass)
    {
        $connection = mysqli_connect("localhost","root","","hrmsdb");

        if(mysqli_connect_errno())
            return mysqli_connect_error();

        $result = mysqli_query($connection,"select * from userinfo where UserName='{$un}' and Password='{$pass}'");

        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $u = UserInfo::MapData($row);
                return $u;
            }

            return null;
        }
        else
        {
            return "Something Went Wrong";
        }
    }

    static function MapData($row)
    {
        $u = new UserInfo();
        $u->ID = $row["ID"];
        $u->UserName = $row["UserName"];
        $u->Password = $row["Password"];
        $u->UserType = $row["UserType"];
        $u->UserStatus = $row["UserStatus"];
        return $u;
    }
}

?>