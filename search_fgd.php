<?php
// Mengambil query pencarian dari parameter GET
$query = $_GET['q'];

// Melakukan pencarian data sesuai dengan query
include('proses/koneksi.php');

$sql = "SELECT * FROM db_fgd WHERE nama_fgd LIKE '%$query%'";
$query = mysqli_query($db, $sql);

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


// Membuat array untuk menampung hasil pencarian
$result = array();

if ($query->num_rows > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $team =[];
        $pic = "";
        foreach($data_nama as $key) {
            // get data pic
            if ($key['userid'] == $data['pic']) {
                $pic = $key['username'];
                }
                // get data supported by
            if (strpos($data['team'], ',') !== false) {
                $array = explode(',', $data['team']);
                foreach ($array as $value) {
                if ($key['userid'] == $value) {
                    array_push($team, $key['username']);
                }
                }
            }
            else{
                if ($key['userid'] == $data['team']) {
                array_push($team, $key['username']);
                }
            }                                               
        }
        $support = !empty($team) ? implode(', ', $team) : '';
            
        $result[] = array(
            'kode_fgd' => $data['kode_fgd'],
            'tahun_fgd' => $data['tahun_fgd'],
            'nama_fgd' => $data['nama_fgd'],
            'pic' => $pic,
            'team' => implode(', ', $team),
        );
    }
}

// Mengirim hasil pencarian dalam format JSON
header('Content-Type: application/json');
echo json_encode($result);
?>
