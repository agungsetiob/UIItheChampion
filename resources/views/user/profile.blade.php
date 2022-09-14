@extends ('layouts.header')
@section('content')
<section class="bg-light-gray">
	<div class="container">
		<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">My Profile</h3>
				</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3" align="center"> 
								<img class="img-circle img-responsive" alt="User Pic" 
								src="{{ asset('images/avatar/') }}/{{Auth::user()->avatar}}">
							</div>
								<div class=" col-md-9 col-lg-9 col-sm-9"> 
									<table class="table table-user-information">
										<tbody>
											<tr>
												<th>Name:</th>
												<td>{{ Auth::user()->name }}</td>
											</tr>
											@if (Auth::user()->role == 'ADMIN')
											<tr>
												<th>NIP:</th>
												<td>{{ Auth::user()->username }}</td>
											</tr>
											@else
											<tr>
												<th>NIM:</th>
												<td>{{ Auth::user()->username }}</td>
											</tr>
											@endif
											<tr>
												<th>Post:</th>
												<td>{{ $post }}</td>
											</tr>
											<tr>
												<th>Email:</th>
												<td><a href="mailto:{{Auth::user()->email}}">{{Auth::user()->email}}</a></td>
											</tr>
											<tr>
												<th>Level:</th>
												<td>{!! $level !!}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

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
				<form action="{{ url('update-profile') }}/{{Auth::user()->username}}" class="well well-sm" method="post" enctype="multipart/form-data">
					<input type='hidden' name='_token' value='{{ csrf_token() }}'>
					<div class=" col-lg-1 col-md-1 col-sm-2 fileUpload btn btn-primary">
	            		<span>Browse</span>
	            		<input id="uploadBtn" type="file" class="upload" name="avatar" required/>
	          		</div>
	          		<div class="col-lg-2 col-md-2 col-sm-3">
	          			<input class="form-control" id="uploadFile" placeholder="Max Size 1Mb" disabled />
	          		</div>
			          <script type="text/javascript">
			            document.getElementById("uploadBtn").onchange = function () {
			            document.getElementById("uploadFile").value = this.value;};
			          </script>
			          <button type="submit" class="btn btn-danger">Update Avatar</button>
	        	</form>
				<a href=" {{ url('user/bookmarks') }} " >
					<input class='btn btn-primary col-lg-6 col-sm-12 col-md-6' type='button' value="My Bookmarks">
				</a>
				<a href="{{ url('user/posts') }}" >
					<input class='btn btn-primary col-lg-6 col-sm-12 col-md-6' type='button' value="My Posts">
				</a>
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
