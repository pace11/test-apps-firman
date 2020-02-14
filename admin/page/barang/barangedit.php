<?php 
    $sql = mysqli_query($conn, "SELECT * FROM barang WHERE id='$_GET[id]'");
    $data = mysqli_fetch_array($sql);
?>
<section class="content-header">
    <h1>Manajemen Barang</h1>
    <ol class="breadcrumb">
        <li><a href="?page=beranda"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a>Manajemen Barang</a></li>
    </ol>
</section>
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Barang</b> | Edit</h3>
                </div>
                <div class="box-body">
                <form action="?page=barangeditpro" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Barang</label><br>
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <span class="label label-success"><?= $data['id'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama" placeholder="masukkan nama barang ..." autocomplete="off" value="<?= $data['nama_barang'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="number" class="form-control" name="harga" placeholder="masukkan harga barang ..." autocomplete="off" value="<?= $data['harga'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    <a href="?page=barang" class="btn btn-danger">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>