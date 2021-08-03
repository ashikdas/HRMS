<?php

class Department{

    var $ID;
    var $Title;

    static function GetAll($key)
    {
        try
        {
            $connection = mysqli_connect("localhost","root","","hrmsdb");

            if(mysqli_connect_errno())
                return mysqli_connect_error();

            $q = "select * from department2";

            if(!empty($key))
            {
                if(is_int($key))
                {
                    $q .= " where ID={$key}";
                }
                else
                {
                    $q .= " where Title like '%{$key}%'";
                }

            }
            //echo $q;
            $result = mysqli_query($connection,$q);

            if($result)
            {
                $list = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    $obj = Department::MapData($row);
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

        $q="select * from department2 where ID=".$id;

        $result = mysqli_query($connection,$q);

        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $obj = Department::MapData($row);
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

            if(empty($obj->Title))
            {
                return "Invalid Title";
            }

            $objToSave = Department::GetByID($obj->ID);

            $isNew=true;
            if(is_object($objToSave))
                $isNew=false;

            $q="";
            if($isNew)
            {
                $q = "insert into department2(Title) values ('".$obj->Title."')";
            }
            else
            {
                $q = "update department2 set Title='".$obj->Title."' where ID=".$obj->ID;
            }

            echo $q;
            $result = mysqli_query($connection,$q);

            if($result)
                return true;
            else
                return "Something Went Wrong;";
        }
        catch(mysqli_sql_exception $e)
        {
            return "Something Went Wrong;";
        }
    }

    static function Delete($id)
    {
        try
        {
            $connection = mysqli_connect("localhost","root","","hrmsdb");

            if(mysqli_connect_errno())
                return mysqli_connect_error();

            $objToSave = Department::GetByID($id);

            if(!is_object($objToSave))
            {
                return "Invalid DepartmentID";
            }

            $q="delete from department2 where ID=".$id;


            $result = mysqli_query($connection,$q);

            return $result;
        }
        catch(mysqli_sql_exception $e)
        {
            return $e;
        }
    }

    static function MapData($row)
    {
        $obj = new Department();
        $obj->ID = $row["ID"];
        $obj->Title = $row["Title"];
        return $obj;
    }
}

?>