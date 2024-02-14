<!doctype html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>العروض</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">   -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>

<body>
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
                        <td>{{ Form::text('of_discount', $id ? $offer['of_discount'] : null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
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
                });
            });
        </script>
   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>