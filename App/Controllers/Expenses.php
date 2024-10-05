<?php

namespace App\Controllers;

use App\Flash;
use App\Models\Income;
use App\Models\User;
use PDO;
use App\Auth;
use Core\View;
use App\Models\Expense;
class Expenses extends \Core\Controller
{

    public function newAction()
    {
//        $loggedUser = Auth::getUser();
//        var_dump($loggedUser);
//        $userId = $loggedUser->id;

        $categories = (new \App\Models\Expense()) -> getCategories();
        $methods = (new \App\Models\Expense()) -> getPaymentMethods();
        View::renderTemplate('Items/expense.html', [
            'categories' => $categories, 'methods' => $methods
        ]);
    }
    public function createAction()
    {
        $expense = new Expense($_POST);

        if ($expense->save())
        {
            Flash::addMessage('Expense added successfully', Flash::SUCCESS);

            View::renderTemplate('Home/index.html');
        }
        else
        {
            Flash::addMessage('Failed to add expense', Flash::WARNING);

            View::renderTemplate('Home/index.html');
        }
    }
}