<?php
include "proses/koneksi.php";
session_start();
$username = $_SESSION['name'];
$kode_fgd = $_GET['kode_fgd'];

// Query the database based on the filter value
if ($kode_fgd == 'all') {
  $sql = "SELECT * FROM db_target_intermediate";
} else {
  // Fetch filtered data
  $sql = "SELECT * FROM db_target_intermediate WHERE kode_fgd = '$kode_fgd' AND user_create = '$username'";
}
$query = mysqli_query($db, $sql);

// Create table header section
$html = '<table class="table">';
$html .= '<thead>
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
        </thead>';

// Create table body section
$html .= '<tbody>';
if ($query->num_rows > 0) {
$no = 1;
while($data = mysqli_fetch_array($query)){
  $html .= '<tr class="cursor">
  <td>'. $no.'</td>
  <td>'. $data['intermediate'].'</td>
  <td>'. $data['uom'].'</td>
  <td>'. "Rp.".$data['estimate_cost'].'</td>
  <td>'. date('d-m-Y', strtotime($data['start'])).'</td>
  <td>'. date('d-m-Y', strtotime($data['end'])).'</td>
  <td>'. $data['duration'].'</td>
  <td>'. $data['asis'].'</td>
  <td>'. $data['tube'].'</td>
  <td>
        <a data-toggle="modal" data-target="#editModal1'.$no.'">
            <span class="fa fa-edit text-primary"></span>
        </a>
    </td>
    <td>
        <a href="delete_intermediate.php?kode_intermediate='.$data['kode_intermediate'].'" onclick="return confirm(\'Anda yakin ingin hapus data?\')">
            <span class="fa fa-trash text-danger"></span>
        </a>
    </td>
  <div class="modal fade" id="editModal1'. $no.'" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                      <select class="form-control" name="kode_endresult" id="kode_endresult'.$no.'" required>';
                          include "proses/koneksi.php";
                          $sql2 = "SELECT * FROM db_target_end_result";
                          $query2 = mysqli_query($db, $sql2);
                          foreach($query2 as $row2) {
                    $html .= '<option value="'.$row2['kode_endresult'].'"';
                            if ($row2['kode_endresult'] == $data['kode_endresult']) {
                    $html .= 'selected';
                            }
                    $html .= '>'.$row2['end_result'].'</option>';
                          }
                    $html .= '</select>
                  </div>
              </div>
            </div>
            <div class="border border-primary mb-2 px-3 pb-3">
              <div class="row text-bold mb-4 h5 text-primary">Intermediate</div>  
              <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Intermediate:</label>
                        <input type="hidden" id="kode_intermediate'.$no.'" name="kode_intermediate" value="'. $data['kode_intermediate'].'"> 
                        <input type="text" class="form-control pull-right" id="intermediate'.$no.'" name="intermediate" value="'. $data['intermediate'].'" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>UoM:</label>
                        <select class="form-control" name="uom" value="'. $data['uom'].'" id="uom'.$no.'" required>';
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
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Nama FGD:</label>
                        <!-- get data dari fgd -->
                        <select class="form-control " name="kode_fgd" id="kode_fgd'.$no.'" required>';
                            include "proses/koneksi.php";
                            $sql2 = "SELECT * FROM db_fgd";
                            $query2 = mysqli_query($db, $sql2);
                            foreach($query2 as $row2) {
                        $html .= '<option value="'.$row2['kode_fgd'].'"';
                              if ($row2['kode_fgd'] == $data['kode_fgd']) {
                        $html .= 'selected';
                              }
                        $html .= '>'.$row2['nama_fgd'].'</option>';
                            }
              $html .= '</select>
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
                        <input type="number" class="form-control pull-right" id="estimate_cost'.$no.'" name="estimate_cost" value="'. $data['estimate_cost'].'" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Start:</label>
                        <input type="date" class="form-control pull-right" id="start'.$no.'" name="start" value="'. $data['start'].'" onchange="aksi_inter()" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>End:</label>
                        <input type="date" class="form-control pull-right" id="end'.$no.'" name="end" value="'. $data['end'].'" onchange="aksi_inter()" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label>Duration:</label>
                        <input type="text" class="form-control pull-right" id="duration'.$no.'" name="duration" value="'. $data['duration'].'" >
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label>As-Is:</label>
                        <input type="text" class="form-control pull-right" id="asis'.$no.'" name="asis" value="'. $data['asis'].'" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label>Tube:</label>
                        <input type="text" class="form-control pull-right" id="tube'.$no.'" name="tube" value="'. $data['tube'].'" required>
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
                          <input type="text" class="form-control pull-right" id="jan'.$no.'" name="jan" value="'. $data['target_jan'].'" required>
                      </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group">
                          <label>Februari:</label>
                          <input type="text" class="form-control pull-right" id="feb'.$no.'" name="feb" value="'. $data['target_feb'].'" required>
                      </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group">
                          <label>Maret:</label>
                          <input type="text" class="form-control pull-right" id="mar'.$no.'" name="mar" value="'. $data['target_mar'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label>April:</label>
                          <input type="text" class="form-control pull-right" id="apr'.$no.'" name="apr" value="'. $data['target_apr'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label>Mei:</label>
                          <input type="text" class="form-control pull-right" id="mei'.$no.'" name="mei" value="'. $data['target_mei'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2"> 
                      <div class="form-group">
                          <label>Juni:</label>
                          <input type="text" class="form-control pull-right" id="jun'.$no.'" name="jun" value="'. $data['target_jun'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label>Juli:</label>
                          <input type="text" class="form-control pull-right" id="jul'.$no.'" name="jul" value="'. $data['target_jul'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label>Agustus:</label>
                          <input type="text" class="form-control pull-right" id="aug'.$no.'" name="aug" value="'. $data['target_aug'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label>September:</label>
                          <input type="text" class="form-control pull-right" id="sep'.$no.'" name="sep" value="'. $data['target_sep'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label>Oktober:</label>
                          <input type="text" class="form-control pull-right" id="okt'.$no.'" name="okt" value="'. $data['target_okt'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label>November:</label>
                          <input type="text" class="form-control pull-right" id="nov'.$no.'" name="nov" value="'. $data['target_nov'].'" required>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label>Desember:</label>
                          <input type="text" class="form-control pull-right" id="des'.$no.'" name="des" value="'. $data['target_des'].'" required>
                      </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="modal-footer">
            <button onclick="myFunction2('.$no.')" id="update" type="submit" class="btn btn-primary float-right">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</tr>';
$no+=1;
}
$html .= '</tbody></table>';

echo $html;

} else {
echo "<div class='text-bold mt-5 h5 mx-5'>Empty Data</div>";
}

?>
