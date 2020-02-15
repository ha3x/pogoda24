<?php
if($_COOKIE["wenc"]=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
{
	if(isset($_POST["clhistory"]))
	{
		echo "
		<meta charset=utf-8><form method=post>
		<style>
		body
		{
			background: black;
		}
		</style>
		<link rel=Stylesheet type=text/css href=css/userIO.css />
		<h2 style=color:white;>Jesteś pewny że chcesz wyczyścić wykres wyświetleń?</h2>
		<h3 style=color:red;>Ta funkcja jest testowa i może prowadzić do nieprzewidzianego zachowania, używaj tylko gdy musisz, na własną odpowiedzialność!</h3>
		<div style=color:yellow;display:inline-block;font-weight:bold;>Powtórz login i hasło, którego używasz do logowania się do panelu:</div><br>
		<input type=text name=cllog value='' id=login placeholder=Login /><br>
		<input type=password name=clpass value='' id=pass placeholder=Hasło /><br>
		<input type=submit name=clconfirm style=color:red;font-weight:bold; value='Usuń!'></input>
		<input type=submit value='Wróć' style=color:green;font-weight:bold; formaction=traffic.php></input><br>
		</form>
		<script>
		setTimeout(function(){
		var pass = document.getElementById('pass');
		var login = document.getElementById('login');
		pass.value='';
		login.value='';
		},100);
		</script>";
	}
	if(isset($_POST["clconfirm"]))
	{
		$Name = $_POST["cllog"];
		$Pass = $_POST["clpass"];
		$enc = hash("sha256",openssl_encrypt($Name.$Pass,"AES-256-CTR","sad0192u1r9hd01294e9j4ujdw9dh82hen2be3u8h",false,"1501131059483502"));
		if($enc=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
		{
		$dir = scandir("pviews/");
		foreach($dir as $item)
		{
			unlink("pviews/".$item);	
		}
		$dir = scandir("paround/");
		foreach($dir as $item)
		{
			unlink("paround/".$item);	
		}
				$lf = fopen("posts/secure/lg","a");
				$hostname = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
				date_default_timezone_set("Europe/Warsaw");
				$date = date("Y-m-d H:i:s");
				
if($_COOKIE["wenc"]=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2"){ $ppref = "[Administrator]"; }else{ $ppref = ""; }
$os = openssl_decrypt($_COOKIE["osprobe"],"AES-256-CTR","HereIsMyData"); 
 fwrite($lf,$pref."[$os][$date][$hostname] Usuwanie historii wyświetleń".PHP_EOL);	
		header("Refresh:0,traffic.php");
		}
		else
		{
			setcookie("wenc",0,1);
			header("Refresh:0,traffic.php");
		}

	}
}
else
{
	setcookie("wenc",0,1);
	header("Refresh:0,index.php");
}
?>
<!-- Skrypt usuwający historię wykresów
