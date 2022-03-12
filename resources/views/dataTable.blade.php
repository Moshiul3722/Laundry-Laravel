@extends('backend.master')

@section('css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
@endsection

@section('title','Test Data Table')

@section('content')





  </head>
  <body>
  <div class="container">
	 <h1>Hello, world!</h1>
	 <table class="table" id="myTable">
	  <thead>
		<tr>
		  <th scope="col">#</th>
		  <th scope="col">First</th>
		  <th scope="col">Last</th>
		  <th scope="col">Handle</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <th scope="row">1</th>
		  <td>Mark</td>
		  <td>Otto</td>
		  <td>@mdo</td>
		</tr>
		<tr>
		  <th scope="row">2</th>
		  <td>Jacob</td>
		  <td>Thornton</td>
		  <td>@fat</td>
		</tr>
		<tr>
		  <th scope="row">3</th>
		  <td>Larry</td>
		  <td>the Bird</td>
		  <td>@twitter</td>
		</tr>
		<tr>
		  <th scope="row">1</th>
		  <td>Mark</td>
		  <td>Otto</td>
		  <td>@mdo</td>
		</tr>
		<tr>
		  <th scope="row">2</th>
		  <td>Jacob</td>
		  <td>Thornton</td>
		  <td>@fat</td>
		</tr>
		<tr>
		  <th scope="row">3</th>
		  <td>Larry</td>
		  <td>the Bird</td>
		  <td>@twitter</td>
		</tr>
		<tr>
		  <th scope="row">1</th>
		  <td>Mark</td>
		  <td>Otto</td>
		  <td>@mdo</td>
		</tr>
		<tr>
		  <th scope="row">2</th>
		  <td>Jacob</td>
		  <td>Thornton</td>
		  <td>@fat</td>
		</tr>
		<tr>
		  <th scope="row">3</th>
		  <td>Larry</td>
		  <td>the Bird</td>
		  <td>@twitter</td>
		</tr>
		<tr>
		  <th scope="row">1</th>
		  <td>Mark</td>
		  <td>Otto</td>
		  <td>@mdo</td>
		</tr>
		<tr>
		  <th scope="row">2</th>
		  <td>Jacob</td>
		  <td>Thornton</td>
		  <td>@fat</td>
		</tr>
		<tr>
		  <th scope="row">3</th>
		  <td>Larry</td>
		  <td>the Bird</td>
		  <td>@twitter</td>
		</tr>
		<tr>
		  <th scope="row">1</th>
		  <td>Mark</td>
		  <td>Otto</td>
		  <td>@mdo</td>
		</tr>
		<tr>
		  <th scope="row">2</th>
		  <td>Jacob</td>
		  <td>Thornton</td>
		  <td>@fat</td>
		</tr>
		<tr>
		  <th scope="row">3</th>
		  <td>Larry</td>
		  <td>the Bird</td>
		  <td>@twitter</td>
		</tr>
		<tr>
		  <th scope="row">1</th>
		  <td>Mark</td>
		  <td>Otto</td>
		  <td>@mdo</td>
		</tr>
		<tr>
		  <th scope="row">2</th>
		  <td>Jacob</td>
		  <td>Thornton</td>
		  <td>@fat</td>
		</tr>
		<tr>
		  <th scope="row">3</th>
		  <td>Larry</td>
		  <td>the Bird</td>
		  <td>@twitter</td>
		</tr>
		<tr>
		  <th scope="row">1</th>
		  <td>Mark</td>
		  <td>Otto</td>
		  <td>@mdo</td>
		</tr>
		<tr>
		  <th scope="row">2</th>
		  <td>Jacob</td>
		  <td>Thornton</td>
		  <td>@fat</td>
		</tr>
		<tr>
		  <th scope="row">3</th>
		  <td>Larry</td>
		  <td>the Bird</td>
		  <td>@twitter</td>
		</tr>
	  </tbody>
</table>
  </div>
@endsection
@section('scripts')
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
	<script>
	$(document).ready( function () {
		$('#myTable').DataTable();
	});
	</script>
@endsection
