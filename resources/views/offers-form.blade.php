<!doctype html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>العروض</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">   -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@3.10.0/css/mdb.min.css" /> 
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
            <a class="dropdown-item " href="{{ route('opportunities.index') }}">
              الفرص التطوعية </a>
          </li>
          <li>
            <a class="dropdown-item " href="{{ route('offers.index') }}">
              العروض الحصرية </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('clinic.index') }}">
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
            <label class="dropdown-item text-center" for="exampleDropdownFormEmail1"> {{ $user }}   </label><br>
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
        <br /> <br />
        <?php
        $categoryArray = [
            'رياضة' => 'رياضة',
            'تعليم وتدريب' => 'تعليم وتدريب',
            'مطاعم ومقاهي' => 'مطاعم ومقاهي',
            'ترفيه' => 'ترفيه',
            'مراكز صحية' => 'مراكز صحية',
            'عناية وجمال' => 'عناية وجمال',
            'سياحة وفنادق' => 'سياحة وفنادق',
            'خدمات السيارات' => 'خدمات السيارات',
            'تسوق' => 'تسوق',
            'عقارات وبناء' => 'عقارات وبناء',
        ];
        ?>
        @if($id)
        {{ Form::open(['url'=> route('offers.update', ['offer'=>$id]), 'method' => 'PUT','enctype' => 'multipart/form-data']) }}
        <h2>تعديل العرض</h2>
        @else
        {{ Form::open(['url'=> route('offers.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        <h2>اضافة عرض حصري</h2>
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
                        <td>التصنيف</td>
                        <td>{{ Form::select('of_category', $categoryArray,
                         isset($id) ? $offer['of_category'] : null, ['class' => 'form-control','placeholder' => 'اختر تصنيف']) }}</td>
                    </tr>
                    <tr>
                        <td>شعار الشركة</td>
                        <td>
                            
                        @if($id)
                        <img src="{{ $offer['of_logo'] }}" height="70" alt="logo">
                            
                            @endif
                            {!! Form::file('image', ['class'=>'form-control', 'id' => 'image','name' => 'image' , 'autocomplete' => 'off' ,'placeholder' => 'اختر صورة']) !!}
                            
                        </td>
                    </tr>
                    <tr>
                        <td>اسم الشركة</td>
                        <td>

                            {{ Form::text('of_name', $id ? $offer['of_name'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>مقدار الخصم</td>
                        <td>{{ Form::number('of_discount', $id ? $offer['of_discount'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                        </td>
                    </tr>
                    <tr>
                      
                        <td>تاريخ الصلاحية</td>
                        <td>{{ Form::text('of_expDate', $id ? $offer['of_expDate'] : null, ['class' => 'form-control', 'id' => 'datePicker', 'autocomplete' => 'off', 'placeholder' => 'حدد التاريخ']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>الفئة المستهدفة</td>
                        <td>{{ Form::text('of_target', $id ? $offer['of_target'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
                    </tr>
                    <tr>
                        <td>وسيلة التواصل</td>
                        <td>{{ Form::text('of_contact', $id ? $offer['of_contact'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
                    </tr>
                    <tr>
                        <td>كود الخصم</td>
                        <td>{{ Form::text('of_code', $id ? $offer['of_code'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
                    </tr>
                    <tr>
                        <td>تفاصيل العرض</td>
                        <td>{{ Form::text('of_details', $id ? $offer['of_details'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
                    </tr>

                </tbody>
            </table>

            <button type="submit" class="btn btn-success btn-sm btn-rouneded">حفظ</button>
            <a href="{{ route('offers.index') }}" class="btn btn-danger btn-sm btn-rounded">رجوع</a>

            {{ Form::close() }}
        </div>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#datePicker", {
                    locale: 'ar',
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    minDate: "today",
                });
            });
            
        </script>
   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>