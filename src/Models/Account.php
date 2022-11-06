<?php

declare(strict_types=1);

namespace Models;

class Account
{
    private string $id;
    private string $owner;
    private float $balance;

    public function __construct(string $owner, float $balance)
    {
        $this->id = uniqid();
        $this->owner = $owner;
        $this->balance = $balance;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public static function getAllAccounts(array $accounts): array
    {
        $allAccounts = [];
        foreach ($accounts as $account) {
            $allAccounts[] = [
                'id' => $account->id,
                'owner' => $account->owner,
                'balance' => $account->balance,
            ];
        }
        return $allAccounts;
    }

    public function getBalanceOfAccount(): float
    {
        return $this->balance;
    }
}
