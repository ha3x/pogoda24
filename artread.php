<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
		<?php
		if(isset($_GET["art"]))
		{
			$raw = file("posts/raw/".$_GET["art"]);
			$raw1 = substr($raw[0],0,50);
			$art = $_GET["art"];
			echo "<title>$raw1 - E-Pogoda24</title>";
		}
		else
		{
			$art = "BRAK";
			echo "<title>E-Pogoda24 - Strona Oficjalna</title>";
		}
		?>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="Stylesheet" type="text/css" href="css/newstyle.css" />
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
				<?php
				date_default_timezone_set("Europe/Warsaw");
				$date = date("Y-m-d H:i:s");
				if(isset($_GET["art"]))
				{
					$art = $_GET["art"];
				}
				else
				{
					$art = "none";
				}
				if(file_exists("posts/full/".$art))
				{		
					$views = fopen("posts/views/".$art,"a");
					$vc = file("posts/views/".$art);
					$vk = $vc[0];
					if($vk=="")
					{
						$vk = 0;
					}
					$vd = $vk+1;
					if(isset($_COOKIE["wenc"]))
					{
					$enc = $_COOKIE["wenc"];
					}
					if($enc!="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
					{
					$viewsw = fopen("posts/views/".$art,"w");
					fwrite($viewsw,$vd);
					}
					$file = file("posts/full/".$art);
					for($x=0;$x<count($file);$x++)
					{
						echo $file[$x]."<br>";
					}
if($enc!="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
{
date_default_timezone_set("Europe/Warsaw");
$d = date("Y-m-d");
$d2 = date("Ymd");
if(!file_exists("pviews/".$d))
{
$file = fopen("pviews/".$d,"w");
fwrite($file,$d2.PHP_EOL."1");
}
else
{
	$file = file("pviews/".$d);
	$v = $file[1];
	$file = fopen("pviews/".$d,"w");
$d2 = date("Ymd");
	$v = $v+1;
	fwrite($file,$d2.PHP_EOL.$v);
}
}
				}
				else
				{
					echo "<h3 class=hh>Nie znaleziono wpisu!</h3>";
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
