<!doctype html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clinic form</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">   -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  </head>
  <body>
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
    </td>           </tr>
    <tr>
                <td>التخصص</td>
                <td>{{ Form::text('cl_department', $id ? $clinic['cl_department'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
            </tr>
            <tr>
                <td>اسم الطبيب</td>
                <td>{{ Form::text('cl_doctor', $id ? $clinic['cl_doctor'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}</td>
            </tr>
            <tr>
                <td>التاريخ</td>
                <td>{{ Form::text('cl_date', $id ? $clinic['cl_date'] : null, ['class' => 'form-control', 'id' => 'datePicker', 'autocomplete' => 'off', 'placeholder' => 'حدد التاريخ']) }}
</td>
            </tr>
            <tr>
    <td>وقت البداية</td>
    <td>{{ Form::text('cl_start_time', $id ? $clinic['cl_start_time'] : null, ['class' => 'form-control', 'id' => 'startTimePicker', 'autocomplete' => 'off', 'placeholder' => '24:00']) }}</td>
</tr>
<tr>
    <td>وقت النهاية</td>
    <td>{{ Form::text('cl_end_time', $id ? $clinic['cl_end_time'] : null, ['class' => 'form-control', 'id' => 'endTimePicker', 'autocomplete' => 'off', 'placeholder' => '24:00']) }}
    </td>
</tr>
          

            
        </tbody>
    </table> 
    

    <button type="submit" class="btn btn-success btn-sm btn-rouneded">حفظ</button>
    <a href="{{ route('clinic.index') }}" class="btn btn-danger btn-sm btn-rounded">رجوع</a>

    {{ Form::close() }}
  </div>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
  <script>
document.addEventListener('DOMContentLoaded', function() {
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
    onChange: function(selectedDates, dateStr, instance) {
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
    onChange: function(selectedDates, dateStr, instance) {
    },
    });
});

</script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>