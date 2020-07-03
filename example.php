<?php
//ini_set("memory_limit","2048M");
require "vendor/autoload.php";

use Src\point\Point;
use Src\ShortestRoute;

$a = new Point("Home", [0,0]);
$b = new Point("Spaghetti", [1,0]);
$c = new Point("Ravioli", [5,6]);
$d = new Point("Lasagna", [5,6]);
$e = new Point("Linguini", [3,4]);

$gridSize = [12,12];
$fileName = "Makaroni trail";
$folderName = "Box";

$start = new ShortestRoute([$a, $b, $c, $d, $e], $gridSize, $fileName, $folderName);
$start->make();
