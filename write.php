<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>E-Pogoda24 - Panel Administracyjny</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="Stylesheet" type="text/css" href="css/newstyle.css" />
	<link rel="Stylesheet" type="text/css" href="css/userIO.css" />
	<link rel="icon" href="img/favicon.png" />
</head>

<body>
	<script>
			if(window.location.href.indexOf('https')==-1)
			{
				if(window.location.href.indexOf('localhost')==-1)
				{
					window.location.replace(window.location.href.replace('http','https'));
				}
			}
	</script>

	<div class="topBar">
		<div class="barTitle"><a class="mainLink" href="index.php"><img width=32 height=32 style="margin-bottom:-8px;" src="img/logoimg.jpg"></img> E-Pogoda24</div></a>
		<div class="barMenu">
			<ul class="barMenuUl">

				<li><a href="about.php">O Nas</a></li>

				<li><a href="ciekawostki.php">Ciekawostki</a></li>
				<li><a href="prognozy.php">Ostrzeżenia i Prognozy</a>
			</ul>
		</div>
	</div>
	<div class="truecontent">	
		<img src="img/bg.jpg" class="bgimg" ></img>
			<div class="onetab" style="display:none;" ><div class="onetabColored"><div style="font-weight:bold;font-size: 19px; border-bottom: 1px solid gray;">Ciekawostki:</div></div>

			</div>
			<div class="post center" style="background: gray;" >
			<?php
			if(isset($_COOKIE["wenc"]))
			{
				if($_COOKIE["wenc"]=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
				{
				$hostname = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
				date_default_timezone_set("Europe/Warsaw");
				$date = date("Y-m-d H:i:s");
				
					if(isset($_GET["cmd"]) && $_GET["cmd"]=="logout")
					{
						setcookie("wenc",0,1);
						header("Refresh:0,write.php");
					}
					else
					{

					echo "
					<a href='generator/generator.php'><img class='panelIcon' src='img/generator.png'></img></a>
					<a href='writer.php'><img class='panelIcon' style='margin-bottom: 4px;' src='img/new.png'></img></a>
					<a href='elist.php'><img class='panelIcon' src='img/elist.png'></img></a>
					<a href='traffic.php'><img class='panelIcon' src='img/pstats.png'></img></a>
					<a href='write.php?cmd=logout'><img class='panelIcon' style='margin-bottom: 20px;' src='img/logout.png'></img></a>
					
					
					";
				}
				}
				else
				{
					setcookie("wenc",0,1);
					echo "
					<h3 class=hh style=color:red>Wprowadzone dane są niepoprawne!</h3>
					<form method=post>
					<input class=ftext1 type=text name=wname required placeholder=Login:></input><br>
					<input class=ftext1 type=password name=wpass required placeholder=Hasło:></input><Br>
					<input type=submit class=fbtn1 value=Wyślij></input></form>";	
				}
			}
			elseif(isset($_POST["wpass"]))
			{
				$Name = $_POST["wname"];
				$Pass = $_POST["wpass"];
				$enc = hash("sha256",openssl_encrypt($Name.$Pass,"AES-256-CTR","sad0192u1r9hd01294e9j4ujdw9dh82hen2be3u8h",false,"1501131059483502"));
				$jc = json_encode($enc);
				if($enc=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
				{
					setcookie("wenc",$enc,time()+86400);
					header("Refresh:0");
				}
				else
				{
					echo "
					<h3 class=hh style=color:red>Wprowadzone dane są niepoprawne!</h3>
					<form method=post>
					<input class=ftext1 type=text style='color:black;' name=wname required placeholder=Login:></input><br>
					<input class=ftext1 type=password style='color:black;' name=wpass required placeholder=Hasło:></input><Br>
					<input type=submit class=fbtn1 value=Wyślij></input></form>";	
				}
			}
			else
			{
				echo "
				<h3 class=hh>Podaj login i hasło do panelu:</h3>
				<form method=post>
				<input class=ftext1 type=text style='color:black;' name=wname required placeholder=Login:></input><br>
					<input class=ftext1 type=password style='color:black;' name=wpass required placeholder=Hasło:></input><Br>
				<input type=submit class=fbtn1 value=Wyślij></input></form>";
			}
			
			?>
			</div>
		<div class="copyright">Copyright &copy; 2019 by Pogoda24/7 </div>
		</div>
			<div class="bar_holder">
			<?php
			if(!file_exists("posts/warns/main.dat"))
			{
				$wf = fopen("posts/warns/main.dat","a");
			}
			$wfile = file("posts/warns/main.dat");
			date_default_timezone_set("Europe/Warsaw");
			$cdate = date("Ymd");
			$date = substr($wfile[0],0,strlen($wfile[0])-1);
			if($cdate>$date)
			{
				echo "<di class='bar_text'>Brak ostrzeżeń</di>";
			}
			else
			{
				echo "<di class='bar_text'>".$wfile[1]."</di>";
			}
			?>
			</div>
</body>

</html>
