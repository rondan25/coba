<?php
    include('../../cekadmin.php');
    include('../../koneksi.php');
    include('class_getNim.php');

    $db = new koneksi();
    $koneksi = $db->getKoneksi();

    $getNim = new getNim();
    $nim = $getNim->getNim();

    $query = mysqli_query($koneksi, "SELECT mahasiswa.nim, mahasiswa.nama, kode_kelas, tempat_lahir, tanggal_lahir, gender, phone, email, ayah, ibu, prodi, alamat, user.username, password
    FROM mahasiswa inner join user 
    On mahasiswa.nim = user.nim
    WHERE mahasiswa.nim='$nim'");
    $data = mysqli_fetch_array($query);
?>

<html>
    <head>
        <title>SIAK - BIODATA MAHASISWA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../../style.css">
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark">
            <div class="container">
                <a class="navbar-brand" href="users_list.php">SISTEM INFORMASI AKADEMIK</a>
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

        <!-- Profile  -->
        <section class="jumbotron text-center">
            <img src="../../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
            <h1 class="display-5"><?php echo $data['nama'] ?></h1>
        </section>

        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">USER INFORMATION</h5> 
                    </div>
                    <div class="card-body" >
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td style="width:20rem;">NIM</td>
                                <td><?php echo $data['nim'] ?></td>
                            </tr>
                            <tr>
                                <td>NAMA</td>
                                <td><?php echo $data['nama'] ?></td>
                            </tr>
                            <tr>
                                <td>KELAS</td>
                                <td><?php echo $data['kode_kelas'] ?></td>
                            </tr>
                            <tr>
                                <td>USERNAME</td>
                                <td><?php echo $data['username'] ?></td>
                            </tr>
                            <tr>
                                <td>PASSWORD</td>
                                <td><?php echo $data['password'] ?></td>
                            </tr>
                            <tr>
                                <td>TEMPAT LAHIR</td>
                                <td><?php echo $data['tempat_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td>TANGGAL LAHIR</th>
                                <td><?php echo $data['tanggal_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td>GENDER</th>
                                <td><?php 
                                        if($data['gender']==1) {
                                            echo "Laki - Laki"; 
                                        } else if($data['gender']==0){
                                            echo "Perempuan";
                                        }?>
                                </td>
                            </tr>
                            <tr>
                                <td>PHONE</td>
                                <td><?php echo $data['phone'] ?></td>
                            </tr>
                            <tr>
                                <td>EMAIL</td>
                                <td><?php echo $data['email'] ?></td>
                            </tr>
                            <tr>
                                <td>AYAH</td>
                                <td><?php echo $data['ayah'] ?></td>
                            </tr>
                            <tr>
                                <td>IBU</th>
                                <td><?php echo $data['ibu'] ?></td>
                            </tr>
                            <tr>
                                <td>PRODI</td>
                                <td><?php echo $data['prodi'] ?></td>
                            </tr>
                            <tr>
                                <td>ALAMAT</td>
                                <td><?php echo $data['alamat'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- UPDATE DATA  -->
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">EDIT USER INFORMATION</h5> 
                    </div>
                    <div class="card-body">
                        <form action="class_upData.php" method="post">
                        <div class="mb-2">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="username" aria-describedby="username" value="<?php echo $data['username'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" id="password" aria-describedby="password" value="<?php echo $data['password'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="kode_kelas" class="form-label">Kelas</label>
                                <select name="kode_kelas" class="form-control" id="kode_kelas">
                                    <?php
                                        $query = "SELECT * FROM kelas";
                                        $hasil = mysqli_query($koneksi,$query);
                                    ?>
                                    <option value="<?php echo $data['kode_kelas'] ?>"><?php echo $data['kode_kelas'] ?></option>
                                    <?php while($select=mysqli_fetch_array($hasil)) {?>
                                    <option value="<?=$select['kode_kelas'] ?>"><?=$select['kode_kelas'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" aria-describedby="tempat_lahir" value="<?php echo $data['tempat_lahir'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" aria-describedby="tanggal_lahir" value="<?php echo $data['tanggal_lahir'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="gender" class="form-label">Gender</label> <br>
                                <input type="radio" name="gender" value ="1" <?php if ($data['gender'] =='1'){ echo "CHECKED"; }?> required/> Laki - Laki
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value ="0" <?php if ($data['gender'] =='0'){ echo "CHECKED"; }?> required/> Perempuan
                            </div>
                            <div class="mb-2">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phone" value="<?php echo $data['phone'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email" value="<?php echo $data['email'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="ayah" class="form-label">Ayah</label>
                                <input type="text" name="ayah" class="form-control" id="ayah" aria-describedby="ayah" value="<?php echo $data['ayah'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="ibu" class="form-label">Ibu</label>
                                <input type="text" name="ibu" class="form-control" id="ibu" aria-describedby="ibu" value="<?php echo $data['ibu'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="prodi" class="form-label">Prodi</label>
                                <select name="prodi" class="form-control" id="prodi">
                                <option value="">- Prodi -</option>
                                <option value="SK" <?php if ($data['prodi']=='SK'){echo"SELECTED";}?>>S1-Sistem Komputer</option>
                                <option value="SI" <?php if ($data['prodi']=='SI'){echo"SELECTED";}?>>S1-Sistem Informasi</option>
                                <option value="TI" <?php if ($data['prodi']=='TI'){echo"SELECTED";}?>>S1-Teknologi Informasi</option>
                                <option value="BD" <?php if ($data['prodi']=='BD'){echo"SELECTED";}?>>S1-Bisnis Digital</option>
                                <option value="MI" <?php if ($data['prodi']=='MI'){echo"SELECTED";}?>>D3-Manajemen Informatika</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" aria-describedby="alamat" value="<?php echo $data['alamat'] ?>">
                            </div>
                            <input type="hidden" name="nim" value="<?php echo $data['nim']; ?>" /> 
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