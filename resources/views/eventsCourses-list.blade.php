<!doctype html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Events</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">   -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    .active{
      text-decoration-line: underline;
      text-decoration-color: blue;


  }
</style>
  </head>
  <body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light">
    <button
    class="navbar-toggler"
    type="button"
    data-mdb-toggle="collapse"
    data-mdb-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <i class="fas fa-bars"></i>
  </button>
  <div class="container d-flex justify-content-center">
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-3">
        <a class="navbar-brand" href="#"
        ><img
          id="MDB-logo"
          src="https://firebasestorage.googleapis.com/v0/b/senior-project-72daf.appspot.com/o/app_use%2FSabreen_Logo%20clear.png?alt=media&token=8ae867f9-f3c5-4ee8-b53d-f4c8a2a83873"
          alt="مجتمعي"
          draggable="false"
          height="70"
      /></a>
      </div>
      <div class="col-12 d-flex justify-content-center">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav align-items-center mx-auto">
            <li class="nav-item">
              <a class="nav-link mx-2 active" href="#">الدورات</a>
            </li>
            <li class="nav-item">
            <a href="{{ route('workshops.index') }}" class="nav-link mx-2">ورش العمل</a>
                      </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="{{ route('courses.index') }}">المؤتمرات</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="{{ route('other.index') }}">فعاليات اخرى</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>

<div class="container" style="margin-top: 110px;">
  <br /><br />
	<h2>الدورات</h2>

    <a href="{{ route('courses.create') }}" class="btn btn-info btn-sm btn-rounded float-end btn-lg">اضافة دورة</a>
    <br /><br />

    <table class="table table-bordered table-hover">
        <thead>
            <th>العنوان</th>
            <th>التاريخ</th>
            <th>الوقت</th>
            <th>الموقع</th>
            <th>مقدم الدورة</th>
            <th>رابط نموذج التسجيل</th>
            <th></th>
            <th></th>
        </thead> 

        <tbody>
        @foreach($eventsCourses as $id => $course)

        <tr>
                <td>{{ $course['course_name'] }}</td>
                <td>{{ $course['course_date'] }}</td>
                <td>{{ $course['course_time'] }}</td>
                <td>{{ $course['course_location'] }}</td>
                <td>{{ $course['course_presenter'] }}</td>
                <td>{{ $course['course_link'] }}</td>

                <td><a href="{{ route('courses.edit', ['course' => $id]) }}" class="btn btn-success btn-sm btn-rounded">تعديل</a></td>

                {{ Form::open(['url'=> route('courses.destroy', ['course' => $id]), 'method' => 'DELETE']) }}
                <td><button type="submit" class="btn btn-danger btn-sm btn-rounded">حذف</button></td>
                {{ Form::close() }}
            </tr>
            @endforeach
        </tbody>
       
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
  </html>