<?php

require_once '../models/categories.php';

function index()
{
    $categories = getCategories();

    require '../views/index.php';
}
