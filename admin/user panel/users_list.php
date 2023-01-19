<?php
include('../../cekadmin.php');
include('../../koneksi.php');

$db = new koneksi();
$tampil = $db->addUser();
?>

<html>
    <head>
        <title>SIAK - LIST USER</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../../style.css">
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark mb-5">
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

        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">DAFTAR USER</h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped text-center table-hover">
                            <tr class="table-secondary">
                                <th>NO.</th>
                                <th>NIM/NIP</th>
                                <th>NAMA</th>
                                <th>KODE KELAS</th>
                                <th>USERNAME</th>
                                <th>PASSWORD</th>
                                <th>LEVEL</th>
                                <th colspan="2">AKSI</th>
                            </tr>

                            <?php 
		                        $no = 1;
		                        foreach ($tampil as $row){
			                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nim'] ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['kode_kelas'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['password'] ?></td>
                                    <td><?php echo $row['level'] ?></td>
                                    <td>
                                        <?php if ($row['level'] == "Dosen") { ?>
                                            <a href="detail_dosen.php?nim=<?=$row['nim']?>"><img src="../../img/update.png" alt="info" class="detail"></a>
                                        <?php } else if ($row['level'] == "Mahasiswa") { ?>
                                            <a href="detail_mhs.php?nim=<?=$row['nim']?>"><img src="../../img/update.png" alt="info" class="detail"></a>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <a href="class_delete.php?nim=<?php echo $row['nim']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><img src="../../img/delete.png" alt="delete" class="detail"></a>
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