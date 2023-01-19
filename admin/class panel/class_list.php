<?php
include("../../koneksi.php");
include('../../cekadmin.php');


class tampil{
    public $query;
    public $data;

    public function tampil_list(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->query = mysqli_query($koneksi, "SELECT * FROM kelas");
    }
}

$dataObj = new tampil();
$row = $dataObj->tampil_list();
?>

<html>
    <head>
        <title>SIAK - LIST KELAS</title>
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
                <div class="card" style="width: 50rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">LIST KELAS</h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle table-hover">
                            <tr class="table-secondary">
                                <th width="50px">NO.</th>
                                <th>KODE KELAS</th>
                                <th>KAPASITAS</th>
                                <th>AKSI</th>
                            </tr>

                            <?php 
                            $no=1;
                            while($data = mysqli_fetch_array($dataObj->query)) { ?>
                            <tr>
                                <td><?php echo $no++?></td>
                                <td><?php echo $data['kode_kelas']?></td>
                                <td><?php echo $data['kapasitas']?></td>
                                <td>
                                    <a href="delete_kelas.php?kode_kelas=<?php echo $data['kode_kelas'];?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><img src="../../img/delete.png" alt="delete" class="detail"></a>
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