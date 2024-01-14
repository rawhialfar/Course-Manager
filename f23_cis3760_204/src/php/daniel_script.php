<?php
// Function to generate a random password
function generatePassword($length = 8) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+';
  $password = '';

  for ($i = 0; $i < $length; $i++) {
    $password .= $characters[rand(0, strlen($characters) - 1)];
  }

  return $password;
}

// Generate a 12-character randomized generatePassword
$randomPassword = generatePassword(12);

$html = "<h3>Generate Random 12-character password</h3>
<p>Randomized password: $randomPassword</p>
<hr>";

echo $html;
?>
