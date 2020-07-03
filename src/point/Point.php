<?php
namespace Src\point;

class Point implements PointInterface
{
    private $name;
    private $X;
    private $Y;

    function __construct(string $name, array $coordinates)
    {
        $this->name = $name;
        $this->X = $coordinates[0];
        $this->Y = $coordinates[1];
    }

    function distanceTo(PointInterface $pointTo): float
    {
        return \Src\distance\Distance::calculateDistance($pointTo->getCoordinates(),[$this->X, $this->Y]);
    }

    function getName(): string
    {
        return $this->name;
    }

    function getCoordinates(): array
    {
        return [$this->X, $this->Y];
    }
}
