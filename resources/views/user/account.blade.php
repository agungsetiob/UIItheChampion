@extends ('layouts.header')
@section('content')
<section id="portfolio1" class="bg-light-gray">
	<div class="container">
		<div class="row">
			@if (Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('message') }}
                </div>
            @elseif (Session::has('error'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('error') }}
                </div>
            @endif
			<form action="{{ url('upload-user') }}" class="well well-sm" method="post" enctype="multipart/form-data">
				<input type='hidden' name='_token' value='{{ csrf_token() }}'>
				<div class=" col-lg-1 col-md-1 col-sm-2 fileUpload btn btn-primary">
            		<span>Browse</span>
            		<input id="uploadBtn" type="file" class="upload" name="file" required/>
          		</div>
          		<div class="col-lg-2 col-md-2 col-sm-3">
          			<input class="form-control" id="uploadFile" placeholder=".csv file" disabled />
          		</div>

		          <script type="text/javascript">
		            document.getElementById("uploadBtn").onchange = function () {
		            document.getElementById("uploadFile").value = this.value;};
		          </script>
		          <button type="submit" class="btn btn-danger">Upload</button>
        	</form>
        </div>
	</div>
	<div class="container">
	<div class="row">
	  <h2>Accounts List</h2>
	  <table class="table table-hover table-bordered">
	    <thead>
	      <tr class="info">
	      	<th>No</th>
	        <th>Name</th>
	        <th>NIM</th>
	        <th>Email</th>
	      </tr>
	    </thead>
	    <tbody>
	    @foreach ($users as $user)
	      <tr class="danger">
	      	<td> {{ $no++ }} </td>
	        <td> {{$user->name}} </td>
	        <td> {{$user->username}} </td>
	        <td><a href="mailto:{{$user->email}}"> {{$user->email}} </a></td>
	      </tr>
	    @endforeach
	    </tbody>
	  </table>
	  <div class="portfolio-item">
	    <ul class="pagination">
	        {!! $users->render() !!}
	    </ul>
	  </div>
  </div>
</div>

	
</section>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<span class="copyright">Copyright &copy; Universitas Islam Indonesia 2016</span>
			</div>
		</div>
	</div>
</footer>
@endsection
<script src=" {{ url('jsadmin/jquery.js') }} "></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>

