@extends ('layouts.header')
@section('content')
<section class="bg-light-gray">
	<div class="container">
		<div class="row">
			@foreach ($users as $user)
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Profile</h3>
					</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3 col-lg-3 col-sm-3" align="center"> 
									<img class="img-circle img-responsive" alt="User Pic" 
									src="{{ asset('images/avatar/'. $user->avatar) }}">
								</div>
									<div class=" col-md-9 col-lg-9 col-sm-9"> 
										<table class="table table-user-information">
											<tbody>
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Rank:</th>
													<td> {{$no++}} </td>
												</tr>
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Name:</th>
													<td>{{ $user->name }}</td>
												</tr>
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">NIM:</th>
													<td>{{ $user->username }}</td>
												</tr>
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Post:</th>
													<td>{{ $user->posts->count() }}</td>
												</tr>
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Email:</th>
													<td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
												</tr>
												@if ($user->posts->count() == 0)
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Level:</th>
													<td><i class="fa fa-btn fa-star"></td>
												</tr>
												@elseif ($user->posts->count() < 6)
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Level:</th>
													<td><i class="fa fa-btn fa-star star"></td>
												</tr>
												@elseif ($user->posts->count() < 11)
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Level:</th>
													<td><i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star"></td>
												</tr>
												@elseif ($user->posts->count() < 16)
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Level:</th>
													<td><i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star"></td>
												</tr>
												@elseif ($user->posts->count() < 21)
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Level:</th>
													<td><i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star"></td>
												</tr>
												@elseif ($user->posts->count() >= 21)
												<tr>
													<th class="col-md-3 col-lg-3 col-sm-3">Level:</th>
													<td><i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star">
													<i class="fa fa-btn fa-star star"></td>
												</tr>
												@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
			@endforeach
		</div>
		<div class="portfolio-item">
	    	<ul class="pagination">
	    	    {!! $users->render() !!}
	    	</ul>
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
