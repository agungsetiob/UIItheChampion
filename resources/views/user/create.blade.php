@extends ('layouts.header')
@section('content')
  <script type="text/javascript" src="{{ url('tinymce/tinymce.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('tinymce/plugins/image/plugin.min.js') }}"></script>
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
<section class="bg-light-gray">
  <div class="container">
  @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
    </div>
  @endif
    <div class="row">
      <form  class="well well-sm col-lg-12 col-md-12 col-sm-12" method="post" action="{{ url('post') }}" enctype="multipart/form-data">
          <h3 class="text-center">New Competition Post</h3>
          <input type='hidden' name='_token' value='{{ csrf_token() }}'>
          <div class="col-lg-6 col-md-6 col-sm-6">
          <input id="judul" class="form-control" type="text" name="judul" placeholder="Competition name" required><br>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
          <select class=" form-control combobox btn-default" name="kategori">
            <option>Regional</option>
            <option>Nasional</option>
            <option>Internasional</option>
          </select><br>
          </div>
          
          <div class="col-lg-6 col-md-6 col-sm-6">
            <input required type="text" class="form-control" id="date" name="tanggal" placeholder="Competition deadline"><br>
          </div>

         <div class="col-lg-6 col-md-6 col-sm-12">
          <div class=" col-lg-3 col-md-3 col-sm-3 fileUpload btn btn-primary">
            <span>Browse</span>
            <input id="uploadBtn" type="file" class="upload form-control" name="gambar" required/>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9">
          <input class="form-control" id="uploadFile" placeholder="Must be jpg or png" disabled /><br>
          </div>
          </div>

          <script type="text/javascript">
            document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;};
          </script>

          <div class="col-lg-12 col-md-12 col-sm-12">
          <textarea class="isiartikel span7" rows="17" name="deskripsi"></textarea><br>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
          <button type="submit" class="btn btn-danger" onsubmit="notifikasi()">Post</button>
          <button type="reset" onclick="konfirmasi_reset()" class="btn btn-danger">Reset</button>
          </div>
      </form>
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
<script src=" {{ url('jsadmin/jquery.js') }} "></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
@endsection