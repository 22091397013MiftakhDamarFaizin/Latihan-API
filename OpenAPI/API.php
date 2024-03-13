<?php
    include "conn.php";

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {

        case "GET":
            $sql = "SELECT * FROM data_mahasiswa";
            $query = mysqli_query($conn, $sql);
            $item = array();
            while($data = mysqli_fetch_array($query)) {
               $item[] = array(
                'NIM' => $data["NIM"],
                'Nama' => $data["Nama"],
                'Prodi' => $data["Prodi"]
               );

               $response = array(
                'data' => $item
            );
            }
            echo json_encode($response);
             break;
        
        case "POST":
            $NIM = isset($_POST["NIM"]) ? $_POST["NIM"]: "";
            $Nama = isset($_POST['Nama']) ? $_POST['Nama']: "";
            $Prodi = isset($_POST['Prodi']) ? $_POST['Prodi']: "";

            //Query menambahkan data

            $sql = "INSERT INTO `data_mahasiswa` (`NIM`, `Nama`, `Prodi`) VALUES ('$NIM', '$Nama', '$Prodi')";
            echo $sql;

            //Running Query
            if (mysqli_query($conn, $sql)) {
                $response = array('status' => 'OK', 'message' => 'Data berhasil ditambahkan.');
            } else {
                $response = array('status' => 'Error', 'message' => 'Gagal menambahkan data: ' . mysqli_error($conn));
            }

            echo json_encode($response);
            break;
        
        case "PUT":
            $data = json_decode(file_get_contents('php://input'), true);
            $NIM = $data['NIM'];
            $Nama = $data['Nama'];
            $Prodi = $data['Prodi'];

            $sql = "UPDATE data_mahasiswa SET Nama='$Nama', Prodi='$Prodi' WHERE NIM=$NIM";
            if (mysqli_query($conn, $sql)) {
                $response = array('status' => 'OK', 'message' => 'Data berhasil diperbarui.');
            } else {
                $response = array('status' => 'Error', 'message' => 'Gagal memperbarui data: ' . mysqli_error($conn));
            }

            echo json_encode($response);
            break;

        case "DELETE":
            $NIM = $_GET['NIM'] ?? null;

            $sql = "DELETE FROM data_mahasiswa WHERE NIM=$NIM";
            if (mysqli_query($conn, $sql)) {
                $response = array('status' => 'OK', 'message' => 'Data berhasil dihapus.');
            } else {
                $response = array('status' => 'Error', 'message' => 'Gagal menghapus data: ' . mysqli_error($conn));
            }

            echo json_encode($response);
            break;

        }
?>