<?php
	
	$berita_id = $_GET['berita_id'];

	$cari= $koneksi->query("SELECT berita_gambar from tb_berita where berita_id='$berita_id'")->fetch_array();
	if (!empty($cari['berita_gambar'])) {
		unlink('img/berita/' . $cari['berita_gambar']);
	}

	$hapus = mysqli_query($koneksi, "DELETE FROM tb_berita WHERE berita_id=$berita_id");
	
	if ($hapus) {
		echo " <script> alert('Data Dihapus')</script>;
		<script> window.location='index.php?page=module/berita/index'</script>
		";
	} else {
		echo " <script> alert('Hapus Data gagal')</script>;
		<script> window.location='index.php?page=module/berita/index'</script>
		";
	}
?>