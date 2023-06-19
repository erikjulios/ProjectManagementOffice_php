<?php
error_reporting(0);
session_start();
if(!isset($_SESSION["loggedin"])) header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- select 2 -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Management Office | Add Project</title>
  <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    .border-tebal{
    border-top : 3px solid blue ;

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
        <div class="row">
          <div class="col-sm-12 mt-4 mb-4 mx-3">
            <h2 class="m-0"> Project Management Office</h2>
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
        <div class="nav-link ">
        <a onclick="return confirm('Anda yakin ingin logout?')" class="nav-link fw-bold mb-4" href="logout.php">
            <span>
            <i class="fas fa-sign-out-alt"></i>  
            </span>
        </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
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
          <li class="nav-item">
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
            <a href="addProject.php" class="nav-link active">
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
            <a href="addTeam.php" class="nav-link">
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
    <div class="content-header" style="margin-top: -20px;">
      <div class="container-fluid">
        <div class="row justify-content-start mt-3">
          <div class="col-2 text-bold">
            Group Forum Discussion
          </div>
          <!-- select end result -->
          <div class="col-3" id="select_end">
            <select style="width: 110px;" class="form-select" name="kode_fgd" id="select_fgd" required>
              <option value="all" class="text-center">---   Pilih FGD   ---</option>
              <?php
                include "proses/koneksi.php";
                $sql = "SELECT kode_fgd, nama_fgd FROM db_fgd";
                $query = mysqli_query($db, $sql);
                foreach($query as $row) {
                  echo '<option value="' . $row['kode_fgd'] . '">' . $row['nama_fgd'] . '</option>';
                }
              ?>
            </select>
          </div>
          <!-- select intermediate -->
          <div class="col-3" id="select_inter" style="display: none;">
            <select class="form-select bg-primary" name="kode_fgd" id="select_fgd2" required>
              <option value="all" class="text-center">---   Pilih FGD   ---</option>
              <?php
                include "proses/koneksi.php";
                $sql = "SELECT kode_fgd, nama_fgd FROM db_fgd";
                $query = mysqli_query($db, $sql);
              foreach($query as $row) {
                echo '<option value="' . $row['kode_fgd'] . '">' . $row['nama_fgd'] . '</option>';
              }
              ?>
            </select>
          </div>
          <!-- select activity -->
          <div class="col-3" id="select_act" style="display: none;">
            <select class="form-select bg-primary" name="kode_fgd" id="select_fgd3" required>
              <option value="all" class="text-center">---   Pilih FGD   ---</option>
              <?php
                include "proses/koneksi.php";
                $sql = "SELECT kode_fgd, nama_fgd FROM db_fgd";
                $query = mysqli_query($db, $sql);
              foreach($query as $row) {
                echo '<option value="' . $row['kode_fgd'] . '">' . $row['nama_fgd'] . '</option>';
              }
              ?>
            </select>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Menu button -->
    <div class="content">
      <div class="container-fluid">
        <div class="row mt-5">
          <!-- button -->
          <div class="col-lg-3 col-4">
          <!-- onclick="location.href='#';" -->
            <button type="button" id="btn-end" class="btn btn-block btn-secondary border border-dark">
              End Result
            </button>
          </div>
          <!-- button -->
          <div class="col-lg-3 col-4">
            <button type="button" id="btn-inter" class="btn btn-block btn-secondary">
              Intermediate Result
            </button>
          </div>
          <!-- button -->
          <div class="col-lg-3 col-4">
            <button type="button" id="btn-act" class="btn btn-block btn-secondary">
              List Activity
            </button>
          </div>
        </div>
        <!-- tabel end result -->
        <div id="endresult" class="px-5 pb-5 pt-2 mt-2">
          <div class="row justify-content-between mt-4 mb-4">
            <div class="col-2 ml-auto">
              <button id="endBtnModal" type="button" class="btn btn-block btn-secondary">
                + Add Project
              </button>
            </div>
          </div>
          <!-- table -->
          <div class="row mt-4" id="data-container">
          </div>
        </div>
        
        <!-- tabel intermediate -->
        <div id="inter" style="display: none;" class="px-5 pb-5 pt-2 mt-2">
          <div class="row justify-content-between mt-4 mb-4">
            <div class="col-2 ml-auto">
              <button id="interBtnModal" type="button" class="btn btn-block btn-secondary">
                + Add Project
              </button>
            </div>
          </div>
          <!-- table -->
          <div class="row mt-4" id="data-container2">
          </div>
        </div>

        <!-- tabel activity -->
        <div id="act" style="display: none;" class="px-5 pb-5 pt-2 mt-2" >
          <div class="row justify-content-between mt-4 mb-4">
            <div class="col-2 ml-auto">
              <button id="actBtnModal" type="button" class="btn btn-block btn-secondary">
                + Add Project
              </button>
            </div>
          </div>

          <!-- table -->
          <div class="row mt-4" id="data-container3">
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


<!-- modal add end result-->
<div id="modalend" class="modal bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="fgdend"></h4><br>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses_addEndresult.php">
          <div class="border border-primary px-3 pb-3">
            <div class="row mb-4 mt-4 text-bold h5 text-primary">End Result</div>  
            <div class="row">
              <div class="col-md-5">
                  <div class="form-group">
                      <label>End Result:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="end_result[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label>UoM:</label>
                      <select class="form-control" name="uom[]" id="" required>
                        <?php
                          include "proses/koneksi.php";
                          $sql = "SELECT * FROM uom";
                          $query = mysqli_query($db, $sql);
                          foreach($query as $row) {
                            echo '<option value="'.$row['id'].'">'.$row['nama'].'</option>';
                          }
                        ?>
                      </select>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label>As-Is:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="asis[]" required>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label>Tube:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="tube[]" required>
                  </div>
              </div>
              <!-- send data hidden dari fgd -->
              <input type="hidden" class="form-control " name="kode_fgd" id="nama_fgdend">
            </div>
          </div>
          <div class="border border-primary px-3 mt-2 pb-3">
            <div class="row text-bold mb-4 mt-4 h5 text-primary">Time Frame</div>
            <div class="row">
              <div class="col-md-2">
                  <div class="form-group">
                      <label>Estimate Cost:</label>
                      <input type="number" class="form-control pull-right" id="nama" name="estimate_cost[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label>Start:</label>
                      <input type="date" class="form-control pull-right" id="start-endresult" name="start[]" onchange="aksi()" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label>End:</label>
                      <input type="date" class="form-control pull-right" id="end-endresult" name="end[]" onchange="aksi()" required>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label>Duration:</label>
                      <input type="text" readonly class="form-control pull-right" id="duration-endresult" name="duration[]" required>
                  </div>
              </div>
            </div>
          </div>
          <div class="border border-primary px-3 mt-2 pb-3">
            <div class="row text-bold mb-4 mt-4 h5 text-primary">Setting Target</div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Januari :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="jan[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Februari :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="feb[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Maret :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="mar[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>April :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="apr[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Mei :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="mei[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Juni :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="jun[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Juli :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="jul[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Agustus :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="aug[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>September :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="sep[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Oktober :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="okt[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>November :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="nov[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Desember :</label>
                        <input type="text" class="form-control pull-right" id="nama" name="des[]" required>
                    </div>
                </div>
              </div>
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

<!-- modal add intermediate-->
<div id="modalinter" class="modal bd-example-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="fgdinter"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses_addIntermediate.php" onsubmit="return validateFormInter()">
          <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label>End Result :</label>
                    <select class="form-control" name="kode_endresult" id="select_endresult_inter" required>
                      <option value="0">-- Pilih End Result --</option>
                      <?php
                        include "proses/koneksi.php";
                        $sql = "SELECT * FROM db_target_end_result";
                        $query = mysqli_query($db, $sql);
                        foreach($query as $row) {
                          echo '<option value="'.$row['kode_endresult'].'">'.$row['end_result'].'</option>';
                        }
                      ?>
                    </select>
                </div>
            </div>
          </div>
          <div class="border border-primary mb-2 px-3 pb-3">
            <div class="row text-bold mb-4 h5 text-primary">Intermediate</div>  
            <div class="row">
              <div class="col-md-5">
                  <div class="form-group">
                      <label>Intermediate:</label>
                      <input type="text" class="form-control pull-right" name="intermediate[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label>UoM:</label>
                      <select class="form-control" name="uom[]" id="uom_inter" required>
                        <option value="0">-- Pilih uom --</option>
                        <?php
                          include "proses/koneksi.php";
                          $sql = "SELECT * FROM uom";
                          $query = mysqli_query($db, $sql);
                          foreach($query as $row) {
                            echo '<option value="'.$row['id'].'">'.$row['nama'].'</option>';
                          }
                        ?>
                      </select>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label>As-Is:</label>
                      <input type="text" class="form-control pull-right" name="asis[]" required>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label>Tube:</label>
                      <input type="text" class="form-control pull-right" name="tube[]" required>
                  </div>
              </div>
                <!-- send data hidden dari fgd -->
                <input type="hidden" class="form-control " name="kode_fgd" id="nama_fgdinter" required>
            </div>
          </div>
          <div class="border border-primary mb-2 px-3 pb-3">
            <div class="row text-bold mb-4 h5 text-primary">Time Frame</div>  
            <div class="row">
              <div class="col-md-2">
                  <div class="form-group">
                      <label>Estimate Cost:</label>
                      <input type="number" class="form-control pull-right" name="estimate_cost[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label>Start:</label>
                      <input type="date" id="start-inter" class="form-control pull-right" name="start[]" onchange="aksi_inter()" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label>End:</label>
                      <input type="date" id="end-inter" class="form-control pull-right" name="end[]" onchange="aksi_inter()" required>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label>Duration:</label>
                      <input type="text" id="duration-inter" class="form-control pull-right" name="duration[]" readonly>
                  </div>
              </div>
            </div>
          </div>
          <div class="border border-primary mb-2 px-3 pb-3">
            <div class="row text-bold mb-4 h5 text-primary">Setting Target</div>  
            <div class="row">
            <div class="col-md-2">
                    <div class="form-group">
                        <label>Januari:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="jan[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Februari:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="feb[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Maret:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="mar[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>April:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="apr[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Mei:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="mei[]" required>
                    </div>
                </div>
                <div class="col-sm-2"> 
                    <div class="form-group">
                        <label>Juni:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="jun[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Juli:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="jul[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Agustus:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="aug[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>September:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="sep[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Oktober:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="okt[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>November:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="nov[]" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Desember:</label>
                        <input type="text" class="form-control pull-right" id="nama" name="des[]" required>
                    </div>
                </div>
            </div>
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

<!-- modal add activity-->
<div id="modalact" class="modal bd-example-modal-lg-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="fgdact"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses_addActivity.php" onsubmit="return validateFormAct()">
          <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-group">
                    <label>End Result :</label>
                    <select class="form-control" name="kode_endresult" id="select_endresult_act" required>
                      <option value="0">-- Pilih end result --</option>
                      <?php
                        include "proses/koneksi.php";
                        $sql = "SELECT * FROM db_target_end_result";
                        $query = mysqli_query($db, $sql);
                        foreach($query as $row) {
                          echo '<option value="'.$row['kode_endresult'].'">'.$row['end_result'].'</option>';
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Intermediate :</label>
                    <select class="form-control" name="kode_intermediate" id="select_inter_act" required>
                    <option value="0">-- Pilih intermediate --</option>
                      <?php
                        include "proses/koneksi.php";
                        $sql = "SELECT * FROM db_target_intermediate";
                        $query = mysqli_query($db, $sql);
                        foreach($query as $row) {
                          echo '<option value="'.$row['kode_intermediate'].'">'.$row['intermediate'].'</option>';
                        }
                      ?>
                    </select>
                </div>
            </div>
          </div>
          <div class="border border-primary px-3 mb-2 pb-3">
            <div id="fgd1" class="row text-bold mb-4 h5 text-primary">Activity</div>  
            <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="nama">Activity :</label>
                      <input type="text" class="form-control pull-right" id="nama" name="activity[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="nama">PIC:</label>
                      <select class="form-control pull-right" name="pic" id="pic" required>
                        <option value="0">-- Pilih PIC --</option>
                        <?php
                          include "proses/koneksi.php";
                          $sql = "SELECT pic,team FROM db_fgd";
                          $query = mysqli_query($db, $sql);
                          $anggota_fgd = array();
                          foreach($query as $row) {
                            $anggota = $row['pic'] . ',' . $row['team'];
                            $anggota = explode(',', $anggota);
                            $anggota_fgd = $anggota;
                          }
                          $getNama = "SELECT userid,username FROM db_user";
                          $execute_nama = mysqli_query($db, $getNama);
                          $daftar_user= array();
                          
                          foreach ($execute_nama as $key) {
                            $daftar_user[] = array(
                              'id' => $key['userid'],
                              'nama' => $key['username'],
                            );
                          }

                          foreach ($anggota_fgd as $key) {
                            foreach ($daftar_user as $value) {
                              if($value['id'] == $key){
                                echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                              }
                            }
                            
                          }
                          
                        ?>
                    </select>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="nama">Supported By:</label>
                      <select class="form-control pull-right" id="support" name="support[]" multiple="multiple" required>
                        <?php
                          include "proses/koneksi.php";
                          $sql = "SELECT pic,team FROM db_fgd";
                          $query = mysqli_query($db, $sql);
                          $anggota_fgd = array();
                          foreach($query as $row) {
                            $anggota = $row['pic'] . ',' . $row['team'];
                            $anggota = explode(',', $anggota);
                            $anggota_fgd = $anggota;
                          }
                          $getNama = "SELECT userid,username FROM db_user";
                          $execute_nama = mysqli_query($db, $getNama);
                          $daftar_user= array();
                          
                          foreach ($execute_nama as $key) {
                            $daftar_user[] = array(
                              'id' => $key['userid'],
                              'nama' => $key['username'],
                            );
                          }

                          foreach ($anggota_fgd as $key) {
                            foreach ($daftar_user as $value) {
                              if($value['id'] == $key){
                                echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                              }
                            }
                            
                          }
                          
                        ?>
                      </select>
                    <script src="dist/js/selectt2.js"></script>
                    <script>
                      $(document).ready(function() {
                          // Inisialisasi Select2 di dalam modal
                          $("#support").select2({
                              placeholder: "Supported by",
                              templateSelection: function (data, container) {
                                  if (data.selected) {
                                      $(container).css({"color":"black"});
                                  }
                                  return data.text;
                              }
                          });
                      });
                    </script>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="nama">Lokasi:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="lokasi[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="nama">UoM:</label>
                      <select class="form-control" name="uom[]" id="uom_act" required>
                      <option value="0">-- Pilih uom --</option>
                        <?php
                          include "proses/koneksi.php";
                          $sql = "SELECT * FROM uom";
                          $query = mysqli_query($db, $sql);
                          foreach($query as $row) {
                            echo '<option value="'.$row['id'].'">'.$row['nama'].'</option>';
                          }
                        ?>
                      </select>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label for="nama">Target:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="target[]" required>
                  </div>
              </div>
                <!-- send data hidden dari fgd -->
                <input type="hidden" class="form-control " name="kode_fgd" id="nama_fgdd" required>                 
            </div>
          </div>
          <div class="border border-primary mb-2 px-3 pb-3">
            <div class="row text-bold mb-4 h5 text-primary">Time Frame</div> 
            <div class="row">
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="nama">Estimate Cost:</label>
                      <input type="number" class="form-control pull-right" id="nama" name="estimate_cost[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="nama">Start:</label>
                      <input type="date" class="form-control pull-right" id="start-act" name="start[]" onchange="aksi_act()" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="nama">End:</label>
                      <input type="date" class="form-control pull-right" id="end-act" name="end[]" onchange="aksi_act()" required>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label for="nama">Duration:</label>
                      <input type="text" class="form-control pull-right" id="duration-act" name="duration[]" readonly>
                  </div>
              </div>
            </div>
          </div>
          <div class="border border-primary px-3 pb-3">
            <div class="row text-bold mb-4 h5 text-primary">Setting Target</div> 
            <div class="row">
            <div class="col-md-2">
                  <div class="form-group">
                      <label>Januari:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="jan[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label>Februari:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="feb[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label>Maret:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="mar[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>April:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="apr[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>Mei:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="mei[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>Juni:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="jun[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>Juli:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="jul[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>Agustus:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="aug[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>September:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="sep[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>Oktober:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="okt[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>November:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="nov[]" required>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label>Desember:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="des[]" required>
                  </div>
              </div>
            </div>
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
<script>
  // Mendapatkan elemen button dan elemen div yang akan ditampilkan
  const end = document.getElementById("btn-end");
  end.style = "background :#007bff";
  const elemen1 = document.getElementById("endresult");
  const inter = document.getElementById("btn-inter");
  const elemen2 = document.getElementById("inter");
  const act = document.getElementById("btn-act");
  const elemen3 = document.getElementById("act");

  const select_end = document.getElementById("select_end");
  const select_inter = document.getElementById("select_inter");
  const select_act = document.getElementById("select_act");

  // Menambahkan event listener ke masing-masing tombol
  end.addEventListener("click", function() {
    // Menampilkan elemen div
    elemen1.style.display = "block";
    end.style = "background :#007bff";
    inter.style = "background :#6c757d";
    act.style = "background :#6c757d";
    elemen2.style.display = "none";
    elemen3.style.display = "none";
    select_inter.style.display = "none";
    select_act.style.display = "none";
    select_end.style.display = "block";
    
  });

  inter.addEventListener("click", function() {
    // Menampilkan elemen div
    elemen2.style.display = "block";
    inter.style = "background :#007bff";
    end.style = "background :#6c757d";
    act.style = "background :#6c757d";
    elemen1.style.display = "none";
    elemen3.style.display = "none";
    select_act.style.display = "none";
    select_end.style.display = "none";
    select_inter.style.display = "block";
  });

  act.addEventListener("click", function() {
    // Menampilkan elemen div
    elemen3.style.display = "block";
    act.style = "background :#007bff";
    end.style = "background :#6c757d";
    inter.style = "background :#6c757d";
    elemen2.style.display = "none";
    elemen1.style.display = "none";
    select_inter.style.display = "none";
    select_end.style.display = "none";
    select_act.style.display = "block";
  });

  //select FGD end
  var select = document.getElementById("select_fgd");

  select.addEventListener("change", function() {
    var selectedOption = select.options[select.selectedIndex].value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('data-container').innerHTML = this.responseText;
      }
      else {
        console.error('There was an error in the request. Status code: ' + this.status);
      }
    };
    xhttp.open('GET', 'select_fgd_end.php?kode_fgd=' + selectedOption, true);
    xhttp.send();
  });

  //select fgd intermediate
  var select2 = document.getElementById("select_fgd2");

  select2.addEventListener("change", function() {
    var selectedOption = select2.options[select2.selectedIndex].value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('data-container2').innerHTML = this.responseText;
      }
    };
    xhttp.open('GET', 'select_fgd_inter.php?kode_fgd=' + selectedOption, true);
    xhttp.send();
  });

  //select fgd activity
  var select3 = document.getElementById("select_fgd3");

  select3.addEventListener("change", function() {
    var selectedOption = select3.options[select3.selectedIndex].value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('data-container3').innerHTML =this.responseText;
      }
    };
    xhttp.open('GET', 'select_fgd_act.php?kode_fgd=' + selectedOption, true);
    xhttp.send();
  });

</script>

<!-- passing select fgd to modal act -->
<script>
  // validasi fgd harus dipilih
  $('#actBtnModal').on('click', function() {
    var selectOption = document.getElementById("select_fgd3").value;
    if (selectOption == "all") {
      alert("Anda harus memilih FGD yang tersedia");
    }
    else{
      $('#modalact').modal('show');
    }
  });
  function validateFormAct() {
    //validasi end result kosong
    var endresult = document.getElementById("select_endresult_act").value;
    var inter = document.getElementById("select_inter_act").value;
    var pic = document.getElementById("pic").value;
    var uomact = document.getElementById("uom_act").value;
    if (endresult == 0) {
      alert('Silahkan pilih end result');
      return false;
    }
    if (inter == 0) {
      alert('Silahkan pilih intermediate');
      return false;
    }
    if (pic == 0) {
      alert('Silahkan pilih PIC');
      return false;
    }
    if (uomact == 0) {
      alert('Silahkan pilih uom');
      return false;
    }
  }

  $(document).ready(function() {
  $('#select_fgd3').change(function() {
    var selectedValue = $(this).val();
    $('#modalact').data('fgdact', selectedValue);
  });

  $('#modalact').on('show.bs.modal', function() {
    var selectedValue = $(this).data('fgdact');
    // Kirim AJAX request ke script getData.php dengan parameter ID
    $.ajax({
      url: 'getnameFgdAct.php?id=' +selectedValue,
      success: function(data) {
        // Tampilkan data yang diterima dari server  
          $('#fgdact').text(data);
          var select = $('#nama_fgdd');
          select.val(selectedValue);
          select.html('<option value="' + selectedValue + '">' + data + '</option>');   
      },
      error: function (request, error) {
        console.log(arguments);
        // alert(" Can't do because: " + error);
    },
    });
    // $('#fgdact').text(selectedValue);
  });
});

</script>

<!-- passing select fgd to modal inter -->
<script>
  // validasi fgd harus dipilih
  $('#interBtnModal').on('click', function() {
    var selectOption = document.getElementById("select_fgd2").value;
    if (selectOption == "all") {
      alert("Anda harus memilih FGD yang tersedia");
    }
    else{
      $('#modalinter').modal('show');
    }
  }); 

  // validasi form intermediate
  function validateFormInter() {
    //validasi end result kosong
    var endresult = document.getElementById("select_endresult_inter").value;
    var uominter = document.getElementById("uom_inter").value;
    if (endresult == 0) {
      alert('Silahkan pilih end result');
      return false;
    }
    if (uominter == 0) {
      alert('Silahkan pilih uom');
      return false;
    }
  }


  $(document).ready(function() {
    // mengambil value fgd
  $('#select_fgd2').change(function() {
    var selectedValue = $(this).val();
    $('#modalinter').data('fgdinter', selectedValue);
  });

  $('#modalinter').on('show.bs.modal', function() {
    var selectedValue = $(this).data('fgdinter');
    // Kirim AJAX request ke script getnameFgdAct.php dengan parameter ID
    $.ajax({
      url: 'getnameFgdAct.php?id=' +selectedValue,
      success: function(data) {
        // Tampilkan data yang diterima dari server  
          $('#fgdinter').text(data);
          var select = $('#nama_fgdinter');
          select.val(selectedValue);
          select.html('<option value="' + selectedValue + '">' + data + '</option>');   
      },
      error: function (request, error) {
        console.log(arguments);
        // alert(" Can't do because: " + error);
    },
    });
    // $('#fgdact').text(selectedValue);
  });
});
</script>

<!-- passing select fgd to modal end result -->
<script>
  // validasi fgd harus dipilih
  $('#endBtnModal').on('click', function() {
    var selectOption = document.getElementById("select_fgd").value;
    if (selectOption == "all") {
      alert("Anda harus memilih FGD yang tersedia");
    }
    else{
      $('#modalend').modal('show');
    }
});

  $(document).ready(function() {
  $('#select_fgd').change(function() {
    var selectedValue = $(this).val();
    $('#modalend').data('fgdend', selectedValue);
  });

  $('#modalend').on('show.bs.modal', function() {
    var selectedValue = $(this).data('fgdend');
    // Kirim AJAX request ke script getData.php dengan parameter ID
    $.ajax({
      url: 'getnameFgdAct.php?id=' +selectedValue,
      success: function(data) {
        // Tampilkan data yang diterima dari server  
          $('#fgdend').text(data);
          var select = $('#nama_fgdend');
          select.val(selectedValue);
          select.html('<option value="' + selectedValue + '">' + data + '</option>');   
      },
      error: function (request, error) {
        console.log(arguments);
        // alert(" Can't do because: " + error);
    },
    });
  });
});
</script>

<!-- onchange start end date -->
<script>
  // endresult
function aksi() {
  // Ambil nilai tanggal dari input
  var startDate = new Date(document.getElementById("start-endresult").value);
  var endDate = new Date(document.getElementById("end-endresult").value);

  // Hitung selisih tanggal dalam milidetik
  var selisih = endDate.getTime() - startDate.getTime();

  // Konversi selisih durasi
  var durasi = Math.ceil(selisih / (1000 * 60 * 60 * 24));
  if (durasi < 0) {
    document.getElementById("duration-endresult").value = 0;
    alert('Masukan tanggal yang sesuai');
    document.getElementById("end-endresult").value = "";
  }
  else if(isNaN(durasi)) {
    document.getElementById("duration-endresult").value = 0;
  }
  else {
    document.getElementById("duration-endresult").value = durasi;
  }
}

//intermediate
function aksi_inter() {
  // Ambil nilai tanggal dari input
  var startDate = new Date(document.getElementById("start-inter").value);
  var endDate = new Date(document.getElementById("end-inter").value);

  // Hitung selisih tanggal dalam milidetik
  var selisih = endDate.getTime() - startDate.getTime();

  // Konversi selisih tanggal dari milidetik menjadi hari
  var durasi = Math.ceil(selisih / (1000 * 60 * 60 * 24));
  if (durasi < 0) {
    document.getElementById("duration-inter").value = 0;
    alert('Masukan tanggal yang sesuai');
    document.getElementById("end-inter").value = "";
  }
  else if(isNaN(durasi)) {
    document.getElementById("duration-inter").value = 0;
  }
  else {
    document.getElementById("duration-inter").value = durasi;
  }
}

// activity
function aksi_act() {
  // Ambil nilai tanggal dari input
  var startDate = new Date(document.getElementById("start-act").value);
  var endDate = new Date(document.getElementById("end-act").value);

  // Hitung selisih tanggal dalam milidetik
  var selisih = endDate.getTime() - startDate.getTime();

  // Konversi selisih tanggal dari milidetik menjadi hari
  var durasi = Math.ceil(selisih / (1000 * 60 * 60 * 24));
  if (durasi < 0) {
    document.getElementById("duration-act").value = 0;
    alert('Masukan tanggal yang sesuai');
    document.getElementById("end-act").value = "";
  }
  else if(isNaN(durasi)) {
    document.getElementById("duration-act").value = 0;
  }
  else {
    document.getElementById("duration-act").value = durasi;
  }
}

function duration_end(no) {
  // Ambil nilai tanggal dari input
  var startDate = new Date(document.getElementById("start"+no).value);
  var endDate = new Date(document.getElementById("end"+no).value);

  // Hitung selisih tanggal dalam milidetik
  var selisih = endDate.getTime() - startDate.getTime();

  // Konversi selisih tanggal dari milidetik menjadi hari
  var durasi = Math.ceil(selisih / (1000 * 60 * 60 * 24));
  if (durasi < 0) {
    document.getElementById("duration"+no).value = 0;
    alert('Masukan tanggal yang sesuai');
    document.getElementById("end"+no).value = "";
  }
  else if(isNaN(durasi)) {
    document.getElementById("duration"+no).value = 0;
  }
  else {
    document.getElementById("duration"+no).value = durasi;
  }
}

function duration_inter(no) {
  // Ambil nilai tanggal dari input
  var startDate = new Date(document.getElementById("start"+no).value);
  var endDate = new Date(document.getElementById("end"+no).value);

  // Hitung selisih tanggal dalam milidetik
  var selisih = endDate.getTime() - startDate.getTime();

  // Konversi selisih tanggal dari milidetik menjadi hari
  var durasi = Math.ceil(selisih / (1000 * 60 * 60 * 24));
  if (durasi < 0) {
    document.getElementById("duration"+no).value = 0;
    alert('Masukan tanggal yang sesuai');
    document.getElementById("end"+no).value = "";
  }
  else if(isNaN(durasi)) {
    document.getElementById("duration"+no).value = 0;
  }
  else {
    document.getElementById("duration"+no).value = durasi;
  }
}

function duration_act(no) {
  // Ambil nilai tanggal dari input
  var startDate = new Date(document.getElementById("start"+no).value);
  var endDate = new Date(document.getElementById("end"+no).value);

  // Hitung selisih tanggal dalam milidetik
  var selisih = endDate.getTime() - startDate.getTime();

  // Konversi selisih tanggal dari milidetik menjadi hari
  var durasi = Math.ceil(selisih / (1000 * 60 * 60 * 24));
  if (durasi < 0) {
    document.getElementById("duration"+no).value = 0;
    alert('Masukan tanggal yang sesuai');
    document.getElementById("end"+no).value = "";
  }
  else if(isNaN(durasi)) {
    document.getElementById("duration"+no).value = 0;
  }
  else {
    document.getElementById("duration"+no).value = durasi;
  }
}

  
//   $(document).on("shown.bs.modal", function () {
//   // Ambil nilai tanggal dari input
//   var startDate = new Date(document.getElementsByName("start")[0].value);
//   var endDate = new Date(document.getElementsByName("end")[0].value);

//   // Hitung selisih tanggal dalam milidetik
//   var selisih = endDate.getTime() - startDate.getTime();

//   // Konversi selisih tanggal dari milidetik menjadi hari
//   var durasi = Math.ceil(selisih / (1000 * 60 * 60 * 24));
//   if (durasi < 0) {
//     document.getElementsByName("duration")[0].value = 0;
//     alert('Masukkan tanggal yang sesuai');
//     document.getElementsByName("end")[0].value = "";
//   }
//   else if (isNaN(durasi)) {
//     document.getElementsByName("duration")[0].value = 0;
//   }
//   else {
//     document.getElementsByName("duration")[0].value = durasi;
//   }
// });


// function aksi_edit_endresult() {
//   // Ambil nilai tanggal dari input
//   var startDate= new Date(document.getElementById("start-endresult2").value);
//   var endDate2 = new Date(document.getElementById("end-endresult2").value);

//   // Hitung selisih tanggal dalam milidetik
//   var selisih2 = endDate2.getTime() - startDate2.getTime();

//   // Konversi selisih tanggal dari milidetik menjadi hari
//   var durasi2 = Math.ceil(selisih / (1000 * 60 * 60 * 24));
//   if (durasi2 < 0) {
//     document.getElementById("duration-endresult2").value = 0;
//     alert('Masukan tanggal yang sesuai');
//     document.getElementById("end-endresult2").value = "";
//   }
//   else if(isNaN(durasi2)) {
//     document.getElementById("duration-endresult2").value = 0;
//   }
//   else {
//     document.getElementById("duration-endresult2").value = durasi2;
//   }
// }
</script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- select 2 -->
<script>
$(document).ready(function() {
  // select2 pada end result
  $('#select_fgd').select2({
    placeholder: 'Pilih fgd..',
    closeOnSelect: false
  });

  //onchange saat pilih fgd endresult
  $('#select_fgd').on('change', function(e) {
    var selectedOption = select.options[select.selectedIndex].value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('data-container').innerHTML = this.responseText;
      // event listener save change diketik
    }
    };
    xhttp.open('GET', 'select_fgd_end.php?kode_fgd=' + selectedOption, true);
    xhttp.send();
  });

  // select2 pada intermediate
  $('#select_fgd2').select2({
    placeholder: 'Pilih fgd..',
    closeOnSelect: false
  });

  //onchange saat pilih fgd intermediate
  $('#select_fgd2').on('change', function(e) {
    var selectedOption = select2.options[select2.selectedIndex].value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('data-container2').innerHTML = this.responseText;
      }
    };
    xhttp.open('GET', 'select_fgd_inter.php?kode_fgd=' + selectedOption, true);
    xhttp.send();
    });
  
  $('#select_fgd3').select2({
    placeholder: 'Pilih fgd..',
    closeOnSelect: false
  });

  //onchange saat pilih fgd act
  $('#select_fgd3').on('change', function(e) {
    var selectedOption = select3.options[select3.selectedIndex].value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('data-container3').innerHTML = this.responseText;
      }
    };
    xhttp.open('GET', 'select_fgd_act.php?kode_fgd=' + selectedOption, true);
    xhttp.send();
  });
});
</script>

<script>
  // edit data end result dengan modal setelah pilih fgd
  function myFunction(no) {
    
    var xmlhttp = new XMLHttpRequest();
    var url = "proses_edit_endresult.php";
    var kode_endresult = document.getElementById("kode_endresult"+no).value;
    var kode_fgd = document.getElementById("kode_fgd"+no).value;
    var end_result = document.getElementById("end_result"+no).value;
    var uom = document.getElementById("uom"+no).value;
    var estimate_cost = document.getElementById("estimate_cost"+no).value;
    var start = document.getElementById("start"+no).value;
    var end = document.getElementById("end"+no).value;
    var duration = document.getElementById("duration"+no).value;
    var asis = document.getElementById("asis"+no).value;
    var tube = document.getElementById("tube"+no).value;
    var jan = document.getElementById("jan"+no).value;
    var feb = document.getElementById("feb"+no).value;
    var mar = document.getElementById("mar"+no).value;
    var apr = document.getElementById("apr"+no).value;
    var mei = document.getElementById("mei"+no).value;
    var jun = document.getElementById("jun"+no).value;
    var jul = document.getElementById("jul"+no).value;
    var aug = document.getElementById("aug"+no).value;
    var sep = document.getElementById("sep"+no).value;
    var okt = document.getElementById("okt"+no).value;
    var nov = document.getElementById("nov"+no).value;
    var des = document.getElementById("des"+no).value;
    var data = "kode_endresult=" + kode_endresult + "&kode_fgd=" + kode_fgd + "&end_result=" + end_result + "&uom=" + uom +
               "&estimate_cost=" + estimate_cost + "&start=" + start + "&end=" + end + 
               "&duration=" + duration + "&asis=" + asis + "&tube=" + tube + "&jan=" + jan + 
               "&feb=" + feb + "&mar=" + mar + "&apr=" + apr + "&mei=" + mei + "&jun=" + jun + 
               "&jul=" + jul + "&aug=" + aug + "&sep=" + sep + "&okt=" + okt + "&nov=" + nov + "&des=" + des;

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Response dari server berhasil diterima
        // console.log(this.responseText);
        // alert(this.responseText);
        // window.open("addProject.php");
        $('body').append(this.responseText);
      }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);

  }
  // edit data intermediate dengan modal setelah pilih fgd
  function myFunction2(no) {
    
    var xmlhttp = new XMLHttpRequest();
    var url = "proses_edit_intermediate.php";
    var kode_endresult = document.getElementById("kode_endresult"+no).value;
    var kode_intermediate = document.getElementById("kode_intermediate"+no).value;
    var intermediate = document.getElementById("intermediate"+no).value;
    var uom = document.getElementById("uom"+no).value;
    var kode_fgd = document.getElementById("kode_fgd"+no).value;
    var estimate_cost = document.getElementById("estimate_cost"+no).value;
    var start = document.getElementById("start"+no).value;
    var end = document.getElementById("end"+no).value;
    var duration = document.getElementById("duration"+no).value;
    var asis = document.getElementById("asis"+no).value;
    var tube = document.getElementById("tube"+no).value;
    var jan = document.getElementById("jan"+no).value;
    var feb = document.getElementById("feb"+no).value;
    var mar = document.getElementById("mar"+no).value;
    var apr = document.getElementById("apr"+no).value;
    var mei = document.getElementById("mei"+no).value;
    var jun = document.getElementById("jun"+no).value;
    var jul = document.getElementById("jul"+no).value;
    var aug = document.getElementById("aug"+no).value;
    var sep = document.getElementById("sep"+no).value;
    var okt = document.getElementById("okt"+no).value;
    var nov = document.getElementById("nov"+no).value;
    var des = document.getElementById("des"+no).value;
    var data = "kode_endresult=" + kode_endresult+ "&kode_intermediate=" + kode_intermediate + "&kode_fgd=" + kode_fgd + "&intermediate=" + intermediate + "&uom=" + uom +
               "&estimate_cost=" + estimate_cost + "&start=" + start + "&end=" + end + 
               "&duration=" + duration + "&asis=" + asis + "&tube=" + tube + "&jan=" + jan + 
               "&feb=" + feb + "&mar=" + mar + "&apr=" + apr + "&mei=" + mei + "&jun=" + jun + 
               "&jul=" + jul + "&aug=" + aug + "&sep=" + sep + "&okt=" + okt + "&nov=" + nov + "&des=" + des;

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        $('body').append(this.responseText);
      }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);

  }
    function myFunction3(no) {
      var xmlhttp = new XMLHttpRequest();
      var url = "proses_edit_activity.php";
      var kode_activity = document.getElementById("kode_activity"+no).value;
      var kode_intermediate = document.getElementById("kode_intermediate"+no).value;
      var activity = document.getElementById("activity"+no).value;
      var pic = document.getElementById("pic"+no).value;
      var support = $("#option_supported_edit"+no).val();
      var lokasi = document.getElementById("lokasi"+no).value;
      var uom = document.getElementById("uom"+no).value;
      var target = document.getElementById("target"+no).value;
      var kode_fgd = document.getElementById("kode_fgd"+no).value;
      var estimate_cost = document.getElementById("estimate_cost"+no).value;
      var start = document.getElementById("start"+no).value;
      var end = document.getElementById("end"+no).value;
      var duration = document.getElementById("duration"+no).value;
      var jan = document.getElementById("jan"+no).value;
      var feb = document.getElementById("feb"+no).value;
      var mar = document.getElementById("mar"+no).value;
      var apr = document.getElementById("apr"+no).value;
      var mei = document.getElementById("mei"+no).value;
      var jun = document.getElementById("jun"+no).value;
      var jul = document.getElementById("jul"+no).value;
      var aug = document.getElementById("aug"+no).value;
      var sep = document.getElementById("sep"+no).value;
      var okt = document.getElementById("okt"+no).value;
      var nov = document.getElementById("nov"+no).value;
      var des = document.getElementById("des"+no).value;
      var data = "kode_activity=" + kode_activity+ "&kode_intermediate=" + kode_intermediate + "&kode_fgd=" + kode_fgd + "&activity=" + activity + "&uom=" + uom +
                "&pic=" + pic +  "&support=" + support + "&lokasi=" + lokasi + "&target=" + target +
                "&estimate_cost=" + estimate_cost + "&start=" + start + "&end=" + end + 
                "&duration=" + duration + "&jan=" + jan + 
                "&feb=" + feb + "&mar=" + mar + "&apr=" + apr + "&mei=" + mei + "&jun=" + jun + 
                "&jul=" + jul + "&aug=" + aug + "&sep=" + sep + "&okt=" + okt + "&nov=" + nov + "&des=" + des;
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          $('body').append(this.responseText);
        }
      };
      xmlhttp.open("POST", url, true);
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttp.send(data);

    }
