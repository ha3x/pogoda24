<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>E-Pogoda24 - O Nas</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="Stylesheet" type="text/css" href="css/newstyle.css" />
	<link rel="Stylesheet" type="text/css" href="css/ekipa.css" />
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
			<div class="post">
<img class="ekipaImg" width="96" height="96" src="img/sb.jpg"><div class="personRow">Sebastian- Synoptyk meteo, a także obserwator burz. Już od wczesnych lat kochał obserwować pogodę, a najbardziej nocne burze. Z biegiem lat dostał szansę rozwoju swojej pasji w Sieci Obserwatorów Burz gdzie obecnie jest obserwatorem burz (S184). Prywatnie Sebastian pasjonuje się ratownictwem. Jako jedyny twierdzi, że burze są jak kobiety, nieprzewidywalne.<br>
</div><br>
<img class="ekipaImg" width="96" height="96" src="img/ak.jpg"><div class="personRow">Adrian- Synoptyk meteo, a także obserwator burz w Śląscy Obserwatorzy Burz. Prywatnie Adrian pasjonuje sie fotografią.<br>
</div><br>
<div class="personRow">Milena- Osoba Techniczna, a także obserwator burz. Prywatnie Milena kocha pisać wiersze.<br>
</div><br>
<div class="personRow">Wojtek- Osoba Techniczna a także obserwator burz. Prywatnie Wojtek pasjonuje się informatyką<br>
</div>
			
			
			
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
