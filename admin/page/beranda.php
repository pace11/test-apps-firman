<?php
    $barang = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM barang"));
?>
<section class="content-header">
    <h1>Beranda</h1>
    <ol class="breadcrumb">
        <li><a href="?page=beranda"><i class="fa fa-dashboard"></i> Beranda</a></li>
    </ol>
</section>

<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $barang ?></h3>
                            <p>Barang</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cogs"></i>
                        </div>
                        <a href="?page=barang" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
