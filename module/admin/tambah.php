<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Admin</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Nama Admin</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Tambah Admin
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label>Nama Admin</label>
			    <input type="text" class="form-control" name="admin_nama">
			  </div>
			  <div class="form-group">
			    <label>Email Admin</label>
			    <input type="email" class="form-control" name="admin_email">
			  </div>
			  <div class="form-group">
			    <label>Password Admin</label>
			    <input type="password" class="form-control" name="admin_password">
			  </div>
			  <div class="form-group">
			    <label>Foto Admin</label>
			    <input type="file" class="form-control" name="admin_foto">
			  </div>
			  <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
			</form>
        </div>
      </div>
    </div>
  </section>

<?php 
	if (isset($_POST['simpan'])) {
		
		$admin_nama = $_POST["admin_nama"];
		$admin_email = $_POST["admin_email"];
		$admin_password = md5($_POST["admin_password"]);
		$admin_foto = $_FILES['admin_foto']['name'];
		$lokasi_foto = $_FILES['admin_foto']['tmp_name'];

		// $allowed = array('jpg', 'png', 'jpeg', 'JPG','JPEG','PNG');
		$file_name = explode('.', $admin_foto);
		$name_file = end($file_name);
		$file_ext = strtolower($name_file);
		$name_file = date('YmdHis')."-".substr(uniqid('',true), -5)."-".$file_ext;


		move_uploaded_file($lokasi_foto, "img/admin/$name_file");

		$simpan = $koneksi->query("INSERT INTO tb_admin (admin_nama, admin_email, admin_password, admin_foto) VALUES ('$admin_nama', '$admin_email', '$admin_password', '$name_file')");

		if ($simpan) {
			echo " <script> alert('Tambah data Berhasil')</script>;
			<script> window.location='index.php?page=module/admin/index'</script>
			";
		} else {
			echo " <script> alert('Tambah data gagal')</script>;
			<script> window.location='index.php?page=module/admin/index'</script>
			";
		}
	} else {
		
	}
?>