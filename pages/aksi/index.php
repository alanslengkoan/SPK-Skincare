<?php
// untuk session start
session_start();
// untuk router
include_once '../../configs/library/my_root.php';
// autoload class
spl_autoload_register('autoLoadClass');
// untuk memanggil class sql
$pdo = new sql;
// untuk class my_login
$mylog = new my_login;
// untuk class my_function
$myfun = new my_function;
// untuk class my_vendor
$myven = new my_vendor;

$aksi = $_REQUEST['aksi'];
if (file_exists($aksi . '.php')) {
    switch ($aksi) {
        case $aksi:
            include_once $aksi . '.php';
            break;
    }
} else {
    include_once '404.html';
}
