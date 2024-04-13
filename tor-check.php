<?php
function isTorUser() {
    $torExitNodesURL = 'https://check.torproject.org/torbulkexitlist';

    // Download the list of Tor exit nodes
    $torExitNodes = file_get_contents($torExitNodesURL);

    // Get the user's IP address
    $userIP = $_SERVER['REMOTE_ADDR'];

    // Check if the user's IP address is in the list of Tor exit nodes
    if (strpos($torExitNodes, $userIP) !== false) {
        return true;
    }

    return false;
}

// Usage
if (isTorUser()) {
    header("Location: tor-forbidden.html");
}
?>