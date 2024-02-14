<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <title>الصفحة الرئيسية</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size:24px;
            font-family: sans-serif;
        }
        .myBox {
            padding-top: 10px;
            padding-right: 30px;

        }
        .container {
            width: 100%;
            padding: 0 0;
        }

        .container h1 {
            text-align: center;
            padding-top: 10%;
            font-weight: 6000;
            position: relative;
            text-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        /* .container h1::after {
            content: '';
            background: #303ef7;
            width: 100px;
            height: 5px;
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);

        } */
        .box {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            min-height: 400px;
            margin: 25px;
            justify-content: space-between;

        }      

        .card {
            flex: 15%;
            height: 250px;
            width: 300px;
            justify-content: center;
            align-items: center;
            box-shadow: 0 1px 10px 5px rgba(0, 0, 0, 0.1);
            padding: 20px 35px;
            border-radius: 10px;
            border: darkgray;
            margin: 10px;
            position: relative;
            overflow: hidden;
            text-align: center;
            cursor: pointer;
        }

        .button {
            text-decoration: none;
            color: black;
            background: none;
            cursor: pointer;
            transition: 0.8s;

        }

        .card:hover {
            transition: 0.4s ease;
            background: mistyrose;
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-white navbar-light">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
            data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="myBox justify-content-right">
            <div class="row">
                <div class="col-12 d-flex justify-content-right mb-3">
                    <a class="navbar-brand" href="#"><img id="MDB-logo"
                            src="https://firebasestorage.googleapis.com/v0/b/senior-project-72daf.appspot.com/o/app_use%2FSabreen_Logo%20clear.png?alt=media&token=8ae867f9-f3c5-4ee8-b53d-f4c8a2a83873"
                            alt="مجتمعي" draggable="false" height="70" /></a>
                </div>

            </div>
        </div>
    </nav>
    <!-- end nav -->
    <div class="container" style="margin-top: 30px;">
        <h1>الخدمات</h1>
        <div class="box">
            <div class="card">
                <a href="{{ route('opportunities.index') }}" class="button">الفرص التطوعية</a>

            </div>
            <div class="card">
                <a href="{{ route('offers.index') }}" class="button">
                    العروض الحصرية
                </a>
            </div>
            <div class="card">
                <a href="{{ route('courses.index') }}" class="button">
                    الفعاليات
                </a>
            </div>
            <div class="card">
                <a href="{{ route('clinic.index') }}" class="button">
                    مواعيد العيادات
                </a>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>

</html>