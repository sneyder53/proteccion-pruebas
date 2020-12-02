<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BackendController extends AbstractController
{

    public function upload(Request $request ){
        $json = $request->get("image", null);
        $file = $request->files->get("image");
        $alto = 1123;
        $ancho = 796;
		$data = array(
			"status" => "error",
			"code" => 400,
			"msg" => "image not upload"
		);
		$em = $this->getDoctrine()->getManager();
		
		
		if(!empty($file)){
			$ext = $file->guessExtension();
			if ($ext == "jpg" || $ext == "JPG" || $ext == "jpeg" || $ext == "JPEG") {
                    $file_name = time() . "." . $ext;
                    $file->move("uploads", $file_name);
                    $tipo = "";
                    $altoImagen = 0;
                    $anchoImagen = 0;
                    list($width, $height, $type, $attr) = getimagesize("uploads/$file_name");
                    $imagennew=imagecreatetruecolor($ancho,$alto);

                    if($height <= $alto){
                        if($width <= $ancho){
                            $tipo = "Vertical";
                            list($anchoImagen, $altoImagen, $type, $attr) = getimagesize("uploads/$file_name");
                        }else{
                            $tipo = "Horizontal";
                            $alto = 796;
                            $ancho = 1123;
                            $original = imagecreatefromjpeg("uploads/$file_name");
                            $x_ratio = $ancho / $width;
                            $y_ratio = $alto / $height;
                            // Nueva altura y ancho
                            if(($x_ratio * $height) < $alto){
                                $newHeight = ceil($x_ratio * $height);
                                $newWidth = $ancho;
                            }else{
                                $newWidth = ceil($y_ratio * $width);
                                $newHeight = $alto;
                            }
                            $imagennew=imagecreatetruecolor($newWidth,$newHeight);
                            imagecopyresampled($imagennew,$original,0,0,0,0,$newWidth, $newHeight,$width,$height);
                            imagejpeg($imagennew,"uploads/".$file_name);
                            list($anchoImagen, $altoImagen, $type, $attr) = getimagesize("uploads/$file_name");
                        }
                    }else{
                        $tipo = "Vertical";
                            $original = imagecreatefromjpeg("uploads/$file_name");
                            $x_ratio = $ancho / $width;
                            $y_ratio = $alto / $height;
                            // Nueva altura y ancho
                            if(($x_ratio * $height) < $alto){
                                $newHeight = ceil($x_ratio * $height);
                                $newWidth = $ancho;
                            }else{
                                $newWidth = ceil($y_ratio * $width);
                                $newHeight = $alto;
                            }
                            $imagennew=imagecreatetruecolor($newWidth,$newHeight);
                            imagecopyresampled($imagennew,$original,0,0,0,0,$newWidth, $newHeight,$width,$height);
                            imagejpeg($imagennew,"uploads/".$file_name);
                            list($anchoImagen, $altoImagen, $type, $attr) = getimagesize("uploads/$file_name");
                    }

					$data = array(
						"status" => "success",
                        "code" => 200,
                        "tipo" => $tipo ,
                        "alto" => $altoImagen,
                        "ancho" => $anchoImagen,
                        "nombre"=>$file_name,
						"msg" => "La imagen de usuario fue cargada correctamente"
					);
				} else {
					$data = array(
						"status" => "error",
						"code" => 400,
						"msg" => "image doesn't format!!"
					);
				}
			
		}
		return $this->json($data);
    }
}
