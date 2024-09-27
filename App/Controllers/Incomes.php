<?php

namespace App\Controllers;

use App\Flash;
use App\Models\User;
use PDO;
use App\Auth;
use Core\View;
use App\Models\Income;

class Incomes extends \Core\Controller
{
    public function newAction()
    {
//        $loggedUser = Auth::getUser();
//        var_dump($loggedUser);
//        $userId = $loggedUser->id;

        $categories = (new \App\Models\Income)->getCategories();
        View::renderTemplate('Items/income.html', [
            'categories' => $categories
        ]);
    }
    public function createAction()
    {
        $income = new Income($_POST);

        if ($income->save())
        {
            Flash::addMessage('Income added successfully', Flash::SUCCESS);

            View::renderTemplate('Home/index.html');
        }
        else
        {
            Flash::addMessage('Failed to add income', Flash::WARNING);

            View::renderTemplate('Home/index.html');
        }
    }
}