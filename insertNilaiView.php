<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Nilai Baru</h2>
                    </div>
                    <p>Please fill this form and submit to add student score to the database.</p>
                    <form action="insertNilaiDo.php" method="post">
                        <div class="form-group">
                            <label>NIM</label>
                            <select id="nim" name="nim" class="form-control">
                                <option value="sv_001">sv_001</option>
                                <option value="sv_002">sv_002</option>
                                <option value="sv_003">sv_003</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kode MK</label>
                            <select id="kode_mk" name="kode_mk" class="form-control">
                                <option value="svpl_001">svpl_001</option>
                                <option value="svpl_002">svpl_002</option>
                                <option value="svpl_003">svpl_003</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="text" name="nilai" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>