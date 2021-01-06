<html>
<head>
    <title>Generate QR Code dengan PHP</title>
</head>
<body>
    <h3>Membuat QR Code</h3>
    <?php
        include "phpqrcode/qrlib.php";    // Ini adalah letak pemyimpanan plugin qrcode
        $tempdir = "qr_img/";        // Nama folder untuk pemyimpanan file qrcode
        
        if (!file_exists($tempdir))        //jika folder belum ada, maka buat
        mkdir($tempdir);
        
            // berikut adalah parameter qr code
            $teks_qrcode    = "1234567890";
            $namafile       = $teks_qrcode.".png";
            $quality        ="H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
            $ukuran         =5; // 1 adalah yang terkecil, 10 paling besar
            $padding        =1;
            
            QRCode::png($teks_qrcode, $tempdir.$namafile, $quality, $ukuran, $padding);
    ?>
</body>
</html>
