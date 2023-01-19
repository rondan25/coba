<?php
include('../../koneksi.php');
include('../../cekadmin.php');

$db = new koneksi();
$koneksi = $db->getKoneksi();

if(isset($_GET['kode_kelas'])){
    $kode_kelas = $_GET['kode_kelas'];
}
if(isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk'];
}

$sql = mysqli_query($koneksi, "SELECT matakuliah.nama_mk, jadwal.hari, ruang, waktu FROM matakuliah INNER JOIN jadwal ON matakuliah.kode_mk = jadwal.kode_mk WHERE matakuliah.kode_mk = '$kode_mk' AND jadwal.kode_kelas = '$kode_kelas'");
$data = mysqli_fetch_array($sql);
?>

<html>
    <head>
        <title>SIAK - UPDATE JADWAL</title>
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
                        <h5 class="card-title mb-2">EDIT JADWAL KELAS <?PHP echo $kode_kelas?></h5> 
                    </div>
                    <div class="card-body">
                        <form action="class_editJadwal.php" method="post">
                            <div class="mb-1">
                                <label for="ruang" class="form-label">Ruang</label>
                                <input type="text" name="ruang" class="form-control" id="ruang" aria-describedby="ruang" required value="<?php echo $data['ruang']?>">
                            </div>
                            <div class="mb-1">
                                <label for="hari" class="form-label">Hari</label>
                                <input type="text" name="hari" class="form-control" id="hari" aria-describedby="hari" required value="<?php echo $data['hari']?>">
                            </div>
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu</label>
                                <input type="text" name="waktu" class="form-control" id="waktu" aria-describedby="waktu" required value="<?php echo $data['waktu']?>">
                            </div>
                            <input type="hidden" name="kode_kelas" value="<?php echo $kode_kelas; ?>" />
                            <input type="hidden" name="kode_mk" value="<?php echo $kode_mk; ?>" />
                            <button type="submit" class="btn btn-primary" value="simpan">Simpan</button>
                            <a href="cari_jadwal.php?kode_kelas=<?PHP echo $kode_kelas;?>" class="btn btn-danger" role="button">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>