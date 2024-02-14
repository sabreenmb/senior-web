<!doctype html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> مجتمعي - تسجيل دخول</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">  
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="css/rtl-app.css">
  <style>

.myBtn:hover,
.myBtn,
.myBtn:focus {
  background: #83CCEA;
  background-color: #83CCEA;
  color: #535D74;
  border: 0 none;
  border-radius: 6px;
}
</style>

</head>
  <body>
  <div
    class="d-flex flex-column min-vh-100 justify-content-center align-items-center"
    id="template-bg-3">
    
    <div class="card mb-5 p-5  bg-white bg-gradient text-black col-md-4">
    <div class="text-center">
    <a class="navbar-brand" href="#"
        ><img
          id="MDB-logo"
          src="https://firebasestorage.googleapis.com/v0/b/senior-project-72daf.appspot.com/o/app_use%2FSabreen_Logo%20clear.png?alt=media&token=8ae867f9-f3c5-4ee8-b53d-f4c8a2a83873"
          alt="مجتمعي"
          draggable="false"
          height="150"
      /></a>        </div>
        <div class="card-body mt-3">


    
        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert" >x
            </button>
            <strong>{{$message}}</strong>

        </div>
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
            <form name="login" action="/login" method="post">
            @csrf    
            <div class="input-group form-group mt-3">
                    <input type="text"
                        class="form-control text-center p-3"
                        placeholder="الرقم الجامعي" name="email" autocomplete="off">
                </div>
                <div class="input-group form-group mt-3">
                    <input type="password"
                        class="form-control text-center p-3"
                        placeholder="كلمة المرور" name="password">
                </div>
                <div class="text-center">
                    <input type="submit" value="تسجيل الدخول "
                        class=" myBtn mt-3 w-100 p-2"
                        name="login">
                </div>
            </form>
         
     
    </div>
</div>
  

  </body>
</html>