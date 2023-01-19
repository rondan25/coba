<?php
include('../cekdosen.php');
include ('../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();
// $tampil = $db->nilai();

if(isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk']; 
}
if(isset($_GET['nim'])){
    $nim = $_GET['nim']; 
}



?>

<html>
    <head>
        <title>SIAK - UPDATE NILAI</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark mb-5">
            <div class="container">
                <a class="navbar-brand" href="Index.php">SISTEM INFORMASI AKADEMIK</a>
                <ul class="navbar-nav ms-auto">
                    <li class="navbar-brand fs-6">
                        <?php 
                            date_default_timezone_set('Asia/Kuala_Lumpur');
                            echo "Welcome " . $_SESSION['username'];
                            echo date(' |  H:i:s');
                        ?>
                    </li>
                    <li class="navbar-brand fs-6">
                        <a href="../logout.php"><img src="../img/logout.png" alt="logout" width="20px" class="logout"> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <section>
            <div class="container d-flex justify-content-center dosen">
            

            <div class="container d-flex justify-content-center dosen mb-5">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">EDIT NILAI - <?php echo $nim ?> </h5> 
                    </div>
                    <div class="card-body">
                        <form action="class_up_nilai.php" method="post">
                        <?php 
                                $data=mysqli_query($koneksi, "SELECT * FROM nilai where kode_mk='$kode_mk' AND nim='$nim'");
                                $row = mysqli_fetch_array($data)
			                ?>

                            <div class="mb-1">
                                <label for="kuis" class="form-label">KUIS</label>
                                <input type="text" name="kuis" class="form-control" id="kuis" aria-describedby="kuis" value="<?php echo $row['kuis'] ?>">
                            </div>
                            <div class="mb-1">
                                <label for="tugas" class="form-label">TUGAS</label>
                                <input type="tugas" name="tugas" class="form-control" id="tugas" aria-describedby="tugas" value="<?php echo $row['tugas'] ?>">
                            
                            <div class="mb-1">
                                <label for="uts" class="form-label">UTS</label>
                                <input type="text" name="uts" class="form-control" id="uts" aria-describedby="alamat" value="<?php echo $row['uts'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="uas" class="form-label">UAS</label>
                                <input type="text" name="uas" class="form-control" id="uas" aria-describedby="uas" value="<?php echo $row['uas'] ?>">
                            </div>
                            <input type="hidden" name="nim" value="<?php echo $row['nim']; ?>" /> 
                            <input type="hidden" name="kode_mk" value="<?php echo $kode_mk; ?>" /> 
                            <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <div
            class="d-flex flex-column flex-md-row text-md-start justify-content-between py-4 px-4 px-xl-5 bg-dark">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0 text-center">
                ©INERSYSUNIVERSITY2023. All rights reserved.
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
