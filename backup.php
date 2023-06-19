  <!-- tabel end result -->
  <div id="endresult" class="px-5 pb-5 pt-2 mt-2">
          <div class="row justify-content-between mt-4 mb-4">
            <div class="col-3">
              <input type="text" class="form-control" id="searchInput_end" placeholder="Search ..." name="search">
            </div>
            <div class="col-2 ml-auto">
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
                  <th scope="col" colspan="2">Action</th>
                  </tr>
              </thead>
              <tbody id="data-body-end">
                <?php 
                include('proses/koneksi.php');
                $sql = "SELECT * FROM db_target_end_result";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows > 0) {
                $no =1;
                while($data = mysqli_fetch_array($query)) { ?>
                <tr class="cursor">
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
                  <td>
                    <a data-toggle="modal" data-target="#editModal<?= $data['kode_endresult'];?>">
                      <span class="fa fa-edit text-primary"></span>
                    </a>
                  </td>
                  <td>
                    <a href="delete_end_result.php?kode_endresult=<?= $data['kode_endresult'];?>" onclick="return confirm('Anda yakin ingin hapus data?')">
                      <span class="fa fa-trash text-danger"></span>
                    </a>
                  </td>
                  <!-- Modal edit end result -->
                  <div class="modal" id="editModal<?= $data['kode_endresult'];?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                                        <input type="text" class="form-control pull-right" id="duration-endresult" value="<?= $data['duration'];?>" name="duration" readonly required>
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
        <div id="inter" style="display: none;" class="border border-top-0 border-primary border-5 px-5 pb-5 pt-2 mt-2">
          <div class="row justify-content-between mt-4 mb-4">
            <div class="col-3">
              <input type="text" class="form-control" id="searchInput_inter" placeholder="Search ..." name="search">
            </div>
            <div class="col-2 ml-auto">
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
                  <th scope="col" colspan="2">Action</th>
                  </tr>
              </thead>
              <tbody id="data-body-inter">
                <?php 
                include('proses/koneksi.php');
                $sql = "SELECT * FROM db_target_intermediate";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows > 0) {
                $no =1;
                while($data = mysqli_fetch_array($query)) { ?>
                <tr class="cursor">
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
                  <td>
                    <a data-toggle="modal" data-target="#editModal1<?= $data['kode_intermediate'];?>">
                      <span class="fa fa-edit text-primary"></span>
                    </a>
                  </td>
                  <td>
                    <a href="delete_intermediate.php?kode_intermediate=<?= $data['kode_intermediate'];?>" onclick="return confirm('Anda yakin ingin hapus data?')">
                      <span class="fa fa-trash text-danger"></span>
                    </a>
                  </td>
                  <!-- Modal edit Intermediate -->
                  <div class="modal" id="editModal1<?= $data['kode_intermediate'];?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                                        <input type="text" id="duration-inter" class="form-control pull-right" name="duration" value="<?= $data['duration'];?>" readonly >
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
                            <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Tutup</button>
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
        <div id="act" style="display: none;" class="border border-top-0 border-primary px-5 pb-5 pt-2 mt-2" >
          <div class="row justify-content-between mt-4 mb-4">
            <div class="col-3">
              <input type="text" class="form-control" id="searchInput_act" placeholder="Search ..." name="search">
            </div>
            <div class="col-2 ml-auto">
              <button id="actBtnModal" type="button" class="btn btn-block btn-secondary">
                + Add Project
              </button>
            </div>
          </div>