<!doctype html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>الفرص التطوعية</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">   -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
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
  </style>
  </head>
  <body>
     <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top bg-white navbar-light">
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
<div class="container" style="margin-top: 110px;">
  <br /><br />
	<h2>الفرص التطوعية</h2>

    <a href="{{ route('opportunities.create') }}" class="myBtn btn btn-sm btn-rounded float-end">اضافة فرصة تطوعية</a>
    <br /><br />

    <table class="table table-bordered table-hover">
        <thead>
            <th>عنوان الفرصة التطوعية</th>
            <th>التاريخ</th>
            <th>الوقت</th>
            <th>الموقع</th>
            <th>عدد المتطوعين</th>
            <th>رابط نموذج التسجيل</th>
            <th></th>
            <th></th>
        </thead>
        @if ($opportunities !=null)

        <tbody>
        @foreach($opportunities as $id => $opportunity)

        <tr>
        <td>{{ $opportunity['op_name'] }}</td>
                <td>{{ $opportunity['op_date'] }}</td>
                <td>{{ $opportunity['op_time'] }}</td>
                <td>{{ $opportunity['op_location'] }}</td>
                <td>{{ $opportunity['op_number'] }}</td>
                <td>{{ $opportunity['op_link'] }}</td>

                <td><a href="{{ route('opportunities.edit', ['opportunity' => $id]) }}" class="btn btn-success btn-sm btn-rounded">تعديل</a></td>

                {{ Form::open(['url'=> route('opportunities.destroy', ['opportunity' => $id]), 'method' => 'DELETE']) }}
                <td><button type="submit" class="btn btn-danger btn-sm btn-rounded">حذف</button></td>
                {{ Form::close() }}
            </tr>
            @endforeach
        </tbody>
        @endif

    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>