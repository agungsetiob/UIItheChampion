@extends ('layouts.header')
 @section('content')
    <section id="portfolio1" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <h2 class="section-heading">bookmarks</h2>
                </div>
                <div class="search well-lg well">
                    <div id="content-search">
                        <div class="gate input-group">
                            <form method="get" action="{{ url('search') }}" class="col-lg-12 col-md-12 col-sm-12">
                                <span class="input-group-btn">
                                    <input type='text' id='cari' placeholder="Type here" class="form-control"
                                    name="search" required>
                                    <input class="btn btn-primary" type="submit" value="Search">
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                @if (Session::has('successMessage'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('successMessage') }}
                </div>
                @endif
                @foreach ($bookmarks as $bookmark)
                <div class="col-lg-4 col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal{{ $bookmark->id }}" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src=" {{ asset('images/posts/'. $bookmark->gambar) }} " class="img-responsive" alt="" style="width:360px; height:260px;">
                    </a>
                        <div class="portfolio-caption">
                            <h4>{{ $bookmark->judul }}</h4>
                        </div>
                        @if (Auth::user()->role == 'STUDENT')
                        <a href="{{ url('bookmark/delete', $bookmark->id) }}" onClick='return konfirmasi_delete()'>
                            <input class='btn btn-primary' type='button' value='Delete'>
                        </a>
                        @elseif(Auth::user()->role == 'ADMIN')
                        <a href="{{ url('edit', $bookmark->post_id)}}" >
                            <input class='btn btn-primary' type='button' value='Edit'>
                        </a>
                        <a href="{{ url('bookmark/delete', $bookmark->id) }}" onClick='return konfirmasi_delete()'>
                            <input class='btn btn-primary' type='button' value='Delete'>
                        </a>
                        @endif
                </div>
                @endforeach
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 portfolio-item">
                <ul class="pagination">
                    {!! $bookmarks->render() !!}
                </ul>
            </div>
        </div>
    </section>
                <footer>
            <div class="container">
                <div class="row">
                    <div class="col lg-12 col-md-12 col-sm-12">
                        <span class="copyright">Copyright &copy; Universitas Islam Indonesia 2016</span>
                    </div>
                </div>
            </div>
        </footer>
                @endsection
                @foreach ($bookmarks as $bookmark)
        <div class="portfolio-modal modal fade" id="portfolioModal{{$bookmark->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project bookmarks Go Here -->
                                <h2>{{ $bookmark->judul }}</h2>
                                <ul class="list-inline">
                                    <li>Deadline: {{ $bookmark->tanggal }}</li>
                                </ul>
                                <img class="img-responsive center-block" src="{{ url('images/posts/'. $bookmark->gambar) }}" alt="">
                                <p style="text-align:justify;">{!!$bookmark->deskripsi !!}</p>
                                <ul class="list-inline">
                                    <li>Posted on: {{ $bookmark->created_at }}</li>
                                    <li>Category: {{ $bookmark->kategori }}</li>
                                    <li>Posted by: {{$bookmark->user->username}} </li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                <a href="{{ url('bookmark/delete', $bookmark->id) }}" onClick='return konfirmasi_delete()'>
                                <input class='btn btn-primary' type='button' value='Delete'>
                                </a>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endforeach
        <script src=" {{ url('jsadmin/jquery.js') }} "></script>
        <script src="{{ url('js/bootstrap.min.js') }}"></script>               