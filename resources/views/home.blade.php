<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>الصفحة الرئيسية</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;

        }

        .container {
            width: 100%;
            height: 100vh;
            padding: 0 8%;
            /* background: lightgrey; */
        }

        .container h1 {
            text-align: center;
            padding-top: 10%;

            font-weight: 6000;
            position: relative;
            text-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);


        }

        .container h1::after {
            content: '';
            background: #303ef7;
            width: 100px;
            height: 5px;
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);

        }

        .services {
            width: 85%;
            display: flex;
            justify-content: space-between;
            /* grid-template-columns: 1fr 1fr; */
            /* grid-template-rows: repeat(2, minmax(100px, 1fr));
            grid-template-columns: repeat(2, minmax(100px, 1fr));
            grid-gap: 1em 1em; */
            align-items: center;
            margin: 75px auto;
            text-align: center;
            /* padding-top: 35px; */
        }

        .card {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 1px 10px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: darkgray;
            background: #fff;
            text-align: center;
            margin: 0px 20px;
            padding: 20px 20px;
            cursor: pointer;

        }
        .button{
            text-decoration: none;
            color: black;
            background: none;
            cursor: pointer;
            transition: 0.8s;

        } 
        .card:hover{
            transition: 0.4s ease;
            background: mistyrose;
        }        

    </style>

</head>

<body>
    <div class="container">
        <h1>الخدمات</h1>
        <div class="services">
            <div class="card">
            <a href="{{ route('opportunities.index') }}" class="button">الفرص التطوعية</a>

            </div>
            <div class="card">
                <a href="{{ route('offers.index') }}" class="button">
                    العروض الحصرية
                </a>
            </div>
            <div class="card">
                <a href="{{ route('courses.index') }}" class="button">
                    الفعاليات
                </a>
            </div>
            <div class="card">
                <a href="{{ route('clinic.index') }}" class="button">
                    مواعيد العيادات
                </a>
            </div>

        </div>
    </div>

</body>

</html>