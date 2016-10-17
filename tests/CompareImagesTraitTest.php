<?php

use Lupka\PHPUnitCompareImages\Stubs\CompareImagesStub as CompareImages;

class CompareImagesTraitTest extends PHPUnit_Framework_TestCase
{
    public function testImageStringInit()
    {
        $compareImages = new CompareImages();
        $image = $compareImages->initImage('');
    }
}
