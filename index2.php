<?php
require_once('koneksi.php');
header('Content-type: text/html; charset=utf-8');
mysql_set_charset('utf8',$koneksi);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;  charset=windows-1256"/>
<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = yes, width = device-width">
<title>
<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$kitab = htmlspecialchars(mysql_real_escape_string($_GET['kitab']));
$judul = str_replace("_", " ", $kitab);
$judul = ucwords($judul);
echo $judul;
?>
</title>
</head>
<body>
<?php
include('header.php');
if(isset($kitab))
{
$maaf = "<center><font color=red>Maaf, halaman tidak dtemukan.</font></center>";
$teks =	htmlspecialchars(mysql_real_escape_string($_GET['teks']));
$q = "SELECT table_name
FROM information_schema.tables
WHERE table_schema =  '$db' AND table_name = '$kitab'";
$x = mysql_query($q);
$jml = @mysql_num_rows($x);
if($jml>0)
  {
while($data=mysql_fetch_assoc($x))
	{
	$judulkitab = $data[table_name];
	$r = "SELECT * FROM $judulkitab WHERE nass LIKE '%$teks%' OR nass_gundul LIKE '%$teks%' OR terjemah LIKE '%$teks%'";
	$s = mysql_query($r);
	$jmlh = @mysql_num_rows($s);
	if($jmlh>0)
		{
echo "<center>Kata kunci: <font color=red><b>".stripslashes($teks)."</b></font></center>";
echo "<center>Hasil: <b>".$jmlh."</b> hadits</center>";
		while($databaru=mysql_fetch_assoc($s))
			{
		echo "<center><table width='100%' border='1' style='border-collapse:collapse' cellpadding='5px'>
<tr>
<td align=center>".$databaru[id].": <b>";
$next = $databaru[id]+1;
$prev = $databaru[id]-1;
echo $judul."</b> ";
$part = $databaru[part];
if (!empty($part) AND $part != 0) {
echo "jilid ".$part;
}
$page = $databaru[page];
if(!empty($page) AND $page != 0) {
echo " halaman ".$page;
}
if (!empty($databaru[hno]))
{
echo " hadits nomor ".$databaru[hno]." ";
}
echo "</td>
</tr>";
		echo "<tr>
<td valign=top><center><a href='lihat.php?kitab=".$kitab."&id=".$next."&perintah=buka'><img src='http://takhrij.net/aset/ikon_lanjut.png' height='30' width='50'></a><a href='lihat.php?kitab=".$kitab."&id=".$prev."&perintah=buka'><img src='http://takhrij.net/aset/ikon_kembali.png' height='30' width='50'></a></center>
<p align=right><font size=6 face='Traditional Arabic'>";
$nass = $databaru['nass'];
$nass = str_replace($teks,'<font color=red style="background-color:yellow">'.$teks.'</font>',$nass);
echo $nass;
echo "</font></p><p align=left><font size=4 face='Verdana'>";
$terjemah = $databaru[terjemah];
$terjemah = str_replace($teks,'<font color=red style="background-color:yellow">'.$teks.'</font>',$terjemah);
echo $terjemah;
echo "</font></p>
<center><a href='lihat.php?kitab=".$kitab."&id=".$next."&perintah=buka'><img src='http://takhrij.net/aset/ikon_lanjut.png' height='30' width='50'></a><a href='lihat.php?kitab=".$kitab."&id=".$prev."&perintah=buka'><img src='http://takhrij.net/aset/ikon_kembali.png' height='30' width='50'></a></center>
</td></tr>";
			}
echo "</table>
</center>";
		}
else
{
echo $maaf;
}
	}
  }
}
else
{
echo $maaf;
}
?>
<br>
<?php
include('paypal.php');
?>
</body>
</html>