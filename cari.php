<?php
//cari.php
if(isset($_GET['teks'])) 
require_once('koneksi.php');
header('Content-type: text/html; charset=utf-8');
$conn->exec('set names utf8');

$jud = htmlspecialchars($_GET['teks']);
?>
<html>
<head>
<title>&#1578;&#1582;&#1585;&#1610;&#1580; &#1581;&#1583;&#1610;&#1579; <?php echo $jud; ?> | Cari Hadits Online</title>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js' type='text/javascript'></script>
<link href="search.png" rel="shortcut icon" />
<meta http-equiv="Content-Type" content="text/html;  charset=windows-1256"/>
<meta name="description" content="Cari Hadits Online: Situs untuk mencari hadits dan terjemahnya dengan mudah" />
<meta name="keywords" content="cari hadits online, cari hadis online, cari hadist online, cari hadits, cari hadis, cari hadist, hadits, hadis, hadist, hadith online, hadith, hadits online, hadis online, hadist online, hadits terjemah, hadis terjemah, hadist terjemah, terjemah hadits, terjemah hadis, terjemah hadist, terjemahan hadits, terjemahan hadis, terjemahan hadist, terjemah hadits online, terjemah hadis online, terjemah hadist online" />
<meta name="author" content="Danns Bass">
<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = yes, width = device-width">
</head>
<body bgcolor='EEEEEE'>
<center>
<?php
include('header.php');
?>
<form method="get" name="form">
<input type="text" name="teks" id="teks" placeholder="Masukkan teks hadits" required/>
<input type="submit" name="perintah" value="Cari!"/><br/>
<a target="_blank" href="daftarkitab.php">Daftar Kitab</a>
</form>
</center>
<?php
if(isset($_GET['perintah']))
{
require_once('koneksi.php');

$input = htmlspecialchars($_GET['teks']);
$find = array("َ","ِ","ُ","ً","ٍ","ٌ","ْ","ّ");
$teks = str_replace($find,"",$input);

echo "<center>Kata kunci:<br/><b><font color=red>".stripslashes($input)."</font></b><br/>Hasil:<br/><table width='99%' border='1' style='border-collapse:collapse' cellpadding='5px'><tr><td align=center width='5%'>No</td><td align=center>Nama Kitab</td><td align=center>Jumlah</td><td align=center>Nomor</td></tr>";

$q = "SELECT table_name
FROM information_schema.tables
WHERE table_schema =  '$db'";
$result = $conn->query($q);
$rows = $result->fetchAll();
if(count($rows)>0) {
$no = 1;
	foreach($rows as $data) {
		$judulkitab = $data['table_name'];
		$query = "SELECT * FROM $judulkitab WHERE terjemah LIKE '%$teks%' OR nass_gundul LIKE '%$teks%'";
		$secondResult = $conn->query($query);
		$secondRows = $secondResult->fetchAll();
		if (count($secondRows) > 0) {
			echo "<tr><td valign=top align=center width='5%'>$no</td><td valign=top width='25%'>";
			$judul = str_replace("_", " ", $judulkitab);
			echo ucwords($judul);
			echo " </td><td valign=top width='25%'><a target='_blank' href='index2.php?kitab=" . $judulkitab . "&teks=";

			$check = str_replace("\'", "%27", $input);
			echo $check;

			echo "&Submit=Cari'>" . count($secondRows) . " hadits</a></td><td valign=top> ";
			foreach($secondRows as $databaru) {
				echo "[<a target='_blank' href='lihat.php?kitab=" . $judulkitab . "&id=" . $databaru['id'] . "&nomor=" . $databaru['hno'] . "&teks=$check&perintah=buka'>" . $databaru['id'] . "</a>] ";
			}
			echo "<br/></td></tr>";
			$no++;
		}
	}
  }
?>
</table></center>
<table width='99%' border='0' style='border-collapse:collapse' cellpadding='5px'>
<tr><td align=left><FORM>
<INPUT type="button" name="kembali" value="«Kembali" onClick="history.back()">
</FORM></td><td align=right>
<FORM>
<INPUT type="button" name="kedepan" value="Kedepan»" onClick="history.forward()">
</FORM></td></tr></table>
<h3>Petunjuk Pencarian</h3>
<p align="justify">
<ol>
<li> Mesin pencari akan mencari teks yang dimasukkan tanpa memedulikan karakter sebelum maupun sesudahnya.</li>
<li> Pilihlah kata yang unik supaya hasil pencarian lebih akurat.</li>
<li> Semakin sedikit kata yang dimasukkan, semakin banyak hasil pencarian.</li>
<li> Untuk pencarian teks Arab, hindari sebisa mungkin tasykil/syakal seperti harokat fathah, kasrah, dhammah, sukun, tasydid dan sebagainya.</li>
<li> Mesin pencari akan membedakan <i>hamzah washal</i> dengan <i>hamzah qatha'</i> sehingga <font face="Traditional Arabic" size="5"><b>ان</b></font> berbeda dengan <font face="Traditional Arabic" size="5"><b>أن</b></font> atau <font face="Traditional Arabic" size="5"><b>إن</b></font>.
</ol>
</p>
<?php
//include_once('tamu.php');
//include_once('komentar.php');
}
 ?>
<script type="text/javascript">
<!--
  document.form.teks.focus();
//-->
</script>
<?php
include('paypal.php');
?>
</body>
</html>