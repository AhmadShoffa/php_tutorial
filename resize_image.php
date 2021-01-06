<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload & Resize Image</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="jumbotron text-center">
        <h3>Upload & Resize Image</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Form Upload</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="newname" class="form-control" placeholder="Nama Baru"><br>
                                <input type="file" name="filename" accept="image/*">
                                <hr>
                                <button class="btn btn-primary" type="submit" name="upload_img">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hasil Upload</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                            function compress($source, $destination, $quality)
                            {
                                $info = getimagesize($source);

                                //menentukan format image
                                if ($info['mime'] == 'image/jpeg') 
                                    $image = imagecreatefromjpeg($source);
                                elseif($info['mime'] == 'image/gif')
                                    $image = imagecreatefromgif($source);
                                elseif($info['mime'] == 'image/png')
                                    $image = imagecreatefrompng($source);
                                
                                //create ulang image
                                imagejpeg($image, $destination, $quality);
                                return $destination;
                            }

                            if (isset($_POST['upload_img']))
                            {
                                //nama baru
                                $newname = $_POST['newname'];
                                $originalname = $_FILES['filename']['name'];
                                $partname = explode(".", $originalname);
                                //extensi file
                                $ext = strtolower(end($partname));
                                //create folder hasil upload
                                $tempdir = "upload/";
                                if (!file_exists($tempdir)) mkdir($tempdir, 0755);

                                //target file
                                //$target_path = $tempdir . basename($_FILES['filename']['name']);
                                $target_path = $tempdir.$newname.".".$ext;

                                $source_img = $_FILES['filename']['tmp_name'];

                                $destination_img = $target_path;

                                //panggil fungsi compress
                                compress($source_img, $destination_img, 65);

                                //tampilkan gambar hasil upload & resize
                                echo "<img src='".$target_path."' class='img-thumbnail'";
                            }
                        ?>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</body>
</html>
