<?php
//  Write a PHP function that calculates the total bill amount with an optional 
// tax percentage (default 5%).


function calculateBillTotal($amount, $tax = 5) {
    $total = $amount + ($amount * $tax / 100);
    return "Total bill amount (including $tax% tax): ₹" . number_format($total, 2);
}

// Example usage
echo calculateBillTotal(1000);     
echo "<br>";
echo calculateBillTotal(1000, 20);  
echo "<br>";
echo calculateBillTotal(1000, 30);  

?>