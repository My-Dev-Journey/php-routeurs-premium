<?php

namespace Models\Entities;

class Categorie extends Entity
{
    protected string $name;
    protected string $description;

    public function name()
    {
        return $this->name;
    }

    public function description()
    {
        return $this->description;
    }
}
