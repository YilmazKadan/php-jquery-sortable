<?php

require("conn.php");

if ($_POST) {
    $dizi = $_POST['sira'];
    // Verileri güncelleme

    for ($i = 0; $i < count($dizi); $i++) {
        $stmt = $db->prepare("Update categories set sira = ? where id = ? ");
        $stmt->execute([$i, $dizi[$i]]);
    }
}
