<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>E-Pogoda24 - Panel Administracyjny</title>
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
			</div>
<?php
if($_COOKIE["wenc"]=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
{
				date_default_timezone_set("Europe/Warsaw");
				$date = date("Y-m-d H:i:s");
				
			date_default_timezone_set("Europe/Warsaw");
$d = date("Y-m-d");
$d2 = date("Ymd");
if(!file_exists("pviews/".$d))
{
$file = fopen("pviews/".$d,"w");
fwrite($file,$d2.PHP_EOL."0");
}
			$dir = scandir("posts/views");
			for($x=2;$x<count($dir);$x++)
			{
				$d = $x-2;
				$file = file("posts/views/".$dir[$x]);
				$cnt[$d] = $file[0];
				$kt = $file[0];
			}
			for($x=0;$x<count($cnt);$x++)
			{
				$kt = $kt + $cnt[$x+1];
			}
			$rnd = round($kt/count($cnt));
			$v = file("posts/allv.dat");
			$v = $v[0];
			if($v=="")
			{
				$v=0;
			}
			if($kt=="")
			{
				$kt=0;
			}
			$cnt = scandir("posts/full");
			$cnt = count($cnt)-2;
			
echo "<div class=post_flen><div class=bold>
Średnia liczba wyświetleń wszystkich postów: $rnd<br>
Całkowita liczba wyświetleń wszystkich postów: $kt<br>
Całkowita liczba wszystkich postów: $cnt<br>
Liczba odwiedzin na stronie głównej: $v<br><br>";
$dir = scandir("pviews/");
for($x=2;$x<count($dir);$x++)
{
	$viewf = file("pviews/".$dir[$x]);
	$view[$x-2] = $viewf[1];
}
for($x=0;$x<count($view);$x++)
{
	$sum = $sum + $view[$x];
}
$datemin = $dir[2];
$datemax = $dir[count($dir)-1];
if($datemin=="")
{
	$datemin = date("Y-m-d");
}
if($datemax=="..")
{
	$datemax = date("Y-m-d");
}
echo "Wykres wyświetleń od ".$datemin." do ".$datemax."<br>
Łączna liczba wyświetleń w tym okresie: $sum<br>
Liczba wyświetleń dzisiaj: $viewf[1] <br>
<a href=elist.php style=color:blue;font-weight:bold>Liczba wyświetleń według postów</a><Br>
<br>
<noscript style=color:orange;font-weight:bold;>Wykres nie mógł zostać wyświetlony, ponieważ w Twojej przeglądarce brakuje obsługi JavaScript, lub jest ona wyłączona!</noscript>
<canvas id=allv width=750 height=950 ></canvas><br>
<form method=post action=delhst.php>
<input type=submit name=clhistory value='Wyczyść historię'></input>
</form>
<form method=post action=dcsv.php>
<input type=submit name=downloadcsv value='Pobierz (do otworzenia w Excel)'></input>
</form>
";
date_default_timezone_set("Europe/Warsaw");
$date = date("d");
if(date("m")=="01")
{
	$dm = "stycznia";
}
elseif(date("m")=="02")
{
	$dm = "lutego";
}
elseif(date("m")=="03")
{
	$dm = "marca";
}
elseif(date("m")=="04")
{
	$dm = "kwietnia";
}
elseif(date("m")=="05")
{
	$dm = "maja";
}
elseif(date("m")=="06")
{
	$dm = "czerwca";
}
elseif(date("m")=="07")
{
	$dm = "lipca";
}
elseif(date("m")=="08")
{
	$dm = "sierpnia";
}
elseif(date("m")=="09")
{
	$dm = "września";
}
elseif(date("m")=="10")
{
	$dm = "października";
}
elseif(date("m")=="11")
{
	$dm = "listopada";
}
elseif(date("m")=="12")
{
	$dm = "grudnia";
}
$date = $date." ".$dm." ".date("Y")." roku";
$datet = date("H:i");
echo "
<script>
var c = document.getElementById('allv');
c = c.getContext('2d');
c.fillStyle = 'black';
c.rect(0,0,1000,1000);
c.fill();
c.strokeStyle = 'white';
c.lineWidth = 2;
c.beginPath();
c.moveTo(20,840);
c.lineTo(630,840);
c.moveTo(20,0);
c.lineTo(20,840);
c.stroke();
c.beginPath();
c.strokeStyle = 'white';
c.lineWidth = 2;
c.moveTo(10,10);
c.lineTo(10,10);
c.fillStyle = 'white';
c.font = '10px Arial';
var x;
for(x=0;x<85;x++)
{
c.moveTo(20,x*10);
c.lineTo(29,x*10);
c.fillText(840-x*10,-1,(x*10)+5);
}
c.fill();
c.stroke();
c.beginPath();
c.moveTo(20,840);
c.lineTo(20,831);
c.font = '8px Arial';
for(x=2;x<32;x++)
{
c.moveTo(x*20,840);
c.lineTo(x*20,831);
c.fillText(x-1,x*20-22,850);
}
c.fillText(x-1,x*20-22,850);
c.fill();
c.stroke();
c.beginPath();
c.font = '13px Arial';
c.fillText('Liczba wyświetleń',30,15);
c.fillText('Dzień miesiąca',540,825);
c.fillText('Stan na dzień $date',550,15);
c.fillText('Godzina $datet',550,30);
c.beginPath();
c.strokeStyle = 'red';
c.lineWidth = 2;";
$vd = scandir("pviews/");
for($x=2;$x<count($vd);$x++)
{
	$file = file("pviews/".$vd[$x]);
	$num = 0;
	$num = $file[1];
	$num = 840-$num;
	$y = $x-1;
	$lp = substr($vd[$x],-2,2)*20;
	echo "
	c.lineTo($lp,$num);
	c.fillStyle = 'red';";
	if($file[2]=="round")
	{
		echo "c.fillStyle = 'orange';";
	}
	$numf = str_replace(PHP_EOL,"",$file[1]);
	echo "c.fillText('o',$lp-4,$num+4);";
	$dd = scandir("posts/full/");
	$posted = 0;
	for($y=0;$y<count($dd);$y++)
	{
		$t = substr($dd[$y],0,strlen($file[0])-1);
		$t2 = substr($file[0],0,strlen($file[0])-1);
		if($t==$t2)
		{
			$posted = 1;
		}
	}
	if($posted==0)
	{
			$lpt = $lp-4;
			echo "
			c.font = '20px Arial';
			c.fillStyle = 'red';
			c.fillText('x',$lpt,845);
			c.fillStyle = 'white';
			c.font = '13px Arial';";
	}
}
echo "
c.stroke();
c.beginPath();
c.moveTo(10,865);
c.lineTo(10,865);
c.font = '20px Arial';
c.fillStyle = 'red';
c.fillText('x',10,870);
c.fill();
c.font = '13px Arial';
c.fillStyle = 'white';
c.stroke();
c.beginPath();
c.font = '13px Arial';
c.strokeStyle = 'red'
c.fillStyle = 'red'
c.moveTo(10,885);
c.lineTo(25,885);
c.fillText('o',30,890);
c.stroke();
c.beginPath();
c.font = '13px Arial';
c.strokeStyle = 'lightblue'
c.fillStyle = 'lightblue'
c.moveTo(10,906);
c.lineTo(25,906);
c.fillText('o',30,910);
c.font = '13px Arial';
c.fillStyle = 'orange';
c.fillText('o',13,930);
c.fillStyle = 'white';
c.fillText('Dane szacowane',45,930);
c.fillText('Średnia liczba wyświetleń',45,910);
c.fillText('Ogólna liczba wyświetleń',45,890);
c.fillText('Dni w których na stronie nie został umieszczony żadny wpis',45,870);
c.stroke();
</script>
";
echo "</div></div>
";
}
else
{
	setcookie("wenc",0,1);
	header("Refresh:0,index.php");
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
