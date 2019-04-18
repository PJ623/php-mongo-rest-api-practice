<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include_once("../../database.php");

$myDB = new MyDB();

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        $myDB->find($_GET["first_name"], $_GET["last_name"]);
        break;
    case "POST":
        $_POST = json_decode(file_get_contents("php://input"), true); // for receiving raw JSON data
        $myDB->insertOne($_POST["first_name"], $_POST["last_name"]);
        break;
    case "DELETE":
        // $_DELETE not native to PHP
        $_DELETE = json_decode(file_get_contents("php://input"), true);
        $myDB->deleteOne($_DELETE["first_name"], $_DELETE["last_name"]);
        break;
    case "PUT":
        // $_PUT not native to PHP
        $_PUT = json_decode(file_get_contents("php://input"), true);
        $myDB->updateOne($_PUT["first_name"], $_PUT["last_name"], $_PUT["new_first_name"], $_PUT["new_last_name"]);
        break;
}