</script> 

<!-- search data end result-->
<script>
    $(document).ready(function() {
      $('#searchInput_end').on('input', function() {
        search_end();
      });
    });

  // <!-- Fungsi untuk melakukan pencarian dan mengganti isi data-body dengan hasil pencarian -->
    
    function search_end() {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // Untuk browser modern
            xmlhttp = new XMLHttpRequest();
        } else {
            // Untuk browser lama
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var dataBody = document.getElementById("data-body-end");
                // Menghapus semua baris data sebelumnya
                while (dataBody.firstChild) {
                    dataBody.removeChild(dataBody.firstChild);
                }
                // Mendapatkan hasil pencarian dari responseText
                var result = JSON.parse(this.responseText);
                if (result.length > 0) {
                    var no = 1;
                    // Menambahkan baris data hasil pencarian ke data-body
                    result.forEach(function(data) {
                        var row = document.createElement("tr");
                        var noCell = document.createElement("td");
                        noCell.textContent = no;
                        var endResultCell = document.createElement("td");
                        endResultCell.textContent = data.end_result;
                        var uomCell = document.createElement("td");
                        uomCell.textContent = data.uom;
                        var estimateCostCell = document.createElement("td");
                        estimateCostCell.textContent ="Rp."+data.estimate_cost;
                        var startCell = document.createElement("td");
                        startCell.textContent = data.start;
                        var endCell = document.createElement("td");
                        endCell.textContent = data.end;
                        var durationCell = document.createElement("td");
                        durationCell.textContent = data.duration;
                        var asIsCell = document.createElement("td");
                        asIsCell.textContent = data.asis;
                        var tubeCell = document.createElement("td");
                        tubeCell.textContent = data.tube;
                        var hapusCell = document.createElement("td");
                        var hapusLink = document.createElement("a");
                        hapusLink.href = 'delete_end_result.php?kode_endresult='+data.kode_endresult;
                        hapusLink.onclick = function() {
                          return confirm('Anda yakin ingin hapus data?');
                        };

                        var trashIcon = document.createElement("span");
                        trashIcon.className = "fa fa-trash text-danger";

                        hapusLink.appendChild(trashIcon);
                        hapusCell.appendChild(hapusLink);
                        
                        var editCell = document.createElement("td");
                        var editLink = document.createElement("a");
                        editLink.href = '#';
                        editLink.onclick = function() {
                          var modal = document.getElementById("editModal"+data.kode_endresult);
                          // Tampilkan modal
                          var modalInstance = new bootstrap.Modal(modal);
                          modalInstance.show();

                          // Tambahkan event listener untuk menutup modal saat diklik pada tombol close
                          var closeButton = modal.querySelector(".close");
                          closeButton.addEventListener("click", function() {
                            modalInstance.hide();
                          });
                        };

                        var editIcon = document.createElement("span");
                        editIcon.className = "fa fa-edit text-primary";

                        editLink.appendChild(editIcon);
                        editCell.appendChild(editLink);

                        row.appendChild(noCell);
                        row.appendChild(endResultCell);
                        row.appendChild(noCell);
                        row.appendChild(endResultCell);
                        row.appendChild(uomCell);
                        row.appendChild(estimateCostCell);
                        row.appendChild(startCell);
                        row.appendChild(endCell);
                        row.appendChild(durationCell);
                        row.appendChild(asIsCell);
                        row.appendChild(tubeCell);
                        row.appendChild(editCell);
                        row.appendChild(hapusCell);
                        
                        // Tambahkan sel-sel kolom lainnya ke dalam baris
                        

                        dataBody.appendChild(row);
                        no++;
                    });
                } else {
                    var row = document.createElement("tr");
                    var emptyCell = document.createElement("td");
                    emptyCell.setAttribute("colspan", "10");
                    emptyCell.textContent = "Data tidak ditemukan";
                    row.appendChild(emptyCell);
                    dataBody.appendChild(row);
                }
            }
        };
        var query = document.getElementById("searchInput_end").value; // Mendapatkan nilai dari input pencarian
        xmlhttp.open("GET", "search_endresult.php?q=" + query, true); // Mengirim permintaan pencarian dengan query sebagai parameter GET
        xmlhttp.send();
    }
