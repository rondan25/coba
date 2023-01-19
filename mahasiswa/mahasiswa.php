<?php
include ('../cekmahasiswa.php');
include ('../koneksi.php');
$db = new koneksi();
$tampil = $db->tampilmhs();

?>

<html>
    <head>
        <title>SIAK - MAHASISWA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark">
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

        <!-- Profile  -->
        <section class="jumbotron text-center">
            <img src="../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
            <h1 class="display-6"><?php echo $_SESSION['nim'] ?></h1>
            <h1 class="display-5"><?php echo $_SESSION['nama'] ?></h1>
        </section>

        <!-- biodata  -->
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                        <?php
                        foreach($tampil as $row);
                        ?>
                        
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">USER INFORMATION</h5> 
                    </div>
                    <div class="card-body table-responsive" >
                        <table class="table table-bordered table-striped">
                        <?php
                        foreach($tampil as $row) {;
                        ?>
                            <tr>
                                <td>NIM</td>
                                <td><?php echo $row['nim'] ?></td>
                            </tr>
                            <tr>
                                <td>NAMA</td>
                                <td><?php echo $row['nama'] ?></td>
                            </tr>
                            <tr>
                                <td>KELAS</td>
                                <td><?php echo $row['kode_kelas'] ?></td>
                            </tr>
                            <tr>
                                <td>TEMPAT LAHIR</td>
                                <td><?php echo $row['tempat_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td>TANGGAL LAHIR</th>
                                <td><?php echo $row['tanggal_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td>JENIS KELAMIN</th>
                                <td><?php if($row['gender']==1) {
                                            echo "Laki - Laki"; 
                                        } else if($row['gender']==0){
                                            echo "Perempuan";
                                        }?></td>
                            </tr>
                            <tr>
                                <td>PHONE</td>
                                <td><?php echo $row['phone'] ?></td>
                            </tr>
                            <tr>
                                <td>EMAIL</td>
                                <td><?php echo $row['email'] ?></td>
                            </tr>
                            <tr>
                                <td>AYAH</td>
                                <td><?php echo $row['ayah'] ?></td>
                            </tr>
                            <tr>
                                <td>IBU</th>
                                <td><?php echo $row['ibu'] ?></td>
                            </tr>
                            <tr>
                                <td>PRODI</td>
                                <td><?php if($row['prodi']=='SK') {
                                            echo "SISTEM KOMPUTER"; 
                                        } else if($row['prodi']=='SI'){
                                            echo "SISTEM INFORMASI";
                                        }else if($row['prodi']=='TI'){
                                            echo "TEKNOLOGI INFORMASI";
                                        }else if($row['prodi']=='BD'){
                                            echo "BISNIS DIGITAL";
                                        }else if($row['prodi']=='MK'){
                                            echo "MANAJEMEN INFORMATIKA";
                                        }
                                        ?></td>
                            </tr>
                            <tr>
                                <td>ALAMAT</td>
                                <td><?php echo $row['alamat'] ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                        <a href="user_mhs.php?nim=<?=$_SESSION['nim']?>" class="btn btn-primary" role="button">Edit Biodata</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- jadwal -->
        <?php 
            $db = new koneksi();
            $koneksi = $db->getKoneksi();
            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$_SESSION[nim]'");
            $data = mysqli_fetch_array($query);

                $no = 1;
                $query = 
                    "SELECT matakuliah.kode_mk, nama_mk, jadwal.hari, waktu, ruang, dosen.nama
                    FROM 
                        matakuliah inner join jadwal
                        ON matakuliah.kode_mk = jadwal.kode_mk
                        inner join dosen
                        ON dosen.nim = matakuliah.nim
                    WHERE jadwal.kode_kelas = '$data[kode_kelas]'
                ";
                $hasil = mysqli_query($koneksi, $query);
                
                if (mysqli_num_rows($hasil) > 0){
        ?>
        <section>                    
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">JADWAL</h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle ">
                            <tr>
                                <th>NO.</th>
                                <th>KODE MATAKULIAH</th>
                                <th>MATAKULIAH</th>
                                <th>HARI</th>
                                <th>RUANG</th>
                                <th width="120px">WAKTU</th>
                                <th>DOSEN</th>
                            </tr>

                            <?php
                                while ($row = mysqli_fetch_array($hasil)) {
			                ?>
                            <tr>
                                
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['kode_mk']; ?></td>
                                <td><?php echo $row['nama_mk']; ?></td>
                                <td><?php echo $row['hari']; ?></td>
                                <td><?php echo $row['ruang']; ?></td>
                                <td><?php echo $row['waktu']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                            </tr>
                            <?php } ?>
                        </table> 
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>

        <!-- NIlai -->
        <?php 
            $db = new koneksi();
            $koneksi = $db->getKoneksi();
            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$_SESSION[nim]'");
            $data = mysqli_fetch_array($query);
            $no = 1;
            $query = 
                "SELECT nilai.kode_mk, matakuliah.nama_mk, uas, uts, tugas, kuis
                FROM nilai inner join matakuliah 
                ON nilai.kode_mk = matakuliah.kode_mk
                WHERE nilai.nim='$_SESSION[nim]'";
            $sql = mysqli_query($koneksi, $query);    
            $no=1;
            if (mysqli_num_rows($sql) > 0){
        ?>
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">NILAI</h5> 
                    </div>
                    <div class="card-body table-responsive"> 
                        <table class="table table-bordered table-striped text-center align-middle ">
                            <tr>
                                <th>NO.</th>
                                <th>KODE MATAKULIAH</th>
                                <th>MATAKULIAH</th>
                                <th>UAS</th>
                                <th>UTS</th>
                                <th>KUIS</th>
                                <th>TUGAS</th>
                            </tr>

                            <?php
                            while ($row = mysqli_fetch_array($sql)) {
			                ?>
                            <tr>
                            <td><?php echo $no++?></td>
                                <td><?php echo $row['kode_mk'];?></td>
                                <td><?php echo $row['nama_mk'];?></td>
                                <td><?php echo $row['uas'];?></td>
                                <td><?php echo $row['uts'];?></td>
                                <td><?php echo $row['kuis'];?></td>
                                <td><?php echo $row['tugas'];?></td>
                            </tr>
                            <?php } ?>
                        </table> 
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <div
            class="d-flex flex-column flex-md-row text-md-start justify-content-between py-4 px-4 px-xl-5 bg-dark">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0 text-center">
                ©INERSYSUNIVERSITY2023. All rights reserved.
            </div>
        </div>
    </body>
</html>