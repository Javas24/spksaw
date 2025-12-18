<?php
require "include/conn.php";

$criteria = $_POST['criteria'];
$weight = $_POST['weight'];
$attribute = $_POST['attribute'];

$sql = "INSERT INTO saw_criterias (criteria, weight, attribute)
        VALUES ('$criteria', '$weight', '$attribute')";

$result = $db->query($sql);

header("Location: bobot.php");
