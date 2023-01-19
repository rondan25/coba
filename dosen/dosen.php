<?php
include('../cekdosen.php');
include ('../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();
$tampil = $db->tampildsn();
$NIM=$_SESSION ['nim'] ;
$query="SELECT * from matakuliah where nim='$NIM'";
$sql= mysqli_query($koneksi,$query);
$dt= mysqli_fetch_array($sql);
$kode_mk = $dt['kode_mk'];
?>

<html>
    <head>
        <link rel="stylesheet" href="../style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
        <title>SIAK - DOSEN</title>
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark">
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
                        <a href="../logout.php"><img src="../img/logout.png" alt="logout" width="20px" class="logout"> Logout</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="jumbotron text-center">
            <img src="../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
            <h1 class="display-6"><?php echo $_SESSION['nim'] ?></h1>
            <h1 class="display-5"><?php echo $_SESSION['nama'] ?></h1>
        </section>

        <!-- biodata  -->
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">BIODATA</h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered border border-secondary ">
                        <?php
                                foreach($tampil as $row);
                                ?>
                                
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td>NIP</td>
                                        <td><?php echo $row['nim'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>NAMA</td>
                                        <td><?php echo $row['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>EMAIL </td>
                                        <td><?php echo $row['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>PHONE </td>
                                        <td><?php echo $row['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>GENDER </td>
                                        <td><?php 
                                                if($row['gender']==1) {
                                                    echo "Laki - Laki"; 
                                                } else if($row['gender']==0){
                                                    echo "Perempuan";
                                                }?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ALAMAT</td>
                                        <td><?php echo $row['alamat'] ?></td>
                                    </tr>
                        </table>
                        <a class="btn btn-primary" href="up_dosen.php?nim=<?=$row['nim']?>" role="button">Update Data</a>
                    </div>
                </div>
            </div>
        </section>
        
        <?php
            $jdw = $db->jdw_dsn();
            if (mysqli_num_rows($db->data)>0) {
        ?>
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">JADWAL DOSEN</h5> 
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered border border-secondary ">  
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Kode MK</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kode Kelas</th>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                        <th>Ruang</th>

                                    </tr>
                                    <?php
                                        foreach($jdw as $mpl){;?>
                                    <tr>
                                        <td><?php echo $mpl['kode_mk'] ?></td>
                                        <td><?php echo $mpl['nama_mk'] ?></td>
                                        <td><?php echo $mpl['kode_kelas'] ?></td>
                                        <td><?php echo $mpl['hari'] ?></td>
                                        <td><?php echo $mpl['waktu'] ?></td>
                                        <td><?php echo $mpl['ruang'] ?></td>
                                    </tr>
                                    <?php }?>
                            </table>
                    </div>
                </div>
            </div>
        </section>
        <?php }?>
        
        <!-- insert nilai  -->
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">INPUT NILAI MAHASISWA</h5> 
                    </div>
                    <div class="card-body">
                        <form action="add_nilai.php" method="post">
                            <div class="mb-3">
                                <label for="nim" class="form-label">Nim</label>
                                <select name="nim" class="form-control" id="nim">
                                    <?php
                                        $query = "SELECT mahasiswa.nim, kelas.kode_kelas
                                        FROM mahasiswa inner join kelas
                                        on mahasiswa.kode_kelas = kelas.kode_kelas
                                        inner join jadwal 
                                        on jadwal.kode_kelas = kelas.kode_kelas
                                        inner join matakuliah 
                                        on matakuliah.kode_mk = jadwal.kode_mk
                                        where matakuliah.nim = '$NIM' 
                                        order by kelas.kode_kelas";
                                        $hasil = mysqli_query($koneksi,$query);
                                    ?>
                                    <option value="">Pilih Nim</option>
                                    <?php while($select=mysqli_fetch_array($hasil)) {?>
                                    <option value="<?=$select['nim'] ?>"><?=$select['nim'] ?> - <?=$select['kode_kelas'] ?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="kode_mk" class="form-label">Kode Matakuliah</label>
                                <select name="kode_mk" class="form-control" id="kode_mk" required>
                                    <?php
                                        $sql = "SELECT * FROM matakuliah where nim='$NIM'";
                                        $data = mysqli_query($koneksi,$sql);
                                    ?>
                                    <option value="">Pilih Kode Matakuliah</option>
                                    <?php while($pilih=mysqli_fetch_array($data)) {?>
                                    <option value="<?=$pilih['kode_mk'] ?>"><?=$pilih['kode_mk'] ." - ". $pilih['nama_mk']?></option>
                                    <?php }?>
                                </select>
                            </div>
                   
                            <div class="form-outline mb-2">
                                <label class="form-label" for="tugas">tugas</label>
                                <input name="tugas" type="text" id="tugas" class="form-control" 
                                placeholder="masukan nilai tugas"/>
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="kuis">kuis</label>
                                <input name="kuis" type="text" id="kuis" class="form-control" 
                                placeholder="masukan nilai kuis"/>
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="uts">uts</label>
                                <input name="uts" type="text" id="uts" class="form-control" 
                                placeholder="masukan nilai uts"/>
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="uas">uas</label>
                                <input name="uas" type="text" id="uas" class="form-control" 
                                placeholder="masukan nilai uas"/>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary" value="simpan">Submit</button>
                            <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                            <a href="detail_nilai.php?kode_mk=<?=$dt['kode_mk']?>" class="btn btn-success" role="button">Detail Nilai</a>
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