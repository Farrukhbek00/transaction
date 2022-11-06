<?php

namespace Repositories;

use Repositories\Interfaces\TransactionsRepositoryInterface;

include_once 'Interfaces/TransactionsRepositoryInterface.php';

class TransactionsRepositorySortedByDueDate implements TransactionsRepositoryInterface
{
    private $transactions;

    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }

    public function getAllTransactions(): array
    {
        $dueDate = array();
        foreach ($this->transactions as $key => $row) {
            $dueDate[$key] = $row['dueDate'];
        }

        array_multisort($dueDate, SORT_ASC, $this->transactions);

        return $this->transactions;
    }
}
