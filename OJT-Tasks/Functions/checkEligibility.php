<!-- Write a function checkEligibility($age) that checks if a person is eligible to 
 vote (age ≥ 18) and returns a message. -->

<?php

function checkEligibility($age) {
    if ($age >= 18) {
        return "You are eligible to vote.";
    } else {
        return "You are not eligible to vote.";
    }
}

echo checkEligibility(20); 
?>



