<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$judul = $isi = $kategori = "";
$judul_err = $isi_err = $kategori_err ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate judul
    $input_judul = trim($_POST["Judul"]);
    if(empty($input_judul)){
        $judul_err = "Isi Judul notes";
    } else{
        $judul = $input_judul;
    }

    // Validate isi notes
    $input_isi = trim($_POST["Isi"]);
    if(empty($input_isi)){
        $isi_err = "Isi Notesnya";
    } else{
        $isi = $input_isi;
    }

     // Validate nama kategori
     $input_kategori = trim($_POST["Kategori"]);
     if(empty($input_kategori)){
         $kategori_err = "Isi Kategori";
     } else{
         $kategori = $input_kategori;
     }

    // Check input errors before inserting in database
    if(empty($judul_err) && empty($isi_err) && empty($kategorit_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO tabel_notes (judul, isi, kategori) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_judul, $param_isi, $param_kategori );

            // Set parameters
            $param_judul = $judul;
            $param_isi = $isi;
            $param_kategori = $kategori;
            
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: home.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NOTES</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<!-- menambah file include -->
<!--?php include 'home.php';?-->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Notes V.2</h2>
                    </div>
                    <p>Isi catatan baru untuk disimpan kedalam database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                                <label>Judul</label>
                            <input type="text" name="Judul" class="form-control" value="<?php echo $judul; ?>">
                            <span class="help-block"><?php echo $judul_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($isi_err)) ? 'has-error' : ''; ?>">
                            <label>Isi Notes</label>
                            <textarea type="text" name="Isi" class="form-control" value="<?php echo $isi; ?>"></textarea>
                            <span class="help-block"><?php echo $isi_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($kategori_err)) ? 'has-error' : ''; ?>">
                            <label>Kategori</label>
                            <input type="text" name="Kategori" class="form-control" value="<?php echo $kategori; ?>">
                            <span class="help-block"><?php echo $kategori_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="SAVE">
                        <a href="tampil.php" class="btn btn-success">TAMPIL</a>
                        <a href="home.php" class="btn btn-warning">BERSIH</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

