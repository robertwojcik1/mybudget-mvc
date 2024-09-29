<?php

namespace App\Controllers;

use App\Flash;
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

//        $categories = (new \App\Models\Income)->getCategories();
        View::renderTemplate('Items/expense.html', [
//            'categories' => $categories
        ]);
    }
}