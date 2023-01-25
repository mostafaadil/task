<?php

require('models/Users/Users.php');
require('models/Users/UsersTransactions.php');
class DoOperations
{
    private $newUser;
    private $newUserTransaction;
    private $user;
    private $usersTransactions;

    function __construct()
    {
        $this->user = new Users();
        $this->usersTransactions = new UsersTransactions();
        $this->newUserTransaction = array("id" => 2, "transaction_type" => 1, "comment" => "Ahmed Adil cash is back", "amount" => 1000, "from_user_id" => 1, "to_user_id" => 5, "due_date" => date("Y-m-d H:m:s"));
        $this->newUser = array("id" => 2, "name" => "John doe", "balance" => 23, "tel" => "+24990375237");
    }

    public function  createUserAccount()
    {
        echo $this->user->store($this->newUser);
    }



    public function  getAllAccounts()
    {
        echo  json_encode($this->user->all());
    }
    public function  createUserTransaction()
    {
        echo $this->usersTransactions->store($this->newUserTransaction);
    }

    public function updateUserBalance()
    {
        # code...
        $results = $this->user->findOne(2);
        echo  json_encode($results);
        $deposits = 1000;
        $updatedBalance = null;
        for ($i = 0; $i < sizeof($results); $i++) {
            $deposits = $deposits + $results[$i]->balance;
            $this->user->update(["balance" => $deposits], $id = 2);
        }
        echo "<br>";
        $updatedBalance = $this->user->findOne(2);
        echo  json_encode($updatedBalance);
    }


    public function findUserBalance()
    {
        # code...
        $results = $this->user->findOne(2);
        for ($i = 0; $i < sizeof($results); $i++) {
            echo $results[$i]->balance . "\n";
        }
    }


    public function sortedTransactionByDate()
    {
        # code...
        $results = $this->usersTransactions->getTransactionsByAccount(1); //get all account transactions
        usort($results, function ($a, $b) {
            return strnatcasecmp($b->due_date, $a->due_date);
        });
        echo json_encode($results);
    }
    public function groupTransactionByComment()
    {
        # code...
        $results = $this->usersTransactions->getTransactionsByAccount(1); //get all account transactions
        /*group by comment*/
        usort($results, function ($a, $b) {
            return strnatcasecmp($a->comment, $b->comment);
        });
        echo json_encode($results);
    }
}

$operation = new DoOperations();
// $operation->sortedTransactionByDate();
// $operation->groupTransactionByComment();
// $operation->createUserTransaction();
// $operation->createUserAccount();
// $operation->getAllAccounts();
// $operation->updateUserBalance()
