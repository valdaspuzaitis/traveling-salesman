<?php

namespace Src\point;

interface PointInterface {
    public function distanceTo(PointInterface $point): float;
    public function getName(): string;
    public function getCoordinates(): array;
}
