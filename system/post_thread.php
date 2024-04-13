<?php
// Start session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

if(isset($_POST['msg']))
{
//$content = $_POST['content'];
$privacy = $_POST['pri'];
$message = strip_tags(trim($_POST['msg']));
//get hashtag from message
$hashtag = gethashtags($message);
$date = date("D/m/y");
$username = $_SESSION['myusername'];


$conn=mysqli_connect("localhost","root","","tawasul_db");
$sql = "INSERT INTO tawasul_posts(author, p_content, hashtags, p_date, p_likes, p_replies, p_reposts, p_views, p_privacy) VALUES ('$username','$message','$hashtag','$date',0,0,0,0,'$privacy')";
if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>toastr.success('Thread Posted Successfully !!!')</script>";
} else {
    echo "<script type='text/javascript'>toastr.danger('".$sql."<br>".$conn->error."')</script>";
}
}
?>