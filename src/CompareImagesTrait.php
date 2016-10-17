<?php

namespace Lupka\PHPUnitCompareImages;

trait CompareImagesTrait
{
    /**
     * Perform image comparison assertion
     *
     * @param  Imagick|string  $image1
     * @param  Imagick|string  $image2
     * @param  float  $threshold
     * @return void
     */
    public function assertImageSimilarity($image1, $image2, $threshold = 0)
    {
        $image1 = $this->initImage($image1);
        $image2 = $this->initImage($image2);

        $this->assertLessThanOrEqual($threshold, $this->performCompare($image1, $image2), $MESSAGEHERE);
    }

    /**
     * Check if parameter is Imagick object, if not load from string file path
     *
     * @param  Imagick|string  $image
     * @return Imagick
     */
    private function initImage($image)
    {
        // $image2 = new Imagick($image);
    }

    /**
     * Perform ImageMagick compare, return result float
     *
     * @param  Imagick  $image1
     * @param  Imagick  $image2
     * @return float
     */
    private function performCompare($image1, $image2)
    {
        $result = $image1->compareImages($image2, Imagick::METRIC_MEANSQUAREERROR);
        return $result[0];
    }

}
