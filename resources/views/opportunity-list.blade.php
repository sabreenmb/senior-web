<!doctype html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Volunteering Opportunities List</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">   -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  </head>
  <body>
<div class="container">
  <br /><br />
	<h2>الفرص التطوعية</h2>

    <a href="{{ route('opportunities.create') }}" class="btn btn-primary btn-sm btn-rounded float-end">اضافة فرصة تطوعية</a>
    <br /><br />

    <table class="table table-bordered table-hover">
        <thead>
            <th>اسم الفرصة</th>
            <th>التاريخ</th>
            <th>الوقت</th>
            <th>الموقع</th>
            <th>عدد المتطوعين</th>
            <th>رابط نموذج التسجيل</th>
            <th></th>
            <th></th>
        </thead>

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
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>