<?php

require_once '../models/categories.php';
require '../models/topics.php';

function showCategory()
{
    $category = $_GET['name'];
    $topics = getTopicsByCategory($category);

    require '../views/category.php';
}

function showTopic()
{
    $topic = getTopic($_GET['id']);
    require '../views/topic.php';
}


function createMessage()
{
    if (empty($_POST['message'])) {
        // Erreur
    }

    addNewMessage($_POST['topic_id'], $_POST['message']);

    return header('location: ?action=topic&id=' . $_POST['topic_id']);
}
