<!doctype html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>الدورات</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">   -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

</head>

<body>
  <div class="container">
    <br /><br />
    @if($id)
    {{ Form::open(['url'=> route('courses.update', ['course'=>$id]), 'method' => 'PUT']) }}
    <h2>تعديل بيانات الدورة</h2>
    @else
    {{ Form::open(['url'=> route('courses.store')]) }}
    <h2>اضافة دورة </h2>
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
            <td>عنوان الدورة</td>
            <td>{{ Form::text('course_name', $id ? $course['course_name'] : null, ['class' => 'form-control',
              'autocomplete' => 'off']) }}</td>
          </tr>
          <tr>
            <td>التاريخ</td>
            <td>{{ Form::text('course_date', $id ? $course['course_date'] : null, ['class' => 'form-control', 'id' =>
              'datePicker', 'autocomplete' => 'off', 'placeholder' => 'حدد التاريخ']) }}
            </td>
          </tr>
          <tr>
            <td>الوقت</td>
            <td>{{ Form::text('course_time', $id ? $course['course_time'] : null, ['class' => 'form-control', 'id' =>
              'timePicker', 'autocomplete' => 'off', 'placeholder' => 'حدد الوقت']) }}</td>
          </tr>
          <tr>
            <td>الموقع</td>
            <td>{{ Form::text('course_location', $id ? $course['course_location'] : null, ['class' => 'form-control',
              'autocomplete' => 'off']) }}</td>
          </tr>
          <tr>
            <td>مقدم الدورة</td>
            <td>{{ Form::text('course_presenter', $id ? $course['course_presenter'] : null, ['class' => 'form-control',
              'autocomplete' => 'off']) }}</td>
          </tr>
          <tr>
            <td>رابط نموذج التسجيل </td>
            <td>{{ Form::text('course_link', $id ? $course['course_link'] : null, ['class' => 'form-control',
              'autocomplete' => 'off']) }}</td>
          </tr>
        </tbody>
      </table>

      <button type="submit" class="btn btn-success btn-sm btn-rouneded">حفظ</button>
      <a href="{{ route('courses.index') }}" class="btn btn-danger btn-sm btn-rounded">رجوع</a>

      {{ Form::close() }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#datePicker", {
          locale: 'ar',
          altInput: true,
          altFormat: "F j, Y",
          dateFormat: "Y-m-d",
          minDate: "today",
        });

        flatpickr("#timePicker", {
          locale: 'ar',
          enableTime: true,
          noCalendar: true,
          dateFormat: "h:i K",
          time_24hr: false,
          minuteIncrement: 1,
        });
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>
</body>

</html>