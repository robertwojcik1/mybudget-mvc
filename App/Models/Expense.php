<?php

namespace App\Models;

use \Core\View;
use PDO;
use PDOException;
class Expense extends \Core\Model
{
    private $category;
    private $paymentMethod;
    private $amount;
    private $date;
    private $comment;

    public function getCategories()
    {
        $sql = 'SELECT id, name FROM expenses_category_assigned_to_users
                WHERE user_id = 1';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        //$stmt->bindValue(':token_hash', $this->token_hash, PDO::PARAM_STR);

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }
    public function getPaymentMethods()
    {
        $sql = 'SELECT id, name FROM payment_methods_assigned_to_users
                WHERE user_id = 1';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        //$stmt->bindValue(':token_hash', $this->token_hash, PDO::PARAM_STR);

        $stmt->execute();
        $methods = $stmt->fetchAll();
        return $methods;
    }
    public function save()
    {
        $this->category = $_POST['category'];
        $this->amount = $_POST['amount'];
        $this->date = $_POST['date'];
        $this->comment = $_POST['comment'];
        $this->paymentMethod = $_POST['paymentMethod'];

        $sql = 'INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, 
                           payment_method_assigned_to_user_id, amount, date_of_expense, expense_comment) VALUES (
                            :user_id, :expense_category_assigned_to_user_id, :payment_method_assigned_to_user_id,
                            :amount, :date_of_expense, :expense_comment
                           )';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':user_id', 1, PDO::PARAM_STR);
        $stmt->bindValue(':expense_category_assigned_to_user_id', $this->category, PDO::PARAM_STR);
        $stmt->bindValue(':payment_method_assigned_to_user_id', $this->paymentMethod, PDO::PARAM_STR);
        $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
        $stmt->bindValue(':date_of_expense', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':expense_comment', $this->comment, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}