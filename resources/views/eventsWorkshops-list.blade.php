<!doctype html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ورش العمل</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@3.10.0/css/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    .active {
      text-decoration-line: underline;
      text-decoration-color: #83CCEA;
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

    .myBox {
      padding-top: 10px;
      padding-right: 30px;

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
      font-weight: 300;
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false"><i style="font-size:20px" class="fa">&#xf009; الخدمات</i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('opportunities.index') }}">
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img id="MDB-logo"
                src="https://firebasestorage.googleapis.com/v0/b/senior-project-72daf.appspot.com/o/app_use%2Fuser%20(1).png?alt=media&token=ba60324a-4c1c-42b8-a86c-835362c3aa95"
                alt="مجتمعي" draggable="false" height="25" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li class="myItem">
                <br>
                <label class="dropdown-item text-center" for="exampleDropdownFormEmail1">{{ $user }} </label><br>
              </li>
              <li class="myItem">
                <hr class="dropdown-divider" />
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
        <div class="col-12 d-flex justify-content-center">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center mx-auto">
              <li class="nav-item myItem">
                <a class="nav-link mx-2 " href="#">الدورات</a>
              </li>
              <li class="nav-item myItem">
                <a href="{{ route('workshops.index') }}" class="nav-link mx-2 active">ورش العمل</a>
              </li>
              <li class="nav-item myItem">
                <a class="nav-link mx-2" href="{{ route('conferences.index') }}">المؤتمرات</a>
              </li>
              <li class="nav-item myItem">
                <a class="nav-link mx-2" href="{{ route('other.index') }}">فعاليات اخرى</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- end nav -->

  <div class="container">
    <br /><br />
    <h2>ورش العمل</h2>

    <a href="{{ route('workshops.create') }}" class="btn myBtn btn-sm btn-rounded float-end btn-lg">اضافة ورشة عمل</a>
    <br /><br />


    <table class="table table-bordered table-hover">
      <thead>
        <th>العنوان</th>
        <th>التاريخ</th>
        <th>الوقت</th>
        <th>الموقع</th>
        <th>مقدم الورشة</th>
        <th>رابط نموذج التسجيل</th>
        <th></th>
        <th></th>
      </thead>
      @if ($eventsWorkshops !== null && $eventsWorkshops !== 'placeholder')

      <tbody>
        @foreach($eventsWorkshops as $id => $workshop)

        <tr>
          <td>{{ $workshop['workshop_name'] }}</td>
          <td>{{ $workshop['workshop_date'] }}</td>
          <td>{{ $workshop['workshop_time'] }}</td>
          <td>{{ $workshop['workshop_location'] }}</td>
          <td>{{ $workshop['workshop_presenter'] }}</td>
          <td>{{ $workshop['workshop_link'] }}</td>

          <td><a href="{{ route('workshops.edit', ['workshop' => $id]) }}"
              class="btn btn-success btn-sm btn-rounded">تعديل</a></td>

          {{ Form::open(['url'=> route('workshops.destroy', ['workshop' => $id]), 'method' => 'DELETE']) }}
          <td><button type="submit" class="btn btn-danger btn-sm btn-rounded">حذف</button></td>
          {{ Form::close() }}
        </tr>
        @endforeach
      </tbody>
      @endif

    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</body>

</html>

</html>