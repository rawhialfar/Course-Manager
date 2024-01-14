<?php
    // Simulate rolling a six-sided dice
    $result = rand(1, 6);
   
    // Display the result
    echo "Result: $result";

    // Check if the result is 6 and display a message
    if ($result == 6) {
        echo "<br>Congratulations! You rolled a 6!";
    }
?>