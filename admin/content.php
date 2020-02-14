<?php 

if (isset($_GET['page'])) $page=$_GET['page'];
else $page="beranda";

if ($page == "beranda") include("page/beranda.php");
elseif ($page == "logout") include("page/logout.php");

    // -------------------------- layanan --------------------------
    elseif ($page == "barang")                 include("page/barang/barang.php");
    elseif ($page == "barangadd")              include("page/barang/barangadd.php");
    elseif ($page == "barangaddpro")           include("page/barang/barangaddpro.php");
    elseif ($page == "barangedit")             include("page/barang/barangedit.php");
    elseif ($page == "barangeditpro")          include("page/barang/barangeditpro.php");
    elseif ($page == "barangdelete")           include("page/barang/barangdelete.php");

else echo"Konten tidak ada";

?>