<?php
session_start();
$username = $_SESSION['name'];
include "proses/koneksi.php";
$kode_fgd = $_GET['kode_fgd'];

// Query the database based on the filter value
if ($kode_fgd == 'all') {
  // $sql = "SELECT * FROM db_target_activity";
} else {
  // Fetch filtered data
  $sql = "SELECT a.start AS activity_start, a.end AS activity_end,
          a.duration AS activity_duration, a.uom AS activity_uom, a.estimasi_cost AS activity_estimasi_cost,
          a.target_jan AS activity_target_jan,a.target_feb AS activity_target_feb, a.target_mar AS activity_target_mar,
          a.target_apr AS activity_target_apr, a.target_mei AS activity_target_mei,
          a.target_jun AS activity_target_jun, a.target_jul AS activity_target_jul,
          a.target_aug AS activity_target_aug, a.target_sep AS activity_target_sep,
          a.target_okt AS activity_target_okt, a.target_nov AS activity_target_nov,
          a.target_des AS activity_target_des, a.*, i.*  FROM db_target_activity a LEFT JOIN db_target_intermediate i ON a.kode_intermediate = i.kode_intermediate WHERE a.kode_fgd = '$kode_fgd' AND a.user_create = '$username'";
}
$query = mysqli_query($db, $sql);

// Create table header section
$html = '<table class="table">';
$html .= '<thead>
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
            <th scope="col" colspan="2">Action</th>
          </tr>
        </thead>';

