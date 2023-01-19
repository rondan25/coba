<?php
include("../../koneksi.php");
include('../../cekadmin.php');


class tampil{
    public $query;
    public $data;

    public function tampil_list(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->query = mysqli_query($koneksi, "SELECT matakuliah.kode_mk, nama_mk, sks, matakuliah.nim, dosen.nama FROM matakuliah INNER JOIN dosen
        ON matakuliah.nim = dosen.nim");
    }
}

$dataObj = new tampil();
$row = $dataObj->tampil_list();
?>

<html>
    <head>
        <title>SIAK - LIST MATAKULIAH</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../../style.css">
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark mb-5">
            <div class="container">
                <a class="navbar-brand" href="admin.php">SISTEM INFORMASI AKADEMIK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="navbar-brand fs-6">
                            <?php 
                            date_default_timezone_set('Asia/Kuala_Lumpur');
                            echo "Welcome " . $_SESSION['username'];
                            echo date(' |  H:i:s');
                        ?>
                    </li>
                    <li class="navbar-brand fs-6">
                        <a href="../../logout.php"><img src="../../img/logout.png" alt="logout" width="20px" class="logout"> Logout</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- create jadwal  -->
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">LIST MATAKULIAH</h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle table-hover">
                            <tr class="table-secondary"> 
                                <th width="50px">NO.</th>
                                <th>KODE MATAKULIAH</th>
                                <th>NAMA MATAKULIAH</th>
                                <th>SKS</th>
                                <th>NIP</th>
                                <th>NAMA DOSEN</th>
                                <th colspan="2">AKSI</th>
                            </tr>

                            <?php 
                            $no=1;
                            while($data = mysqli_fetch_array($dataObj->query)) { ?>
                            <tr>
                                <td><?php echo $no++?></td>
                                <td><?php echo $data['kode_mk']?></td>
                                <td><?php echo $data['nama_mk']?></td>
                                <td><?php echo $data['sks']?></td>
                                <td><?php echo $data['nim']?></td>
                                <td><?php echo $data['nama']?></td>
                                <td>
                                    <a href="edit_matakuliah.php?kode_mk=<?php echo $data['kode_mk'];?>"><img src="../../img/update.png" alt="update" class="detail"></a>
                                </td>

                                <td>
                                    <a href="class_delete.php?kode_mk=<?php echo $data['kode_mk'];?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><img src="../../img/delete.png" alt="delete" class="detail"></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>