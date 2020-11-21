<?php 
	$id	= $_GET["berita_id"];
	$data = $koneksi->query("SELECT * FROM tb_berita WHERE berita_id='$id'")->fetch_array();
	$data_kategori = $koneksi->query("SELECT kategori_id, kategori_nama FROM tb_kategori");
?>
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit berita</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">berita</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Edit berita
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label>Kategori Berita</label>
			    <select class="form-control" name="kategori_id">
			    	<?php while($result = mysqli_fetch_assoc($data_kategori) ){ ?>
				    <option value="<?php echo $result['kategori_id']; ?>">
				    	<?php echo $result['kategori_nama']; ?>		
				    </option>
				   	<?php } ?>
				   	<script>
				   		document.getElementsByName('kategori_id')[0].value=<?php echo $data['kategori_id'] ?>
				   	</script>
			    </select>
			  </div>
			  <div class="form-group">
			    <label>judul berita</label>
			    <input type="text" class="form-control" name="berita_judul" value="<?php echo $data['berita_judul'] ?>">
			  </div>
			  <div class="form-group">
			    <label>Tanggal berita</label>
			    <input type="date" class="form-control" name="berita_tanggal" value="<?php echo $data['berita_tanggal'] ?>">
			  </div>
			  <div class="form-group">
			    <label>Gambar Berita</label>
			    <br>
			    <img src="img/berita/<?php echo $data['berita_gambar'] ?>" alt="" class="text-center" style="width: 100px;">  
			    <input type="file" class="form-control" name="berita_gambar" >
			  </div>
			  <div class="form-group">
			    <label>Penulis Berita</label>
			    <input type="text" class="form-control" name="berita_penulis" value="<?php echo $data['berita_penulis'] ?>">
			  </div>
			  <div class="form-group">
			  	<label>Isi Berita</label>
				<textarea class="form-control" name="berita_isi"  id="editor1"><?php echo $data['berita_isi'] ?></textarea>
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
		
		$berita_judul = $_POST["berita_judul"];
		$berita_tanggal = $_POST["berita_tanggal"];
		$berita_penulis = $_POST["berita_penulis"];
		$kategori_id = $_POST["kategori_id"];
		$berita_isi = $_POST["berita_isi"];
		$berita_gambar = $_FILES['berita_gambar']['name'];
		$lokasi_gambar = $_FILES['berita_gambar']['tmp_name'];
		$berita_id = $id;

		$file_name = explode('.', $berita_gambar);
		$name_file = end($file_name);
		$file_ext = strtolower($name_file);
		$name_file = date('YmdHis')."-".substr(uniqid('',true), -5)."-".$file_ext;

		$cari_gambar = $koneksi->query("SELECT berita_gambar FROM tb_berita WHERE berita_id='$berita_id'")->fetch_array();

		if ($berita_gambar == null) {
			$simpan = $koneksi->query("UPDATE tb_berita SET berita_judul='$berita_judul', berita_tanggal='$berita_tanggal', berita_penulis='$berita_penulis', berita_isi='$berita_isi' WHERE berita_id='$berita_id'");

		} elseif ($berita_gambar != null) {
			move_uploaded_file($lokasi_gambar, "img/berita/$name_file");
			if (!empty($cari_gambar['berita_gambar'])) {
				unlink('img/berita/' . $cari_gambar['berita_gambar']);
			}

			$simpan = $koneksi->query("UPDATE tb_berita SET kategori_id='$kategori_id', berita_judul='$berita_judul', berita_tanggal='$berita_tanggal', berita_gambar='$name_file', berita_penulis='$berita_penulis', berita_isi='$berita_isi' WHERE berita_id='$berita_id'");
		}

		// $allowed = array('jpg', 'png', 'jpeg', 'JPG','JPEG','PNG');
		// $file_name = explode('.', $berita_gambar);
		// $name_file = end($file_name);
		// $file_ext = strtolower($name_file);
		// $name_file = date('YmdHis')."-".substr(uniqid('',true), -5)."-".$file_ext;

		// move_uploaded_file($lokasi_gambar, "img/berita/$name_file");

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