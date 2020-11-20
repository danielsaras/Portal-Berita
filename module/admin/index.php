<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Admin</h1>
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
          Data Admin
        </div>
        <div class="card-body">
          <a href ="?page=module/admin/tambah" class="btn btn-primary my-4">Tambah</a>
          <table class="table table-striped table-dark" id="example1">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">NAMA</th>
                <th scope="col">Email</th>
                <th scope="col">Foto</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $data = $koneksi->query("SELECT * FROM tb_admin");
                foreach ($data as $a => $value ) {
              ?>
              <tr>
                <td><?php echo $a + 1; ?></td>
                <td><?php echo $value['admin_nama']; ?></td>
                <td><?php echo $value['admin_email']; ?></td>
                <td>
                  <img src="img/admin/<?php echo $value['admin_foto']; ?>" alt="" style="width: 100px;">
                </td>
                <td>
                  <a href="?page=module/admin/edit&admin_id=<?= $value['admin_id']?>" class="btn btn-warning">Edit</a>
                  <a href="?page=module/admin/hapus&admin_id=<?= $value['admin_id']?>" class="btn btn-danger">Hapus</a>
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