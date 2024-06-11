<?php
include("global.php");
global $db;

if (isset($_GET['page'])) {
    // require_once(__DIR__ . "/classes/gallery_ajax.class.php");
    $page = $_GET['page'];
    session_start();
    // $ajax = new gallery_ajax();
    switch ($page) {
        case 'chksession':

            if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $sessionTimeout) {
                echo json_encode(['status' => 'expired']);
            } else {
                $_SESSION['last_activity'] = time();
                echo json_encode(['status' => 'active']);
            }


        }
    }

?>