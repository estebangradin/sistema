<?php/*
function createWatermarkOnImage ($imagePath, $waterMarkText){
 
    header ("Content-type: image/png");
        
    $font = 200;
    
  //  $width = imagefontwidth($font) * strlen($waterMarkText) ;
    
  //  $height = imagefontheight($font) ;
    
    $image = imagecreatefrompng($imagePath);
    
  //  $x = imagesx($image) - $width - 5 ;
    
   // $y = imagesy($image) - $height - 13;
    
//   $backgroundColor = imagecolorallocate ($image, 255,255,255);
    
    $textColor = imagecolorallocate ($image, 255,0,0);
    
    imagestring ($image, $font, 5, 13, $waterMarkText, $textColor);
    
    imagepng($image);    
    }
     createWatermarkOnImage ('marcador.png', '12');*/
     ?>



<?php
// Cargar la estampa y la foto para aplicarle la marca de agua
$estampa = imagecreatefrompng('marcador.png');
$im = imagecreatefromjpeg('bc.jpeg');

// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
$margen_dcho = 10;
$margen_inf = 10;
$sx = imagesx($estampa);
$sy = imagesy($estampa);

// Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
// ancho de la foto para calcular la posición de la estampa. 
imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));

// Imprimir y liberar memoria
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);

?>