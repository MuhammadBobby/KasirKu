<?php
// require_once __DIR__ . '/config.php';

$page = $_GET['page'] ?? 'kasir';

$path = "pages/$page.php";

if (file_exists($path)) {
    $content = $path;
} else {
    $content = "pages/404.php";
}

include('layout.php');
