<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Opeertonity Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">  
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  </head>
  <body>
  <div
    class="d-flex flex-column min-vh-100 justify-content-center align-items-center"
    id="template-bg-3">
    <div class="card mb-5 p-5  bg-white bg-gradient text-black col-md-4">
        <div class="text-center">
            <h3>{{$user}}</h3>
            
         
        </div>
        <div class="card-body mt-3">

        

            <form name="login" action="/opportunities-list" method="get">
                <div class="input-group form-group mt-3">
                    <input type="text"
                        class="form-control text-center p-3"
                        placeholder="ID" name="userId">
                </div>
                <div class="input-group form-group mt-3">
                    <input type="password"
                        class="form-control text-center p-3"
                        placeholder="Password" name="password">
                </div>
                <div class="text-center">
                    <input type="submit" value="Login"
                        class="btn btn-primary mt-3 w-100 p-2"
                        name="login-btn">
                </div>
            </form>
         

    </div>
</div>
  
  </body>
</html>