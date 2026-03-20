<?php
$cellSize = $_GET['cell_size'] ?? 50;
$base_image = file_get_contents('./original.jpg');
$gdImage = imagecreatefromjpeg('./original.jpg');
imagefilter($gdImage, IMG_FILTER_PIXELATE, $cellSize);

// Output the image to browser
header('Content-Type: image/gif');
imagegif($gdImage);
return null;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Mosaic</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
        }

        img {
            width: 350px;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="original.jpg" alt="Mosaic image with pixelations defined on url">
</div>
</body>
</html>