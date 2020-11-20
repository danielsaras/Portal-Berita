<?php
	
	$kategori_id = $_GET['kategori_id'];

	$cari= $koneksi->query("SELECT kategori_logo from tb_kategori where kategori_id='$kategori_id'")->fetch_array();
	if (!empty($cari['kategori_logo'])) {
		unlink('img/kategori/' . $cari['kategori_logo']);
	}

	$hapus = mysqli_query($koneksi, "DELETE FROM tb_kategori WHERE kategori_id=$kategori_id");
	
	if ($hapus) {
		echo " <script> alert('Data Dihapus')</script>;
		<script> window.location='index.php?page=module/kategori/index'</script>
		";
	} else {
		echo " <script> alert('Hapus Data gagal')</script>;
		<script> window.location='index.php?page=module/kategori/index'</script>
		";
	}
?>