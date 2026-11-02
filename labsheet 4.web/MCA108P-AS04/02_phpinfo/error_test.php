<?php
// Confirms display_errors = On (the undefined variable triggers a warning).
ini_set('display_errors', '1');
error_reporting(E_ALL);
echo "display_errors = " . ini_get('display_errors') . "<br>";
echo $undefined_variable;
