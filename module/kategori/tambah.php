<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah kategori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Nama kategori</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Tambah kategori
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label>Nama kategori</label>
			    <input type="text" class="form-control" name="kategori_nama">
			  </div>
			  <div class="form-group">
			    <label>logo kategori</label>
			    <input type="file" class="form-control" name="kategori_logo">
			  </div>
			  <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
			</form>
        </div>
      </div>
    </div>
  </section>

<?php 
	if (isset($_POST['simpan'])) {
		
		$kategori_nama = $_POST["kategori_nama"];
		$kategori_logo = $_FILES['kategori_logo']['name'];
		$lokasi_logo = $_FILES['kategori_logo']['tmp_name'];

		// $allowed = array('jpg', 'png', 'jpeg', 'JPG','JPEG','PNG');
		$file_name = explode('.', $kategori_logo);
		$name_file = end($file_name);
		$file_ext = strtolower($name_file);
		$name_file = date('YmdHis')."-".substr(uniqid('',true), -5)."-".$file_ext;


		move_uploaded_file($lokasi_logo, "img/kategori/$name_file");

		$simpan = $koneksi->query("INSERT INTO tb_kategori (kategori_nama, kategori_logo) VALUES ('$kategori_nama', '$name_file')");

		if ($simpan) {
			echo " <script> alert('Tambah data Berhasil')</script>;
			<script> window.location='index.php?page=module/kategori/index'</script>
			";
		} else {
			echo " <script> alert('Tambah data gagal')</script>;
			<script> window.location='index.php?page=module/kategori/index'</script>
			";
		}
	} else {
		
	}
?>