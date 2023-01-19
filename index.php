<?php
session_start();
if($_SESSION){
	if($_SESSION['level']=="Administrator")
	{
		header("Location: admin/admin.php");
	}
	if($_SESSION['level']=="Dosen")
	{
		header("Location: dosen/dosen.php");
	}
	if($_SESSION['level']=="Mahasiswa")
	{
		header("Location: mahasiswa/mahasiswa.php");
	}
}
include('login.php');  
?>

<html>
    <head>
        <title>SIAK</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>

    <body>
        <section class="login justify c">
            <div class="container d-flex justify-content-center">
                <div class="col-7 text-center">
                    <img src="img/SIAK.png" class="img-fluid" width="300px">
                </div>

                <div class="col-3">
                    <form role="form" method="post">
                        <!-- Username input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input name="username" type="text" id="username" class="form-control form-control-lg"
                                placeholder="Enter Username" required/>
                            </div>

                        <!-- Password input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input name="password" type="password" id="password" class="form-control form-control-lg"
                                placeholder="Enter Password" required/>
                            </div>
                        
                        <!-- role select  -->
                            <!-- <div class="form-outline mb-3">
                                <select name="level" class="form-control" required>
									<option value="">Hak Akses</option>
									<option value="1">Administrator</option>
									<option value="2">Dosen</option>
									<option value="3">Mahasiswa</option>
								</select>
                            </div> -->

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button name="submit" type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;" >Login</button>
                            </div>
                            <?php echo $error; ?>
                    </form>
                </div>
                <div class="col-2"></div>
            </div>

        
        </section>

        <div
            class="d-flex flex-column flex-md-row text-md-start justify-content-between py-4 px-4 px-xl-5 bg-dark">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0 text-center">
                ©INERSYSUNIVERSITY2023. All rights reserved.
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
    </body>
</html>