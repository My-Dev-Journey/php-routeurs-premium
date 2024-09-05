<?php

namespace Controllers;

class ErrorsController
{
    public function error404()
    {
        echo '404';
    }

    public function error403()
    {
        echo '403';
    }
}
