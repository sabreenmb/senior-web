
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@3.10.0/css/mdb.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

    
    <title>الصفحة الرئيسية</title>

    <style>
            .active {
      text-decoration-line: underline;
      text-decoration-color: #F2D1BE;
    }
    .myBox {
      padding-top: 10px;
      padding-right: 30px;
    }
    .myBtn:hover,
    .myBtn,
    .myBtn:focus {
      background: #83CCEA;
      background-color: #83CCEA;
      color: #ffffff;
      border: 0 none;
      border-radius: 6px;
    }

    .navC {
      background-color: #535D74;
    }

    ul {
      font-family: Arial, san-serif;
      list-style: none;
    }

    ul>li {
      padding: 5px 14px;
      cursor: default;
      transition: 0.2s ease-in-out;
      border-right: 3px solid transparent;
    }

    ul>li {
      border-bottom: 1px solid rgba(0, 0, 0, .03500);
    }

    ul>li:last-child {
      border-bottom: 0;
    }

    ul>li:not(.myItem):hover {
      font-weight: 400;
      color: #F2D1BE;
      background: rgba(0, 0, 0, 0.05);
      border-right: 3px solid #F2D1BE;
    }

    ul>li:active {
      background: rgba(0, 0, 0, 0.05);
    }

    li.myItem a.nav-link {
      color: black;
    }
        * {
            /* margin: 0;
            padding: 0;
            box-sizing: border-box; */
            /* font-size: 24px; */
            font-family: sans-serif;
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
                        font-size: 24px;

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
        <?php
        $user = session('user');
        ?>
    <nav class="navbar navbar-default navbar-expand-lg navbar-fixed-top bg-white">

        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand justify-content-right" href="#"><img id="MDB-logo"
                        src="https://firebasestorage.googleapis.com/v0/b/senior-project-72daf.appspot.com/o/app_use%2FSabreen_Logo%20clear.png?alt=media&token=e7cb29a4-e056-43cd-8e49-357543be44d6"
                        alt="مجتمعي" draggable="false" height="50" /></a>

            </div>
            <div class="d-flex justify-content-between container">

                <ul class="nav navbar-nav navbar-right nav-item">

                    <li class="nav-item dropdown myItem">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i style="font-size:20px"
                                class="fa">&#xf009; الخدمات</i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item " href="{{ route('opportunities.index') }}">
                                    الفرص التطوعية </a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="{{ route('offers.index') }}">
                                    العروض الحصرية </a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="{{ route('clinic.index') }}">
                                    العيادات </a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="{{ route('courses.index') }}">
                                    الفعاليات </a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="{{ route('clubs.index') }}">
                                    النوادي الطلابية </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-left nav-item">
                    <li class="nav-item dropdown myItem">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="MDB-logo"
                                src="https://firebasestorage.googleapis.com/v0/b/senior-project-72daf.appspot.com/o/app_use%2Fuser%20(1).png?alt=media&token=ba60324a-4c1c-42b8-a86c-835362c3aa95"
                                alt="مجتمعي" draggable="false" height="25" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li class="myItem">
                                <br>
                                <label class="dropdown-item text-center" for="exampleDropdownFormEmail1">{{ $user }}  </label><br>
                            </li>
                            <li>
                                <hr class="dropdown-divider myItem" />
                            </li>
                            <li>
                                <a class="dropdown-item text-center" href="{{ route('logout') }}">
                                    تسجيل الخروج </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <nav>
        <div class="navbar navbar-expand-lg navbar-dark ftco_navbar navC ftco-navbar-light justify-content-center">
            <div class="row">

            </div>
        </div>
    </nav>
    <!-- end nav  -->
    
    <div class="container" >
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
            <div class="card">
                <a href="{{ route('clubs.index') }}" class="button">
                النوادي الطلابية
                </a>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>

</html>