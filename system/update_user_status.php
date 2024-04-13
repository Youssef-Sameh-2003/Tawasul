<?php
if (isset($_SESSION['myusername']) && isset($_POST['status'])) {
    // Update user status in the database
    updateUserStatus($_SESSION['myusername'], $_POST['status']);
}
?>
