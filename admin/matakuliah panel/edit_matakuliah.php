<?php
include('../../cekadmin.php');
include('../../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

class Matakuliah {
    public $kode_mk;
    public $nama_mk;
    public $sks;
    public $nim;
    public $query;
    public $sql;
    public $data;

    public function getKode_mk()
    {
        if(isset($_GET['kode_mk'])){
            $this->kode_mk = $_GET['kode_mk'];
        }
    }

    public function read() {
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->sql = mysqli_query($koneksi, "SELECT matakuliah.kode_mk, nama_mk, sks, matakuliah.nim, dosen.nama FROM matakuliah INNER JOIN dosen
        ON matakuliah.nim = dosen.nim
        WHERE kode_mk='$this->kode_mk'");
        $this->data = mysqli_fetch_array($this->sql);
    }
}

$updateObj = new matakuliah();
$getmk = $updateObj->getKode_mk();
$hasil = $updateObj->read();
?>

<html>
    <head>
        <title>SIAK - UPDATE MATAKULIAH</title>
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
                        <h5 class="card-title mb-2">UPDATE MATAKULIAH - <?php echo $updateObj->kode_mk; ?></h5> 
                    </div>
                    <div class="card-body">
                        <form action="class_update.php" method="post">
                            <div class="mb-1">
                                <label for="nama_mk" class="form-label">Nama Matakuliah</label>
                                <input type="text" name="nama_mk" class="form-control" id="nama_mk" aria-describedby="nama_mk" required value="<?php echo $updateObj->data['nama_mk']?>">
                            </div>
                            <div class="mb-1">
                                <label for="sks" class="form-label">SKS</label>
                                <input type="text" name="sks" class="form-control" id="sks" aria-describedby="sks" required value="<?php echo $updateObj->data['sks']?>">
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label">Dosen</label>
                                <select name="nim" class="form-control" id="nim" required>
                                    <?php
                                        $sql = "SELECT * FROM dosen";
                                        $data = mysqli_query($koneksi,$sql);
                                    ?>
                                    <option value="<?php echo $updateObj->data['nim']?>"><?php echo $updateObj->data['nim']?> - <?php echo $updateObj->data['nama']?></option>
                                    <?php while($pilih=mysqli_fetch_array($data)) {?>
                                    <option value="<?=$pilih['nim'] ?>"><?=$pilih['nim'] ." - ". $pilih['nama']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <input type="hidden" name="kode_mk" value="<?php echo $updateObj->kode_mk; ?>" /> 
                            <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>  
            </div>
        </section>
    </body>
</html>