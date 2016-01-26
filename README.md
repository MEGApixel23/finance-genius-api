Finance Genius API [WORK IN PROGRESS]
====================================

Finance Genius is an Open Source finance manager. This API provides an open access for its functionality.

Its keys features:
 - Wallets
 - Transactions
 - Expenses and Incomes accounting
 - Transfers between Wallets
 - Multi-currencies per one Wallet
 - Shared access for common wallets, transactions, etc (User's Groups)
 
Will be available soon:
 - Budget planning
 - Loans and Deposits
 - Charts, reports, etc.
 - Many other
 
## Requirements

1. PHP 5.4.0+
2. Composer

## Installation

1. Clone this project with following command:
    `git clone git@github.com:MEGApixel23/fg.git`
2. Install all required libraries by typing:
    `composer install`
3. Create DB, configure db connection string in `config/db.php` and run migrations `php yii migrate`