</script>

<!-- search data intermediate-->
<script>
    $(document).ready(function() {
      $('#searchInput_inter').on('input', function() {
        search_inter();
      });
    });

  // <!-- Fungsi untuk melakukan pencarian dan mengganti isi data-body dengan hasil pencarian -->
    function search_inter() {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // Untuk browser modern
            xmlhttp = new XMLHttpRequest();
        } else {
            // Untuk browser lama
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var dataBody = document.getElementById("data-body-inter");
                // Menghapus semua baris data sebelumnya
                while (dataBody.firstChild) {
                    dataBody.removeChild(dataBody.firstChild);
                }
                // Mendapatkan hasil pencarian dari responseText
                var result = JSON.parse(this.responseText);
                if (result.length > 0) {
                    var no = 1;
                    // Menambahkan baris data hasil pencarian ke data-body
                    result.forEach(function(data) {
                        var row = document.createElement("tr");
                        var noCell = document.createElement("td");
                        noCell.textContent = no;
                        var intermediateCell = document.createElement("td");
                        intermediateCell.textContent = data.intermediate;
                        var uomCell = document.createElement("td");
                        uomCell.textContent = data.uom;
                        var estimateCostCell = document.createElement("td");
                        estimateCostCell.textContent = "Rp."+data.estimate_cost;
                        var startCell = document.createElement("td");
                        startCell.textContent = data.start;
                        var endCell = document.createElement("td");
                        endCell.textContent = data.end;
                        var durationCell = document.createElement("td");
                        durationCell.textContent = data.duration;
                        var asIsCell = document.createElement("td");
                        asIsCell.textContent = data.asis;
                        var tubeCell = document.createElement("td");
                        tubeCell.textContent = data.tube;
                        var hapusCell = document.createElement("td");
                        var hapusLink = document.createElement("a");
                        hapusLink.href = 'delete_intermediate.php?kode_intermediate='+data.kode_intermediate;
                        hapusLink.onclick = function() {
                          return confirm('Anda yakin ingin hapus data?');
                        };

                        var trashIcon = document.createElement("span");
                        trashIcon.className = "fa fa-trash text-danger";

                        hapusLink.appendChild(trashIcon);
                        hapusCell.appendChild(hapusLink);
                        
                        var editCell = document.createElement("td");
                        var editLink = document.createElement("a");
                        editLink.href = '#';
                        editLink.onclick = function() {
                          var modal = document.getElementById("editModal1"+data.kode_intermediate);

                          // Tampilkan modal
                          var modalInstance = new bootstrap.Modal(modal);
                          modalInstance.show();

                          // Tambahkan event listener untuk menutup modal saat diklik pada tombol close
                          var closeButton = modal.querySelector(".close");
                          closeButton.addEventListener("click", function() {
                            modalInstance.hide();
                          });
                        };

                        var editIcon = document.createElement("span");
                        editIcon.className = "fa fa-edit text-primary";

                        editLink.appendChild(editIcon);
                        editCell.appendChild(editLink);

                        row.appendChild(noCell);
                        row.appendChild(intermediateCell);
                        row.appendChild(noCell);
                        row.appendChild(intermediateCell);
                        row.appendChild(uomCell);
                        row.appendChild(estimateCostCell);
                        row.appendChild(startCell);
                        row.appendChild(endCell);
                        row.appendChild(durationCell);
                        row.appendChild(asIsCell);
                        row.appendChild(tubeCell);
                        row.appendChild(editCell);
                        row.appendChild(hapusCell);
                        // Tambahkan sel-sel kolom lainnya ke dalam baris
                        

                        dataBody.appendChild(row);
                        no++;
                    });
                } else {
                    var row = document.createElement("tr");
                    var emptyCell = document.createElement("td");
                    emptyCell.setAttribute("colspan", "10");
                    emptyCell.textContent = "Data tidak ditemukan";
                    row.appendChild(emptyCell);
                    dataBody.appendChild(row);
                }
            }
        };
        var query = document.getElementById("searchInput_inter").value; // Mendapatkan nilai dari input pencarian
        xmlhttp.open("GET", "search_intermediate.php?q=" + query, true); // Mengirim permintaan pencarian dengan query sebagai parameter GET
        xmlhttp.send();
    }
