<!DOCTYPE html>
<html lang="en">
<head>
  <title>ImgBB Ajax</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    function upload_img(){
        $('.message').html('Processing ..<br/>');
        var key = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
        var file = document.getElementById('input_img');
        var form = new FormData();
        form.append("image", file.files[0]);

        var upload = {
            "url": "https://api.imgbb.com/1/upload?key="+key,
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };

        $.ajax(upload).done(function (response) {
            $('.message').html('Done ..<br/>');
            let data = JSON.parse(response);
            $('.output').html(`<img src="${data.data.display_url}" class="img-thumbnail"/>`);
            console.log(data);
        });

        return false;
    };  
  </script>
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
                        <div class="form-group">
                            <input type="file" id="input_img" accept="image/*">
                            <button class="btn btn-primary" onclick="upload_img()">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hasil Upload</h3>
                    </div>
                    <div class="panel-body">
                        <div class="message"></div>
                        <div class="output"></div>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</body>
</html>
