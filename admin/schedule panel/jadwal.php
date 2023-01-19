<?php 
include('../../koneksi.php');
include('../../cekadmin.php');

$db = new koneksi();
$koneksi = $db->getKoneksi();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_kelas = ($_POST["kode_kelas"]);
}
if(isset($_GET['kode_kelas'])){
    $kode_kelas = $_GET['kode_kelas'];
}
?>

<html>
    <head>
        <title>SIAK - JADWAL</title>
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

        <!-- list jadwal  -->
        <?php 
            $no = 1;
            $query = 
                "SELECT matakuliah.kode_mk, nama_mk, jadwal.hari, waktu, ruang, dosen.nama
                FROM 
                    matakuliah inner join jadwal
                    ON matakuliah.kode_mk = jadwal.kode_mk
                    inner join dosen
                    ON dosen.nim = matakuliah.nim
                WHERE jadwal.kode_kelas = '$kode_kelas'
            ";
            $hasil = mysqli_query($koneksi, $query);
            
            if(mysqli_num_rows($hasil) > 0) { 
        ?>
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">JADWAL KELAS <?PHP echo $kode_kelas?></h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle table-hover">
                            <tr class="table-secondary">
                                <th>NO.</th>
                                <th>KODE MATAKULIAH</th>
                                <th>MATAKULIAH</th>
                                <th>HARI</th>
                                <th>RUANG</th>
                                <th  width="120px">WAKTU</th>
                                <th>DOSEN</th>
                                <th colspan="2">AKSI</th>
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
                                <td>
                                    <a href="edit_jadwal.php?kode_kelas=<?php echo $kode_kelas;?>&kode_mk=<?php echo $row['kode_mk'];?>"><img src="../../img/update.png" alt="update" class="detail"></a>
                                </td>
                                <td>
                                    <a href="delete_jadwal.php?kode_mk=<?php echo $row['kode_mk']; ?>&kode_kelas=<?php echo $kode_kelas;?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><img src="../../img/delete.png" alt="delete" class="detail"></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table> 
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>


        <!-- create jadwal  -->
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">CREATE JADWAL KELAS <?PHP echo $kode_kelas; ?></h5> 
                    </div>
                    <div class="card-body">
                        <form action="class_jadwal.php" method="post">
                            <div class="mb-1">
                                <label for="kode_mk" class="form-label">Kode Matakuliah</label>
                                <select name="kode_mk" class="form-control" id="kode_mk">
                                    <?php
                                        $query = "SELECT * FROM matakuliah";
                                        $hasil = mysqli_query($koneksi,$query);
                                    ?>
                                    <option value="">- Kode Matakuliah -</option>
                                    <?php while($select=mysqli_fetch_array($hasil)) {?>
                                    <option value="<?=$select['kode_mk'] ?>"><?=$select['kode_mk'] ?> - <?=$select['nama_mk'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="hari" class="form-label">Hari</label>
                                <input type="text" name="hari" class="form-control" id="hari" aria-describedby="hari" required>
                            </div>
                            <div class="mb-1">
                                <label for="hari" class="form-label">Ruang</label>
                                <input type="text" name="ruang" class="form-control" id="ruang" aria-describedby="ruang" required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu</label>
                                <input type="text" name="waktu" class="form-control" id="waktu" aria-describedby="waktu" required>
                            </div>
                            <input type="hidden" name="kode_kelas" value="<?php echo $kode_kelas; ?>" />
                            <button type="submit" class="btn btn-primary mb-3" value="simpan">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
    </body>
</html>