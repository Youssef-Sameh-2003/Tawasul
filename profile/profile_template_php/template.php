<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() == PHP_SESSION_NONE) {
        // Session has not started, start it
        session_start();
}

include_once('../../system/follow.php');
include_once('../../system/db_config.php');
//include_once('../../system/like-post.php');
$path = getcwd();
$username = basename($path);
$sql = "select * from tawasul_users where username = '$username'";
$result = $conn->query($sql);
while ($profile= $result-> fetch_assoc()) {	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="../../css/main.css">
<link rel="stylesheet" href="../../css/style.css">

<!------------------LIght BOx for Gallery-------------->
<link rel="stylesheet" href="../../components/lightbox/lightbox.min.css">
<script type="text/javascript" src="../../components/lightbox/lightbox-plus-jquery.min.js"></script>
<!------------------LIght BOx for Gallery-------------->


<title><?php echo $profile['first_name'].' '; echo $profile['last_name'];?></title>
</head>
<body>


    <!-------------------------------NAvigation Starts------------------>

    <nav class="navbar navbar-expand-md navbar-dark mb-4" style="background-color:#3097D1">
        <a href="index.html" class="navbar-brand"><img src="../../img/cover.png" alt="logo" class="img-fluid" width="80px" height="100px"></a>
        
        <button class="navbar-toggler" data-toggle="collapse" data-target="#responsive"><span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="responsive">
            <ul class="navbar-nav mr-auto text-capitalize">
                <li class="nav-item"><a href="index.html" class="nav-link active">home</a></li>
                <li class="nav-item"><a href="profile.html" class="nav-link">profile</a></li>
                <li class="nav-item"><a href="#modalview" class="nav-link" data-toggle="modal">messages</a></li>
                <li class="nav-item"><a href="notification.html" class="nav-link">docs</a></li>
                <li class="nav-item"><a href="#" class="nav-link ">logout</a></li>

            </ul>

            <form action="" class="form-inline ml-auto d-none d-md-block">
                <input type="text" name="search" id="search" placeholder="Search" class=>
            </form>
            <a href="notification.html" class="text-decoration-none" style="color:#CBE4F2;font-size:22px;"><i class="far fa-bell ml-3 d-none d-md-block"></i></a> 
            <img src="<?php echo '../../profile/'.$username.'/'.$profile["profile_pic"]; ?>" alt="" class="rounded-circle ml-3 d-none d-md-block" width="32px" height="32px">
        </div>
    </nav>

    <!---------------------------------------------Ends navigation------------------------------>

         <!---------------------------MOdal Section  satrts------------------->

    <div class="modal fade" id="modalview" >
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    
                <div class="modal-content">
    
    
                    <div class="modal-header">
                        <div class="modal-title h4">Messages</div>
    
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
    
    
                    <div class="modal-body">
    
    
                        <ul class="list-unstyled">
    
    
                         <a href="#" class="text-decoration-none">
                            <li class="media hover-media">
                               
                                    <img src="../../img/avatar-dhg.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
    
                                    <div class="media-body text-dark">
                                            <h6 class="media-header">Jchob Thunder and <strong> 1 others</strong></h6>
                                            <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    
                                    </div>
    
                            </li>
                        </a>
                        <hr class="my-3">
    
    
                        
                        <a href="#" class="text-decoration-none">
                                <li class="media hover-media">
                                   
                                        <img src="../../img/avatar-fat.jpg" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
        
                                        <div class="media-body text-dark">
                                                <h6 class="media-header">Mark Otto and <strong> 3 others</strong></h6>
                                                <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        
                                        </div>
        
                                </li>
                            </a>
    
    
                            <hr class="my-3">
    
    
                            <a href="#" class="text-decoration-none">
                                <li class="media hover-media">
                                   
                                        <img src="../../img/avatar-mdo.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
        
                                        <div class="media-body text-dark">
                                                <h6 class="media-header">Archer andu and <strong> 5 others</strong></h6>
                                                <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        
                                        </div>
        
                                </li>
                            </a>
    
                            <hr class="my-3">
    
    
                            <a href="#" class="text-decoration-none">
                                    <li class="media hover-media">
                                       
                                            <img src="../../img/avatar-dhg.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
            
                                            <div class="media-body text-dark">
                                                    <h6 class="media-header">Jchob Thunder and <strong> 1 others</strong></h6>
                                                    <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            
                                            </div>
            
                                    </li>
                                </a>
                                <hr class="my-3">  
                                <a href="#" class="text-decoration-none">
                                        <li class="media hover-media">             
                                                <img src="../../img/avatar-fat.jpg" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                                                <div class="media-body text-dark">
                                                        <h6 class="media-header">Mark Otto and <strong> 3 others</strong></h6>
                                                        <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                
                                                </div>
                                        </li>
                                    </a>
                                    <hr class="my-3">
                             <a href="#" class="text-decoration-none">
                                        <li class="media hover-media">
                                                <img src="../../img/avatar-mdo.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                                                <div class="media-body text-dark">
                                                        <h6 class="media-header">Archer andu and <strong> 5 others</strong></h6>
                                                        <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                
                                                </div>  
                                        </li>
                                    </a>
                                    <hr class="my-3">
                                    <a href="#" class="text-decoration-none">
                                            <li class="media hover-media">
                                               
                                                    <img src="../../img/avatar-dhg.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                    
                                                    <div class="media-body text-dark">
                                                            <h6 class="media-header">Jchob Thunder and <strong> 1 others</strong></h6>
                                                            <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    
                                                    </div>
                    
                                            </li>
                                        </a>
                                        <hr class="my-3">
                                        <a href="#" class="text-decoration-none">
                                                <li class="media hover-media">          
                                                        <img src="../../img/avatar-fat.jpg" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                                                        <div class="media-body text-dark">
                                                                <h6 class="media-header">Mark Otto and <strong> 3 others</strong></h6>
                                                                <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        
                                                        </div>
                                                </li>
                                            </a>
                                            <hr class="my-3">
                                            <a href="#" class="text-decoration-none">
                                                <li class="media hover-media">
                                                   
                                                        <img src="../../img/avatar-mdo.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                        
                                                        <div class="media-body text-dark">
                                                                <h6 class="media-header">Archer andu and <strong> 5 others</strong></h6>
                                                                <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                        </div>                    
                                               </li>
                                            </a>
                        </ul>
                    </div>
                </div>
</div>
        </div>
    
        <!-------------------------------MOdal Ends---------------------------->
        <?php
function gethashtags($text)
{
//Match the hashtags
preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $text, $matchedHashtags);
$hashtag = '';
// For each hashtag, strip all characters but alpha numeric
if(!empty($matchedHashtags[0])) {
foreach($matchedHashtags[0] as $match) {
$hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match).',';
}
}
//to remove last comma in a string
return rtrim($hashtag, ',');
}
//usage
//$text = "w3lessons.info - #php programming blog, #facebook wall script";
//echo gethashtags($text); //output - php,facebook

