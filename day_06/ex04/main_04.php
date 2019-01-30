<?php
/* ************************************************************************** */
/*                                                                            */
/*                 main_04.php for J06                                        */
/*                 Created on : Mon Mar 31 17:37:41 2014                      */
/*                 Made by : David "Thor" GIRON <thor@42.fr>                  */
/*                                                                            */
/* ************************************************************************** */


require_once 'Vertex.class.php';
require_once 'Vector.class.php';
require_once 'Matrix.class.php';
require_once 'Camera.class.php';

Vertex::$verbose = False;
Vector::$verbose = False;
Matrix::$verbose = False;

print( Camera::doc() );
Camera::$verbose = True;

$vtxO = new Vertex( array( 'x' => 0, 'y' => 0, 'z' => 0.0 ) );
$R    = new Matrix( array( 'preset' => Matrix::RY, 'angle' => M_PI ) );
$cam  = new Camera( array( 'origin' => $vtxO,
						   'orientation' => $R,
						   'width' => 640,
						   'height' => 480,
						   'fov' => 60,
						   'near' => 1.0,
						   'far' => 100.0) );

print( $cam . PHP_EOL );
$V = new Vertex( array( 'x' => -1, 'y' => 10, 'z' => 0 ) );
$a = $cam->watchVertex($V);
echo("$a\n");
?>
