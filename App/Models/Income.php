<?php

namespace App\Models;

use PDO;
use \Core\View;

class Income extends \Core\Model
{
    private $category;
    private $amount;
    private $date;
    private $comment;

}