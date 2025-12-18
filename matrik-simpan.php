<?php
require "include/conn.php";

// 1. Ambil ID Alternatif (hanya satu)
$id_alternative = $_POST['id_alternative'];

// 2. Ambil Array Values (key = id_criteria, value = nilai input)
$values = $_POST['values'];

// Cek apakah data valid
if (! empty($id_alternative) && is_array($values)) {

    // 3. Loop setiap nilai kriteria yang dikirim
    foreach ($values as $id_criteria => $val) {

        // Pastikan nilai tidak kosong
        if ($val !== "") {
            // Gunakan REPLACE INTO agar jika data sudah ada, akan di-update
            $sql = "REPLACE INTO saw_evaluations (id_alternative, id_criteria, value)
                    VALUES ('$id_alternative', '$id_criteria', '$val')";

            $db->query($sql);
        }
    }

    // Redirect kembali setelah selesai loop
    header("location:./matrik.php");

} else {
    echo "Error: Data tidak lengkap.";
}