// Create table body section
$html .= '<tbody>';
if ($query->num_rows > 0) {
$no = 1;
while($data = mysqli_fetch_array($query)){
  $html .= '<tr class="cursor">
  <td>'. $no.'</td>
  <td>'. $data['activity'].'</td>';
  $sqll = "SELECT username FROM db_user WHERE userid=".$data['pic'];
  $queryy = mysqli_query($db, $sqll);
  $dataa = mysqli_fetch_array($queryy);
  $html .= '<td>'.$dataa['username'].'</td>';
      $getNama = "SELECT userid,username FROM db_user";
      $execute_nama = mysqli_query($db, $getNama);
      $daftar_user= array();
      foreach ($execute_nama as $key) {
        if($data['supported_by'] == $key['userid']){
          $html .= '<td>'. $key['username'].'</td>';
          $key['username'];
        }
      }
  $html .= '
  
  <td>'. $data['lokasi'].'</td>';
  $get_uom = "SELECT * FROM uom";
  $exec = mysqli_query($db, $get_uom);
  foreach($exec as $row) {
    if ($row['id'] == $data['activity_uom']) {
      $html .= '<td>'. $row['nama'].'</td>
      ';
    }
  }
  $html .= '
  <td>'. $data['target'].'</td>
  <td>'. "Rp.".$data['activity_estimasi_cost'].'</td>
  <td>'. date('d-m-Y', strtotime($data['start'])).'</td>
  <td>'. date('d-m-Y', strtotime($data['end'])).'</td>
  <td>'. $data['activity_duration'].'</td>
  <td>
    <a data-toggle="modal" data-target="#editModal2'.$no.'">
      <span class="fa fa-edit text-primary"></span>
    </a>
  </td>
  <td>
    <a href="delete_activity.php?kode_activity='.$data['kode_activity'].'" onclick="return confirm(\'Anda yakin ingin hapus data?\')">
      <span class="fa fa-trash text-danger"></span>
    </a>
  </td>
  <div class="modal" id="editModal2'. $no.'" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="fgdact">Edit Activity</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" action="proses_edit_activity.php">
            <input type="hidden" id="kode_activity'.$no.'" name="kode_activity" value="'. $data['kode_activity'].'">
            <div class="row mb-3">
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Nama FGD:</label>
                      <!-- get data dari fgd -->
                      <select class="form-control " name="kode_fgd" id="kode_fgd'.$no.'" required>';
                            include "proses/koneksi.php";
                            $sql1 = "SELECT * FROM db_fgd";
                            $query1 = mysqli_query($db, $sql1);
                            foreach($query1 as $row) {
                              $html .= '<option value="'.$row['kode_fgd'].'"';
                              if ($row['kode_fgd'] == $data['kode_fgd']) {
                                $html .= 'selected';
                              }
                              $html .= '>'.$row['nama_fgd'].'</option>';
                            }
                      $html .= '</select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label>End Result :</label>
                      <select class="form-control" name="kode_intermediate" id="kode_intermediate'.$no.'" required>;';
                            include "proses/koneksi.php";
                            $sql1 = "SELECT * FROM db_target_intermediate";
                            $query1 = mysqli_query($db, $sql1);
                            foreach($query1 as $row) {
                      $html .= '<option value="'.$row['kode_endresult'].'"';
                              if ($row['kode_endresult'] == $data['kode_endresult']) {
                      $html .= 'selected';
                              }
                              // select dulu dari end result buat nampilin nama atau pake left join ke end result
                      $html .= '>'.$row['kode_endresult'].'</option>';
                            }
                      $html .= '</select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label>Intermediate :</label>
                      <select class="form-control" name="kode_intermediate" id="kode_intermediate'.$no.'" required>;';
                            include "proses/koneksi.php";
                            $sql1 = "SELECT * FROM db_target_intermediate";
                            $query1 = mysqli_query($db, $sql1);
                            foreach($query1 as $row) {
                      $html .= '<option value="'.$row['kode_intermediate'].'"';
                              if ($row['kode_intermediate'] == $data['kode_intermediate']) {
                      $html .= 'selected';
                              }
                      $html .= '>'.$row['intermediate'].'</option>';
                            }
                      $html .= '</select>
                  </div>
              </div>
            </div>
            <div class="border border-primary px-3 mb-2 pb-3">
              <div id="fgd1" class="row text-bold mb-4 h5 text-primary">Activity</div>  
              <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nama">Activity :</label>
                        <input type="text" class="form-control pull-right" id="activity'.$no.'" name="activity" value="'. $data['activity'].'" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                      <label for="nama">PIC:</label>
                      <select class="form-control pull-right" name="pic" id="pic'.$no.'" required>';
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
                                $html .= '<option value="'.$value['id'].'"';
                                if ($value['id'] == $data['pic']) {
                                  $html .= 'selected';
                                      }
                                  $html .= '>'.$value['nama'].'</option>';
                                }
                            }
                            
                          }
                  $html .= '</select>
                  </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nama">Supported By:</label>
                        <select id="option_supported_edit'.$no.'" class="form-control pull-right" name="support[]" multiple="multiple" required>';
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


                              $html .= '<option value="'.$value['id'].'"';
                              if (strpos($data['supported_by'], ',') !== false) {
                                $array = explode(',', $data['supported_by']);
                                foreach ($array as $row) {
                                  if ($value['id'] == $row) {
                                    $html .='selected';
                                  }
                                }
                              }
                              else{
                                if ($value['id'] == $data['supported_by']) {
                                  $html .='selected';
                                }
                              }                                               
                              $html .= '>'.$value['nama'].'</option>';
                              }
                          }
                          
                        }    
                        $html .='</select>';
                        $html .='<script src="dist/js/selectt2.js"></script>';
                        $html .='
                        <script>
                        $(document).on("shown.bs.modal", function () {
                          $("#option_supported_edit'.$no.'").select2({
                              placeholder: "Supported by",
                              templateSelection: function (data, container) {
                                if (data.selected) {
                                    $(container).css("color", "black");
                                }
                                return data.text;
                            }
                          });
                          console.log("a");
                        });
                        </script>';
            $html .='</div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nama">Lokasi:</label>
                        <input type="text" class="form-control pull-right" id="lokasi'.$no.'" name="lokasi" value="'. $data['lokasi'].'" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nama">UoM:</label>
                        <select class="form-control" name="uom" id="uom'.$no.'" required>';
                            include "proses/koneksi.php";
                            $sql1 = "SELECT * FROM uom";
                            $query1 = mysqli_query($db, $sql1);
                            foreach($query1 as $row) {
                              $html .= '<option value="'.$row['id'].'"';
                              if ($row['id'] == $data['uom']) {
                                $html .= 'selected';
                              }
                              $html .= '>'.$row['nama'].'</option>';
                            }
                        $html .= '</select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="nama">Target:</label>
                        <input type="text" class="form-control pull-right" id="target'.$no.'" name="target" value="'. $data['target'].'" required>
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
                        <input type="number" class="form-control pull-right" id="estimate_cost'.$no.'" name="estimate_cost" value="'. $data['estimasi_cost'].'" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nama">Start:</label>
                        <input type="date" class="form-control pull-right" id="start'.$no.'" name="start" value="'.$data['activity_start'].'" onchange="duration_act('.$no.')" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nama">End:</label>
                        <input type="date" class="form-control pull-right" id="end'.$no.'" name="end" value="'.$data['activity_end'].'" onchange="duration_act('.$no.')" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="nama">Duration:</label>
                        <input type="text" class="form-control pull-right" id="duration'.$no.'" name="duration" value="'.$data['activity_duration'].'" required readonly >
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
                        <input type="text" class="form-control pull-right" id="jan'.$no.'" name="jan" value="'. $data['activity_target_jan'].'" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Februari:</label>
                        <input type="text" class="form-control pull-right" id="feb'.$no.'" name="feb" value="'. $data['activity_target_feb'].'" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Maret:</label>
                        <input type="text" class="form-control pull-right" id="mar'.$no.'" name="mar" value="'. $data['activity_target_mar'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>April:</label>
                        <input type="text" class="form-control pull-right" id="apr'.$no.'" name="apr" value="'. $data['activity_target_apr'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Mei:</label>
                        <input type="text" class="form-control pull-right" id="mei'.$no.'" name="mei" value="'. $data['activity_target_mei'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Juni:</label>
                        <input type="text" class="form-control pull-right" id="jun'.$no.'" name="jun" value="'. $data['activity_target_jun'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Juli:</label>
                        <input type="text" class="form-control pull-right" id="jul'.$no.'" name="jul" value="'. $data['activity_target_jul'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Agustus:</label>
                        <input type="text" class="form-control pull-right" id="aug'.$no.'" name="aug" value="'. $data['activity_target_aug'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>September:</label>
                        <input type="text" class="form-control pull-right" id="sep'.$no.'" name="sep" value="'. $data['activity_target_sep'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Oktober:</label>
                        <input type="text" class="form-control pull-right" id="okt'.$no.'" name="okt" value="'. $data['activity_target_okt'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>November:</label>
                        <input type="text" class="form-control pull-right" id="nov'.$no.'" name="nov" value="'. $data['activity_target_nov'].'" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Desember:</label>
                        <input type="text" class="form-control pull-right" id="des'.$no.'" name="des" value="'. $data['activity_target_des'].'" required>
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
          <button type="submit" onclick="myFunction3('.$no.')" id="update" class="btn btn-primary float-right">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</tr>';
$no++;
}
$html .= '</tbody></table>';

echo $html;

} else {
echo "<div class='text-bold mt-5 h5 mx-5'>Empty Data</div>";
}

?>
