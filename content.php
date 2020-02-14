<?php 
if (isset($_GET['page'])) $page=$_GET['page'];
else $page="beranda";
    
    if ($page == "beranda")                              include("page/beranda.php");
    elseif ($page == "login")                            include("page/admin/login.php");

    // ------------------------------- menu -------------------------------
    elseif ($page == "keranjang")                        include("page/keranjang.php");
    elseif ($page == "lihatstatus")                      include("page/lihatstatus.php");

    else "Halaman tidak ditemukan";
?>