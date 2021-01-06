<!DOCTYPE html>
<html lang="en">
<head>
  <title>ImgBB PHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="jumbotron text-center">
        <h3>ImgBB Ajax</h3>
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
                                <input type="file" name="input_img" accept="image/*">
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
                            function save_record_image($image,$name = null){
                                $api_key = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload?key='.$api_key);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                                $extension = pathinfo($image['name'],PATHINFO_EXTENSION);
                                $file_name = ($name)? $name.'.'.$extension : $image['name'] ;
                                $data = array('image' => base64_encode(file_get_contents($image['tmp_name'])), 'name' => $file_name);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                                $result = curl_exec($ch);
                                if (curl_errno($ch)) {
                                    return 'Error:' . curl_error($ch);
                                }else{
                                    return json_decode($result, true);
                                }
                                curl_close($ch);
                            }

                            if (!empty($_FILES['input_img'])) {
                                $return = save_record_image($_FILES['input_img'],'test');
                                echo "<img src='".$return['data']['display_url']."' class='img-thumbnail'";
                            }
                        ?>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</body>
</html>
