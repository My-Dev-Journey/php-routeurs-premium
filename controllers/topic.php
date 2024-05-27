<?php

require '../models/topics.php';

if (empty($_GET['id'])) {
    return header('location:index.php');
}

function showTopic()
{
    $topic = getTopic($_GET['id']);
    require '../views/topic.php';
}
