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
			<div class="post">

			<?php
			if($_COOKIE["wenc"]=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
			{
				date_default_timezone_set("Europe/Warsaw");
				$date = date("Y-m-d H:i:s");
				$dir = scandir("posts/full/");
				rsort($dir);
				$cnt = count($dir)-2;
				echo "
				<div id='confirm'></div>
				<h3 class=hh>Lista postów</h3>
				<h4 class=hh style=color:white;>Liczba wszystkich postów: $cnt <a href=traffic.php class='postlink' >Wykres wyświetleń</a></h4>
				<table style=background:black; cellpadding=2 cellspacing=2>
				<tr style=background:green; >
				<td>Nazwa</td>
				<td>Typ</td>
				<td>Akcja</td>
				<td>Wyświetlenia</td>
				<td id=warnings></td>
				</tr>";

				if(count($dir)!=2)
				{
				for($x=0;$x<count($dir);$x++)
				{
					if($dir[$x]!="." && $dir[$x]!="..")
					{
						if(count($dir)<124)
						{
							$isoof = false;
					echo "<tr style=background:lightgreen; >
					<td><a style=color:blue;font-weight:bold; href=artread.php?art=$dir[$x]>".$dir[$x]."</a></td>";
					if(substr($dir[$x],-1,1)=="p")
					{
					echo "<td style='color: black;' >Prognoza</td>";		
					}
					elseif(substr($dir[$x],-1,1)=="o")
					{
					echo "<td style='color: black;' >Ostrzeżenie</td>";		
					}
					elseif(substr($dir[$x],-1,1)=="c")
					{
					echo "<td style='color: black;' >Ciekawostka</td>";		
					}
					elseif(substr($dir[$x],-1,1)=="e")
					{
					echo "<td style='color: black;' >Post Edukacyjny</td>";		
					}
					elseif(substr($dir[$x],-1,1)=="b")
					{
					echo "<td style='color: black;' >Prognoza Burzowa</td>";		
					}
					else
					{
					$isoof = true;
					echo  "<td style=font-weight:bold;color:red;>Nieznany*</td>";
					}
					}
					$jsdir = json_encode($dir[$x]);
					$fv = file("posts/views/".$dir[$x]);
					$fv = $fv[0];
					if($fv=="")
					{
						if($isoof)
						{
						$fv="<div style=color:red;font-weight:bold;>Błąd!</div>";	
						}
						else
						{
							$fv="brak";
						}
					}
					echo "<td><input type=submit style='color: black;'  value=Usuń hidden id=delbtn$dir[$x] onclick=qconfirm($jsdir);></input>
					<noscript>
<form action=delpost.php><input type=text name=post hidden style=display:none; value=$dir[$x]></input><input style='color: black;' type=submit value=Usuń></input></form>
					</noscript>
					<script>
					delbtn$dir[$x].hidden=''</script><form method=post action=eedit.php><input type=text name=eart hidden style=display:none; value=$dir[$x]></input><input type=submit style='color: black;' value=Edytuj></input></form></td>
					<td style='color: black;' >$fv</td>
					<td id=cd_$dir[$x]></td>";
				}
				}
				}
				else
				{
					echo "<tr style=background:lightgreen; >
					<td style=font-weight:bold;>Brak wpisów na stronie!</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>";
				}
				echo "</tr></table>";
				if($isoof)
				{
					echo "<div style=color:orange;font-weight:bold;>*W przypadku wystąpienia wpisu z typem 'Nieznany' zaleca się jego usunięcie</div>";
				}
				
			}
			else
			{
				setcookie("wenc",0,1);
				header("Refresh:0,index.php");
			}
			?>
		<script>
			function qconfirm(a)
			{
				var cf = document.getElementById("cd_"+a);
				var warnings = document.getElementById("warnings");
				warnings.innerHTML = "Ostrzeżenia";
				cf.innerHTML="<div class='bold2' style='color:black;'>Czy na pewno chcesz usunąć post "+a+"?<input type=submit value=Tak onclick=window.location.replace('delpost.php?post="+a+"');></input></div>";
			}
			
		</script>
			
			
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
