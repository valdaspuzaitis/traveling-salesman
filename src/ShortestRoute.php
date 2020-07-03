<?php

namespace Src;

class ShortestRoute{

    private $points;
    private $routes = [];
    private $distances =[];
    private $gridSize;
    private $startPoint;
    private $routeName;
    private $folderName;

    function __construct(array $points, array $gridSize, $routeName, string $folderName){
        $this->folderName = $folderName;
        $this->routeName = $routeName;
        $this->startPoint = $points[0];
        $this->gridSize = $gridSize;
        foreach($points as $point){
            $this->points[$point->getName()] = $point;
        }
    }

    public function make()
    {
        $this->allPossibleRoutes($this->points, $this->startPoint);    
        
        $this->distanceCalculation();
        
        $this->create($this->clean($this->distances)[0]);
    }

    /**
     * Rekursive function for generating all possible route tree.
     */
    private function allPossibleRoutes(array $points, \Src\point\Point $startPoint, array $list = [])
    {
        $list[] = $startPoint->getName();
        unset($points[$startPoint->getName()]);
        if(empty($points)){
            $this->routes[] = $list;
        }
        foreach($points as $nextCity){
            $this->allPossibleRoutes($points, $nextCity, $list);
        }
    }

    /**
     * Calculates distances of all routes.
     */
    private function distanceCalculation()
    {
        foreach($this->routes as $route){
            $distance = [];
            for($i = 0; $i < count($route); $i++){
                if($i == count($route)-1){
                    $distance[] = [$route[$i], $this->points[$route[$i]]->distanceTo($this->startPoint)];
                } else {
                    $distance[] = [$route[$i], $this->points[$route[$i]]->distanceTo($this->points[$route[$i+1]])];
                }
            }
            $distance["sum"] = $this->routeLength($distance);
            $this->distances[] = $distance;
        }
    }

    private function routeLength(array $distance)
    {
        $length = 0;
        foreach($distance as $section){
            $length += $section[1];
        }
        return $length;
    }

    /**
     * Sorts values from smallest and removes doubles.
     */
    private function clean(array $distances){
        usort($distances, function($a, $b){return $a['sum']<=>$b['sum'];});
        for ($i = 1; isset($distances[$i]); $i += 2) { 
            unset($distances[$i]);
        }
        return $distances;
    }

    /**
     * Creates SVG file from given coordinates.
     */
    private function create(array $coordinates){
        $vectorCoordinates = [];
        foreach($coordinates as $key => $coord){
            if($key !== 'sum'){
                $vectorCoordinates[] = $this->points[$coord[0]]->getCoordinates();
            }
        }

        $formedCoordinates = "";
        foreach($vectorCoordinates as $coordinate){
            $formedCoordinates .= $this->coordinateConvert($coordinate);
        }
        $formedCoordinates .= $this->coordinateConvert($vectorCoordinates[0]);

        \Src\createFiles\WriteSVG::create($formedCoordinates, $vectorCoordinates[0], $this->gridSize, $this->routeName."-". $this->distances[0]["sum"], $this->folderName);
    }

    private function coordinateConvert(array $coordinate): string{
        return implode(",", $coordinate).' ';
    }
}
