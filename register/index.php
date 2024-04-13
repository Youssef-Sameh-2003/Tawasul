<?php
if (isset($_POST["submit"])) {
	//error_reporting(1);

	$conn=mysqli_connect("localhost","root","","tawasul_db");
	$first_name= $_POST['fname'];
	$last_name = $_POST['lname'];
    $username = $_POST['username'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$cnf_pass = $_POST['cnf-pass'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
	extract($_POST);

	if ($cnf_pass == $pass) {

        $enc_pass = sha1(md5($pass));

		mkdir("../profile/$username");
		mkdir("../profile/$username/profile_pic");
		$target_pic_dir = "../profile/$username/profile_pic/";
        $target_dir = "../profile/$username/";

		$sql = "INSERT INTO tawasul_users(first_name, last_name, username, email, password, country, gender, dob, profile_pic, cover_pic, bio, followers_num, following_num, verified, online) VALUES ('$first_name','$last_name', '$username', '$email','$enc_pass','$country', '$gender', '$dob', '/profile_pic/image.png','','',0,0,0,0)";

		if ($conn->query($sql) === TRUE) {
			echo "<div class='alert alert-success' role='alert'>Account Created Successfully !!! Redirecting To Your Home Page in 5 Seconds...</div>";
		} else {
			echo "<div class='alert alert-danger' role='alert'>".$sql."<br>".$conn->error."</div>";
		}
        $myfile = fopen("$target_dir/index.php", "w");
			$txt = "<?php ";
			fwrite($myfile, $txt);
			$txt='include "../profile_template_php/template.php";';
			fwrite($myfile, $txt);
			$txt="?>";
			fwrite($myfile, $txt);
			fclose($myfile);
		    copy("../profile/profile_placeholder_img/image.png",$target_pic_dir."/image.png");
		sleep(10);
		header("Location: ../login/index.php");
	}
	else
	{
		echo "<div class='alert alert-danger' role='alert'>Passwords Does not Match !!!</div>";
	}
}
?>
<html>
  <head>
  <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="..\css\style.css">
<link rel="stylesheet" href="../css/application.css">
    <link rel="shortcut icon" href="../img/favicon.png">
<!------------------LIght BOx for Gallery-------------->
<link rel="stylesheet" href="..\components\lightbox\lightbox.min.css">
<script type="text/javascript" src="..\components\lightbox\lightbox-plus-jquery.min.js"></script>
<!------------------LIght BOx for Gallery-------------->
    <title>Tawasul - Registration</title>
<style>
			html {
    height: 100%;
}
body {
    height: 100%;
    margin: 0;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

/* Text Align */
.text-c {
    text-align: center;
}
.text-l {
    text-align: left;
}
.text-r {
    text-align: right
}
.text-j {
    text-align: justify;
}

/* Text Color */
.text-whitesmoke {
    color: whitesmoke
}
.text-darkyellow {
    color: rgba(255, 235, 59, 0.432)
}

/* Lines */

.line-b {
    border-bottom: 1px solid #FFEB3B !important;
}

/* Buttons */
.button {
    border-radius: 3px;
}
.form-button {
    background-color: rgba(255, 235, 59, 0.24);
    border-color: rgba(255, 235, 59, 0.24);
    color: #e6e6e6;
}
.form-button:hover,
.form-button:focus,
.form-button:active,
.form-button.active,
.form-button:active:focus,
.form-button:active:hover,
.form-button.active:hover,
.form-button.active:focus {
    background-color: rgba(255, 235, 59, 0.473);
    border-color: rgba(255, 235, 59, 0.473);
    color: #e6e6e6;
}
.button-l {
    width: 100% !important;
}

/* Margins g(global) - l(left) - r(right) - t(top) - b(bottom) */

.margin-g {
    margin: 15px;
}
.margin-g-sm {
    margin: 10px;
}
.margin-g-md {
    margin: 20px;
}
.margin-g-lg {
    margin: 30px;
}

.margin-l {
    margin-left: 15px;
}
.margin-l-sm {
    margin-left: 10px;
}
.margin-l-md {
    margin-left: 20px;
}
.margin-l-lg {
    margin-left: 30px;
}

.margin-r {
    margin-right: 15px;
}
.margin-r-sm {
    margin-right: 10px;
}
.margin-r-md {
    margin-right: 20px;
}
.margin-r-lg {
    margin-right: 30px;
}

.margin-t {
    margin-top: 15px;
}
.margin-t-sm {
    margin-top: 10px;
}
.margin-t-md {
    margin-top: 20px;
}
.margin-t-lg {
    margin-top: 30px;
}

.margin-b {
    margin-bottom: 15px;
}
.margin-b-sm {
    margin-bottom: 10px;
}
.margin-b-md {
    margin-bottom: 20px;
}
.margin-b-lg {
    margin-bottom: 30px;
}

/* Bootstrap Form Control Extension */

.form-control,
.border-line {
    background-color: #5f5f5f;
    background-image: none;
    border: 1px solid #424242;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
}
.form-control:focus,
.border-line:focus {
    border-color: #FFEB3B;
    background-color: #616161;
    color: #e6e6e6;
}
.form-control,
.form-control:focus {
    box-shadow: none;
}
.form-control::-webkit-input-placeholder { color: #BDBDBD; }

/* Container */

.container-content {
    background-color: #3a3a3aa2;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #FFEB3B;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
}

/* Backgrounds */

.main-bg {

    background: #424242;
    background: linear-gradient( #424242, #212121);
}

/* Login & Register Pages*/

.login-container {
    max-width: 400px;
    z-index: 100;
    margin: 0 auto;
    padding-top: 100px;
}
.login.login-container {
    width: 300px;
}
.wrapper.login-container {
    margin-top: 140px;
}
.logo-badge {
    color: #e6e6e6;
    font-size: 80px;
    font-weight: 800;
    letter-spacing: -10px;
    margin-bottom: 0;
}
		</style>
</head>
<body class="main-bg">
        <div class="login-container text-c animated flipInX">
                <div>
                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                </div>
                    <h3 class="text-whitesmoke">Register</h3>
                    <p class="text-whitesmoke">Tawasul Registration</p>
                <div class="container-content">
                    <form action="" method="POST" class="margin-t">
                        <div class="form-group">
                            <input type="text" class="form__input" placeholder="first name" name="fname" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form__input" placeholder="last name" name="lname" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form__input" placeholder="username" name="username" required="">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form__input" placeholder="email" name="email" required="">
                        </div>
                        <div class="form-group">
                        <label style="color:#e6e6e6">Password :</label>
                            <input type="password" class="form__input" placeholder="*****" name="pass" required="">
                        </div>
                        <label style="color:#e6e6e6">Confirm Password :</label>
                        <div class="form-group">
                            <input type="password" class="form__input" placeholder="*****" name="cnf-pass" required="">
                        </div>
                        <div class="form-group">
                        <select class="form__input" id="country" name="country">
    <option selected>select country</option>
    <option value="AF">Afghanistan</option>
    <option value="AX">Aland Islands</option>
    <option value="AL">Albania</option>
    <option value="DZ">Algeria</option>
    <option value="AS">American Samoa</option>
    <option value="AD">Andorra</option>
    <option value="AO">Angola</option>
    <option value="AI">Anguilla</option>
    <option value="AQ">Antarctica</option>
    <option value="AG">Antigua and Barbuda</option>
    <option value="AR">Argentina</option>
    <option value="AM">Armenia</option>
    <option value="AW">Aruba</option>
    <option value="AU">Australia</option>
    <option value="AT">Austria</option>
    <option value="AZ">Azerbaijan</option>
    <option value="BS">Bahamas</option>
    <option value="BH">Bahrain</option>
    <option value="BD">Bangladesh</option>
    <option value="BB">Barbados</option>
    <option value="BY">Belarus</option>
    <option value="BE">Belgium</option>
    <option value="BZ">Belize</option>
    <option value="BJ">Benin</option>
    <option value="BM">Bermuda</option>
    <option value="BT">Bhutan</option>
    <option value="BO">Bolivia</option>
    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
    <option value="BA">Bosnia and Herzegovina</option>
    <option value="BW">Botswana</option>
    <option value="BV">Bouvet Island</option>
    <option value="BR">Brazil</option>
    <option value="IO">British Indian Ocean Territory</option>
    <option value="BN">Brunei Darussalam</option>
    <option value="BG">Bulgaria</option>
    <option value="BF">Burkina Faso</option>
    <option value="BI">Burundi</option>
    <option value="KH">Cambodia</option>
    <option value="CM">Cameroon</option>
    <option value="CA">Canada</option>
    <option value="CV">Cape Verde</option>
    <option value="KY">Cayman Islands</option>
    <option value="CF">Central African Republic</option>
    <option value="TD">Chad</option>
    <option value="CL">Chile</option>
    <option value="CN">China</option>
    <option value="CX">Christmas Island</option>
    <option value="CC">Cocos (Keeling) Islands</option>
    <option value="CO">Colombia</option>
    <option value="KM">Comoros</option>
    <option value="CG">Congo</option>
    <option value="CD">Congo, Democratic Republic of the Congo</option>
    <option value="CK">Cook Islands</option>
    <option value="CR">Costa Rica</option>
    <option value="CI">Cote D'Ivoire</option>
    <option value="HR">Croatia</option>
    <option value="CU">Cuba</option>
    <option value="CW">Curacao</option>
    <option value="CY">Cyprus</option>
    <option value="CZ">Czech Republic</option>
    <option value="DJ">Djibouti</option>
    <option value="DM">Dominica</option>
    <option value="DO">Dominican Republic</option>
    <option value="EC">Ecuador</option>
    <option value="EG">Egypt</option>
    <option value="SV">El Salvador</option>
    <option value="GQ">Equatorial Guinea</option>
    <option value="ER">Eritrea</option>
    <option value="EE">Estonia</option>
    <option value="ET">Ethiopia</option>
    <option value="FK">Falkland Islands (Malvinas)</option>
    <option value="FO">Faroe Islands</option>
    <option value="FJ">Fiji</option>
    <option value="FI">Finland</option>
    <option value="FR">France</option>
    <option value="GF">French Guiana</option>
    <option value="PF">French Polynesia</option>
    <option value="TF">French Southern Territories</option>
    <option value="GA">Gabon</option>
    <option value="GM">Gambia</option>
    <option value="GE">Georgia</option>
    <option value="DE">Germany</option>
    <option value="GH">Ghana</option>
    <option value="GI">Gibraltar</option>
    <option value="GR">Greece</option>
    <option value="GL">Greenland</option>
    <option value="GD">Grenada</option>
    <option value="GP">Guadeloupe</option>
    <option value="GU">Guam</option>
    <option value="GT">Guatemala</option>
    <option value="GG">Guernsey</option>
    <option value="GN">Guinea</option>
    <option value="GW">Guinea-Bissau</option>
    <option value="GY">Guyana</option>
    <option value="HT">Haiti</option>
    <option value="HM">Heard Island and Mcdonald Islands</option>
    <option value="VA">Holy See (Vatican City State)</option>
    <option value="HN">Honduras</option>
    <option value="HK">Hong Kong</option>
    <option value="HU">Hungary</option>
    <option value="IS">Iceland</option>
    <option value="IN">India</option>
    <option value="ID">Indonesia</option>
    <option value="IR">Iran, Islamic Republic of</option>
    <option value="IQ">Iraq</option>
    <option value="IE">Ireland</option>
    <option value="IM">Isle of Man</option>
    <option value="IT">Italy</option>
    <option value="JM">Jamaica</option>
    <option value="JP">Japan</option>
    <option value="JE">Jersey</option>
    <option value="JO">Jordan</option>
    <option value="KZ">Kazakhstan</option>
    <option value="KE">Kenya</option>
    <option value="KI">Kiribati</option>
    <option value="KP">Korea, Democratic People's Republic of</option>
    <option value="KR">Korea, Republic of</option>
    <option value="XK">Kosovo</option>
    <option value="KW">Kuwait</option>
    <option value="KG">Kyrgyzstan</option>
    <option value="LA">Lao People's Democratic Republic</option>
    <option value="LV">Latvia</option>
    <option value="LB">Lebanon</option>
    <option value="LS">Lesotho</option>
    <option value="LR">Liberia</option>
    <option value="LY">Libyan Arab Jamahiriya</option>
    <option value="LI">Liechtenstein</option>
    <option value="LT">Lithuania</option>
    <option value="LU">Luxembourg</option>
    <option value="MO">Macao</option>
    <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
    <option value="MG">Madagascar</option>
    <option value="MW">Malawi</option>
    <option value="MY">Malaysia</option>
    <option value="MV">Maldives</option>
    <option value="ML">Mali</option>
    <option value="MT">Malta</option>
    <option value="MH">Marshall Islands</option>
    <option value="MQ">Martinique</option>
    <option value="MR">Mauritania</option>
    <option value="MU">Mauritius</option>
    <option value="YT">Mayotte</option>
    <option value="MX">Mexico</option>
    <option value="FM">Micronesia, Federated States of</option>
    <option value="MD">Moldova, Republic of</option>
    <option value="MC">Monaco</option>
    <option value="MN">Mongolia</option>
    <option value="ME">Montenegro</option>
    <option value="MS">Montserrat</option>
    <option value="MA">Morocco</option>
    <option value="MZ">Mozambique</option>
    <option value="MM">Myanmar</option>
    <option value="NA">Namibia</option>
    <option value="NR">Nauru</option>
    <option value="NP">Nepal</option>
    <option value="NL">Netherlands</option>
    <option value="AN">Netherlands Antilles</option>
    <option value="NC">New Caledonia</option>
    <option value="NZ">New Zealand</option>
    <option value="NI">Nicaragua</option>
    <option value="NE">Niger</option>
    <option value="NG">Nigeria</option>
    <option value="NU">Niue</option>
    <option value="NF">Norfolk Island</option>
    <option value="MP">Northern Mariana Islands</option>
    <option value="NO">Norway</option>
    <option value="OM">Oman</option>
    <option value="PK">Pakistan</option>
    <option value="PW">Palau</option>
    <option value="PS">Palestine</option>
    <option value="PA">Panama</option>
    <option value="PG">Papua New Guinea</option>
    <option value="PY">Paraguay</option>
    <option value="PE">Peru</option>
    <option value="PH">Philippines</option>
    <option value="PN">Pitcairn</option>
    <option value="PL">Poland</option>
    <option value="PT">Portugal</option>
    <option value="PR">Puerto Rico</option>
    <option value="QA">Qatar</option>
    <option value="RE">Reunion</option>
    <option value="RO">Romania</option>
    <option value="RU">Russian Federation</option>
    <option value="RW">Rwanda</option>
    <option value="BL">Saint Barthelemy</option>
    <option value="SH">Saint Helena</option>
    <option value="KN">Saint Kitts and Nevis</option>
    <option value="LC">Saint Lucia</option>
    <option value="MF">Saint Martin</option>
    <option value="PM">Saint Pierre and Miquelon</option>
    <option value="VC">Saint Vincent and the Grenadines</option>
    <option value="WS">Samoa</option>
    <option value="SM">San Marino</option>
    <option value="ST">Sao Tome and Principe</option>
    <option value="SA">Saudi Arabia</option>
    <option value="SN">Senegal</option>
    <option value="RS">Serbia</option>
    <option value="CS">Serbia and Montenegro</option>
    <option value="SC">Seychelles</option>
    <option value="SL">Sierra Leone</option>
    <option value="SG">Singapore</option>
    <option value="SX">Sint Maarten</option>
    <option value="SK">Slovakia</option>
    <option value="SI">Slovenia</option>
    <option value="SB">Solomon Islands</option>
    <option value="SO">Somalia</option>
    <option value="ZA">South Africa</option>
    <option value="GS">South Georgia and the South Sandwich Islands</option>
    <option value="SS">South Sudan</option>
    <option value="ES">Spain</option>
    <option value="LK">Sri Lanka</option>
    <option value="SD">Sudan</option>
    <option value="SR">Suriname</option>
    <option value="SJ">Svalbard and Jan Mayen</option>
    <option value="SZ">Swaziland</option>
    <option value="CH">Switzerland</option>
    <option value="SY">Syrian Arab Republic</option>
    <option value="TW">Taiwan, Province of China</option>
    <option value="TJ">Tajikistan</option>
    <option value="TZ">Tanzania, United Republic of</option>
    <option value="TH">Thailand</option>
    <option value="TL">Timor-Leste</option>
    <option value="TG">Togo</option>
    <option value="TK">Tokelau</option>
    <option value="TO">Tonga</option>
    <option value="TT">Trinidad and Tobago</option>
    <option value="TN">Tunisia</option>
    <option value="TR">Turkey</option>
    <option value="TM">Turkmenistan</option>
    <option value="TC">Turks and Caicos Islands</option>
    <option value="TV">Tuvalu</option>
    <option value="UG">Uganda</option>
    <option value="UA">Ukraine</option>
    <option value="AE">United Arab Emirates</option>
    <option value="GB">United Kingdom</option>
    <option value="US">United States</option>
    <option value="UM">United States Minor Outlying Islands</option>
    <option value="UY">Uruguay</option>
    <option value="UZ">Uzbekistan</option>
    <option value="VU">Vanuatu</option>
    <option value="VE">Venezuela</option>
    <option value="VN">Viet Nam</option>
    <option value="VG">Virgin Islands, British</option>
    <option value="VI">Virgin Islands, U.s.</option>
    <option value="WF">Wallis and Futuna</option>
    <option value="EH">Western Sahara</option>
    <option value="YE">Yemen</option>
    <option value="ZM">Zambia</option>
    <option value="ZW">Zimbabwe</option>
</select>
                        </div>
                        <div class="form-group">
                            <select class="form__input"  name="gender" required="">
                                <option selected >Select Your Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="color:#e6e6e6">Date of birth :</label>
                            <input type="date" class="form__input" placeholder="Date of Birth" name="dob" required="">
                        </div>
                        <button type="submit" class="btn--default button-l margin-b" name="submit">Create Account</button>
                    </form>
                    <p class="margin-t text-whitesmoke"><small> Tawasul &copy; 2023</small> </p>
                </div>
            </div>
</body>
</html>