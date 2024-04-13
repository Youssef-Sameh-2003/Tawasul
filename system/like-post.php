<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$username = $_SESSION['myusername'];
$conn = mysqli_connect("localhost", "root", "", "tawasul_db");

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $post_id = $_POST['post_id'];

    // Check if user already liked the post
    $check_sql = "SELECT * FROM tawasul_likes WHERE post_id='$post_id' AND liker='$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0 && $type == 'like') {
        // User already liked the post
        echo '<script>toastr.success("Thread Already Liked !!!");</script>';
        exit; // Exit script
    }

    // Use prepared statement to prevent SQL injection
    if ($type == 'like') {
        $stmt = $conn->prepare("INSERT INTO tawasul_likes(post_id, liker) VALUES (?, ?)");
    } elseif ($type == 'dislike') {
        $stmt = $conn->prepare("DELETE FROM tawasul_likes WHERE post_id=? AND liker=?");
    } else {
        echo 'error';
        exit; // Exit script if type is neither like nor dislike
    }

    $stmt->bind_param("ss", $post_id, $username);

    if ($stmt->execute()) {
        $stmt->close();

        // Update post_likes
        $update_sql = "UPDATE tawasul_posts SET p_likes = p_likes + 1 WHERE id = '$post_id'";
        if ($type == 'dislike') {
            $update_sql = "UPDATE tawasul_posts SET p_likes = p_likes - 1 WHERE id = '$post_id'";
        }

        if ($conn->query($update_sql) === TRUE) {
            echo 'success';
            exit; // Exit script after success
        } else {
            echo 'error';
            // Log the error
            error_log("Error updating post_likes: " . $conn->error);
        }
    } else {
        echo 'error';
        // Log the error
        error_log("Error executing query: " . $stmt->error);
    }
} else {
    echo 'error';
}
?>
