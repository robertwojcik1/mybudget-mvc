<?php

namespace App\Controllers;

use Core\View;

class Income extends \Core\Controller
{
    public function newAction()
    {
        View::renderTemplate('Items/income.html');
    }
}