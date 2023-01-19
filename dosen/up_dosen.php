<?php
include('../cekdosen.php');
include ('../koneksi.php');
include('../admin/user panel/class_getNim.php');

$db = new koneksi();
$koneksi = $db->getKoneksi();


$getNim = new getNim();
$nim = $getNim->getNim();
$db = new koneksi();
$tampil = $db->tampildsn();
?>

<html>
    <head>
        <title>SIAK - UPDATE BIODATA</title>
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

        <section>
            <div class="container d-flex justify-content-center dosen mb-5">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">EDIT BIODATA</h5> 
                    </div>
                    <div class="card-body">
                        <form action="biodata_dosen.php" method="post">
                            <?php
                            foreach($tampil as $row);
                            ?>
                            <div class="mb-2">
                                <label for="gender" class="form-label">Gender</label> <br>
                                <input type="radio" name="gender" value ="1" <?php if ($row['gender'] =='1'){ echo "CHECKED"; }?> required/> Laki - Laki
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value ="0" <?php if ($row['gender'] =='0'){ echo "CHECKED"; }?> required/> Perempuan
                            </div>
                            <div class="mb-2">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phone" value="<?php echo $row['phone'] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email" value="<?php echo $row['email'] ?>">
                            
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" aria-describedby="alamat" value="<?php echo $row['alamat'] ?>">
                            </div>
                            <input type="hidden" name="nim" value="<?php echo $row['nim']; ?>" /> 
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
