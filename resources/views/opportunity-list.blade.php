<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Volunteering Opportunities List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">  
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  </head>
<body>
<div class="container">
  <br /><br />
	<h2>opportunities</h2>

    <a href="{{ route('opportunities.create') }}" class="btn btn-primary btn-sm btn-rounded float-end">Add Volunteering Opeertonity</a>
    <br /><br />

    <table class="table table-bordered table-hover">
        <thead>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Country</th>
            <th></th>
            <th></th>
        </thead>

        <tbody>
        @foreach($opportunities as $id => $opportunity)

        <tr>
                <td>{{ $opportunity['first_name'] }}</td>
                <td>{{ $opportunity['last_name'] }}</td>
                <td>{{ $opportunity['email'] }}</td>
                <td>{{ $opportunity['phone'] }}</td>
                <td>{{ $opportunity['country'] }}</td>
                <td><a href="{{ route('opportunities.edit', ['opportunity' => $id]) }}" class="btn btn-success btn-sm btn-rounded">Edit</a></td>

                {{ Form::open(['url'=> route('opportunities.destroy', ['opportunity' => $id]), 'method' => 'DELETE']) }}
                <td><button type="submit" class="btn btn-danger btn-sm btn-rounded">Delete</button></td>
                {{ Form::close() }}
            </tr>
            @endforeach
        </tbody>
    </table>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>