</script>

<!-- search data activity -->
<script>
    $(document).ready(function() {
      $('#searchInput_act').on('input', function() {
        search_act();
      });
    });
    
    function search_act() {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // Untuk browser modern
            xmlhttp = new XMLHttpRequest();
        } else {
            // Untuk browser lama
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var dataBody = document.getElementById("data-body-act");
                // Menghapus semua baris data sebelumnya
                while (dataBody.firstChild) {
                    dataBody.removeChild(dataBody.firstChild);
                }
                // Mendapatkan hasil pencarian dari responseText
                var result = JSON.parse(this.responseText);
                if (result.length > 0) {
                    var no = 1;
                    // Menambahkan baris data hasil pencarian ke data-body
                    result.forEach(function(data) {
                        var row = document.createElement("tr");
                        var noCell = document.createElement("td");
                        noCell.textContent = no;
                        var activityCell = document.createElement("td");
                        activityCell.textContent = data.activity;
                        var picCell = document.createElement("td");
                        picCell.textContent = data.pic;
                        var supportCell = document.createElement("td");
                        supportCell.textContent = data.support;
                        var lokasiCell = document.createElement("td");
                        lokasiCell.textContent = data.lokasi;
                        var uomCell = document.createElement("td");
                        uomCell.textContent = data.uom;
                        var targetCell = document.createElement("td");
                        targetCell.textContent = data.target;
                        var estimasi_costCell = document.createElement("td");
                        estimasi_costCell.textContent = "Rp."+data.estimasi_cost;
                        var startCell = document.createElement("td");
                        startCell.textContent = data.start;
                        var endCell = document.createElement("td");
                        endCell.textContent = data.end;
                        var durationCell = document.createElement("td");
                        durationCell.textContent = data.duration;
                        var hapusCell = document.createElement("td");
                        var hapusLink = document.createElement("a");
                        hapusLink.href = 'delete_activity.php?kode_activity='+data.kode_activity;
                        hapusLink.onclick = function() {
                          return confirm('Anda yakin ingin hapus data?');
                        };

                        var trashIcon = document.createElement("span");
                        trashIcon.className = "fa fa-trash text-danger";

                        hapusLink.appendChild(trashIcon);
                        hapusCell.appendChild(hapusLink);

                        var editCell = document.createElement("td");
                        var editLink = document.createElement("a");
                        editLink.href = '#';
                        editLink.onclick = function() {
                          var modal = document.getElementById("editModal2"+data.kode_activity);

                          // Tampilkan modal
                          var modalInstance = new bootstrap.Modal(modal);
                          modalInstance.show();

                          // Tambahkan event listener untuk menutup modal saat diklik pada tombol close
                          var closeButton = modal.querySelector(".close");
                          closeButton.addEventListener("click", function() {
                            modalInstance.hide();
                          });
                        };

                        var editIcon = document.createElement("span");
                        editIcon.className = "fa fa-edit text-primary";

                        editLink.appendChild(editIcon);
                        editCell.appendChild(editLink);

                        row.appendChild(noCell);
                        row.appendChild(activityCell);
                        row.appendChild(noCell);
                        row.appendChild(activityCell);
                        row.appendChild(picCell);
                        row.appendChild(supportCell);
                        row.appendChild(lokasiCell);
                        row.appendChild(uomCell);
                        row.appendChild(targetCell);
                        row.appendChild(estimasi_costCell);
                        row.appendChild(startCell);
                        row.appendChild(endCell);
                        row.appendChild(durationCell);
                        row.appendChild(editCell);
                        row.appendChild(hapusCell);
                        
                        // Tambahkan sel-sel kolom lainnya ke dalam baris
                        
                        dataBody.appendChild(row);
                        no++;
                    });
                } else {
                    var row = document.createElement("tr");
                    var emptyCell = document.createElement("td");
                    emptyCell.setAttribute("colspan", "10");
                    emptyCell.textContent = "Data tidak ditemukan";
                    row.appendChild(emptyCell);
                    dataBody.appendChild(row);
                }
            }
        };
        var query = document.getElementById("searchInput_act").value; // Mendapatkan nilai dari input pencarian
        xmlhttp.open("GET", "search_activity.php?q=" + query, true); // Mengirim permintaan pencarian dengan query sebagai parameter GET
        xmlhttp.send();
    }
</script>
</body>
</html>

<!-- myFunction3 tidak terbaca -->