function convert_links($message)
{
$parsedMessage = preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#([a-z0-9_]+)/i'), array('<a href="$1" target="_blank">$1</a>', '$1<a href="">@$2</a>', '$1<a href="index.php?hashtag=$2">#$2</a>'), $message);
return $parsedMessage;
}

if(isset($_GET['hashtag']) && $_GET['hashtag'] != '') {
    $tags = trim($_GET['hashtag']);
    $hresult = mysqli_query($conn,"SELECT * FROM `tawasul_posts` WHERE hashtags LIKE '%$tags%' ORDER BY `id` DESC");
    } else {
    $hresult = mysqli_query($conn, "SELECT * FROM `tawasul_posts` WHERE p_privacy='public'");
    }
?>

        <!-----------------------------------Banner/img Starts-------------------->

                    <div class="card card-middle1 mb-4" >
                    <div class="card-header bg-transparent">
                        <center>
                <img src="<?php echo '../../profile/'.$username.'/'.$profile["profile_pic"]; ?>" alt="img" class="rounded-circle" width="80px" height="80px">
                <h3  style="color:#212121"><?php echo $profile['first_name'].' '; echo $profile['last_name'];?><?php if($profile['verified'] == 1){echo ' <img src="../../img/verifyBadge-blue.png">';}?></h3>
                <?php if($profile['bio'] != null){echo '<p style="color:#212121">'.$profile['bio'].'</p>';} else{ echo '<center><p style="color:#212121">There is no bio</p></center>';}?>
                <ul class="list-unstyled nav justify-content-center">
                               <a href="#" class="text-dark text-decoration-none"> <li class="nav-item">Following <br> <strong><?php echo $profile['following_num']; ?></strong></li></a>&nbsp; &nbsp;
                              <a href="#" class="text-dark text-decoration-none"> <li class="nav-item">Followers <br> <strong><?php echo $profile['followers_num']; ?></strong></li></a> 
                            </ul>
                <?php 
                   include('../../system/check_follow.php'); 
                   $myusername = $_SESSION['myusername']; 
                   if($username == $myusername) 
                   {  
                        echo '<br/>';
                        echo '<form action="" method="POST">';
                        echo '<button type="submit" class="myButton" name="edit-profile">Edit Profile</button>';
                        echo '</form>';  
                   } ?>
              </center>
              </div>
            <?php include('../../system/display_user_threads.php'); } ?>
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>