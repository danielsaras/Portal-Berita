<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data berita</h1>
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
          Data berita
        </div>
        <div class="card-body">
          <a href ="?page=module/berita/tambah" class="btn btn-primary my-4">Tambah</a>
          <table class="table table-striped table-dark" id="example1">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">Kategori</th>
                <th scope="col">Judul</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Penulis</th>
                <th scope="col">Gambar</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $data = $koneksi->query("SELECT * FROM tb_berita left join tb_kategori on tb_berita.kategori_id = tb_kategori.kategori_id");
                foreach ($data as $a => $value ) {
              ?>
              <tr>
                <td><?php echo $a + 1; ?></td>
                <td><?php echo $value['kategori_nama']; ?></td>
                <td><?php echo $value['berita_judul']; ?></td>
                <td><?php echo $value['berita_tanggal']; ?></td>
                <td><?php echo $value['berita_penulis']; ?></td>
                <td>
                  <img src="img/berita/<?php echo $value['berita_gambar']; ?>" alt="" style="width: 100px; max-height: 100px">
                </td>
                <td>
                  <a href="?page=module/berita/edit&berita_id=<?= $value['berita_id']?>" class="btn btn-warning">Edit</a>
                  <a href="?page=module/berita/hapus&berita_id=<?= $value['berita_id']?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
              <?php 
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>