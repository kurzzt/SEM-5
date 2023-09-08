<?php

require_once('./lib/db_login.php');

// TODO 1: Ambil value dari query string parameter id

// TODO 2: Tuliskan dan eksekusi query untuk mendapatkan informasi customer

if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

// TODO 3: Tuliskan response

// TODO 4: Dealokasi variabel dan tutup koneksi database
