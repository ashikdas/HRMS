<?php

class Employee{

    var $ID;
    var $DepartmentID;
    var $Skills;
    var $DOB;

    var $UserName;
    var $Password;
    var $UserType;
    var $UserStatus;
    var $DepartmentTitle;

    static function GetAll($key)
    {
        try
        {
            $connection = mysqli_connect("localhost","root","","hrmsdb");

            if(mysqli_connect_errno())
                return mysqli_connect_error();

            $q = "select e.*,u.UserName,u.Password,u.UserType,u.UserStatus,d.Title from employee e,userinfo u, department2 d where e.ID=u.ID and e.DepartmentID=d.ID";

            if(!empty($key))
            {
                if(is_int($key))
                {
                    $q .= " and e.ID={$key}";
                }
                else
                {
                    $q .= " and u.UserName like '%{$key}%'";
                }

            }
            //echo $q;
            $result = mysqli_query($connection,$q);

            if($result)
            {
                $list = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    $obj = Employee::MapData($row);
                    $list[] = $obj;
                }

                return $list;
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

        $q="select e.*,u.UserName,u.Password,u.UserType,u.UserStatus,d.Title from employee e,userinfo u, department2 d where e.ID=u.ID and e.DepartmentID=d.ID and e.ID=".$id;

        $result = mysqli_query($connection,$q);

        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $obj = Employee::MapData($row);
                return $obj;
            }

            return null;
        }
        else
        {
            return "Something Went Wrong";
        }
    }

    static function Save($obj)
    {
        try
        {
            $connection = mysqli_connect("localhost","root","","hrmsdb");

            if(mysqli_connect_errno())
                return "Connection Error";

            if(empty($obj->UserName))
            {
                return "Invalid UserName";
            }

            $objToSave = Employee::GetByID($obj->ID);

            $isNew=true;
            if(is_object($objToSave))
                $isNew=false;

            $q1="";
            $q2="";
            if($isNew)
            {
                $q1 = "insert into userinfo(username,password,usertype,userstatus) values ('".$obj->UserName."','".$obj->Password."','".$obj->UserType."','".$obj->UserStatus."')";
                $result = mysqli_query($connection,$q1);
                if($result)
                {
                    $id = mysqli_insert_id($connection);
                    $q2 = "insert into employee values (".$id.",".$obj->DepartmentID.",'".$obj->Skills."','".$obj->DOB."')";
                    $result = mysqli_query($connection,$q2);
                    if($result)
                        return true;
                    else
                        return "Something Went Wrong;";
                }
                else
                    return "Something Went Wrong;";

            }
            else
            {
                $q1 = "update userinfo set username='".$obj->UserName."',password='".$obj->Password."',usertype='".$obj->UserType."',userstatus='".$obj->UserStatus."' where ID=".$obj->ID;
                $result = mysqli_query($connection,$q1);
                if($result)
                {
                    $q2 = "update  employee set DepartmentID=".$obj->DepartmentID.",Skills='".$obj->Skills."',DOB='".$obj->DOB."' where ID=".$obj->ID;
                    $result = mysqli_query($connection,$q2);
                    if($result)
                        return true;
                    else
                        return "Something Went Wrong;";
                }
                else
                    return "Something Went Wrong;";
            }


        }
        catch(mysqli_sql_exception $e)
        {
            return "Something Went Wrong;";
        }
    }

    static function MapData($row)
    {
        $obj = new Employee();
        $obj->ID = $row["ID"];
        $obj->Skills = $row["Skills"];
        $obj->DOB = $row["DOB"];
        $obj->DepartmentID = $row["DepartmentID"];

        $obj->UserName = $row["UserName"];
        $obj->Password = $row["Password"];
        $obj->UserType = $row["UserType"];
        $obj->UserStatus = $row["UserStatus"];
        $obj->DepartmentTitle = $row["Title"];
        return $obj;
    }
}

?>