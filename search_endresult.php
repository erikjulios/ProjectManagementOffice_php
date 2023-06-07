<?php
// Mengambil query pencarian dari parameter GET
$query = $_GET['q'];

// Melakukan pencarian data sesuai dengan query
include('proses/koneksi.php');
$sql = "SELECT * FROM db_target_end_result WHERE end_result LIKE '%$query%'";
$query = mysqli_query($db, $sql);

// Membuat array untuk menampung hasil pencarian
$result = array();

if ($query->num_rows > 0) {
    while ($data = mysqli_fetch_array($query)) {
        // Menambahkan data hasil pencarian ke dalam array
        $result[] = array(
            'kode_endresult' => $data['kode_endresult'],
            'end_result' => $data['end_result'],
            'uom' => $data['uom'],
            'estimate_cost' => $data['estimate_cost'],
            'start' => $data['start'],
            'end' => $data['end'],
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
