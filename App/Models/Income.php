<?php

namespace App\Models;

use PDO;
use \Core\View;
use PDOException;

class Income extends \Core\Model
{
    private $category;
    private $amount;
    private $date;
    private $comment;

    public function getCategories()
    {
        $sql = 'SELECT id, name FROM incomes_category_assigned_to_users
                WHERE user_id = 1';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        //$stmt->bindValue(':token_hash', $this->token_hash, PDO::PARAM_STR);

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }
    public function save()
    {
        $this->category = $_POST['category'];
        $this->amount = $_POST['amount'];
        $this->date = $_POST['date'];
        $this->comment = $_POST['comment'];

        $sql = 'INSERT INTO incomes (user_id, income_category_assigned_to_user_id, 
                           amount, date_of_income, income_comment) VALUES (
                            :user_id, :income_category_assigned_to_user_id,
                            :amount, :date_of_income, :income_comment
                           )';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':user_id', 1, PDO::PARAM_STR);
        $stmt->bindValue(':income_category_assigned_to_user_id', $this->category, PDO::PARAM_STR);
        $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
        $stmt->bindValue(':date_of_income', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':income_comment', $this->comment, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}