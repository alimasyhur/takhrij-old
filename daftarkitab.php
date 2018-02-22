
<html>
<head>
<meta name="description" content="Cari Hadits Offline" />
<title>Daftar Kitab</title>
   <style>
   h3{
      text-align:center; }
   table { 
      border-collapse:collapse;
      border-spacing:0;     
      font-family:Arial, sans-serif;
      font-size:16px;
      padding-left:300px;
      margin:auto; }
   table th {
      font-weight:bold;
      padding:10px;
      color:#fff;
      background-color:#25774A;
      border-top:1px black solid;
      border-bottom:1px black solid;}
   table td {
      padding:10px;
      border-top:1px black solid;
      border-bottom:1px black solid;
      text-align:left; }         
   tr:nth-child(even) {
     background-color: #DFFBF8; }
   </style>
<link href="../search.png" rel="shortcut icon" />
<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = yes, width = device-width">
</head>
<body>
<h3>Daftar Kitab</h3>
<table>
<tr>
   <th>No</th>
   <th>Nama Kitab</th>
</tr>
<?php
require_once('koneksi.php');
$q = "SELECT table_name
FROM information_schema.tables
WHERE table_schema =  '$db'";
$result = $conn->query($q);
$rows = $result->fetchAll();
if(count($rows)>0) {
echo "<center>Saat ini tersedia <b>".$jml."</b> kitab sebagai berikut (sesuai urutan abjad):</center><br/>";
$no = 1;
    foreach($rows as $data) {
      $judulkitab = $data['table_name'];
      $judul = str_replace('_', ' ', $judulkitab);
      echo "<tr><td>" . $no . "</td><td><a href='lihat.php?kitab=" . $judulkitab . "&id=1'>" . ucwords($judul) . "</a></td></tr>";
      $no++;
    }
  }
?>
</body>
</html>
