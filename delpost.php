<?php
if($_COOKIE["wenc"]=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
{
	$post = $_GET["post"];
	unlink("posts/short/".$post);
	unlink("posts/full/".$post);
	unlink("posts/views/".$post);
	unlink("posts/raw/".$post);
	if(isset($_GET["debug"]))
	{
				$lf = fopen("posts/secure/lg","a");
				$hostname = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
				date_default_timezone_set("Europe/Warsaw");
				$date = date("Y-m-d H:i:s");
				
$os = openssl_decrypt($_COOKIE["osprobe"],"AES-256-CTR","HereIsMyData"); 
 fwrite($lf,$pref."[$os][$date][$hostname] Usuwanie posta $post".PHP_EOL);	
	header("Refresh:0,performance.php");	
	}
	else
	{
				$lf = fopen("posts/secure/lg","a");
				$hostname = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
				date_default_timezone_set("Europe/Warsaw");
				$date = date("Y-m-d H:i:s");
				
if($_COOKIE["wenc"]=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2"){ $ppref = "[Administrator]"; }else{ $ppref = ""; }
$os = openssl_decrypt($_COOKIE["osprobe"],"AES-256-CTR","HereIsMyData"); 
 fwrite($lf,$pref."[$os][$date][$hostname] Usuwanie posta $post".PHP_EOL);	
	header("Refresh:0,elist.php");
	}
}
else
{
	setcookie("wenc",0,1);
	header("Refresh:0,index.php");
}
?>
<!--Skrypt odpowiadający za usuwanie postów, oraz ich danych