<?php
// Mengambil query pencarian dari parameter GET
$query = $_GET['q'];

// Melakukan pencarian data sesuai dengan query
include('proses/koneksi.php');
$get_uom = "SELECT * FROM uom";
$query_uom = mysqli_query($db, $get_uom);

// Membuat array untuk menampung hasil pencarian
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

$sql = "SELECT * FROM db_target_end_result WHERE end_result LIKE '%$query%'";
$query = mysqli_query($db, $sql);

// Membuat array untuk menampung hasil pencarian
$result = array();
$nama_uom = "";

if ($query->num_rows > 0) {
    while ($data = mysqli_fetch_array($query)) {
        foreach ($data_uom as $key) {
            if ($key['id'] == $data['uom']) {
                $nama_uom = $key['nama'];
            }
        }
        $result[] = array(
            'kode_endresult' => $data['kode_endresult'],
            'end_result' => $data['end_result'],
            'uom' => $nama_uom,
            'estimate_cost' => $data['estimate_cost'],
            'start' => date('d-m-Y', strtotime($data['start'])),
            'end' => date('d-m-Y', strtotime($data['end'])),
            'duration' => $data['duration'],
            'asis' => $data['asis'],
            'tube' => $data['tube'],
            // Tambahkan kolom-kolom lainnya
            // ...
        );
    }
}

// Mengirim hasil pencarian dalam format JSON
header('Content-Type: application/json');
echo json_encode($result);
?>
