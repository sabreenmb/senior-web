<!doctype html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Opeertonity Form</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">   -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  </head>
  <body>
<div class="container">
  <br /><br />
  @if($id)
      {{ Form::open(['url'=> route('opportunities.update', ['opportunity'=>$id]), 'method' => 'PUT']) }}
      <h2>Edit opportunity</h2>
  @else
      {{ Form::open(['url'=> route('opportunities.store')]) }}
      <h2>اضافة فرصة</h2>
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
                <td>اسم الفرصة</td>
                <td>{{ Form::text('op_name', $id ? $opportunity['op_name'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
            </tr>
            <tr>
                <td>التاريخ</td>
                <td>{{ Form::text('op_date', $id ? $opportunity['op_date'] : null, ['class' => 'form-control', 'id' => 'datePicker', 'autocomplete' => 'off', 'placeholder' => 'حدد التاريخ']) }}
</td>
            </tr>
            <tr>
                <td>الوقت</td>
                <td>{{ Form::text('op_time', $id ? $opportunity['op_time'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
            </tr>
            <tr>
                <td>الموقع</td>
                <td>{{ Form::text('op_location', $id ? $opportunity['op_location'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
            </tr>
            <tr>
                <td>عدد المتطوعين</td>
                <td>{{ Form::text('op_number', $id ? $opportunity['op_number'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
            </tr>
            <tr>
                <td>رابط نموذج التسجيل </td>
                <td>{{ Form::text('op_link', $id ? $opportunity['op_link'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
            </tr>
        </tbody>
    </table>  

    <button type="submit" class="btn btn-success btn-sm btn-rouneded">حفظ</button>
    <a href="{{ route('opportunities.index') }}" class="btn btn-danger btn-sm btn-rounded">رجوع</a>

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
  });
});
</script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>