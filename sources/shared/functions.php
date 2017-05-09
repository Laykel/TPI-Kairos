<?php
//--------------------------
//Filename: functions.php
//Creation date: 08.03.2017
//Author: Luc Wachter
//Function: Transfers the queries to the database and returns the results, other functions
//Last modification: 23.03.2017
//--------------------------

function DBRequest($req, $type_req){
    try{
        //Connection to the tasking database
        $connect = new PDO('mysql:host=172.17.102.104; dbname=tasking_db;charset=utf8', 'tasking', 'Fu4XvUNpa4yjX7Xr');
        
        //Allows to get more information from errors
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        echo 'Une erreur est survenue! '.$e->getMessage();
        die();
    }
    

    //Execution of the request
    if($type_req == 'select')
        $res = $connect->query($req); //Execute a select req
    else
    {
        if (false === $connect->exec($req)) //Execute a non-select req 
            return false;
        $res = $connect->lastInsertId();
    }
    return ($res);
}

//Function used to secure the output of forms
function secureArray($array)
{
    foreach ($array as $key => $value) 
    {
        if(is_array($value)) 
            $array[$key] = secureArray($value);
        else 
            $array[$key] = htmlentities($value, ENT_QUOTES);
    }
    return $array;
}