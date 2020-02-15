<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>E-Pogoda24 - Strona Oficjalna</title>
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
			<div class="onetab" >

				<h3 class="hh">Wyładowania</h3>
<img width=80% style="margin-bottom:20px;" src="http://images.blitzortung.org/Images/image_b_pl.png?t=25180377" ></img>			
				<h3 class="hh">Zachmurzenie (Sat24)</h3>
<img width=80% style="margin-bottom:20px;" src="https://api.sat24.com/animated/PL/visual/1/Central%20European%20Standard%20Time/7296177" ></img>			
				<h3 class="hh">Opady (Sat24)</h3>
<img width=80% src="https://api.sat24.com/animated/PL/rainTMC/1/Central%20European%20Standard%20Time/847023" ></img>	
			</div>
			<?php
			$dir = scandir("posts/short/");
			rsort($dir);
			for($x=0;$x<5;$x++)
			{
				if($dir[$x]!="." && $dir[$x]!=".." && $dir[$x]!=null )
				{
					echo "<div class=post>";
					$file = file("posts/short/".$dir[$x]);
					for($y=0;$y<count($file);$y++)
					{
						echo $file[$y]."<br>";
					}
					echo "</div>";
				}
				
			}
			?>
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
