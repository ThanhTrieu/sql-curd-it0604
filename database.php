<?php

function connection()
{
    try {

        $dbh = new PDO('mysql:host=localhost;dbname=students_system', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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