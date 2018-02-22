<?php
require_once('koneksi.php');
header('Content-type: text/html; charset=utf-8');
$conn->exec('set names utf8');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<link href="search.png" rel="shortcut icon" />
    <title>Cari Hadits Online</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="-1" />
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="aset/style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="aset/style.responsive.css" media="all">
    <script src="aset/jquery.js"></script>
    <script src="aset/script.js"></script>
    <script src="aset/script.responsive.js"></script>
<style>.dannscontent .dannspostcontent-0 .layout-item-0 { color: #EEEEEE; background: #FFFFFF; padding-right: 10px;padding-left: 10px;  }
.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
.ie6 .post .layout-cell {border:none !important; padding:0 !important; }
</style></head>
<body>
<div id="dannsmain">
    <div class="dannssheet clearfix">
            <div class="dannslayout-wrapper clearfix">
                <div class="dannscontent-layout">
                    <div class="dannscontent-layout-row">
                        <div class="dannslayout-cell dannscontent clearfix"><article class="dannspost dannsarticle">
                <div class="dannspostcontent dannspostcontent-0 clearfix"><div class="dannscontent-layout">
    <div class="dannscontent-layout-row">
    <div class="dannslayout-cell layout-item-0" style="width: 100%" >
		<br>
        <p style="text-align: center;"><img width="220" alt="" class="dannslightbox" src="aset/header-crop.jpg"></p>
		<br>
		<form name="cari" action="cari.php" method="get">		
        <table class="dannsarticle" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 80%; margin-right: auto; margin-left: auto;">
        <tbody>
        <tr>
        <td style="width: 100%; text-align: left;"><span style="color: #212B36;">Masukkan teks hadits:</span></td>
        </tr>
        <tr>
        <td style="width: 100%;"><input name="teks" type="text" required /><br></td>
        </tr>
        <tr>
        <td style="width: 100%; text-align: right;"><br>
        <input type="submit" name="perintah" value="Cari!" class="dannsbutton dannsbutton"/><br>
</td>
        </tr>
        </tbody>
        </table>
		</form>
    </div>
    </div>
</div>
</div>
</article></div>
                    </div>
                </div>
            </div><footer class="dannsfooter clearfix">
<p style="text-align: center;"> <a href="daftarkitab.php"><img width="50" height="50" alt="Lihat Daftar Kitab" class="dannslightbox" src="aset/search.png"> <a href="http://files.appsgeyser.com/Cari%20Hadits%20Online_4475034.apk"><img width="50" height="50" alt="Download aplikasi android" class="dannslightbox" src="aset/android.png"></a> <a href="https://www.facebook.com/groups/forum.diskusi.hadits"><img width="50" height="50" alt="Bergabung di Forum Diskusi Hadits" class="dannslightbox" src="aset/facebook.png"></a></p>
<br/>
<?php
include('paypal.php');
?>
<p><a href="https://carihadis.wordpress.com/">Cari Hadits Online &copy; 2015</a><br></p>
<p style="text-align: center;"></p>
</footer>
    </div>
</div>

<script type="text/javascript">
<!--
  document.cari.teks.focus();
//-->
</script>
</body></html>