<?php
require "vendor/autoload.php";

class MyDB
{
    function connect()
    {
        // Connect to MongoDB server.
        $client = new MongoDB\Client("mongodb://localhost:27017");

        // Accesses people collection in demo database.
        return $client->demo->people;
    }

    public function find($firstName, $lastName = "")
    {
        $collection = $this->connect();
        $result = $collection->find(["first_name" => $firstName, "last_name" => $lastName])->toArray();

        echo json_encode($result);
    }

    public function deleteOne($firstName, $lastName)
    {
        $collection = $this->connect();
        $collection->deleteOne(["first_name" => $firstName, "last_name" => $lastName]);
    }

    public function updateOne($firstName, $lastName, $newFirstName, $newLastName)
    {
        $collection = $this->connect();
        $collection->updateOne(["first_name" => $firstName, "last_name" => $lastName], ['$set' => ["first_name" => $newFirstName, "last_name" => $newLastName]]);
    }

    public function insertOne($firstName, $lastName = "")
    {
        $collection = $this->connect();
        $collection->insertOne(["first_name" => $firstName, "last_name" => $lastName]);
    }
}
