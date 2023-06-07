<?php
// Mengambil query pencarian dari parameter GET
$query = $_GET['q'];

// Melakukan pencarian data sesuai dengan query
include('proses/koneksi.php');
$sql = "SELECT * FROM db_target_activity WHERE activity LIKE '%$query%'";
$query = mysqli_query($db, $sql);

// Membuat array untuk menampung hasil pencarian
$result = array();

if ($query->num_rows > 0) {
    while ($data = mysqli_fetch_array($query)) {
        // Menambahkan data hasil pencarian ke dalam array
        $result[] = array(
            'kode_activity' => $data['kode_activity'],
            'activity' => $data['activity'],
            'pic' => $data['pic'],
            'support' => $data['supported_by'],
            'lokasi' => $data['lokasi'],
            'uom' => $data['uom'],
            'target' => $data['target'],
            'estimasi_cost' => $data['estimasi_cost'],
            'start' => $data['start'],
            'end' => $data['end'],
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
