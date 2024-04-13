<?php
//include_once 'tor-check.php';
session_start();
global $author;

function updateUserStatus($userId, $status) {
  $conn = mysqli_connect("localhost", "root", "", "tawasul_db");

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$update_sql = "UPDATE tawasul_users SET online = '$status' WHERE username = '$userId'";
        if ($conn->query($update_sql) === TRUE) {
            echo 'success';
             // Exit script after success
        } else {
            echo 'error';
            // Log the error
            error_log("Error updating post_likes: " . $conn->error);
        }
}

// Set user status to "online" when they log in
if (isset($_SESSION['myusername'])) {
  updateUserStatus($_SESSION['myusername'], '1');
}

// Handle tab closure to set user status to "offline"
if (isset($_SESSION['myusername'])) {
  echo '<script>
      window.addEventListener("beforeunload", function() {
          $.ajax({
              type: "POST",
              url: "./system/update_user_status.php",
              data: { status: "0" },
              async: false, // Make the request synchronous
          });
      });
  </script>';
}

if(!isset($_SESSION['myusername']))
{
    header("Location: login/");
}
else
{
    $username = $_SESSION['myusername'];
    $conn=mysqli_connect("localhost","root","","tawasul_db");
    //include('system/like-post.php');
    $sql = "select * from tawasul_users where username = '$username'";
    $result = $conn->query($sql);

			while ($profile= $result-> fetch_assoc()) {				

?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css\style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<link rel="stylesheet" href="css/application.css">
<link rel="shortcut icon" href="img/favicon.png">
<!------------------LIght BOx for Gallery-------------->
<link rel="stylesheet" href="components\lightbox\lightbox.min.css">
<script type="text/javascript" src="components\lightbox\lightbox-plus-jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .green-dot {
            width: 10px;
            height: 10px;
            background-color: green;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
<!------------------LIght BOx for Gallery-------------->
<title>Tawasul</title>
</head>
<body>
    <!-------------------------------NAvigation Starts------------------>
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Tawasul</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fa fa-home"></i>
          Home
          <span class="sr-only">(current)</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " style='color:#ffffff' href="profile/<?php echo $_SESSION['myusername'];?>">
          <i class="fa fa-user" style='color:#ffffff'>
            
          </i>
          My Profile
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">
          <i class="fa fa-envelope-o">
            <span class="badge badge-warning">11</span>
          </i>
          Disabled
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-envelope-o">
            <span class="badge badge-primary">11</span>
          </i>
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fa fa-bell">
            <span class="badge badge-info">11</span>
          </i>
          Test
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fa fa-globe">
            <span class="badge badge-success">11</span>
          </i>
          Test
        </a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


    <!---------------------------------------------Ends navigation------------------------------>

    <!---------------------------MOdal Section  satrts------------------->

    <div class="modal fade" id="modalview">
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
                                <img src="img/avatar-dhg.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">

                                <div class="media-body text-dark">
                                        <h6 class="media-header">Jchob Thunder and <strong> 1 others</strong></h6>
                                        <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                                </div>
                        </li>
                    </a>
                    <hr class="my-3">

                    <a href="#" class="text-decoration-none">
                            <li class="media hover-media">
                               
                                    <img src="img/avatar-dhg.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
    
                                    <div class="media-body text-dark">
                                            <h6 class="media-header">Mark Otto and <strong> 3 others</strong></h6>
                                            <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    
                                    </div>
    
                            </li>
                        </a>


                        <hr class="my-3">


                        <a href="#" class="text-decoration-none">
                            <li class="media hover-media">
                               
                                    <img src="img/avatar-mdo.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
    
                                    <div class="media-body text-dark">
                                            <h6 class="media-header">Archer andu and <strong> 5 others</strong></h6>
                                            <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    
                                    </div>
    
                            </li>
                        </a>

                        <hr class="my-3">
                        <a href="#" class="text-decoration-none">
                                <li class="media hover-media">
                                        <img src="img/avatar-dhg.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
        
                                        <div class="media-body text-dark">
                                                <h6 class="media-header">Jchob Thunder and <strong> 1 others</strong></h6>
                                                <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                        </div>
                                </li>
                            </a>
                            <hr class="my-3">
        
                            <a href="#" class="text-decoration-none">
                                    <li class="media hover-media">
                                            <img src="img/avatar-fat.jpg" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                                            <div class="media-body text-dark">
                                                    <h6 class="media-header">Mark Otto and <strong> 3 others</strong></h6>
                                                    <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                            </div>
                                    </li>
                                </a>
        
                                <hr class="my-3">
                                <a href="#" class="text-decoration-none">
                                    <li class="media hover-media">
                                            <img src="img/avatar-mdo.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                                            <div class="media-body text-dark">
                                                    <h6 class="media-header">Archer andu and <strong> 5 others</strong></h6>
                                                    <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                            </div>
                                    </li>
                                </a>

                                <hr class="my-3">
                                <a href="#" class="text-decoration-none">
                                        <li class="media hover-media">
                                                <img src="img/avatar-dhg.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                
                                                <div class="media-body text-dark">
                                                        <h6 class="media-header">Jchob Thunder and <strong> 1 others</strong></h6>
                                                        <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </div>
                                        </li>
                                    </a>
                                    <hr class="my-3">
                                    <a href="#" class="text-decoration-none">
                                            <li class="media hover-media">
                                                    <img src="img/avatar-fat.jpg" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
                    
                                                    <div class="media-body text-dark">
                                                            <h6 class="media-header">Mark Otto and <strong> 3 others</strong></h6>
                                                            <p class="media-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    
                                                    </div>
                                            </li>
                                        </a>
                                        <hr class="my-3">
                                        <a href="#" class="text-decoration-none">
                                            <li class="media hover-media">
                                                    <img src="img/avatar-mdo.png" alt="img" width="60px" height="60px" class="rounded-circle mr-3">
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

    <!-------------------------------------------Start Grids layout for lg-xl-3 columns and (xs-lg 1 columns)--------------------------------->

    <div class="container">
        <div class="row">

            <!--------------------------left columns  start-->

            <div class="col-12 col-lg-3">
                <div class="left-column">
                    <div class="card card-left1 mb-4" >
                        <img src="img/photo-1455448972184-de647495d428.jpg" alt="" class="card-img-top img-fluid">
                        <div class="card-body text-center ">
                            <img src="<?php echo 'profile/'.$username.'/'.$profile["profile_pic"]; ?>" alt="img" width="120px" height="120px" class="rounded-circle mt-n5">
                            <br/>
                            <h5 class="card-title"><?php echo $profile['first_name'].'&nbsp;'; echo $profile['last_name'];?><?php if($profile['verified'] == 1){echo ' <img src="img/verifyBadge-blue.png">';}?></h5>
                            <?php if($profile['bio'] != null){echo '<p class="card-text text-justify mb-2">'.$profile['bio'].'</p>';} else{ echo '<center><p class="card-text text-justify mb-2">There is no bio</p></center>';}?>
                            <ul class="list-unstyled nav justify-content-center">
                               <a href="#" class="text-dark text-decoration-none"> <li class="nav-item">Following <br> <strong><?php echo $profile['following_num']; ?></strong></li></a>&nbsp; &nbsp;
                              <a href="#" class="text-dark text-decoration-none"> <li class="nav-item">Followers <br> <strong><?php echo $profile['followers_num']; ?></strong></li></a> 
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-sm card-left2 mb-4">
                        <div class="card-body">
                                <h5 class="mb-3 card-title">About <small><a href="#" class="ml-1">Edit</a></small></h5>
                                <p class="card-text"> <i class="fas fa-home mr-2"></i> Live in <a href="#" class="text-decoration-none"><?php echo $profile['country'];?></a></p>
                        </div>
                    </div>
                    
                    <div class="card shadow-sm card-left3 mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Photos<small class="ml-2"><a href="#">.Edit </a></small></h5>
                            <div class="row">
                                <div class="col-6 p-1">
                                    <a href="img/left1.jpg" data-lightbox="id" ><img src="img/left1.jpg" alt="img" class="img-fluid my-2"></a>  
                                    <a href="img/left2.jpg"data-lightbox="id"><img src="img/left2.jpg" alt="img" class="img-fluid my-2"></a>
                                    <a href="img/left3.jpg"data-lightbox="id"><img src="img/left3.jpg" alt="img" class="img-fluid my-2"></a>
                                </div>

                                <div class="col-6 p-1">
                                        <a href="img/left4.jpg"data-lightbox="id"><img src="img/left4.jpg" alt="img" class="img-fluid my-2"></a>
                                        <a href="img/left5.jpg"data-lightbox="id"><img src="img/left5.jpg" alt="img" class="img-fluid my-2"></a>
                                        <a href="img/left6.jpg"data-lightbox="id"><img src="img/left6.jpg" alt="img" class="img-fluid my-2"></a>
    
                                    </div>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
 <!--------------------------Ends Left columns-->
 <script>
    function updatedata() {
        //preloader
        //$('#post-loader').show();
        var msg = $("#message").val();
        var pri = $("#privacy").val();
        if(msg != '') {
        $.ajax({
        type: "POST",
        url: "./system/post_thread.php",
        data: 'msg='+msg+'&pri='+pri,
        cache: false,
        success: function(html) {
        toastr.success('Thread Posted Successfully !!!');
        $("#message").val('');
        },
        error: function() {
        //$('#post-loader').hide();
        alert("error occured !!!" +error);
        }
        });
        return false;
        } else {
        alert("Message cannot be empty!");
        return false;
        }
    }
    function like_post() {
    var postid = $("#post_id").val();
    if(postid != ''){
    $.ajax({
        type: "POST",
        url: "./system/like-post.php",
        data: 'post_id=' + postid + '&type=like',
        cache: false,
        success: function (response) {
            if (response === 'success') {
                toastr.success('Post Liked !!!');
            } else {
                toastr.error('Failed !!!');
            }
        },
        error: function () {
            toastr.error('Failed !!!');
        }
    });
    return false;
}
}
    function dislike_post()
    {
        var postid = $("#post_id").val();
        $.ajax({
            type: "POST",
            url: "./system/like-post.php",
            data: 'post_id='+postid+'type=dislike',
            cache: false,
            success: function(html) {
             
            },
            error: function()
            {

            }
        });
        return false;
    }
    // Simulate user status (replace this with your actual logic)
    var userStatus = localStorage.getItem("isOnline");

// Function to update the green dot based on user status
// Function to update the green dot based on user status
function updateStatusIndicator() {
    // Select elements with the class "statusIndicator"
    $(".statusIndicator").each(function() {
        if (userStatus === 1) {
            $(this).addClass("green-dot");
        } else {
            $(this).removeClass("green-dot");
        }
    });
}
</script>
 <!---------------------------------------Middle columns  start---------------->

            <div class="col-12 col-lg-6" >
                <div class="middle-column">
                    <div class="card" >
                        <div class="card-header bg-transparent">
                        <form action="" method="POST" onsubmit="return htag.save()">
                                    <textarea class="form__input" id="message" name="message" rows="2" maxlength="350"></textarea>
                                    <div class="container">
                                    
                                      <select id="privacy" class="form__input" name="privacy">
                                         <option selected value="public">Public</option>
                                         <option value="followers-only">Followers only</option>
                                         <option value="private">Private</option>
                                      </select>
                                    &emsp; &nbsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;<div type="button" name="action" onclick="updatedata()" class="btn--info button-l margin-b">Post Thread</div>
                                   </div>
                                 
                        </form>
                                </div>                                    
<?php include('system/display_all_threads.php'); }}?>
 </div>
 </div>
  </div>
  
  <br> <br> <br><br> <br> <br>

