<?php
include('../cekdosen.php');
include ('../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

if(isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk']; 
}

?>


<html>
    <head>
        <title>SIAK - LIST NILAI</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark">
            <div class="container">
                <a class="navbar-brand" href="dosen.php">SISTEM INFORMASI AKADEMIK</a>
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
                        <a href="../logout.php"><img src="../img/logout.png" alt="logout" width="20px" class="logout"> Logout</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Profile  -->
        <section class="jumbotron text-center">
            <img src="../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
            <h1 class="display-6"><?php echo $_SESSION['nim'] ?></h1>
            <h1 class="display-5"><?php echo $_SESSION['nama'] ?></h1>
        </section>

        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">DAFTAR NILAI <?php echo $kode_mk;?></h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <tr>
                                <th>NO</th>
                                <th>NIM</th>
                                <th>NAMA</th>
                                <th>KODE KELAS</th>
                                <th>KUIS</th>
                                <th>TUGAS</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th colspan="2">AKSI</th>
                            </th>

                            <?php 
                                $data=mysqli_query($koneksi, "SELECT mahasiswa.nim, mahasiswa.nama, kelas.kode_kelas, nilai.uas, uts, tugas, kuis FROM nilai inner join mahasiswa on mahasiswa.nim = nilai.nim 
                                inner join kelas on mahasiswa.kode_kelas = kelas.kode_kelas
                                where kode_mk='$kode_mk' order by kelas.kode_kelas");

		                        $no = 1;
		                        while($row = mysqli_fetch_array($data)){

                                
			                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nim'] ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['kode_kelas'] ?></td>
                                    <td><?php echo $row['kuis'] ?></td>
                                    <td><?php echo $row['tugas'] ?></td>
                                    <td><?php echo $row['uts'] ?></td>
                                    <td><?php echo $row['uas'] ?></td>
                                    <td>
                                        <a href="up_nilai.php?nim=<?php echo $row['nim'];?>&kode_mk=<?php echo $kode_mk;?>"><img src="../img/update.png" alt="update" class="detail"></a>
                                    </td>

                                    <td>
                                        <a href="del_nilai.php?nim=<?php echo $row['nim']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><img src="../img/delete.png" alt="delete" class="detail"></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            
                        </table>
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