<?php

namespace App\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Core\View;

class Balances extends \Core\Controller
{

    public function showAction()
    {
        $incomes = Income::getIncomes();
        $expenses = Expense::getExpenses();

        View::renderTemplate('Items/balance.html', [
            'incomes' => $incomes,
            'expenses' => $expenses
        ]);
    }
}