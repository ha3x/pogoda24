<?php
if($_COOKIE["wenc"]=="d2df653b1deaef258a40c44312c8925802499ba7d9c9429e8d75b2aa58a19bd2")
{
				$lf = fopen("posts/secure/lg","a");
				$hostname = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
				date_default_timezone_set("Europe/Warsaw");
				$date = date("Y-m-d H:i:s");
				
$os = openssl_decrypt($_COOKIE["osprobe"],"AES-256-CTR","HereIsMyData"); 
 fwrite($lf,$pref."[$os][$date][$hostname] Umieszczono post na stronie".PHP_EOL);	
	date_default_timezone_set("Europe/Warsaw");
	if(isset($_POST["etext"]))
	{
		$text = $_POST["etext"];
		$art = $_POST["eart"];
		$bname = substr($art,0,strlen($art)-2);
		$idir = scandir("uploads/");
		$cdate_1 = date("Y-m-d");
		$cdate_2 = date("H:i");
		$cdate = $cdate_1." o ".$cdate_2;
		$e = 0;
		for($x=0;$x<count($idir);$x++)
		{
			if(substr($idir[$x],0,strlen($art)-2)==$bname)
			{
				$img[$e]=$idir[$x];
				$e = $e+1;
			}
		}
		$pfile = fopen("posts/full/".$art,"w");
		$rfile = fopen("posts/raw/".$art,"w");
		$sfile = fopen("posts/short/".$art,"w");
	if(strlen($text)>90)
	{
		$a = 175;
		while(substr($text,$a,1)!=" ")
		{
			$a = $a-1;
		}
		$text_short = substr($text,0,$a)."...";
	}
	else
	{
	$text_short = $text." ";
	}
	fwrite($pfile,"<div class=postdate >$cdate</div><div class=bold><div class=center>".$text."</br>");
	fwrite($sfile,"<div class=postdate >$cdate</div><div class=bold><div class=center>".$text_short."<a href=artread.php?art=$art style='color:lightblue;'>+ + Czytaj dalej</a></br>");
	fwrite($rfile,$text);
	if(count($img)==1)
	{
		fwrite($sfile,"<a href=uploads/$img[0]><img class=pimg src=uploads/$img[0] width=80%></img></a>");
		fwrite($pfile,"<a href=uploads/$img[0]><img class=pimg src=uploads/$img[0] width=80%></img></a>");
	}
	else
	{
		for($y=0;$y<count($img);$y++)
		{
			fwrite($sfile,"<a href=uploads/$img[$y]><img class=pimg src=uploads/$img[$y] width=49%></img></a>");
			fwrite($pfile,"<a href=uploads/$img[$y]><img class=pimg src=uploads/$img[$y] width=49%></img></a>");
		}
	}
	fwrite($pfile,"</div></div>");
	fwrite($sfile,"</div></div>");
	header("Refresh:0,index.php");
	}
	else
	{
	date_default_timezone_set("Europe/Warsaw");
	$date = date("YmdHis");
	$cdate_1 = date("Y-m-d");
	$cdate_2 = date("H:i");
	$cdate = $cdate_1." o ".$cdate_2;
	$type = $_POST["type"];
	$file_short = fopen("posts/short/".$date."_".$type,"w");
	$file_full = fopen("posts/full/".$date."_".$type,"w");
	$file_raw = fopen("posts/raw/".$date."_".$type,"w");
	$file_views = fopen("posts/views/".$date."_".$type,"w");
	fwrite($file_views,"0");
	$text = $_POST["text"];
	$dfix = $date."_".$type;
	if($type=="o")
	{
		$check = $_POST["wshow"];
		if($check=="on")
		{
	$file_warns = fopen("posts/warns/main.dat","w");
	$wlen = $_POST["wlen"];
	if($wlen=="")
	{
		$wlen = 1;
	}
	if(isset($_POST["wdesc"]) && $_POST["wdesc"]!="")
	{
		$artr = $date."_".$type;
		$header = substr($_POST["wdesc"],0,45)."...<a style='color:lightblue;font-weight:bold;' href='artread.php?art=$artr' >Czytaj </a>";
	}
	else
	{
		$artr = $date."_".$type;
		$header = preg_replace("/\s+/"," ",substr($text,0,45))."...<a style='color:lightblue;font-weight:bold;' href='artread.php?art=$artr' >Czytaj </a>";
	}
	date_default_timezone_set("Europe/Warsaw");
	$wdate = date("Ymd",time()+$wlen*86400);
	$rldate = date("Y-m-d",time()+$wlen*86400);
	fwrite($file_warns,$wdate.PHP_EOL.$header."(ostrzeżenie ważne do $rldate)");
	}
	}
	if(strlen($text)>90)
	{
		$a = 175;
		while(substr($text,$a,1)!=" ")
		{
			$a = $a-1;
		}
		$text_short = substr($text,0,$a)."...";
	}
	else
	{
	$text_short = $text." ";
	}
	fwrite($file_short,"<div class=postdate >$cdate</div><div class=bold><div class=center>".$text_short."<a href=artread.php?art=$dfix style='color:lightblue;'>+ Czytaj dalej</a></br>");
	fwrite($file_full,"<div class=postdate >$cdate</div><div class=bold><div class=center>".$text."</br>");
	fwrite($file_raw,$text);
	if($_FILES["file1"]["name"]!="" && $_FILES["file2"]["name"]=="")
	{
			$ftmp1 = $_FILES["file1"]["tmp_name"];
			$fname1 = preg_replace("/\s+/","_",$date.$_FILES["file1"]["name"]);
			move_uploaded_file($ftmp1,"uploads/".$fname1);
			fwrite($file_short,"<a href=uploads/$fname1><img class=pimg src=uploads/$fname1 width=80%></img></a>");
			fwrite($file_full,"<a href=uploads/$fname1><img class=pimg src=uploads/$fname1 width=80%></img></a>");
	}
	else
	{
		if($_FILES["file1"]["name"]!="")
		{
			$ftmp1 = $_FILES["file1"]["tmp_name"];
			$fname1 = preg_replace("/\s+/","_",$date.$_FILES["file1"]["name"]);
			move_uploaded_file($ftmp1,"uploads/".$fname1);
			fwrite($file_short,"<a href=uploads/$fname1><img class=pimg src=uploads/$fname1 width=49%></img></a>");
			fwrite($file_full,"<a href=uploads/$fname1><img class=pimg src=uploads/$fname1 width=49%></img></a>");
		}
		if($_FILES["file2"]["name"]!="")
		{
			$ftmp2 = $_FILES["file2"]["tmp_name"];
			$fname2 = preg_replace("/\s+/","_",$date.$_FILES["file2"]["name"]);
			move_uploaded_file($ftmp2,"uploads/".$fname2);
			fwrite($file_short,"<a href=uploads/$fname2><img class=pimg src=uploads/$fname2 width=49%></img></a></br>");
			fwrite($file_full,"<a href=uploads/$fname2><img class=pimg src=uploads/$fname2 width=49%></img></a></br>");
		}
		if($_FILES["file3"]["name"]!="")
		{
			$ftmp3 = $_FILES["file3"]["tmp_name"];
			$fname3 = preg_replace("/\s+/","_",$date.$_FILES["file3"]["name"]);
			move_uploaded_file($ftmp3,"uploads/".$fname3);
			fwrite($file_short,"<a href=uploads/$fname3><img class=pimg src=uploads/$fname3 width=49%></img></a>");
			fwrite($file_full,"<a href=uploads/$fname3><img class=pimg src=uploads/$fname3 width=49%></img></a>");
		}
		if($_FILES["file4"]["name"]!="")
		{
			$ftmp4 = $_FILES["file4"]["tmp_name"];
			$fname4 = preg_replace("/\s+/","_",$date.$_FILES["file4"]["name"]);
			move_uploaded_file($ftmp4,"uploads/".$fname4);
			fwrite($file_short,"<a href=uploads/$fname4><img class=pimg src=uploads/$fname4 width=49%></img></a>");
			fwrite($file_full,"<a href=uploads/$fname4><img class=pimg src=uploads/$fname4 width=49%></img></a>");
		}
	}
	fwrite($file_short,"</div></div>");
	fwrite($file_full,"</div></div>");
	if($type=="p")
	{
		$sw = "prognozy.php";
	}
	elseif($type=="o")
	{
		$sw = "ostrzezenia.php";
	}
	elseif($type=="c")
	{
		$sw = "ciekawostki.php";
	}
	$mails = file("posts/secure/mails.dat");
	$key =  "66c718e7e5849bde0cdb84c595d7bb28728a6758206140b0540b513a2a2aa4b6";
	$iv = "1032104592458256";
	$enctype = "AES-256-CBC";
	for($x=0;$x<count($mails);$x++)
	{
		if(strlen($mails[$x])>1)
		{
			$mail_encrypted = substr($mails[$x],0,strlen($mails[$x])-1);
			$mail = openssl_decrypt($mail_encrypted,$enctype,$key,false,$iv);
			$mail = strtolower($mail);
			$textt = str_replace(PHP_EOL," ",$text);
			$mailprep = wordwrap("
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN' 'http://www.w3.org/Math/DTD/mathml2/xhtml-math11-f.dtd'>
<?xml version='1.0' encoding='UTF-8'?><html xmlns='http://www.w3.org/1999/xhtml' style='margin:0;'>
<!--This file was converted to xhtml by LibreOffice - see http://cgit.freedesktop.org/libreoffice/core/tree/filter/source/xslt for the code.--><head profile='http://dublincore.org/documents/dcmi-terms/' style='margin:0;'>
<meta http-equiv='Content-Type' content='application/xhtml+xml; charset=utf-8' style='margin:0;'>
<title xml:lang='en-US' style='margin:0;'>- no title specified</title>
<meta name='DCTERMS.title' content='' xml:lang='en-US' style='margin:0;'>
<meta name='DCTERMS.language' content='en-US' scheme='DCTERMS.RFC4646' style='margin:0;'>
<meta name='DCTERMS.source' content='http://xml.openoffice.org/odf2xhtml' style='margin:0;'>
<meta name='DCTERMS.creator' content='Wojtek' style='margin:0;'>
<meta name='DCTERMS.issued' content='2019-02-04T19:17:00' scheme='DCTERMS.W3CDTF' style='margin:0;'>
<meta name='DCTERMS.contributor' content='Wojtek' style='margin:0;'>
<meta name='DCTERMS.modified' content='2019-02-04T19:23:00' scheme='DCTERMS.W3CDTF' style='margin:0;'>
<meta name='DCTERMS.provenance' content='' xml:lang='en-US' style='margin:0;'>
<meta name='DCTERMS.subject' content=',' xml:lang='en-US' style='margin:0;'>
<link rel='schema.DC' href='http://purl.org/dc/elements/1.1/' hreflang='en' style='margin:0;'>
<link rel='schema.DCTERMS' href='http://purl.org/dc/terms/' hreflang='en' style='margin:0;'>
<link rel='schema.DCTYPE' href='http://purl.org/dc/dcmitype/' hreflang='en' style='margin:0;'>
<link rel='schema.DCAM' href='http://purl.org/dc/dcam/' hreflang='en' style='margin:0;'>
</head>
<body dir='ltr' style='max-width:21.001cm;margin-top:2.499cm;margin-bottom:2.499cm;margin-left:2.499cm;margin-right:2.499cm;writing-mode:lr-tb;margin:0;font:11px/20px Georgia, 'Times New Roman', Times, serif;'>
<table border='0' cellspacing='0' cellpadding='0' class='Table1' style='margin:0;border-collapse:collapse;border-spacing:0;empty-cells:show;width:16.249cm;margin-left:-0.199cm;margin-top:0cm;margin-bottom:0cm;margin-right:auto;writing-mode:lr-tb;'>
<colgroup style='margin:0;'><col width='710' style='margin:0;'></colgroup>
<tr class='Table11' style='margin:0;'><td style='text-align:left;width:16.249cm;margin:0;vertical-align:top;font-size:12pt;background-color:#b8cce4;padding-left:0.199cm;padding-right:0.191cm;padding-top:0cm;padding-bottom:0cm;border-width:0,3175cm;border-style:double;border-color:#0070c0;' class='Table1_A1'>
<h1 class='P5' style='margin:0;font-weight:bold;font-size:14pt;clear:both;color:#365f91;line-height:115%;margin-bottom:0cm;margin-top:0.847cm;text-align:left ! important;font-family:Cambria;writing-mode:lr-tb;'>
<a id='a___Tytuł_e-maila_' style='margin:0;'><span style='margin:0;'></span></a><span class='T1' style='margin:0;font-size:16pt;'>$text_short</span><a name='_GoBack' style='margin:0;'></a>
</h1>
<p class='P2_borderStart' style='margin:0;margin-bottom:1em;font-family:Arial;text-align:left ! important;font-size:9.5pt;line-height:115%;margin-top:0cm;writing-mode:lr-tb;background-color:#b8cce4;color:#000000;font-weight:bold;padding-bottom:0cm;border-bottom-style:none;'></p>
<p class='P1' style='margin:0;margin-bottom:1em;font-family:Calibri;text-align:left ! important;font-size:11pt;line-height:115%;writing-mode:lr-tb;background-color:#b8cce4;padding-bottom:0cm;padding-top:0cm;border-top-style:none;border-bottom-style:none;'><span class='T2' style='margin:0;font-family:Arial Narrow;'> $textt </span></p>
<p class='P3' style='margin:0;margin-bottom:1em;font-family:Times New Roman;text-align:left ! important;font-size:12pt;line-height:115%;writing-mode:lr-tb;background-color:#b8cce4;padding-bottom:0cm;padding-top:0cm;border-top-style:none;border-bottom-style:none;'></p>
<p class='P1_borderEnd' style='margin:0;margin-bottom:0cm;font-family:Calibri;text-align:left ! important;font-size:11pt;line-height:115%;writing-mode:lr-tb;background-color:#b8cce4;padding-top:0cm;border-top-style:none;'><span class='T3' style='margin:0;color:#000000;font-family:Arial;font-size:9.5pt;font-weight:bold;'>Po więcej informacji zajrzyj </span><span class='T4' style='margin:0;color:#0070c0;font-family:Arial;font-size:9.5pt;font-style:italic;font-weight:bold;'><a href='https://www.e-pogoda24.pl/artread.php?art=$dfix'>Tutaj</a> </span><span class='T5' style='margin:0;color:#0070c0;font-family:Arial;font-size:9.5pt;font-weight:bold;'> </span></p>
<p class='P4' style='margin:0;margin-bottom:0cm;font-family:Calibri;text-align:left ! important;font-size:11pt;line-height:115%;margin-top:0cm;writing-mode:lr-tb;'> </p>
</td></tr>
</table>
<p class='Standard' style='margin:0;margin-bottom:0.353cm;font-family:Calibri;text-align:left ! important;font-size:11pt;line-height:115%;margin-top:0cm;writing-mode:lr-tb;'> </p>
</body>
</html>

			");
			$from_name = "e-pogoda24.pl";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers .= "From: ".$from_name." <e-pogoda24@e-pogoda24.pl> \r\n";
	if($type=="p")
	{
		$topic = "Prognoza od Pogoda24/7";
	}
	elseif($type=="o")
	{
		$topic = "Ostrzeżenie od Pogoda24/7";
	}
	elseif($type=="c")
	{
		$topic = "Ciekawostka od Pogoda24/7";
	}
			//~mail($mail,$topic,$mailprep,$headers);
		}
	}
	header("Refresh:0,artread.php?art=".$date."_".$type);
}
}
else
{
	setcookie("wenc",0,1);
	header("Refresh:0,index.php");
}
?>
<!--Skrypt odpowiadający za wysyłanie treści postów na stronę
