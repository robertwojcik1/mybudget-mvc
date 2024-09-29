<?php

namespace App\Models;

use \Core\View;
use PDOException;
class Expense extends \Core\Model
{
    private $category;
    private $paymentMethod;
    private $amount;
    private $date;
    private $comment;
}