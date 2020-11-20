<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Kategori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kategori</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Data kategori
        </div>
        <div class="card-body">
          <a href ="?page=module/kategori/tambah" class="btn btn-primary my-4">Tambah</a>
          <table class="table table-striped table-dark" id="example1">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">NAMA</th>
                <th scope="col">LOGO</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $data = $koneksi->query("SELECT * FROM tb_kategori");
                foreach ($data as $a => $value ) {
              ?>
              <tr>
                <td><?php echo $a + 1; ?></td>
                <td><?php echo $value['kategori_nama']; ?></td>
                <td>
                  <img src="img/kategori/<?php echo $value['kategori_logo']; ?>" alt="" style="width: 100px;">
                </td>
                <td>
                  <a href="?page=module/kategori/edit&kategori_id=<?= $value['kategori_id']?>" class="btn btn-warning">Edit</a>
                  <a href="?page=module/kategori/hapus&kategori_id=<?= $value['kategori_id']?>" class="btn btn-danger">Hapus</a>
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