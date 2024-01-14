<?php
// Initialize or increment the counter
// session_start();

// if (!isset($_SESSION['counter'])) {
//     $_SESSION['counter'] = 1;
// } else {
//     $_SESSION['counter']++;
// }

// $counter = $_SESSION['counter'];


// $html = "<br/><p>You've clicked my name $counter times.</p>";
    $colors = array('red', 'blue', 'yellow', 'dodgerblue', 'aqua', 'darkorchid', 'lightseagreen');
    $html = '<div style="background-color:' . $colors[array_rand($colors)] . ';height:100%;width:100%;"></div>';

    echo $html;
?>
