<?php
function convert_links($message)
{
$parsedMessage = preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#([a-z0-9_]+)/i'), array('<a href="$1" target="_blank">$1</a>', '$1<a href="">@$2</a>', '$1<a href="index.php?hashtag=$2">#$2</a>'), $message);
return $parsedMessage;
}

$conn=mysqli_connect("localhost","root","","tawasul_db");  
$sql = "SELECT * FROM tawasul_posts WHERE p_privacy='public'";
$display_result = $conn->query($sql);
while ($all_posts=$display_result-> fetch_assoc()) {
                $p_author = $all_posts['author'];
                $sql3= "SELECT * FROM tawasul_users where username='$p_author'";
                $result3 = $conn->query($sql3);
                while($all_user= $result3-> fetch_assoc())
                {
                    ?>
<script>
    var useronline = <?php echo $all_user['online']?>;
    alert(useronline);
    localStorage.setItem("isOnline",useronline);
</script>
<div class="offcanvas">
    <div class="media">
            <img src="profile/<?php echo $p_author; ?><?php echo $all_user['profile_pic'];?>" alt="img" width="55px" height="55px" class="rounded-circle mr-3">
        <div class="media-body">
                <h5><?php echo '<a href="profile/'.$p_author.'/" style="color: white;">'.$all_user['first_name'].'&nbsp;'.$all_user['last_name'].'</a>';?><?php if($all_user['verified'] == 1){echo ' <div class="statusIndicator green-dot"></div><img src="img/verifyBadge-blue.png">';}?></h5>
                <p class="text-justify getMentions textfont" style="color: white; font-family: 'Russo One';"><?php echo convert_links($all_posts['p_content']); ?></p>
                <form action="" method="POST">
                <input id="post_id" name="post_id" type="text" value="<?php echo $all_posts['id']; ?>" hidden>
                <?php
                $username = $_SESSION['myusername'];
                $post_id = $all_posts['id'];
                $p_likes = $all_posts['p_likes'];
                $p_comments = $all_posts['p_replies'];
                $like_result = mysqli_query($conn, "SELECT * FROM tawasul_likes WHERE liker='$username' AND post_id='$post_id'");
                $num_rows = mysqli_num_rows($like_result);
                if ($num_rows > 0) {
                    echo'<div type="button" name="action" onclick="dislike_post()" class="fas fa-thumbs-up" style="color: #0259ed;"></div>&nbsp; &nbsp<medium style="color: white;">'.$p_likes.'</medium>';
                }
                else {
                    echo '<div type="button" name="action" onclick="like_post()" class="fas fa-thumbs-up"></i></div>&nbsp; &nbsp;<medium style="color: white;">'.$p_likes.'</medium>';
                }
                echo '&nbsp; &nbsp; <button type="submit" name="comment"><i class="fas fa-comment"></i></button>&nbsp; &nbsp;<medium style="color: white;">'.$p_comments.'</medium>';
                ?>
                
                </form>
        </div>

        <small style="color: white;"><?php echo $all_posts['p_date']; ?></small>
    </div>
</div>
            
<hr>
<?php }} ?>