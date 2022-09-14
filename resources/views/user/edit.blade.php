@extends ('layouts.header')
@section('content')
  <script type="text/javascript" src="{{ url('tinymce/tinymce.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('tinymce/plugins/plugin.min.js') }}"></script>
  <script type="text/javascript">
  tinymce.init({
    selector: ".isiartikel",
    plugins:"image, media, autolink, advlist, anchor, table, wordcount, pagebreak, link, textcolor, emoticons",
    forced_root_block : "", 
    force_br_newlines : false,
    force_p_newlines : false,
    image_advtab: true
  });
  </script>
<section>
  <div class="container">
  @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
    </div>
  @endif
      <div class="row">
      @if (Session::has('edit'))
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('edit') }}
        </div>
         @elseif (Session::has('editError'))
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('editError') }}
        </div>
      @endif
        <form  class="well well-sm col-lg-12 col-md-12 col-sm-12" method="post" action="{{ url('update', $post->id) }}" enctype="multipart/form-data">
          <h3 class="text-center">Edit Form</h3>
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="col-lg-6 col-md-6 col-sm-6"><input class="form-control" type="text" name="judul" placeholder="Judul"
          value="{{$post->judul}}" required><br>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
          <select class="combobox form-control btn-default" name="kategori">
            <option {{ $post->kategori == 'Regional' ? 'selected' : '' }}>Regional</option>
            <option {{ $post->kategori == 'Nasional' ? 'selected' : '' }}>Nasional</option>
            <option {{ $post->kategori == 'Internasional' ? 'selected' : '' }}>Internasional</option>
          </select><br>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6">
            <input value="{{$post->tanggal}}" required type="text" class="form-control" id="date" name="tanggal" placeholder="Competition deadline"><br>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6">
          <div class=" col-lg-3 col-md-3 col-sm-3 fileUpload btn btn-primary">
            <span>Browse</span>
            <input id="uploadBtn" type="file" class="upload" name="gambar"/>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
          <input class="form-control" id="uploadFile" placeholder="Must be jpg or png" disabled /><br>
          </div>
          <script type="text/javascript">
            document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;};
          </script>
          <div class="col-lg-3 col-md-3 col-sm-3">
          <img src="{{ asset('images/posts/'.$post->gambar) }}" width="100px">
          </div>
          </div>
          
          <div class="col-lg-12 col-md-12 col-sm-12">
          <textarea class="isiartikel span7" rows="17" name="deskripsi">{{$post->deskripsi}}</textarea><br>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
          <button type="submit" class="btn btn-danger" onsubmit="notification()">Post</button>
          <button type="reset" onclick="return konfirmasi_reset()" class="btn btn-danger">Reset</button>
          </div>
        </form>
        </div>
</section>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <span class="copyright">Copyright &copy; Universitas Islam Indonesia 2016</span>
      </div>
    </div>
  </div>
</footer>
</div>
<script src=" {{ url('jsadmin/jquery.js') }} "></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
@endsection