<?php

namespace Lupka\PHPUnitCompareImages;

use Imagick;
use Exception;

trait CompareImagesTrait
{
    /**
     * Perform image similarity assertion
     *
     * @param  Imagick|string  $image1
     * @param  Imagick|string  $image2
     * @param  float  $threshold
     * @param  string $message
     * @return void
     */
    public function assertImageSimilarity($image1, $image2, $threshold = 0, $message = 'Images are not within similarity threshold.')
    {
        $image1 = $this->initImage($image1);
        $image2 = $this->initImage($image2);

        $this->assertLessThanOrEqual($threshold, $this->performCompare($image1, $image2), $message);
    }

    /**
     * Perform image different assertion (opposite of assertImageSimilarity)
     *
     * @param  Imagick|string  $image1
     * @param  Imagick|string  $image2
     * @param  float  $threshold
     * @param  string $message
     * @return void
     */
    public function assertImageDifference($image1, $image2, $threshold = 0, $message = 'Images are not above difference threshold.')
    {
        $image1 = $this->initImage($image1);
        $image2 = $this->initImage($image2);

        $this->assertGreaterThan($threshold, $this->performCompare($image1, $image2), $message);
    }

    /**
     * Shortcut to test that images are exactly the same
     *
     * @param  Imagick|string  $image1
     * @param  Imagick|string  $image2
     * @return void
     */
    public function assertImagesSame($image1, $image2)
    {
        $this->assertImageSimilarity($image1, $image2, 0, 'Images are not the same.');
    }

    /**
     * Shortcut to test that images are different
     *
     * @param  Imagick|string  $image1
     * @param  Imagick|string  $image2
     * @return void
     */
    public function assertImagesDifferent($image1, $image2)
    {
        $this->assertImageDifference($image1, $image2, 0, 'Images are not different.');
    }

    /**
     * Check if parameter is Imagick object, if not load from string file path
     *
     * @param  Imagick|string  $image
     * @return Imagick
     */
    private function initImage($image)
    {
        if(is_string($image))
        {
            return new Imagick($image);
        }
        elseif ($image instanceof Imagick)
        {
            return $image;
        }
        else
        {
            throw new Exception('Image input must be Imagick object or string path ('.gettype($image).' sent)');
        }
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
        return $result[1];
    }

}
