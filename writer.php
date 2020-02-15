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
			$enc = null;
			if(isset($_COOKIE["wenc"]))
			{
				$enc = $_COOKIE["wenc"];
			}
			if($enc=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
			{

				echo "
				<form id='wform' action=esend.php method=post enctype=multipart/form-data>
				<h3 class=hh>Witaj w edytorze wpisów.</h3>
				Możesz tutaj tworzyć nowe posty do umieszczenia na stronie<br>
				<textarea required name=text id=txa class=ftext2 cols=100 rows=10 placeholder='Treść posta...'></textarea><br>
				<div class=post><div class=bold>Wybierz obrazy:</div><br>
				1:<input type=file class=file name=file1 accept=image/* ></input><br>
				2:<input type=file class=file name=file2 accept=image/* ></input><br>
				3:<input type=file class=file name=file3 accept=image/* ></input><br>
				4:<input type=file class=file name=file4 accept=image/* ></input><br><br></div>
				<div class=post>
				<input type=radio name=type required id=p value=p checked></input><label for=p>Prognoza</label><br>
				<input type=radio name=type required id=c value=c ></input><label for=c>Ciekawostka</label><br>
				<input type=radio name=type required id=o value=o ></input><label for=o>Ostrzeżenie</label><br><br></div>
				<div class=post><div id='wl_container' style='margin-top:10px;'><input type='checkbox' name='wshow' id='wshow' checked /><label id='wlbl' for='wshow'>Dodaj do paska u góry strony</label><Br><br>
				Czas trwania ostrzeżenia: <input required value=1 type=number name='wlen' id='wlen' min=0 max=31 style='width:50px; color:black;' /> dni (0 = do końca dzisiejszego dnia)<br><Br>
				Krótki opis ostrzeżenia (np. 'Ostrzeżenie przed wiatrem'): <input type=text name='wdesc' id='wdesc' style='color:black;' required placeholder='Opis:' /><br><div style='font-weight:bold;'>(Opis zostanie wyświetlony na czerwonym pasku u góry strony)<br><br></div></div></div>
				<input type=submit value=Wyślij class=fbtn1></input></form>
				<script>
				var wform = document.getElementById('wform');
				var ol = document.getElementById('o');
				var wlen = document.getElementById('wlen');
				var wdesc = document.getElementById('wdesc');
				var wll = document.getElementById('wl_container');
				var wshow = document.getElementById('wshow');
				var wlbl = document.getElementById('wlbl');
				if(ol.checked)
				{
					wshow.disabled = false;
					if(wshow.checked)
					{
					wlen.disabled = false;
					wdesc.disabled = false;
					wll.style.color = '';
					wlbl.style.color = 'white';
					}
					else
					{
					wlen.disabled = true;
					wdesc.disabled = true;
					wll.style.color = '#4A4A4A';
					wlbl.style.color = 'white';
					}
				}
				else
				{
					wlen.disabled = true;
					wdesc.disabled = true;
					wshow.disabled = true;
					wll.style.color = '#4A4A4A';
					wlbl.style.color = '#4A4A4A';
				}
				wform.addEventListener('change',function(){
				if(ol.checked)
				{
					wshow.disabled = false;
					if(wshow.checked)
					{
					wlen.disabled = false;
					wdesc.disabled = false;
					wll.style.color = '';
					wlbl.style.color = 'white';
					}
					else
					{
					wlen.disabled = true;
					wdesc.disabled = true;
					wll.style.color = '#4A4A4A';
					wlbl.style.color = 'white';
					}
				}
				else
				{
					wlen.disabled = true;
					wdesc.disabled = true;
					wshow.disabled = true;
					wll.style.color = '#4A4A4A';
					wlbl.style.color = '#4A4A4A';
				}
				
				});
				
				</script>";
			}
			else
			{
				setcookie("wenc",0,1);
				header("Refresh:0,index.php");
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
