<?php
session_start();
if(!isset($_SESSION["loggedin"])) header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Management Office | Add Team</title>
  <!-- bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .cursor:hover{
      cursor: pointer;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="">
        <div class="row mt-1">
          <div class="col-sm-12 mx-3">
            <h4 class="m-0"> Project Management Office</h4>
          </div><!-- /.col -->
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php
            date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu
            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"); 
            $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 

            $now = time(); 
            $tanggal = date("j", $now); 
            $hari = $hari[date("w", $now)]; 
            $bulan = $bulan[date("n", $now) - 1]; 
            $tahun = date("Y", $now); 
            $jam = date("H", $now); 
            $menit = date("i", $now); 
            $detik = date("s", $now);
        ?>
        <div class="nav-link">
          <?php
              echo "$hari, $tanggal $bulan $tahun";
          ?>
        </div>
      </li>
      <li class="nav-item">
          <div class="nav-link" id="clock"></div>
      </li>
      <li class="nav-item">
        <a onclick="return confirm('Anda yakin ingin logout?')" class="nav-link fw-bold" href="logout.php">
            <span>
            <i class="fas fa-sign-out-alt"></i>  
            </span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/logo.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['name'];?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="addFgd.php" class="nav-link">
              <!-- <i class="nav-icon fas fa-th"></i> -->
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Add FGD
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="addProject.php" class="nav-link">
              <!-- <i class="nav-icon fas fa-th"></i> -->
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Add Project
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Input Progress
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Status Project
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="addTeam.php" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Team
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->

    <!-- Menu button -->
    <div class="content">
      <div class="container-fluid">
        <!-- tabel end result -->
        <div id="endresult">
          <div class="row justify-content-end">
            <div class="col-2 mt-3">
              <button type="button"  data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-secondary">
                + Add Team
              </button>
            </div>
          </div>
          <!-- table -->
          <div id="data-container" class="row mt-4">
            <table class="table">
              <thead>
                  <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <th scope="col">Departement</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Otoritas</th>
                  <th scope="col">Status</th>
                  <th scope="col" colspan="2">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                include('proses/koneksi.php');
                $sql = "SELECT * FROM db_user";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows > 0) {
                $no =1;
                while($data = mysqli_fetch_array($query)) { ?>
                <tr class="cursor" >
                  <td><?= $no;?></td>
                  <td><?= $data['username'];?></td>
                  <td><?= $data['email'];?></td>
                  <td><?= $data['departement'];?></td>
                  <td><?= $data['jabatan'];?></td>
                  <td><?= $data['otoritas'];?></td>
                  <td><?= $data['status'];?></td>
                  <td>
                    <a data-toggle="modal" data-target="#editModal<?= $data['userid'];?>">
                      <span class="fa fa-edit text-primary"></span>
                    </a>
                  </td>
                  <td>
                    <a href="delete_team.php?userid=<?= $data['userid'];?>" onclick="return confirm('Anda yakin ingin hapus data?')">
                      <span class="fa fa-trash text-danger"></span>
                    </a>
                  </td>
                  <!-- Modal edit team -->
                  <div class="modal fade" id="editModal<?= $data['userid'];?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel">Edit Data Team</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="proses_edit_team.php" method="POST">
                            <input type="hidden" name="userid" value="<?= $data['userid'];?>"> <!-- Hidden input field -->
                            <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['username'];?>" required>
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="text" class="form-control" id="email" name="email" value="<?= $data['email'];?>" required>
                            </div>
                            <div class="form-group">
                              <label for="departement">Departement</label>
                              <input type="text" class="form-control" id="departement" name="departement" value="<?= $data['departement'];?>" required>
                            </div>
                            <div class="form-group">
                              <label for="jabatan">Jabatan</label>
                              <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $data['jabatan'];?>" required>
                            </div>
                            <div class="form-group">
                              <label for="otoritas">Otoritas</label>
                              <input type="text" class="form-control" id="otoritas" name="otoritas" value="<?= $data['otoritas'];?>" required>
                            </div>
                            <div class="form-group">
                              <label for="status">Status</label>
                              <input type="text" class="form-control" id="status" name="status" value="<?= $data['status'];?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </tr>
                <?php
                  $no++; 
                      }
                    } else {
                    echo "<br><br><b>0 results<b>";
                    }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; Erik Julios.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>


<!-- Modal add team-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Team</h4><br>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses_addTeam.php">
            <div class="col">
                <div class="form-group">
                    <label>Nama :</label>
                    <input type="text" class="form-control pull-right" id="nama" name="nama">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Departement :</label>
                    <input type="text" class="form-control pull-right" id="departement" name="departement">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Jabatan :</label>
                    <input type="text" class="form-control pull-right" id="jabatan" name="jabatan">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Otoritas :</label>
                    <input type="text" class="form-control pull-right" id="otoritas" name="otoritas">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Status :</label>
                    <input type="text" class="form-control pull-right" id="status" name="status">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Email :</label>
                    <input type="text" class="form-control pull-right" id="email" name="email">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Username :</label>
                    <input type="text" class="form-control pull-right" id="username" name="username">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Password :</label>
                    <input type="password" class="form-control pull-right" id="password" name="password">
                </div>
            </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary float-right">Tambah</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
<script>
    function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var time = hours + ':' + minutes + ':' + seconds;
    document.getElementById('clock').innerHTML = time;
    setTimeout(updateClock, 1000);
  }
  updateClock();

  function editData(id) {
      $.ajax({
          url: 'proses_edit_endresult.php',
          type: 'post',
          data: {id: id},
          dataType: 'json',
          success: function(response) {
              $('#tanggal').val(response.tanggal);
              $('#end').val(response.end);
              $('#id').val(response.id);
          }
      });
  }
</script>
<script>
$(document).ready(function() {
  $('.btn-edit').click(function() {
    var id = $(this).data('id');
    $.ajax({
      url: 'proses_edit_endresult.php',
      type: 'POST',
      data: {id: id},
      dataType: 'json',
      success: function(data) {
        $('#edit-id').val(data.id);
        $('#edit-nama').val(data.nama);
        $('#edit-email').val(data.email);
      }
    });
  });
});
</script>
</body>
</html>
