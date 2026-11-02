<?php
// Generates entries in Apache/PHP error.log
error_log("Custom test error from trigger_error.php");
trigger_error("Simulated warning", E_USER_WARNING);
echo $undefined; // notice/warning
echo "Check error.log for new entries.";
