<?php

class Notice{

    var $ID;
    var $Title;
    var $Description;

    static function GetAll($key)
    {
        try
        {
            $connection = mysqli_connect("localhost","root","","hrmsdb");

            if(mysqli_connect_errno())
                return mysqli_connect_error();

            $q = "select * from notice";

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
                    $obj = Notice::MapData($row);
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

        $q="select * from notice where ID=".$id;

        $result = mysqli_query($connection,$q);

        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $obj = Notice::MapData($row);
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

            $objToSave = Notice::GetByID($obj->ID);

            $isNew=true;
            if(is_object($objToSave))
                $isNew=false;

            $q="";
            if($isNew)
            {
                $q = "insert into notice(Title,Description) values ('".$obj->Title."','".$obj->Description."')";
            }
            else
            {
                $q = "update notice set Title='".$obj->Title."' where ID=".$obj->ID;
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

            $objToSave = Notice::GetByID($id);

            if(!is_object($objToSave))
            {
                return "Invalid NoticeID";
            }

            $q="delete from notice where ID=".$id;


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
        $obj = new Notice();
        $obj->ID = $row["ID"];
        $obj->Title = $row["Title"];
        $obj->Description = $row["Description"];
        return $obj;
    }
}

?>