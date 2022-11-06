<?php

declare(strict_types=1);

namespace Models;

use Exception;

class Transaction
{
    private string $id;
    private float $amount;
    private string $comment;
    private string $dueDate;
    private string $account_id;

    public function __construct(float $amount, string $comment, string $dueDate, string $account_id)
    {
        $this->id = uniqid();
        $this->amount = $amount;
        $this->comment = $comment;
        $this->dueDate = $dueDate;
        $this->account_id = $account_id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setDueDate(string $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function setAccountId(string $account_id): void
    {
        $this->account_id = $account_id;
    }

    public function getAccountId(): string
    {
        return $this->account_id;
    }

    public function deposit(Account $account): Transaction
    {
        $new_balance = $account->getBalance() + $this->amount;

        $account->setBalance($new_balance);

        return $this;
    }

    public function withdraw(Account $account): Transaction
    {
        try {
            if ($this->amount > $account->getBalance()) {
                throw new Exception("Sender does not have enough money in balance");
            }

            $new_balance = $account->getBalance() - $this->amount;

            $account->setBalance($new_balance);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this;
    }

    public function transfer(Account $account, $sender): Transaction
    {
        try {
            if ($this->amount > $sender->getBalance()) {
                throw new Exception("Sender does not have enough money in balance");
            }

            $senderNewBalance = $sender->getBalance() - $this->amount;
            $sender->setBalance($senderNewBalance);

            $receiverNewBalance = $account->getBalance() + $this->amount;
            $account->setBalance($receiverNewBalance);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this;
    }
}
