<?php
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
        <!-- <hr style="height:2px;border-width:0;color:gray;background-color:gray"> -->
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
            <button type="button" id="btn-end" class="btn btn-block btn-secondary">
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
        <div id="endresult">
          <div class="row justify-content-end mt-4 mb-4">
            <div class="col-2">
              <button id="endBtnModal" type="button" class="btn btn-block btn-secondary">
                + Add Project
              </button>
            </div>
          </div>
          <!-- table -->
          <div id="data-container" class="row mt-4">
            <table class="table">
              <thead>
                  <tr>
                  <th scope="col">No</th>
                  <th scope="col">End Result</th>
                  <th scope="col">UoM</th>
                  <th scope="col">Estimate Cost</th>
                  <th scope="col">Start</th>
                  <th scope="col">End</th>
                  <th scope="col">Duration</th>
                  <th scope="col">As-Is</th>
                  <th scope="col">Tube</th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                include('proses/koneksi.php');
                $sql = "SELECT * FROM db_target_end_result";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows > 0) {
                $no =1;
                while($data = mysqli_fetch_array($query)) { ?>
                <tr class="cursor"  data-toggle="modal" data-target="#editModal<?= $no;?>">
                  <td><?= $no;?></td>
                  <td><?= $data['end_result'];?></td>
                  <td>
                    <?php
                      $sql1 = "SELECT nama FROM uom WHERE id=".$data['uom'];
                      $query1 = mysqli_query($db, $sql1);
                      while ($uom = mysqli_fetch_assoc($query1)) {
                        echo $uom['nama'];
                      }
                    ?>
                  </td>
                  <td><?= "Rp.".$data['estimate_cost'];?></td>
                  <td><?= date('d-m-Y', strtotime($data['start']));?></td>
                  <td><?= date('d-m-Y', strtotime($data['end']));?></td>
                  <td><?= $data['duration'];?></td>
                  <td><?= $data['asis'];?></td>
                  <td><?= $data['tube'];?></td>
                  <!-- Modal edit end result -->
                  <div class="modal" id="editModal<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="fgdend">Edit End Result</h4><br>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="proses_edit_endresult.php">
                            <input type="hidden" name="kode_endresult" value="<?= $data['kode_endresult'];?>"> <!-- Hidden input field to send the kode_endresult value -->
                            <div class="border border-primary px-3 pb-3">
                              <div class="row mb-4 mt-4 text-bold h5 text-primary">End Result</div>  
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>End Result:</label>
                                        <input type="text" class="form-control pull-right" id="end_result" name="end_result" value="<?= $data['end_result'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>UoM:</label>
                                        <select class="form-control" name="uom" id="" required>
                                          <!-- get data dari database ke select otomatis -->
                                          <?php
                                            include "proses/koneksi.php";
                                            $sql1 = "SELECT * FROM uom";
                                            $query1 = mysqli_query($db, $sql1);
                                            foreach($query1 as $row) {
                                              echo '<option value="'.$row['id'].'"';
                                              if ($row['id'] == $data['uom']) {
                                                echo 'selected';
                                              }
                                              echo '>'.$row['nama'].'</option>';
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nama FGD:</label>
                                        <!-- get data dari fgd -->
                                        <select class="form-control" name="kode_fgd" id="" required>
                                          <?php
                                            include "proses/koneksi.php";
                                            $sql2 = "SELECT * FROM db_fgd";
                                            $query2 = mysqli_query($db, $sql2);
                                            foreach($query2 as $row2) {
                                              echo '<option value="'.$row2['kode_fgd'].'"';
                                              if ($row2['kode_fgd'] == $data['kode_fgd']) {
                                                echo 'selected';
                                              }
                                              echo '>'.$row2['nama_fgd'].'</option>';
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="border border-primary px-3 mt-2 pb-3">
                              <div class="row text-bold mb-4 mt-4 h5 text-primary">Time Frame</div>
                              <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Estimate Cost:</label>
                                        <input type="number" class="form-control pull-right" id="nama" name="estimate_cost" value="<?= $data['estimate_cost'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Start:</label>
                                        <input type="date" class="form-control pull-right" id="start-endresult" value="<?= $data['start'];?>" name="start" onchange="aksi()" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>End:</label>
                                        <input type="date" class="form-control pull-right" id="end-endresult" value="<?= $data['end'];?>" name="end" onchange="aksi()" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Duration:</label>
                                        <input type="text" class="form-control pull-right" id="duration-endresult" value="<?= $data['duration'];?>" name="duration" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>As-Is:</label>
                                        <input type="text" class="form-control pull-right" id="nama" value="<?= $data['asis'];?>" name="asis" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Tube:</label>
                                        <input type="text" class="form-control pull-right" value="<?= $data['tube'];?>" id="nama" name="tube" required>
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
                                          <input type="text" class="form-control pull-right" id="nama" name="jan" value="<?= $data['target_jan'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label>Februari :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="feb" value="<?= $data['target_feb'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label>Maret :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="mar" value="<?= $data['target_mar'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>April :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="apr" value="<?= $data['target_apr'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Mei :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="mei" value="<?= $data['target_mei'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Juni :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="jun" value="<?= $data['target_jun'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Juli :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="jul" value="<?= $data['target_jul'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Agustus :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="aug" value="<?= $data['target_aug'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>September :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="sep" value="<?= $data['target_sep'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Oktober :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="okt" value="<?= $data['target_okt'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>November :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="nov" value="<?= $data['target_nov'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Desember :</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="des" value="<?= $data['target_des'];?>" required>
                                      </div>
                                  </div>
                                </div>
                            </div>
                              <!-- multi input -->
                              <!-- <div class="col-md-1 float-right">
                                  <div class="form-group">
                                      <label></label>
                                      <button type="button" class="mt-4 btn btn-primary" onclick="addEndresult()">+</button>
                                  </div>
                              </div>
                              <div id="form_endresult"></div> -->
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary float-right">Update</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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

        <!-- tabel intermediate -->
        <div id="inter" style="display: none;" >
          <div class="row justify-content-end">
            <div class="col-2">
              <button id="interBtnModal" type="button" class="btn btn-block btn-secondary">
                + Add Project
              </button>
            </div>
          </div>

          <!-- table -->
          <div class="row mt-4" id="data-container2">
          <table class="table">
              <thead>
                  <tr>
                  <th scope="col">No</th>
                  <th scope="col">Intermediate</th>
                  <th scope="col">UoM</th>
                  <th scope="col">Estimate Cost</th>
                  <th scope="col">Start</th>
                  <th scope="col">End</th>
                  <th scope="col">Duration</th>
                  <th scope="col">As-Is</th>
                  <th scope="col">Tube</th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                include('proses/koneksi.php');
                $sql = "SELECT * FROM db_target_intermediate";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows > 0) {
                $no =1;
                while($data = mysqli_fetch_array($query)) { ?>
                <tr class="cursor"  data-toggle="modal" data-target="#editModal1<?= $no;?>">
                  <td><?= $no;?></td>
                  <td><?= $data['intermediate'];?></td>
                  <td>
                    <?php
                      $sql1 = "SELECT nama FROM uom WHERE id=".$data['uom'];
                      $query1 = mysqli_query($db, $sql1);
                      while ($uom = mysqli_fetch_assoc($query1)) {
                        echo $uom['nama'];
                      }
                    ?>
                  </td>
                  <td><?= "Rp.".$data['estimate_cost'];?></td>
                  <td><?= date('d-m-Y', strtotime($data['start']));?></td>
                  <td><?= date('d-m-Y', strtotime($data['end']));?></td>
                  <td><?= $data['duration'];?></td>
                  <td><?= $data['asis'];?></td>
                  <td><?= $data['tube'];?></td>
                  <!-- Modal edit Intermediate -->
                  <div class="modal fade" id="editModal1<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="fgdinter">Edit Intermediate</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="proses_edit_intermediate.php">
                            <div class="row mb-3">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>End Result :</label>
                                      <select class="form-control" name="kode_endresult" id="" required>
                                        <?php
                                          include "proses/koneksi.php";
                                          $sql2 = "SELECT * FROM db_target_end_result";
                                          $query2 = mysqli_query($db, $sql2);
                                          foreach($query2 as $row2) {
                                            echo '<option value="'.$row2['kode_endresult'].'"';
                                            if ($row2['kode_endresult'] == $data['kode_endresult']) {
                                              echo 'selected';
                                            }
                                            echo '>'.$row2['end_result'].'</option>';
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
                                        <input type="hidden" name="kode_intermediate" value="<?= $data['kode_intermediate'];?>"> <!-- Hidden input field to send the kode_intermediate value -->
                                        <input type="text" class="form-control pull-right" name="intermediate" value="<?= $data['intermediate'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>UoM:</label>
                                        <select class="form-control" name="uom" value="<?= $data[''];?>" id="" required>
                                          <?php
                                            include "proses/koneksi.php";
                                            $sql1 = "SELECT * FROM uom";
                                            $query1 = mysqli_query($db, $sql1);
                                            foreach($query1 as $row) {
                                              echo '<option value="'.$row['id'].'"';
                                              if ($row['id'] == $data['uom']) {
                                                echo 'selected';
                                              }
                                              echo '>'.$row['nama'].'</option>';
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nama FGD:</label>
                                        <!-- get data dari fgd -->
                                        <select class="form-control " name="kode_fgd" id="nama_fgdinter" required>
                                          <?php
                                            include "proses/koneksi.php";
                                            $sql2 = "SELECT * FROM db_fgd";
                                            $query2 = mysqli_query($db, $sql2);
                                            foreach($query2 as $row2) {
                                              echo '<option value="'.$row2['kode_fgd'].'"';
                                              if ($row2['kode_fgd'] == $data['kode_fgd']) {
                                                echo 'selected';
                                              }
                                              echo '>'.$row2['nama_fgd'].'</option>';
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="border border-primary mb-2 px-3 pb-3">
                              <div class="row text-bold mb-4 h5 text-primary">Time Frame</div>  
                              <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Estimate Cost:</label>
                                        <input type="number" class="form-control pull-right" name="estimate_cost" value="<?= $data['estimate_cost'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Start:</label>
                                        <input type="date" id="start-inter" class="form-control pull-right" name="start" value="<?= $data['start'];?>" onchange="aksi_inter()" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>End:</label>
                                        <input type="date" id="end-inter" class="form-control pull-right" name="end" value="<?= $data['end'];?>" onchange="aksi_inter()" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Duration:</label>
                                        <input type="text" id="duration-inter" class="form-control pull-right" name="duration" value="<?= $data['duration'];?>" >
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>As-Is:</label>
                                        <input type="text" class="form-control pull-right" name="asis" value="<?= $data['asis'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Tube:</label>
                                        <input type="text" class="form-control pull-right" name="tube" value="<?= $data['tube'];?>" required>
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
                                          <input type="text" class="form-control pull-right" id="nama" name="jan" value="<?= $data['target_jan'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label>Februari:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="feb" value="<?= $data['target_feb'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label>Maret:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="mar" value="<?= $data['target_mar'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>April:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="apr" value="<?= $data['target_apr'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Mei:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="mei" value="<?= $data['target_mei'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2"> 
                                      <div class="form-group">
                                          <label>Juni:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="jun" value="<?= $data['target_jun'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Juli:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="jul" value="<?= $data['target_jul'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Agustus:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="aug" value="<?= $data['target_aug'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>September:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="sep" value="<?= $data['target_sep'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Oktober:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="okt" value="<?= $data['target_okt'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>November:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="nov" value="<?= $data['target_nov'];?>" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-2">
                                      <div class="form-group">
                                          <label>Desember:</label>
                                          <input type="text" class="form-control pull-right" id="nama" name="des" value="<?= $data['target_des'];?>" required>
                                      </div>
                                  </div>
                              </div>
                              <!-- multi input -->
                                <!-- <div class="col-md-1 float-right">
                                    <div class="form-group">
                                        <label></label>
                                        <button type="button" class="mt-4 btn btn-primary" onclick="addIntermediate()">+</button>
                                    </div>
                                </div>
                                <div id="form_intermediate"></div> -->
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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

        <!-- tabel activity -->
        <div id="act" style="display: none;" >
          <div class="row justify-content-end">
            <div class="col-2">
              <button id="actBtnModal" type="button" class="btn btn-block btn-secondary">
                + Add Project
              </button>
            </div>
          </div>

          <!-- table -->
          <div class="row mt-4" id="data-container3">
          <table class="table">
              <thead>
                  <tr>
                  <th scope="col">No</th>
                  <th scope="col">Activity</th>
                  <th scope="col">PIC</th>
                  <th scope="col">Supported By</th>
                  <th scope="col">Lokasi</th>
                  <th scope="col">UoM</th>
                  <th scope="col">Target</th>
                  <th scope="col">Estimate Cost</th>
                  <th scope="col">Start</th>
                  <th scope="col">End</th>
                  <th scope="col">Duration</th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                include('proses/koneksi.php');
                $sql = "SELECT * FROM db_target_activity";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows > 0) {
                $no =1;
                while($data = mysqli_fetch_array($query)) { ?>
                <tr class="cursor"  data-toggle="modal" data-target="#editModal2<?= $no;?>">
                  <td><?= $no;?></td>
                  <td><?= $data['activity'];?></td>
                  <?php
                  $sqll = "SELECT username FROM db_user WHERE userid=".$data['pic'];
                  $queryy = mysqli_query($db, $sqll);
                  $dataa = mysqli_fetch_array($queryy);
                  echo '<td>'.$dataa['username'].'</td>';
                  ?>
                  <td>
                    <?php
                      include "proses/koneksi.php";
                      $sql1 = "SELECT * FROM db_user";
                      $query1 = mysqli_query($db, $sql1);
                      // masukan data dari database ke multiselectt
                      foreach($query1 as $row) {
                        if (strpos($data['supported_by'], ',') !== false) {
                          $array = explode(',', $data['supported_by']);
                          foreach ($array as $value) {
                            if ($row['userid'] == $value) {
                              echo $row['username'].", ";
                            }
                          }
                        }
                        else{
                          if ($row['userid'] == $data['supported_by']) {
                            echo $row['username'];
                          }
                        }                                               
                      }
                    ?>
                  </td>
                  <td><?= $data['lokasi'];?></td>
                  <td>
                    <?php
                      $sql1 = "SELECT nama FROM uom WHERE id=".$data['uom'];
                      $query1 = mysqli_query($db, $sql1);
                      while ($uom = mysqli_fetch_assoc($query1)) {
                        echo $uom['nama'];
                      }
                    ?>
                  </td>
                  <td><?= $data['target'];?></td>
                  <td><?= "Rp.".$data['estimasi_cost'];?></td>
                  <td><?= date('d-m-Y', strtotime($data['start']));?></td>
                  <td><?= date('d-m-Y', strtotime($data['end']));?></td>
                  <td><?= $data['duration'];?></td>
                  <!-- Modal Edit Activity -->
                  <div class="modal fade" id="editModal2<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="fgdact">Edit Activity</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="proses_edit_activity.php">
                            <input type="hidden" name="kode_activity" value="<?= $data['kode_activity'];?>"> <!-- Hidden input field to send the kode_activity value -->
                            <div class="row mb-3">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Intermediate :</label>
                                      <select class="form-control" name="kode_intermediate" id="" required>
                                        <?php
                                            include "proses/koneksi.php";
                                            $sql1 = "SELECT * FROM db_target_intermediate";
                                            $query1 = mysqli_query($db, $sql1);
                                            foreach($query1 as $row) {
                                              echo '<option value="'.$row['kode_intermediate'].'"';
                                              if ($row['kode_intermediate'] == $data['kode_intermediate']) {
                                                echo 'selected';
                                              }
                                              echo '>'.$row['intermediate'].'</option>';
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
                                        <input type="text" class="form-control pull-right" id="nama" name="activity" value="<?= $data['activity'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="nama">PIC:</label>
                                      <select class="form-control pull-right" name="pic" id="pic" required>
                                        <?php
                                            include "proses/koneksi.php";
                                            $sql1 = "SELECT * FROM db_user";
                                            $query1 = mysqli_query($db, $sql1);
                                            foreach($query1 as $row) {
                                              echo '<option value="'.$row['userid'].'"';
                                              if ($row['userid'] == $data['pic']) {
                                                echo 'selected';
                                              }
                                              echo '>'.$row['username'].'</option>';
                                            }
                                          ?>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nama">Supported By:</label>
                                        <select id="option_supported_edit<?= $no?>" class="form-control pull-right" name="support[]" multiple="multiple" required>
                                          <?php
                                            include "proses/koneksi.php";
                                            $sql1 = "SELECT * FROM db_user";
                                            $query1 = mysqli_query($db, $sql1);
                                            // masukan data dari database ke multiselectt
                                            foreach($query1 as $row) {
                                              echo '<option value="'.$row['userid'].'"';
                                              if (strpos($data['supported_by'], ',') !== false) {
                                                //id masi muncul cuma 1 terakhir
                                                $array = explode(',', $data['supported_by']);
                                                foreach ($array as $value) {
                                                  if ($row['userid'] == $value) {
                                                    echo 'selected';
                                                  }
                                                }
                                              }
                                              else{
                                                if ($row['userid'] == $data['supported_by']) {
                                                  echo 'selected';
                                                }
                                              }                                               
                                              echo '>'.$row['username'].'</option>';
                                            }
                                          ?>
                                        </select>
                                        <!-- select2 -->
                                        <script src="dist/js/selectt2.js"></script>
                                        <script>
                                          $("#option_supported_edit<?= $no?>").select2({
                                              placeholder: "Supported by",
                                              templateSelection: function (data, container) {
                                                if (data.selected) {
                                                    $(container).css("color", "black");
                                                }
                                                return data.text;
                                            }
                                          });
                                        </script>
                                        <!-- <input type="text" class="form-control pull-right" id="nama" name="support" value="<?= $data[''];?>" required> -->
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nama">Lokasi:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="lokasi" value="<?= $data['lokasi'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nama">UoM:</label>
                                        <select class="form-control" name="uom" id="" required>
                                          <?php
                                            include "proses/koneksi.php";
                                            $sql1 = "SELECT * FROM uom";
                                            $query1 = mysqli_query($db, $sql1);
                                            foreach($query1 as $row) {
                                              echo '<option value="'.$row['id'].'"';
                                              if ($row['id'] == $data['uom']) {
                                                echo 'selected';
                                              }
                                              echo '>'.$row['nama'].'</option>';
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nama">Target:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="target" value="<?= $data['target'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                      <label>Nama FGD:</label>
                                      <!-- get data dari fgd -->
                                      <select class="form-control " name="kode_fgd" id="nama_fgdd" required>
                                        <?php
                                            include "proses/koneksi.php";
                                            $sql1 = "SELECT * FROM db_fgd";
                                            $query1 = mysqli_query($db, $sql1);
                                            foreach($query1 as $row) {
                                              echo '<option value="'.$row['kode_fgd'].'"';
                                              if ($row['kode_fgd'] == $data['kode_fgd']) {
                                                echo 'selected';
                                              }
                                              echo '>'.$row['nama_fgd'].'</option>';
                                            }
                                          ?>                
                                      </select>
                                  </div>
                              </div>
                              </div>
                            </div>
                            <div class="border border-primary mb-2 px-3 pb-3">
                              <div class="row text-bold mb-4 h5 text-primary">Time Frame</div> 
                              <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nama">Estimate Cost:</label>
                                        <input type="number" class="form-control pull-right" id="nama" name="estimate_cost" value="<?= $data['estimasi_cost'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nama">Start:</label>
                                        <input type="date" class="form-control pull-right" id="start-act" name="start" value="<?= $data['start'];?>" onchange="aksi_act()" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nama">End:</label>
                                        <input type="date" class="form-control pull-right" id="end-act" name="end" value="<?= $data['end'];?>" onchange="aksi_act()" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nama">Duration:</label>
                                        <input type="text" class="form-control pull-right" id="duration-act" name="duration" value="<?= $data['duration'];?>" >
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
                                        <input type="text" class="form-control pull-right" id="nama" name="jan" value="<?= $data['target_jan'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Februari:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="feb" value="<?= $data['target_feb'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Maret:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="mar" value="<?= $data['target_mar'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>April:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="apr" value="<?= $data['target_apr'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Mei:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="mei" value="<?= $data['target_mei'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Juni:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="jun" value="<?= $data['target_jun'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Juli:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="jul" value="<?= $data['target_jul'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Agustus:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="aug" value="<?= $data['target_aug'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>September:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="sep" value="<?= $data['target_sep'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Oktober:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="okt" value="<?= $data['target_okt'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>November:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="nov" value="<?= $data['target_nov'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Desember:</label>
                                        <input type="text" class="form-control pull-right" id="nama" name="des" value="<?= $data['target_des'];?>" required>
                                    </div>
                                </div>
                              </div>
                            </div>
                              <!-- multi input -->
                              <!-- <div class="col-md-1 float-right">
                                  <div class="form-group">
                                      <label for="nama"></label>
                                      <button type="button" class="mt-4 btn btn-primary" onclick="addActivity()">+</button>
                                  </div>
                              </div>
                              <div id="form_activity"></div> -->
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary float-right">Tambah</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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


<!-- Modal add project End Result-->
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
              <div class="col-md-1">
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
              <div class="col-md-2">
                  <div class="form-group">
                      <label>Nama FGD:</label>
                      <!-- get data dari fgd -->
                      <select class="form-control " name="kode_fgd" id="nama_fgdend" required>
                      </select>
                  </div>
              </div>
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
            <!-- multi input -->
            <!-- <div class="col-md-1 float-right">
                <div class="form-group">
                    <label></label>
                    <button type="button" class="mt-4 btn btn-primary" onclick="addEndresult()">+</button>
                </div>
            </div>
            <div id="form_endresult"></div> -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary float-right">Tambah</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal add project Intermediate-->
<div id="modalinter" class="modal bd-example-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="fgdinter"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses_addIntermediate.php">
          <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-group">
                    <label>End Result :</label>
                    <select class="form-control" name="kode_endresult" id="" required>
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
              <div class="col-md-1">
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
              <div class="col-md-2">
                  <div class="form-group">
                      <label>Nama FGD:</label>
                      <!-- get data dari fgd -->
                      <select class="form-control " name="kode_fgd" id="nama_fgdinter" required>
                      </select>
                  </div>
              </div>
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
            <!-- multi input -->
              <!-- <div class="col-md-1 float-right">
                  <div class="form-group">
                      <label></label>
                      <button type="button" class="mt-4 btn btn-primary" onclick="addIntermediate()">+</button>
                  </div>
              </div>
              <div id="form_intermediate"></div> -->
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

<!-- Modal add project List Activity-->
<div id="modalact" class="modal bd-example-modal-lg-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="fgdact"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses_addActivity.php">
          <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Intermediate :</label>
                    <select class="form-control" name="kode_intermediate" id="" required>
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
                    <?php
                        include "proses/koneksi.php";
                        $sql = "SELECT * FROM db_user";
                        $query = mysqli_query($db, $sql);
                        foreach($query as $row) {
                          echo '<option value="'.$row['userid'].'">'.$row['username'].'</option>';
                        }
                      ?>
                    </select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="nama">Supported By:</label>
                      <select id="option_supported" class="form-control pull-right" name="support[]" multiple="multiple" required>
                        <?php
                          include "proses/koneksi.php";
                          $sql = "SELECT * FROM db_user";
                          $query = mysqli_query($db, $sql);
                          foreach($query as $row) {
                            echo '<option value="'.$row['userid'].'">'.$row['username'].'</option>';
                          }
                        ?>
                      </select>
                      <!-- <input type="text" class="form-control pull-right" id="nama" name="support[]" required> -->
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="nama">Lokasi:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="lokasi[]" required>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group">
                      <label for="nama">UoM:</label>
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
                      <label for="nama">Target:</label>
                      <input type="text" class="form-control pull-right" id="nama" name="target[]" required>
                  </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label>Nama FGD:</label>
                    <!-- get data dari fgd -->
                    <select class="form-control " name="kode_fgd" id="nama_fgdd" required>                 
                    </select>
                </div>
            </div>
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
            <!-- multi input -->
            <!-- <div class="col-md-1 float-right">
                <div class="form-group">
                    <label for="nama"></label>
                    <button type="button" class="mt-4 btn btn-primary" onclick="addActivity()">+</button>
                </div>
            </div>
            <div id="form_activity"></div> -->
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
    // function addEndresult() {
    //     var html = '<br><br><br><br><br>' +
    //                '<div class="row">' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Tanggal :</label>' +
    //                '<input type="date" class="form-control pull-right"  name="tanggal[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-5">' +
    //                '<div class="form-group">' +
    //                '<label for="name">End Result:</label>' +
    //                '<input type="text" class="form-control pull-right" name="end_result[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">UoM:</label>' +
    //                '<input type="text" class="form-control pull-right" name="uom[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Estimate Cost:</label>' +
    //                '<input type="text" class="form-control pull-right" name="estimate_cost[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Start:</label>' +
    //                '<input type="date" class="form-control pull-right" name="start[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">End:</label>' +
    //                '<input type="date" class="form-control pull-right" name="end[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Duration:</label>' +
    //                '<input type="text" class="form-control pull-right" name="duration[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">As-Is:</label>' +
    //                '<input type="text" class="form-control pull-right" name="asis[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Tube:</label>' +
    //                '<input type="text" class="form-control pull-right" name="tube[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '</div>'+
    //                '<div class="row">' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jan:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jan[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Feb:</label>' +
    //                '<input type="text" class="form-control pull-right" name="feb[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Mar:</label>' +
    //                '<input type="text" class="form-control pull-right" name="mar[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Apr:</label>' +
    //                '<input type="text" class="form-control pull-right" name="apr[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Mei:</label>' +
    //                '<input type="text" class="form-control pull-right" name="mei[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jun:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jun[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jul:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jul[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Aug:</label>' +
    //                '<input type="text" class="form-control pull-right" name="aug[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Sep:</label>' +
    //                '<input type="text" class="form-control pull-right" name="sep[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Okt:</label>' +
    //                '<input type="text" class="form-control pull-right" name="okt[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Nov:</label>' +
    //                '<input type="text" class="form-control pull-right" name="nov[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Des:</label>' +
    //                '<input type="text" class="form-control pull-right" name="des[]">' +
    //                '</div>' +
    //                '</div>';
    //                '</div>';
    //     $('#form_endresult').append(html);
    // }
    // function addIntermediate() {
    //     var html = '<br><br><br><br>' +
    //                '<div class="row">' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Tanggal :</label>' +
    //                '<input type="date" class="form-control pull-right"  name="tanggal[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-5">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Intermediate :</label>' +
    //                '<input type="text" class="form-control pull-right" name="intermediate[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">UoM:</label>' +
    //                '<input type="text" class="form-control pull-right" name="uom[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Estimate Cost:</label>' +
    //                '<input type="text" class="form-control pull-right" name="estimate_cost[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Start:</label>' +
    //                '<input type="date" class="form-control pull-right" name="start[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">End:</label>' +
    //                '<input type="date" class="form-control pull-right" name="end[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Duration:</label>' +
    //                '<input type="text" class="form-control pull-right" name="duration[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">As-Is:</label>' +
    //                '<input type="text" class="form-control pull-right" name="asis[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Tube:</label>' +
    //                '<input type="text" class="form-control pull-right" name="tube[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '</div>'+
    //                '<div class="row">' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jan:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jan[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Feb:</label>' +
    //                '<input type="text" class="form-control pull-right" name="feb[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Mar:</label>' +
    //                '<input type="text" class="form-control pull-right" name="mar[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Apr:</label>' +
    //                '<input type="text" class="form-control pull-right" name="apr[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Mei:</label>' +
    //                '<input type="text" class="form-control pull-right" name="mei[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jun:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jun[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jul:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jul[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Aug:</label>' +
    //                '<input type="text" class="form-control pull-right" name="aug[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Sep:</label>' +
    //                '<input type="text" class="form-control pull-right" name="sep[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Okt:</label>' +
    //                '<input type="text" class="form-control pull-right" name="okt[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Nov:</label>' +
    //                '<input type="text" class="form-control pull-right" name="nov[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Des:</label>' +
    //                '<input type="text" class="form-control pull-right" name="des[]">' +
    //                '</div>' +
    //                '</div>';
    //                '</div>';
    //     $('#form_intermediate').append(html);
    // }
    // function addActivity() {
    //     var html = '<br><br><br><br>' +
    //                '<div class="row">' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Tanggal :</label>' +
    //                '<input type="date" class="form-control pull-right"  name="tanggal[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-3">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Activity:</label>' +
    //                '<input type="text" class="form-control pull-right" name="activity[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">PIC:</label>' +
    //                '<input type="text" class="form-control pull-right" name="pic[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Supported By:</label>' +
    //                '<input type="text" class="form-control pull-right" name="support[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Lokasi:</label>' +
    //                '<input type="text" class="form-control pull-right" name="lokasi[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">UoM:</label>' +
    //                '<input type="text" class="form-control pull-right" name="uom[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target:</label>' +
    //                '<input type="text" class="form-control pull-right" name="target[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Estimate Cost:</label>' +
    //                '<input type="text" class="form-control pull-right" name="estimate_cost[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Start:</label>' +
    //                '<input type="date" class="form-control pull-right" name="start[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">End:</label>' +
    //                '<input type="date" class="form-control pull-right" name="end[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '<div class="col-md-1">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Duration:</label>' +
    //                '<input type="text" class="form-control pull-right" name="duration[]">' +
    //                '</div>' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="row">' +
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jan:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jan[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Feb:</label>' +
    //                '<input type="text" class="form-control pull-right" name="feb[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Mar:</label>' +
    //                '<input type="text" class="form-control pull-right" name="mar[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Apr:</label>' +
    //                '<input type="text" class="form-control pull-right" name="apr[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Mei:</label>' +
    //                '<input type="text" class="form-control pull-right" name="mei[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jun:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jun[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Jul:</label>' +
    //                '<input type="text" class="form-control pull-right" name="jul[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Aug:</label>' +
    //                '<input type="text" class="form-control pull-right" name="aug[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Sep:</label>' +
    //                '<input type="text" class="form-control pull-right" name="sep[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Okt:</label>' +
    //                '<input type="text" class="form-control pull-right" name="okt[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Nov:</label>' +
    //                '<input type="text" class="form-control pull-right" name="nov[]">' +
    //                '</div>' +
    //                '</div>'+
    //                '<div class="col-md-2">' +
    //                '<div class="form-group">' +
    //                '<label for="name">Target-Des:</label>' +
    //                '<input type="text" class="form-control pull-right" name="des[]">' +
    //                '</div>' +
    //                '</div>'
    //                '</div>';
    //     $('#form_activity').append(html);
    // }

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

  $(document).ready(function() {
  $('#select_fgd2').change(function() {
    var selectedValue = $(this).val();
    $('#modalinter').data('fgdinter', selectedValue);
  });

  $('#modalinter').on('show.bs.modal', function() {
    var selectedValue = $(this).data('fgdinter');
    // Kirim AJAX request ke script getData.php dengan parameter ID
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
    // $('#fgdact').text(selectedValue);
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

  // Konversi selisih tanggal dari milidetik menjadi hari
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
  function myFunction3(no) {
    var xmlhttp = new XMLHttpRequest();
    var url = "proses_edit_activity.php";
    var kode_activity = document.getElementById("kode_activity"+no).value;
    var kode_intermediate = document.getElementById("kode_intermediate"+no).value;
    var activity = document.getElementById("activity"+no).value;
    var pic = document.getElementById("pic"+no).value;
    // var option_supported_edit = document.getElementById("option_supported_edit"+no).value;
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
               "&pic=" + pic + "&lokasi=" + lokasi + "&target=" + target +
               "&estimate_cost=" + estimate_cost + "&start=" + start + "&end=" + end + 
               "&duration=" + duration + "&jan=" + jan + 
               "&feb=" + feb + "&mar=" + mar + "&apr=" + apr + "&mei=" + mei + "&jun=" + jun + 
               "&jul=" + jul + "&aug=" + aug + "&sep=" + sep + "&okt=" + okt + "&nov=" + nov + "&des=" + des;
              //  "&option_supported_edit=" + option_supported_edit +
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
</script>                                        
</body>
</html>

<!-- error masukan data dari db ke multi select pada activity -->