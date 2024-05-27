<?php
session_start();
$nb_users = 1000;
$nb_topics = 500;
$nb_messages = 4242;
require_once '../models/categories.php';

$logged_in = $_SESSION['auth'] ?? false;

function showCategory()
{
    $category = $_GET['name']; // Ici je n'ai plus besoin de ?? null, car le routeur va faire la vérification en amont
    $topics = getTopicsByCategory($category);

    require '../views/category.php';
}
