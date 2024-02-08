<!doctype html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Opeertonity Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">  
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="css/rtl-app.css">
 
</head>
  <body>
  <div
    class="d-flex flex-column min-vh-100 justify-content-center align-items-center"
    id="template-bg-3">
    <div class="card mb-5 p-5  bg-white bg-gradient text-black col-md-4">
    <div class="text-center">
            <h3>تسجيل الدخول</h3>
        </div>
        <div class="card-body mt-3">


        <!-- @if(isset(Auth::user()->email))
            <script>window.location= "/home";

            </script>
        @endif -->
        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert" >x
            </button>
            <strong>{{$message}}</strong>

        </div>
        @endif
            @if (count($errors)>0) 
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form name="login" action="/login" method="post">
            @csrf    
            <div class="input-group form-group mt-3">
                    <input type="email"
                        class="form-control text-center p-3"
                        placeholder="الرقم الجامعي" name="email">
                </div>
                <div class="input-group form-group mt-3">
                    <input type="password"
                        class="form-control text-center p-3"
                        placeholder="كلمة المرور" name="password">
                </div>
                <div class="text-center">
                    <input type="submit" value="Login"
                        class="btn btn-primary mt-3 w-100 p-2"
                        name="login">
                </div>
            </form>
         
        <!-- <div class="card-footer p-3">
            <div class="d-flex justify-content-center">
                <div class="text-primary">If you are a registered user,
                    login here.</div>
            </div>
        </div> -->
    </div>
</div>
  

  </body>
</html>