<!------------------------Middle column Ends---------------->

<!---------------------------Statrs Right Columns----------------->

<div class="col-12 col-lg-3">
    <div class="right-column">
        <div class="card shadow-sm mb-4" >
            <div class="card-body">
                <h6 class="card-title">Sponsored</h6>
                <img src="img/right1.jpg" alt="card-img" class="card-img mb-3">
                <p class="card-text text-justify"> <span class="h6">It might be time to visit Iceland.</span> Iceland is so chill, and everything looks cool here. Also, we heard the people are pretty nice.  What are you waiting for?</p>
                <a href="#" class="btn btn-outline-info card-link btn-sm">Buy a ticket</a>
            </div>
        </div>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                  <h6 class="card-title ">Likes <a href="#" class="ml-1"><small>.View All</small> </a> </h6>
                    <div class="row no-gutters d-none d-lg-flex">
                        <div class="col-6 p-1">
                                <img src="img/avatar-dhg.png" alt="img" width="80px" height="80px" class="rounded-circle mb-4">
                                <img src="img/avatar-fat.jpg" alt="img" width="80px" height="80px" class="rounded-circle">

                        </div>
                        <div class="col-6 p-1 text-left">
                            <h6>Jacob Thornton @fat</h6>
                            <a href="#" class="btn btn-outline-info btn-sm mb-3"><i class="fas fa-user-friends"></i>Follow </a>

                            <h6>Mark otto</h6>
                            <a href="#" class="btn btn-outline-info  btn-sm"><i class="fas fa-user-friends"></i>Follow </a>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <p class="lead" style="font-size:18px;">Dave really likes these nerds, no one knows why though.</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <p>&copy; 2018 Bootstrap
                        <a href="#">About</a>
                        <a href="#">Help</a>
                        <a href="#">Terms</a>
                        <a href="#">Privacy</a>
                        <a href="#">Cookies</a>
                        <a href="#">Ads </a>
                        <a href="#">Info</a>
                        <a href="#">Brand</a>
                        <a href="#">Blog</a>
                        <a href="#">Status</a>
                        <a href="#">Apps</a>
                        <a href="#">Jobs</a>
                        <a href="#">Advertise</a>
                </p>
            </div>

        </div>
    </div>
            </div>
</div>

<!------------------------Light BOx OPtions------------->
<script> lightbox.option({ }) </script>
<!------------------------Light BOx OPtions------------->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> -->

<?php include('system/post_thread.php'); ?>
</body>
</html>