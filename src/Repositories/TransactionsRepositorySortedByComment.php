<?php

namespace Repositories;

use Repositories\Interfaces\TransactionsRepositoryInterface;

include_once 'Interfaces/TransactionsRepositoryInterface.php';

class TransactionsRepositorySortedByComment implements TransactionsRepositoryInterface
{
    private $transactions;

    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }

    public function getAllTransactions(): array
    {
        $comment = array();
        foreach ($this->transactions as $key => $row) {
            $comment[$key] = $row['comment'];
        }

        array_multisort($comment, SORT_ASC, $this->transactions);

        return $this->transactions;
    }
}
