<?php 
	$data = $koneksi->query("SELECT kategori_id, kategori_nama FROM tb_kategori");
?>
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Berita</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Judul Berita</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Tambah Berita
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label>Kategori Berita</label>
			    <select class="form-control" name="kategori_id">
			    	<option selected disabled>Pilih</option>
			    	<?php while($result = mysqli_fetch_assoc($data) ){ ?>
				    <option value="<?php echo $result['kategori_id']; ?>"><?php echo $result['kategori_nama']; ?></option>
				   	<?php } ?>
			    </select>
			  </div>
			  <div class="form-group">
			    <label>Judul Berita</label>
			    <input type="text" class="form-control" name="berita_judul">
			  </div>
			  <div class="form-group">
			    <label>Tanggal Berita</label>
			    <input type="date" class="form-control" name="berita_tanggal">
			  </div>
			  <div class="form-group">
			    <label>Gambar Berita</label>
			    <input type="file" class="form-control" name="berita_gambar">
			  </div>
			  <div class="form-group">
			    <label>Penulis Berita</label>
			    <input type="text" class="form-control" name="berita_penulis">
			  </div>
			  <div class="form-group">
			  	<label>Isi Berita</label>
				<textarea class="form-control" name="berita_isi" id="editor1"></textarea>
				<script>
					CKEDITOR.replace('editor1')
				</script>
			  </div>
			  <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
			</form>
        </div>
      </div>
    </div>
  </section>

<?php 
	if (isset($_POST['simpan'])) {
		// $id = $result['berita_kategori'];
		$kategori_id 	= $_POST["kategori_id"];
		$berita_judul 	= $_POST["berita_judul"];
		$berita_penulis = $_POST["berita_penulis"];
		$berita_tanggal = $_POST["berita_tanggal"];
		$berita_isi 	= $_POST["berita_isi"];
		$berita_gambar 	= $_FILES['berita_gambar']['name'];
		$lokasi_gambar 	= $_FILES['berita_gambar']['tmp_name'];

		// $allowed = array('jpg', 'png', 'jpeg', 'JPG','JPEG','PNG');
		$file_name = explode('.', $berita_gambar);
		$name_file = end($file_name);
		$file_ext = strtolower($name_file);
		$name_file = date('YmdHis')."-".substr(uniqid('',true), -5)."-".$file_ext;


		move_uploaded_file($lokasi_gambar, "img/berita/$name_file");

		$simpan = $koneksi->query("INSERT INTO tb_berita (kategori_id, berita_judul, berita_tanggal, berita_gambar, berita_penulis, berita_isi) VALUES ('$kategori_id', '$berita_judul', '$berita_tanggal', '$name_file', '$berita_penulis', '$berita_isi')");

		if ($simpan) {
			echo " <script> alert('Tambah data Berhasil')</script>;
			<script> window.location='index.php?page=module/berita/index'</script>
			";
		} else {
			echo " <script> alert('Tambah data gagal')</script>;
			<script> window.location='index.php?page=module/berita/index'</script>
			";
		}
	} else {
		
	}
?>