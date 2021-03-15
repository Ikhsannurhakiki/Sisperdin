<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SisPerDin | Login</title>

    <!-- Custom fonts for this template-->
    <link href="http://localhost/SisPerDin/assets/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="http://localhost/SisPerDin/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        input[type] {
            color: black;
        }

        body {
            background-image: url("../assets/img/back.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        h3 {
            color: white;
            font-weight: bold;
        }

        .wrapperjudul {

            padding: 50px;
            width: 80%;
            height: 90px;
            margin-top: 20px;
            border-radius: 25px;
            opacity: 0.5;
            position: relative;
        }

        .judul {
            text-align: center;
            text-decoration-color: white;
            margin-top: 30px;
            text-align: center;
            position: absolute;
            padding-top: 120px;

        }
    </style>

</head>

<body>


    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-6 col-md-9">
            <br><br><br>
            <div class="judul">
                <h3>Sistem Informasi Perjalanan Dinas</h3>
                <h3>Dinas Pemberdayaan Masyarakat dan Desa </h3>
                <h3>Kabupaten Indragiri Hulu</h3>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-9">
            <br><br><br>
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                </div>
                                <form class="user" method="post" action="../api/apilogin.php?f=login">
                                    <div class="form-group">
                                        <input type="username" name="username" class="form-control form-control-user" id="exampleInputEmail" placeholder="Inputkan username...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="http://localhost/SisPerDin/assets/vendor/jquery/jquery.min.js"></script>
    <script src="http://localhost/SisPerDin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="http://localhost/SisPerDin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="http://localhost/SisPerDin/assets/js/sb-admin-2.min.js"></script>

</body>

</html>