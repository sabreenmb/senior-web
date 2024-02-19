<!doctype html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clinic form</title>
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@3.10.0/css/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">


  <style>
    .active {
      text-decoration-line: underline;
      text-decoration-color: #F2D1BE;
    }

    .myBox {
      padding-top: 10px;
      padding-right: 30px;
    }

    td {
      font-weight: 1000;

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
  </style>
</head>

<body>
  <!-- Navbar -->

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
                <a class="dropdown-item text-end" href="{{ route('opportunities.index') }}">
                  الفرص التطوعية </a>
              </li>
              <li>
                <a class="dropdown-item text-end" href="{{ route('offers.index') }}">
                  العروض الحصرية </a>
              </li>
              <li>
                <a class="dropdown-item text-end" href="{{ route('clinic.index') }}">
                  العيادات </a>
              </li>
              <li>
                <a class="dropdown-item text-end" href="{{ route('courses.index') }}">
                  الفعاليات </a>
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
                <label class="dropdown-item text-center" for="exampleDropdownFormEmail1"> صابرين بن سلمان
                </label><br>
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
  <!-- end nav -->
  <div class="container">
    <br /><br />
    @if($id)
    {{ Form::open(['url'=> route('clinic.update', ['clinic'=>$id]), 'method' => 'PUT' ])}}
    <h2>تعديل بيانات العيادة</h2>
    @else
    {{ Form::open(['url'=> route('clinic.store')]) }}
    <h2>اضافة عيادة</h2>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <br /><br />
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>الفرع</td>
            <td>
              {{ Form::select('cl_branch', [
              'المقر الرئيسي' => 'المقر الرئيسي',
              'الفيصلية' => 'الفيصلية',
              'الفيصلية مبنى 17' => 'الفيصلية مبنى 17',
              'الكامل' => 'الكامل',
              'خليص' => 'خليص',
              'كلية التربية' => 'كلية التربية',
              'الكليات الصحية' => 'الكليات الصحية',
              'كلية التصاميم والفنون' => 'كلية التصاميم والفنون'
              ], $id ? $clinic['cl_branch'] : null, ['class' => 'form-control', 'placeholder' => 'اختر الفرع']) }}
            </td>
          </tr>
          <tr>
            <td>التخصص</td>
            <td>{{ Form::text('cl_department', $id ? $clinic['cl_department'] : null, ['class' => 'form-control',
              'autocomplete' => 'off']) }}</td>
          </tr>
          <tr>
            <td>اسم الطبيب</td>
            <td>{{ Form::text('cl_doctor', $id ? $clinic['cl_doctor'] : null, ['class' => 'form-control', 'autocomplete'
              => 'off']) }}</td>
          </tr>
          <tr>
            <td>التاريخ</td>
            <td>{{ Form::text('cl_date', $id ? $clinic['cl_date'] : null, ['class' => 'form-control', 'id' =>
              'datePicker', 'autocomplete' => 'off', 'placeholder' => 'حدد التاريخ']) }}
            </td>
          </tr>
          <tr>
            <td>وقت البداية</td>
            <td>{{ Form::text('cl_start_time', $id ? $clinic['cl_start_time'] : null, ['class' => 'form-control', 'id'
              => 'startTimePicker', 'autocomplete' => 'off', 'placeholder' => '24:00']) }}</td>
          </tr>
          <tr>
            <td>وقت النهاية</td>
            <td>{{ Form::text('cl_end_time', $id ? $clinic['cl_end_time'] : null, ['class' => 'form-control', 'id' =>
              'endTimePicker', 'autocomplete' => 'off', 'placeholder' => '24:00']) }}
            </td>
          </tr>



        </tbody>
      </table>


      <button type="submit" class="btn btn-success btn-sm btn-rouneded">حفظ</button>
      <a href="{{ route('clinic.index') }}" class=" btn btn-danger btn-sm btn-rouneded">رجوع</a>

      {{ Form::close() }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // var endTimePicker;
        flatpickr("#datePicker", {
          locale: 'ar',
          altInput: true,
          altFormat: "F j, Y",
          dateFormat: "Y-m-d",
          minDate: "today",
        });

        flatpickr("#startTimePicker", {
          enableTime: true,
          noCalendar: true,
          locale: 'ar',
          time_24hr: true,
          dateFormat: "H:i",
          minTime: "08:00",
          maxTime: "15:00",
          onChange: function (selectedDates, dateStr, instance) {
            var startTime = selectedDates[0];
            if (endTimePicker && startTime) {
              var minEndTime = new Date(startTime.getTime());
              minEndTime.setMinutes(minEndTime.getMinutes() + 30);
              endTimePicker.set('minTime', minEndTime.getHours() + ":" + minEndTime.getMinutes());
              endTimePicker.set('minDate', startTime);
            }
          },
        });

        flatpickr("#endTimePicker", {
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i",
          locale: 'ar',
          time_24hr: true,
          minTime: "08:00",
          onChange: function (selectedDates, dateStr, instance) {
          },
        });
      });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>


</body>

</html>