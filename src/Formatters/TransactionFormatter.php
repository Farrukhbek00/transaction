<?php

declare(strict_types=1);

namespace Formatters;

class TransactionFormatter
{
    protected $transactions;

    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }

    public function format(): array
    {
        $allTransactions = [];
        foreach ($this->transactions as $transaction) {
            $allTransactions[] = [
                'id' => $transaction->getId(),
                'amount' => $transaction->getAmount(),
                'comment' => $transaction->getComment(),
                'dueDate' => $transaction->getDueDate(),
                'account_id' => $transaction->getAccountId(),
            ];
        }
        return $allTransactions;
    }
}
