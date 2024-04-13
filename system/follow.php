<?php
include_once('db_config.php');

if(isset($_POST['follow']))
{
    $path = getcwd();
    $profile_un = basename($path);
    $myun = $_SESSION['myusername'];
    $follow_sql = "INSERT INTO tawasul_follow(acc1, acc2) VALUES ('$myun','$profile_un')";
    if ($conn->query($follow_sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Account Followed !!!</div>";
        $select_sql = "select * from tawasul_users where username = '$myun'";
		$result = $conn->query($select_sql);
		while ($all_user= $result-> fetch_assoc()) {
            $new_following_num = $all_user['following_num'] + 1;
            $sql2= "UPDATE tawasul_users SET following_num='$new_following_num' WHERE username='$myun'";
		    $result2 = $conn->query($sql2);
        }
        $select_sql_2 = "select * from tawasul_users where username = '$profile_un'";
		$result2 = $conn->query($select_sql_2);
		while ($all_user2= $result2-> fetch_assoc()) {
            $new_follower_num = $all_user2['followers_num'] + 1;
            $sql3= "UPDATE tawasul_users SET followers_num='$new_follower_num' WHERE username='$profile_un'";
		    $result3 = $conn->query($sql3);
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>".$sql."<br>".$conn->error."</div>";
    }      
}

if(isset($_POST['unfollow']))
{
    $path = getcwd();
    $profile_un = basename($path);
    $myun = $_SESSION['myusername'];
    $unfollow_sql = "DELETE FROM tawasul_follow WHERE acc1='$myun' AND acc2='$profile_un'";
    if ($conn->query($unfollow_sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Account Unfollowed !!!</div>";
        $select2_sql = "select * from tawasul_users where username = '$myun'";
		$result = $conn->query($select2_sql);
		while ($all_user= $result-> fetch_assoc()) {
            if($all_user['following_num'] > 0)
            {
            $new_following_num = $all_user['following_num'] - 1;
            $sql2= "UPDATE tawasul_users SET following_num='$new_following_num' WHERE username='$myun'";
		    $result2 = $conn->query($sql2);
            }
        }
        $select2_sql_2 = "select * from tawasul_users where username = '$profile_un'";
		$result2 = $conn->query($select2_sql_2);
		while ($all_user2= $result2-> fetch_assoc()) {
            if($all_user2['followers_num'] > 0)
            {
            $new_follower_num = $all_user2['followers_num'] - 1;
            $sql3= "UPDATE tawasul_users SET followers_num='$new_follower_num' WHERE username='$profile_un'";
		    $result3 = $conn->query($sql3);
            }
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>".$sql."<br>".$conn->error."</div>";
    }
}

?>