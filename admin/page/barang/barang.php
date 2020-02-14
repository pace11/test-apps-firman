<section class="content-header">
    <h1>Manajemen Barang</h1>
    <ol class="breadcrumb">
        <li><a href="?page=beranda"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a>Manajemen Barang</a></li>
    </ol>
</section>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Barang</b> | List</h3>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="?page=barangadd">
                            <span class="fa fa-plus-circle"></span> Tambah Data
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID</th>
                                    <th>NAMA BARANG</th>
                                    <th>HARGA</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no=1;
                                $sql = mysqli_query($conn, "SELECT * FROM barang");
                                while($data = mysqli_fetch_array($sql)){ ?>
                                <tr>
                                    <td><?= $no ?>.</td>
                                    <td><?= $data['id'] ?></td>
                                    <td><?= $data['nama_barang'] ?></td>
                                    <td><?= $data['harga'] ?></td>
                                    <td>
                                        <a href="?page=barangedit&id=<?= $data['id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> edit</a>
                                        <a href="?page=barangdelete&id=<?= $data['id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> hapus</a>
                                    </td>
                                </tr>
                            <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>