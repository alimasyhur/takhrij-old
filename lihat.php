<?php
require_once('koneksi.php');
header('Content-type: text/html; charset=utf-8');
$conn->exec('set names utf8');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;  charset=windows-1256"/>
<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = yes, width = device-width">
<title>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$kitab = htmlspecialchars($_GET['kitab']);
$judul = str_replace("_", " ", $kitab);

$judul = ucwords($judul);
echo $judul;
?>
</title>
<link href="search.png" rel="shortcut icon" />
</head>
<body>
<?php
include('header.php');

$teks =	htmlspecialchars($_GET['teks']);
$id=abs((int)$_GET['id']);
$nomor=abs((int)$_GET['nomor']);
if(isset($kitab))
{
$q = "SELECT table_name
FROM information_schema.tables
WHERE table_schema =  '$db' AND table_name = '$kitab'";
$result = $conn->query($q);
$rows = $result->fetchAll();

if(count($rows)>0) {
	  foreach($rows as $data) {
			$judulkitab = $data['table_name'];

			if (!isset($nomor) or empty($nomor) or $nomor == 0) {
				$r = "SELECT * FROM $judulkitab WHERE id = $id";
			} else if (!isset($id) or empty($id) or $id == 0) {
				$r = "SELECT * FROM $judulkitab WHERE hno = $nomor";
			} else if ($id == $nomor) {
				$r = "SELECT * FROM $judulkitab WHERE hno = $nomor";
			} else if ($id !== $nomor) {
				$r = "SELECT * FROM $judulkitab WHERE id = $id AND hno = $nomor";
			}

			$secondResult = $conn->query($r);
			$secondRows = $secondResult->fetchAll();

			if (count($secondRows) > 0) {

				foreach($secondRows as $databaru){

						$next = $databaru[id] + 1;
						$prev = $databaru[id] - 1;
						echo "<center><table width='100%' border='1' style='border-collapse:collapse' cellpadding='5px'>
									<tr>
									<td align=center>";
						if ($databaru[id] != $databaru[hno]) {
							echo $databaru[id] . ". ";
						}
						echo "<b>" . $judul . "</b>";
						if (!empty($databaru[part]) and $databaru[page]) {
							echo " jilid " . $databaru[part] . " halaman " . $databaru[page];
						}
						if (!empty($databaru[hno])) {
							echo " hadits nomor: " . $databaru[hno];
						}
						if ($judulkitab == Shahih_Bukhari) {
							echo " (<a href='35kitab/lihat.php?kitab=Fathul_Bari_Ibnu_Hajar&nomor=" . $id . "&perintah=buka'>Buka Fathu Bari Ibnu Hajar</a>)";
						} else if ($judulkitab == Shahih_Muslim) {
							echo " (<a href='35kitab/lihat.php?kitab=Syarh_Shahih_Muslim_Nawawi&nomor=" . $id . "&perintah=buka'>Buka Syarh Shahih Muslim Nawawi</a>)";
						} else if ($judulkitab == Sunan_Abu_Daud) {
							echo " (<a href='35kitab/lihat.php?kitab=Aunul_Mabud&nomor=" . $id . "&perintah=buka'>Buka Aunul Ma'bud</a>)";
						} else if ($judulkitab == Sunan_Nasai) {
							echo " (<a href='35kitab/lihat.php?kitab=Hasyiatus_Sindi_Nasai&nomor=" . $id . "&perintah=buka'>Buka Hasyiatus Sindi</a>)";
						} else if ($judulkitab == Sunan_Ibnu_Majah) {
							echo " (<a href='35kitab/lihat.php?kitab=Hasyiatus_Sindi_Ibnu_Majah&nomor=" . $id . "&perintah=buka'>Buka Hasyiatus Sindi</a>)";
						}
						echo "</td>
									</tr>";
						echo "<tr>
									<td valign=top><center><a href='lihat.php?kitab=" . $kitab . "&id=" . $next . "&perintah=buka'><img src='http://takhrij.net/aset/ikon_lanjut.png' height='30' width='50'></a><a href='lihat.php?kitab=" . $kitab . "&id=" . $prev . "&perintah=buka'><img src='http://takhrij.net/aset/ikon_kembali.png' height='30' width='50'></a></center>
									<p align=right><font size=6 face='Traditional Arabic'> ";
						$nass = $databaru['nass'];
						$nass = str_replace($teks, '<font color=red style="background-color:yellow">' . $teks . '</font>', $nass);
						echo $nass;
						echo "</font></p><p align=left><font size=4 face='Verdana'>";
						$terjemah = $databaru[terjemah];
						$terjemah = str_replace($teks, '<font color=red style="background-color:yellow">' . $teks . '</font>', $terjemah);
						echo $terjemah;
						echo "</font></p><center><a href='lihat.php?kitab=" . $kitab . "&id=" . $next . "&perintah=buka'><img src='http://takhrij.net/aset/ikon_lanjut.png' height='30' width='50'></a><a href='lihat.php?kitab=" . $kitab . "&id=" . $prev . "&perintah=buka'><img src='http://takhrij.net/aset/ikon_kembali.png' height='30' width='50'></a></center></td></tr>";

				}
				echo "</table>
			</center>";
			} else {
				echo "<center><font color=red>Maaf, halaman tidak ditemukan.</font></center>";
			}
	  }
  }
}
else
{
echo "<center><font color=red>Maaf, halaman tidak ditemukan.</font></center>";
}
?>

<?php
include('paypal.php');
?>
</body>
</html>