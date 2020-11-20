<?php 
	$id	= $_GET["admin_id"];
	$data = $koneksi->query("SELECT * FROM tb_admin WHERE admin_id='$id'")->fetch_array();
?>
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Admin</h1>
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
          Edit Admin
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label>Nama Admin</label>
			    <input type="text" class="form-control" name="admin_nama" value="<?php echo $data['admin_nama'] ?>">
			  </div>
			  <div class="form-group">
			    <label>Email Admin</label>
			    <input type="email" class="form-control" name="admin_email" value="<?php echo $data['admin_email'] ?>">
			  </div>
			  <div class="form-group">
			    <label>Password Admin</label>
			    <input type="password" class="form-control" name="admin_password">
			  </div>
			  <div class="form-group">
			    <label>Foto Admin</label>
			    <br>
			    <img src="img/admin/<?php echo $data['admin_foto'] ?>" alt="" class="text-center" style="width: 100px;">  
			    <input type="file" class="form-control" name="admin_foto" >
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
		$admin_password = $_POST["admin_password"];
		$admin_foto = $_FILES['admin_foto']['name'];
		$lokasi_foto = $_FILES['admin_foto']['tmp_name'];
		$admin_id = $id;

		$password = md5($admin_password);

		$file_name = explode('.', $admin_foto);
		$name_file = end($file_name);
		$file_ext = strtolower($name_file);
		$name_file = date('YmdHis')."-".substr(uniqid('',true), -5)."-".$file_ext;

		$cari_foto = $koneksi->query("SELECT admin_foto FROM tb_admin WHERE admin_id='$admin_id'")->fetch_array();

		if ($admin_password == null && $admin_foto == null) {
			$simpan = $koneksi->query("UPDATE tb_admin SET admin_nama='$admin_nama', admin_email='$admin_email' WHERE admin_id='$admin_id'");

		} elseif($admin_password == null && $admin_foto != null) {
			move_uploaded_file($lokasi_foto, "img/admin/$name_file");
			if (!empty($cari_foto['admin_foto'])) {
				unlink('img/admin/' . $cari_foto['admin_foto']);
			}

			$simpan = $koneksi->query("UPDATE tb_admin SET admin_nama='$admin_nama', admin_email='$admin_email', admin_foto='$name_file' WHERE admin_id='$admin_id'");

		} elseif($admin_password != null && $admin_foto == null) {
			$simpan = $koneksi->query("UPDATE tb_admin SET admin_nama='$admin_nama', admin_email='$admin_email', admin_password='$password' WHERE admin_id='$admin_id'");

		} else {
			move_uploaded_file($lokasi_foto, "img/admin/$name_file");
			if (!empty($cari_foto['admin_foto'])) {
				unlink('img/admin/' . $cari_foto['admin_foto']);
			}
			$simpan = $koneksi->query("UPDATE tb_admin SET admin_nama='$admin_nama', admin_email='$admin_email', admin_password='$password', admin_foto='$name_file' WHERE admin_id=$admin_id");
		}

		// $allowed = array('jpg', 'png', 'jpeg', 'JPG','JPEG','PNG');
		// $file_name = explode('.', $admin_foto);
		// $name_file = end($file_name);
		// $file_ext = strtolower($name_file);
		// $name_file = date('YmdHis')."-".substr(uniqid('',true), -5)."-".$file_ext;

		// move_uploaded_file($lokasi_foto, "img/admin/$name_file");

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