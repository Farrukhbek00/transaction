<?php

include 'Models/Account.php';
include 'Models/Transaction.php';
include 'Formatters/TransactionFormatter.php';
include 'Repositories/TransactionsRepositorySortedByComment.php';
include 'Repositories/TransactionsRepositorySortedByDueDate.php';

use Formatters\TransactionFormatter;
use Models\Account;
use Models\Transaction;
use Repositories\TransactionsRepositorySortedByComment;
use Repositories\TransactionsRepositorySortedByDueDate;

$accounts = [];
$account = new Account("Jhon", 10);
$account2 = new Account("Frank", 100);

array_push($accounts, $account, $account2);

// 1.Get all accounts in the system.
// var_dump(Account::getAllAccounts($accounts));

// 2.Get the balance of a specific account
// var_dump($account->getBalanceOfAccount());

$transaction1 = new Transaction(5, 'Sending $5', date('Y-m-d', time() + 60 * 60 * 24), $account->getId());
$transaction1->deposit($account);

// 3.Deposit
// var_dump($account);
// var_dump($transaction1);

$transaction2 = new Transaction(15, 'Withdrawing $20', date('Y-m-d'), $account->getId());
$transaction2->withdraw($account);

// 4.Withdraw
// var_dump($account);
// var_dump($transaction2);

$transaction3 = new Transaction(10, 'Transdering $10', date('Y-m-d', time() - 60 * 60 * 24), $account->getId());
$transaction3->transfer($account, $account2);

// 5.Transfer
// var_dump($account);
// var_dump($account2);
// var_dump($transaction3);

$transactions = [$transaction1, $transaction2, $transaction3];

$transactionFormatter = new TransactionFormatter($transactions);
$formmatedTransactions = $transactionFormatter->format();

$allTransactionsSortedByComment = new TransactionsRepositorySortedByComment($formmatedTransactions);
$allTransactionsSortedByDueDate = new TransactionsRepositorySortedByDueDate($formmatedTransactions);

// 6.Get all account transactions sorted by comment in alphabetical order.
// var_dump($allTransactionsSortedByComment->getAllTransactions());

// 7.Get all account transactions sorted by date.
// var_dump($allTransactionsSortedByDueDate->getAllTransactions());
