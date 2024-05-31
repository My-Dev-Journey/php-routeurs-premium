<?php

namespace Controllers;

use Models\Categorie;

class HomeController
{
    private Categorie $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Categorie();
    }
    public function index()
    {
        $categories = $this->categoryModel->getCategories();

        require '../views/index.php';
    }
}
