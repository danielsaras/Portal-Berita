<?php
	
	$admin_id = $_GET['admin_id'];

	$cari= $koneksi->query("SELECT admin_foto from tb_admin where admin_id='$admin_id'")->fetch_array();
	if (!empty($cari['admin_foto'])) {
		unlink('img/admin/' . $cari['admin_foto']);
	}

	$hapus = mysqli_query($koneksi, "DELETE FROM tb_admin WHERE admin_id=$admin_id");

	if ($hapus) {
		echo " <script> alert('Data Dihapus')</script>;
		<script> window.location='index.php?page=module/admin/index'</script>
		";
	} else {
		echo " <script> alert('Hapus Data gagal')</script>;
		<script> window.location='index.php?page=module/admin/index'</script>
		";
	}
?>