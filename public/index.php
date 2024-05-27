<?php
session_start();

$action = $_GET['action'] ?? '';
require '../controllers/index.php';
require '../controllers/login.php';
require '../controllers/categoryAndTopics.php';

require '../middlewares/authentication.php';
require '../middlewares/stats.php';

switch ($action) {
    case '':
        getStats();
        index();
        break;
    case 'login':
        login();
        break;
    case 'topic':
        getStats();
        showTopic();
        break;
    case 'category':
        getStats();
        showCategory();
        break;
    case 'create-message':
        checkAuth();
        createMessage();
        break;
    case '403':
        echo 'Erreur 403';
        break;
}
