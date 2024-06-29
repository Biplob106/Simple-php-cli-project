<?php

$incomeFile = 'incomes.txt';
$expenseFile = 'expenses.txt';

// Load data from files
$incomes = [];
if (file_exists($incomeFile)) {
    $handle = fopen($incomeFile, 'r');
    while (($line = fgets($handle)) !== false) {
        list($amount, $category) = explode(',', trim($line));
        $incomes[] = ['amount' =>  $amount, 'category' => $category];
    }
    fclose($handle);
}

$expenses = [];
if (file_exists($expenseFile)) {
    $handle = fopen($expenseFile, 'r');
    while (($line = fgets($handle)) !== false) {
        list($amount, $category) = explode(',', trim($line));
        $expenses[] = ['amount' =>  $amount, 'category' => $category];
    }
    fclose($handle);
}

while (true) {
    echo "\nOptions:\n";
    echo "1. Add income\n";
    echo "2. Add expense\n";
    echo "3. View incomes\n";
    echo "4. View expenses\n";
    echo "5. View savings\n";
    echo "6. View categories\n";
    echo "7. Exit\n";

    $options = readline("Enter your option: ");

    switch ($options) {
        case '1':
            $amount =  readline("Enter income amount: ");
            $category = readline("Enter income category: ");
            $incomes[] = ['amount' => $amount, 'category' => $category];
            $handle = fopen($incomeFile, 'w');
            foreach ($incomes as $income) {
                fwrite($handle, "{$income['amount']},{$income['category']}\n");
            }
            fclose($handle);
            break;
        case '2':
            $amount =  readline("Enter expense amount: ");
            $category = readline("Enter expense category: ");
            $expenses[] = ['amount' => $amount, 'category' => $category];
            $handle = fopen($expenseFile, 'w');
            foreach ($expenses as $expense) {
                fwrite($handle, "{$expense['amount']},{$expense['category']}\n");
            }
            fclose($handle);
            break;
        case '3':
            foreach ($incomes as $income) {
                echo "Amount: {$income['amount']}, Category: {$income['category']}\n";
            }
            break;
        case '4':
            foreach ($expenses as $expense) {
                echo "Amount: {$expense['amount']}, Category: {$expense['category']}\n";
            }
            break;
        case '5':
            $totalIncome = array_sum(array_column($incomes, 'amount'));
            $totalExpense = array_sum(array_column($expenses, 'amount'));
            echo "Savings: " . ($totalIncome - $totalExpense) . "\n";
            break;
        case '6':
            $incomeCategories = array_unique(array_column($incomes, 'category'));
            $expenseCategories = array_unique(array_column($expenses, 'category'));
            echo "Income Categories: " . implode(', ', $incomeCategories) . "\n";
            echo "Expense Categories: " . implode(', ', $expenseCategories) . "\n";
            break;
        case '7':
            exit("Exit Options!\n");
        default:
            echo "Invalid option, please try again.\n";
    }
}
?>
