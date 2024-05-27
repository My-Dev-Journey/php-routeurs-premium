<?php

$nb_users = 1000;
$nb_topics = 500;
$nb_messages = 4242;

require '../models/topics.php';

if (empty($_GET['id'])) {
    return header('location:index.php');
}

function showTopic()
{
    $topic = getTopic($_GET['id']);
    require '../views/topic.php';
}
