<?php
class Box
{
    private $length;
    private $width;
    private $height;
    public function __construct($length, $width, $height)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }
    public function getVolume()
    {
        return round($this->length * $this->width * $this->height, 2);
    }
    public function getSurfaceArea()
    {
        $surfaceArea = (2 * $this->length * $this->width) + (2 * $this->length * $this->height)
            + (2 * $this->width * $this->height);
        return round($surfaceArea, 2);
    }
    public function getLateralSurfaceArea()
    {
        $areaBasis = (2 * $this->length * $this->height) + (2 * $this->width * $this->height);
        return round($areaBasis, 2);
    }
    public function __toString()
    {
        return sprintf("Surface Area - %.2f\nLateral Surface Area - %.2f\nVolume - %.2f",
            $this->getSurfaceArea(),
            $this->getLateralSurfaceArea(),
            $this->getVolume());
    }
}
$length = readline();
$width = readline();
$height = readline();
$box = new Box($length, $width, $height);
echo $box;
