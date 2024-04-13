<?php
if(isset($_SESSION['myusername']))
{
$path = getcwd();
$profile_un = basename($path);
$myuser = $_SESSION['myusername'];
if($profile_un != $myuser)
{
    $conn=mysqli_connect("localhost","root","","tawasul_db");
    $check_result = mysqli_query($conn, "SELECT * FROM tawasul_follow WHERE acc1='$myuser' AND acc2='$profile_un'");
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows > 0) {
        echo '<br/>';
        echo '<form action="" method="POST">';
        echo '<button type="submit" class="myButton" name="unfollow">UnFollow</button>';
        echo '</form>';
        echo '<form action="" method="POST">';
        echo '<button type="submit" class="myButton" style="float: center;" name="message">Message  </button>';
        echo '</form>';
        echo '<br/>';
    }
    else {
        echo '<br/>';
        echo '<form action="" method="POST">';
        echo '<button type="submit" class="myButton" name="follow">+ Follow</button>';
        echo '</form>';
        echo '<form action="" method="POST">';
        echo '<button type="submit" class="myButton" name="message">Message  </button>';
        echo '</form>';
        echo '<br/>';
    }
}
}
?>