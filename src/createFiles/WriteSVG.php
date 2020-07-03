<?php

namespace Src\createFiles;

class WriteSVG
{
    static function create(string $coordinates, array $startCoords, array $gridSize, string $distance, string $dir)
    {
        $data = '<?xml version="1.0" encoding="UTF-8"?>
                <svg version="1.1" viewBox="0 0 '.$gridSize[0].' '.$gridSize[1].'">
                <polyline points="'.$coordinates.'" fill="none" stroke="black" stroke-width="0.1" />
                <circle cx="'.$startCoords[0].'" cy="'.$startCoords[1].'" r="0.2" fill="green" stroke-width="0.1"/>
                </svg>';

        if( !file_exists( $dir ) && !is_dir( $dir ) ) {
            if(!mkdir( $dir )){
                /**
                 * Here you can define a message if creating directory failed
                 */
                echo('Unable to write to '.$dir.' folder.');
                exit();
            }
        }

        $filePath = $dir."/".$distance.".svg";
        file_put_contents ($filePath , $data);
    }
}
