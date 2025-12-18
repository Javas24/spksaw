<?php
require "include/conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query hapus
    $sql = "DELETE FROM saw_criterias WHERE id_criteria = '$id'";
    $result = $db->query($sql);
}

// Kembali ke halaman utama
header("Location: bobot.php");
exit();
