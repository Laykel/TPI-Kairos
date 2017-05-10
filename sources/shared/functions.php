<?php
//--------------------------
//Filename: functions.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: Transfers the queries to the database and returns the results, other functions
//--------------------------

function dbRequest($req, $type_req){
    try{
        //Connection to the tasking database
        $connect = new PDO('mysql:host=localhost; dbname=kairos_db;charset=utf8', 'root', 'root');
        
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
function secureArray($array){
    foreach ($array as $key => $value){
        if(is_array($value)){
            $array[$key] = secureArray($value);
        }
        else{
            $array[$key] = htmlentities($value, ENT_QUOTES);
        }
    }
    return $array;
}

function checkAvailable($data, $column){
    $availableReq = "SELECT ".$column." FROM user
                     WHERE ".$column." = '".$data."'";
    $availableRes = dbRequest($availableReq, "select");
    $line = $availableRes->fetch();

    return $line;
}