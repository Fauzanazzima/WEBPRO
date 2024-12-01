<?php
include "../config.php"; //koneksi ke data base

//data akan disimpan ketika tombol simpan di tekan
if(isset($_POST['btnSimpan'])) {
    $id = $_POST["id"];
    $user_id = $_POST["user_id"];
    $nama = $_POST["nama"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $amount_saved = $_POST["amount_saved"];
    $target_amount = $_POST["target_amount"];

    //query untuk menyimpan data ke database
    $sqlStatment= "INSERT INTO savings (id, user_id, nama, startDate, end_date, amount_saved, target_amount) 
        VALUES ('$id', '$user_id', '$nama', '$startDate', '$endDate', $amount_saved, '$target_amount')";
    $query = mysqli_query($conn,$sqlStatement);

    if(mysqli_query($conn, $sqlStatement)){
        header("location:indexsaving.php");
    } else {
        $errMsg = "Penambahan Tabungan dengan nama tabungan" .$name. "GAGAL!" .mysqli_error($conn);
    };

    mysqli_close($conn);
};

//header halaman
include "../mainheader2.php";
?>
<div class="row mt-3 mb-4 text-center">
    <div class="col-md-6">
        <h4>Tambah Tabungan</h4>
    </div>
</div>
    <?php 
    if(isset($errMsg)):
            ?>
            <div class="alert alert-danger" role="alert">
                <?=$errMsg; ?>
            </div>
        <?php 
        endif;
         ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100px;
            padding: 20px;
        }
        .table-form {
            width: 100%;
            max-width: 600px;
            border:1px;
            padding: 20px;
            border-radius:8px;
            box-shadow:0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table td, .table th{
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="form-container">
    <form action="addsaving.php" method="POST" enctype="multipart/form-data" class="table-form">
        <table class="table table-bordered">    
            <div class="mb-1 row">
                <div class="col-2">
                    <label for="id" class="form-label">ID</label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" id="id" name="id" size="10">
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-2">
                    <label for="user_id" class="form-label">User ID</label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" id="user_id" name="user_id" size="10">
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-2">
                    <label for="name" class="form-label">Nama Tabungan</label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" size="10">
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-2">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" id="start_date" name="startDate" size="10">
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-2">
                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" id="endDate" name="end_date" size="10">
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-2">
                    <label for="amount_saved" class="form-label">Jumlah Tabungan</label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" id="amount_saved" name="amount_saved" size="10">
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-2">
                    <label for="target_amount" class="form-label">Target Tabungan</label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" id="target_amount" name="target_amount" size="10">
                </div>
            </div>
            <div class="mt-4 row">
                <div class="col-auto">
                    <input type="submit" class="btn btn-success" name="btnSimpan" value="Simpan">
                        <input type="reset" class="btn btn-danger" value="Ulangi">
                            <a href="<?=HOST . "/Savings/"?>"  class="btn btn-secondary">Kembali</a>      
                </div>
            </div>
        </table>
    </form>
</div>
</body>
</html>
<?php
include "../mainfooter.php";
?>
