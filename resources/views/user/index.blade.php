@extends ('layouts.header')
 @section('content')
    <section id="portfolio1" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <h2 class="section-heading">Competitions</h2>
                </div>
                <div class="search well-lg well">
                    <div id="content-search">
                        <div class="col-lg-12 col-md-12 col-sm-12 input-group">
                            <form method="get" action="{{ url('search') }}" class="col-lg-4 col-md-4 col-sm-4">
                                <span class="input-group-btn">
                                    <input type='text' id='cari' placeholder="Type here" class="form-control"
                                    name="search" required>
                                    <input class="btn btn-primary" type="submit" value="Search">
                                </span>
                            </form>
                            <div class="col-lg-4 col-md-4 col-sm-4 pull-right">
                            <a class="pull-right btn btn-primary" href="{{ url('deadline') }}">Order by Deadline</a>
                            </div>
                        </div>    
                    </div>
                </div>
                </div>
                @if (Session::has('successMessage'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('successMessage') }}
                </div>
                @elseif (Session::has('errors'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('errors') }}
                </div>
                @elseif (Session::has('editRestrict'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('editRestrict') }}
                </div>
                @elseif (Session::has('edit'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('edit') }}
                </div>
                @elseif (Session::has('delete'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('delete') }}
                </div>
                @elseif (Session::has('search'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('search') }}
                </div>
                @endif
                    @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-4 col-sm-6 portfolio-item">
                        <a href="#portfolioModal{{ $post->id }}" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img src=" {{ asset('images/posts/'. $post->gambar) }} " class="img-responsive" alt="" style="width:360px; height:260px;">
                        </a>
                        <div class="portfolio-caption">
                        <h4>{{ $post->judul }}</h4>
                        </div>
                        @if (Auth::guest() or Auth::user()->role == 'STUDENT')
                        <div></div>
                        @elseif(Auth::user()->role == 'ADMIN')
                        <a href="{{ url('edit', $post->id)}}" >
                            <input class='btn btn-primary' type='button' value='Edit'>
                        </a>
                        <a href="{{ url('delete', $post->id) }}" onClick='return konfirmasi_delete()'>
                            <input class='btn btn-primary' type='button' value='Delete'>
                        </a>
                        @endif
                    </div>
                    @endforeach
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <ul class="pagination">
                            {!! $posts->render() !!}
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
         @foreach ($posts as $post)
        <div class="portfolio-modal modal fade" id="portfolioModal{{$post->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <h2>{{ $post->judul }}</h2>
                                <ul class="list-inline">
                                    <li>Deadline: {{ $post->tanggal }}</li>
                                </ul>
                                <img class="img-responsive center-block" src="{{ url('images/posts/'. $post->gambar) }}" alt="">
                                <p style="text-align:justify;">{!! $post->deskripsi !!}</p>
                                <ul class="list-inline">
                                    <li>Posted at: {{ $post->created_at }}</li>
                                    <li>Category: {{ $post->kategori }}</li>
                                    <li>Posted by: {{ $post->user->username }}  </li>
                                </ul>
                                @if (Auth::user())
                                   <form method="post" action="{{ url('post/bookmark', $post->id) }}">
                                      {{ csrf_field() }}
                                      {{ method_field('PUT') }}
                                      <div class="col-lg-5 col-md-5 col-sm-5"><input type="hidden" class="form-control" type="text" name="user_id"
                                      value="{{Auth::user()->id}}" required>
                                      </div>
                                      <div class="col-lg-5 col-md-5 col-sm-5"><input type="hidden" class="form-control" type="text" name="post_id"
                                      value="{{$post->id}}" required>
                                      </div>                                      
                                      <button type="submit" class='btn btn-primary'><i class="fa fa-star"></i> Bookmark</button>
                                    </form>
                                    @endif
                                    <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='25410912'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endforeach
        <script src=" {{ url('jsadmin/jquery.js') }} "></script>
        <script src="{{ url('js/bootstrap.min.js') }}"></script>               