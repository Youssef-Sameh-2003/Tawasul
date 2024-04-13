<?php
$path = getcwd();
$username = basename($path);
            $conn=mysqli_connect("localhost","root","","tawasul_db");  
$sql_disp = "SELECT * FROM tawasul_posts WHERE author='$username'";
$display_result3 = $conn->query($sql_disp);
while ($all_posts=$display_result3-> fetch_assoc()) {
                //$p_author = $all_posts['author'];
                $sql4= "SELECT * FROM tawasul_users where username='$username'";
                $result3 = $conn->query($sql4);
                while($all_user3= $result3-> fetch_assoc())
                {
                    ?>
                    
                <div class="card-body">
    <div class="media">
            <img src="../../profile/<?php echo $username; ?>/<?php echo $all_user3['profile_pic'];?>" alt="img" width="55px" height="55px" class="rounded-circle mr-3">
        <div class="media-body">
                <h5><?php echo '<a href="../../profile/'.$username.'/">'.$all_user3['first_name'].'&nbsp;'.$all_user3['last_name'].'</a>';?><?php if($all_user3['verified'] == 1){echo ' <img src="../../img/verifyBadge-blue.png">';}?></h5>
                <p class="text-justify"><?php echo convert_links($all_posts['p_content']); ?></p>
                <form action="" method="POST">
                <input name="post_id" type="text" value="<?php echo $all_posts['id']; ?>" hidden>
                <?php
                $username = $_SESSION['myusername'];
                $post_id = $all_posts['id'];
                $p_likes = $all_posts['p_likes'];
                $p_comments = $all_posts['p_replies'];
                $like_result = mysqli_query($conn, "SELECT * FROM tawasul_likes WHERE liker='$username' AND post_id='$post_id'");
                $num_rows = mysqli_num_rows($like_result);
                if ($num_rows > 0) {
                    echo'<button type="submit" name="dislike_post"><i class="fas fa-thumbs-up" style="color: #0259ed;"></i></button>&nbsp; &nbsp'.$p_likes;
                }
                else {
                    echo '<button type="submit" name="like_post"><i class="fas fa-thumbs-up"></i></button>&nbsp; &nbsp;'.$p_likes;
                }
                echo '&nbsp; &nbsp; <button type="submit" name="comment"><i class="fas fa-comment"></i></button>&nbsp; &nbsp;'.$p_comments;
                ?>
                
                </form>
        </div>
        <small><?php echo $all_posts['p_date']; ?></small>
    </div>
            </div><hr>
    <?php }} ?>
