<?php
include('../cekadmin.php');  
include('../koneksi.php');  
$db = new koneksi();
$koneksi = $db->getKoneksi();
?>

<html>
    <head>
        <title>SIAK - ADMIN</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
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

        <!-- Profile  -->
        <section class="jumbotron text-center">
            <img src="../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
            <h1 class="display-5"><?php echo $_SESSION['nama'] ?></h1>
        </section>
        
        

        <!-- Control panel admin  -->
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">USER PANEL</h5> 
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-2">Add User</h5> 
                        <form action="user panel/add_user.php" method="post">
                            <div class="mb-1">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" aria-describedby="nama" required>
                            </div>
                            <div class="mb-1">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" name="nim" class="form-control" id="nim" aria-describedby="nim" required>
                            </div>
                            <div class="mb-1">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
                            </div>
                            <div class="mb-1">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="mb-1">
                                <label for="level" class="form-label">Level</label>
                                <select name="level" class="form-control" required>
									<option value="">Pilih Level User</option>
									<option value="Dosen">Dosen</option>
									<option value="Mahasiswa">Mahasiswa</option>
								</select>
                            </div>
                            <div class="mb-3">
                                <label for="kode_kelas" class="form-label">Kode Kelas <span style="color:red;">* hanya untuk level mahasiswa!</span></label>
                                <select name="kode_kelas" class="form-control" id="kode_kelas">
                                    <?php
                                        $query = "SELECT * FROM kelas";
                                        $hasil = mysqli_query($koneksi,$query);
                                    ?>
                                    <option value="">Pilih Kode Kelas</option>
                                    <?php while($select=mysqli_fetch_array($hasil)) {?>
                                    <option value="<?=$select['kode_kelas'] ?>"><?=$select['kode_kelas'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="user panel/users_list.php" class="btn btn-success" role="button">User List</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">CLASS PANEL</h5> 
                    </div>
                    <div class="card-body">
                    <h5 class="card-title mb-2">Add Class</h5> 
                    <form action="class panel/class_tambahKelas.php" method="post">
                        <div class="mb-1">
                            <label for="kode_kelas" class="form-label">Kode Kelas</label>
                            <input type="text" name="kode_kelas" class="form-control" id="kode_kelas" aria-describedby="kode_kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="text" name="kapasitas" class="form-control" id="kapasitas" aria-describedby="kapasitas" required>
                        </div>
                        <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="class panel/class_list.php" class="btn btn-success" role="button">Class List</a>
                    </form>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">MATAKULIAH PANEL</h5> 
                    </div>
                    <div class="card-body">
                    <h5 class="card-title mb-2">Add Matakuliah</h5> 
                    <form action="matakuliah panel/class_tambah.php" method="post">
                        <div class="mb-1">
                            <label for="kode_mk" class="form-label">Kode Matakuliah</label>
                            <input type="text" name="kode_mk" class="form-control" id="kode_mk" aria-describedby="kode_mk" required>
                        </div>
                        <div class="mb-1">
                            <label for="nama_mk" class="form-label">Nama Matakuliah</label>
                            <input type="text" name="nama_mk" class="form-control" id="nama_mk" aria-describedby="nama_mk" required>
                        </div>
                        <div class="mb-1">
                            <label for="sks" class="form-label">SKS</label>
                            <input type="text" name="sks" class="form-control" id="sks" aria-describedby="sks" required>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">Dosen</label>
                            <select name="nim" class="form-control" id="nim" required>
                                <?php
                                    $sql = "SELECT * FROM dosen";
                                    $data = mysqli_query($koneksi,$sql);
                                ?>
                                <option value="">Pilih Dosen</option>
                                <?php while($pilih=mysqli_fetch_array($data)) {?>
                                <option value="<?=$pilih['nim'] ?>"><?=$pilih['nim'] ." - ". $pilih['nama']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="matakuliah panel/matakuliah_list.php" class="btn btn-success" role="button">Matakuliah List</a>
                    </form>
                    </div>
                </div>
            </div>
        </section>
             
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">SCHEDULE PANEL</h5> 
                    </div>
                    <div class="card-body">
                        <h5>Create Schedule</h5>
                        <form action="schedule panel/jadwal.php" method="post">
                            <div class="mb-3">
                                <label for="nim" class="form-label">Kode Kelas</label>
                                <select name="kode_kelas" class="form-control" id="kode_kelas" required>
                                    <?php
                                        $query = "SELECT * FROM kelas";
                                        $hasil = mysqli_query($koneksi,$query);
                                    ?>
                                    <option value="">Pilih Kode Kelas</option>
                                    <?php while($select=mysqli_fetch_array($hasil)) {?>
                                    <option value="<?=$select['kode_kelas'] ?>"><?=$select['kode_kelas'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" value="create">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
            
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">GRADE PANEL</h5> 
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-2">Add Nilai</h5>
                        <form action="grade panel/class_nilai.php" method="post">
                            <div class="mb-3">
                                    <label for="nim" class="form-label">Nim</label>
                                    <select name="nim" class="form-control" id="nim">
                                        <?php
                                            $query = "SELECT * FROM mahasiswa order by kode_kelas";
                                            $hasil = mysqli_query($koneksi,$query);
                                        ?>
                                        <option value="">Pilih Nim</option>
                                        <?php while($select=mysqli_fetch_array($hasil)) {?>
                                        <option value="<?=$select['nim'] ?>"><?=$select['nim'] ?> - <?=$select['kode_kelas'] ?></option>
                                        <?php }?>
                                    </select>
                            </div>
                            <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
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