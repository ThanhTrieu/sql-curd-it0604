<?php

function connection()
{
    try {

        $dbh = new PDO('mysql:host=localhost;dbname=students_system', 'root', '');
        return $dbh;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
function disconnection($connect = null)
{
    $connect = null;
}