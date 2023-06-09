<?php
// Mengambil query pencarian dari parameter GET
$query = $_GET['q'];

// Melakukan pencarian data sesuai dengan query
include('proses/koneksi.php');


$get_uom = "SELECT * FROM uom";
$query_uom = mysqli_query($db, $get_uom);

// getnama uom
$data_uom = array();

if ($query_uom->num_rows > 0) {
    while ($data1 = mysqli_fetch_array($query_uom)) {
        // Menambahkan data hasil pencarian ke dalam array
        $data_uom[] = array(
            'id' => $data1['id'],
            'nama' => $data1['nama'],
        );
    }
}

// get nama pic dan supported by
$get_nama = "SELECT userid, username FROM db_user";
$query_nama = mysqli_query($db, $get_nama);

$data_nama = [];

if ($query_nama->num_rows > 0) {
    while ($data2 = mysqli_fetch_array($query_nama)) {
        // Menambahkan data hasil pencarian ke dalam array
        $data_nama[] = array(
            'userid' => $data2['userid'],
            'username' => $data2['username'],
        );
    }
}



$sql = "SELECT * FROM db_target_activity WHERE activity LIKE '%$query%'";
$query = mysqli_query($db, $sql);

$result = array();
$nama_uom = "";




if ($query->num_rows > 0) {
    while ($data = mysqli_fetch_array($query)) {
        // nama uom
        
        foreach ($data_uom as $key) {
            if ($key['id'] == $data['uom']) {
                $nama_uom = $key['nama'];
            }
        }
        
        $support_name =[];
        $pic = "";

        
        foreach($data_nama as $key) {
            // get data pic
            if ($key['userid'] == $data['pic']) {
                $pic = $key['username'];
             }
             // get data supported by
            if (strpos($data['supported_by'], ',') !== false) {
              $array = explode(',', $data['supported_by']);
              foreach ($array as $value) {
                if ($key['userid'] == $value) {
                    array_push($support_name, $key['username']);
                }
              }
            }
            else{
              if ($key['userid'] == $data['supported_by']) {
                array_push($support_name, $key['username']);
              }
            }                                               
          }
          $support = !empty($support_name) ? implode(', ', $support_name) : '';
                 
        $result[] = array(
            'kode_activity' => $data['kode_activity'],
            'activity' => $data['activity'],
            'pic' => $pic,
            'support' => implode(', ', $support_name),
            'lokasi' => $data['lokasi'],
            'uom' => $nama_uom,
            'target' => $data['target'],
            'estimasi_cost' => $data['estimasi_cost'],
            'start' => date('d-m-Y', strtotime($data['start'])),
            'end' => date('d-m-Y', strtotime($data['end'])),
            'duration' => $data['duration'],
          
            // Tambahkan kolom-kolom lainnya
            // ...
        );
    }
}

// Mengirim hasil pencarian dalam format JSON
header('Content-Type: application/json');
echo json_encode($result);
?>
