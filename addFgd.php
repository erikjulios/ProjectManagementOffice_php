<?php
session_start();
if(!isset($_SESSION["loggedin"])) header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Management Office | Add FGD</title>
  <!-- bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

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
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="addFgd.php" class="nav-link active">
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
    <!-- /.content-header -->

    <!-- Menu button -->
    <div class="content">
      <div class="container-fluid">
        <!-- tabel fgd -->
        <div id="endresult">
          <div class="row justify-content-between ">
            <div class="col-3 pt-2 mt-2">
              <input type="text" class="form-control" id="searchInput_fgd" placeholder="Search ..." name="search">
            </div>
            <div class="col-2 mt-3">
              <button type="button"  data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-secondary">
                + Add FGD
              </button>
            </div>
          </div>
          <!-- table -->
          <div id="data-container" class="row mt-4">
            <table class="table">
              <thead>
                  <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tahun FGD</th>
                  <th scope="col">Nama FGD</th>
                  <th scope="col">PIC</th>
                  <th scope="col">Team</th>
                  <th scope="col" colspan="2">Action</th>
                  </tr>
              </thead>
              <tbody id="data-body-fgd">
                <?php 
                include('proses/koneksi.php');
                $sql = "SELECT * FROM db_fgd";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows > 0) {
                $no =1;
                while($data = mysqli_fetch_array($query)) { ?>
                <tr class="cursor">
                  <td><?= $no;?></td>
                  <td><?= $data['tahun_fgd'];?></td>
                  <td><?= $data['nama_fgd'];?></td>
                  <?php
                  $sql3 = "SELECT username FROM db_user WHERE userid=".$data['pic'];
                  $query3 = mysqli_query($db, $sql3);
                  $data3 = mysqli_fetch_array($query3);
                  echo '<td>'.$data3['username'].'</td>';
                  ?>
                  <?php
                  include('proses/koneksi.php');
                  $team_id = explode(",", $data['team']); 
                  $team_names = array(); 
                  foreach ($team_id as $id) {
                      $sql = "SELECT * FROM db_user WHERE userid = $id";
                      $query1 = mysqli_query($db, $sql);
                      if ($query1->num_rows > 0) {
                          $team_data = mysqli_fetch_array($query1);
                          $team_names[] = $team_data['username']; 
                      }
                  }
                  $team_names_str = implode(", ", $team_names); 
                  echo '<td>'.$team_names_str.'</td>';
                  ?>
                  <td>
                    <a data-toggle="modal" data-target="#editModal<?= $data['kode_fgd'];?>">
                      <span class="fa fa-edit text-primary"></span>
                    </a>
                  </td>
                  <td>
                    <a href="delete_fgd.php?kode_fgd=<?= $data['kode_fgd'];?>" onclick="return confirm('Anda yakin ingin hapus data?')">
                      <span class="fa fa-trash text-danger"></span>
                    </a>
                  </td>
                  <!-- Modal edit fgd-->
                  <div class="modal fade" id="editModal<?= $data['kode_fgd'];?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel">Edit Data FGD</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="proses_edit_fgd.php" method="POST">
                            <input type="hidden" name="kode_fgd" value="<?= $data['kode_fgd'];?>"> <!-- Hidden input field -->
                            <div class="form-group">
                              <label for="tahun">Tahun FGD</label>
                              <input type="text" class="form-control" id="tahun_fgd" name="tahun_fgd" value="<?= $data['tahun_fgd'];?>" required>
                            </div>
                            <div class="form-group">
                              <label for="nama_fgd">Nama FGD</label>
                              <input type="text" class="form-control" id="nama_fgd" name="nama_fgd" value="<?= $data['nama_fgd'];?>" required>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="nama">Team:</label>
                                    <select id="option_team_edit<?= $no?>" class="form-control pull-right" name="team[]" multiple="multiple" required>
                                      <?php
                                        include "proses/koneksi.php";
                                        $sql1 = "SELECT * FROM db_user";
                                        $query1 = mysqli_query($db, $sql1);
                                        // masukan data dari database ke multiselectt
                                        foreach($query1 as $row) {
                                          echo '<option value="'.$row['userid'].'"';
                                          if (strpos($data['team'], ',') !== false) {
                                            //id masi muncul cuma 1 terakhir
                                            $array = explode(',', $data['team']);
                                            foreach ($array as $value) {
                                              if ($row['userid'] == $value) {
                                                echo 'selected';
                                              }
                                            }
                                          }
                                          else{
                                            if ($row['userid'] == $data['team']) {
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
                                      $(document).on('shown.bs.modal', function () {
                                          // Inisialisasi Select2 di dalam modal
                                          $("#option_team_edit<?= $no?>").select2({
                                              placeholder: "Team",
                                              templateSelection: function (data, container) {
                                                  if (data.selected) {
                                                      $(container).css("color", "black");
                                                  }
                                                  return data.text;
                                              }
                                          });
                                      });
                                    </script>
                                    <!-- <input type="text" class="form-control pull-right" id="nama" name="support" value="<?= $data[''];?>" required> -->
                                </div>
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


<!-- Modal Add Fgd-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add FGD</h4><br>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses_addFgd.php">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Tahun FGD:</label>
                    <input type="number" class="form-control pull-right" id="tahun_fgd" name="tahun_fgd" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Nama FGD:</label>
                    <input type="text" class="form-control pull-right" id="nama_fgd" name="nama_fgd" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>PIC:</label>
                    <select class="form-control pull-right" name="pic" id="pic">
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
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Team:</label><br>
                    <select id="option" class="form-control pull-right" name="options[]" multiple="multiple" required>
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
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary float-left">Tambah</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $(document).ready(function () {
      //add team
      $("#option").select2({
          placeholder: "Pilih Team"
      });
  });
</script>
<script>
    $(document).ready(function() {
      $('#searchInput_fgd').on('input', function() {
        search_fgd();
      });
    });

  // <!-- Fungsi untuk melakukan pencarian dan mengganti isi data-body dengan hasil pencarian -->
  function search_fgd() {
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
              var dataBody = document.getElementById("data-body-fgd");
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
                      var kode_fgd = document.createElement("td");
                      kode_fgd.textContent = data.kode_fgd;                      
                      var tahun_fgdCell = document.createElement("td");
                      tahun_fgdCell.textContent = data.tahun_fgd;                      
                      var nama_fgd = document.createElement("td");
                      nama_fgd.textContent = data.nama_fgd;
                      var pic = document.createElement("td");
                      pic.textContent = data.pic;
                      var team = document.createElement("td");
                      team.textContent = data.team;
                      var hapusCell = document.createElement("td");
                      var hapusLink = document.createElement("a");
                      hapusLink.href = 'delete_fgd.php?kode_fgd='+data.kode_fgd;
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
                        var modal = document.getElementById("editModal"+data.kode_fgd);

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
                      row.appendChild(tahun_fgdCell);
                      row.appendChild(noCell);
                      row.appendChild(tahun_fgdCell);
                      row.appendChild(nama_fgd);
                      row.appendChild(pic);
                      row.appendChild(team);
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
      var query = document.getElementById("searchInput_fgd").value; // Mendapatkan nilai dari input pencarian
      xmlhttp.open("GET", "search_fgd.php?q=" + query, true); // Mengirim permintaan pencarian dengan query sebagai parameter GET
      xmlhttp.send();
    }
</script>