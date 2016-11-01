<?php

use Lupka\PHPUnitCompareImages\Stubs\CompareImagesStub as CompareImages;

class CompareImagesTraitTest extends PHPUnit_Framework_TestCase
{
    public function testImageStringInit()
    {
        $compareImages = new CompareImages();
        $image = $compareImages->callProtectedMethod('initImage', ['tests/images/default.jpg']);
        $this->assertInstanceOf('Imagick', $image);
    }

    public function testImageImagickInit()
    {
        $compareImages = new CompareImages();
        $image = $compareImages->callProtectedMethod('initImage', [new Imagick('tests/images/default.jpg')]);
        $this->assertInstanceOf('Imagick', $image);
    }

    public function testImageInvalidInit()
    {
        $this->expectException(Exception::class);

        $compareImages = new CompareImages();
        $image = $compareImages->callProtectedMethod('initImage', [3.134]);
    }

    public function testPerformCompare()
    {
        $compareImages = new CompareImages();

        $image1 = $compareImages->callProtectedMethod('initImage', [new Imagick('tests/images/default.jpg')]);
        $image2 = $compareImages->callProtectedMethod('initImage', [new Imagick('tests/images/same.jpg')]);
        $image3 = $compareImages->callProtectedMethod('initImage', [new Imagick('tests/images/different.jpg')]);

        $expectedEqual = $compareImages->callProtectedMethod('performCompare', [$image1, $image2]);
        $expectedDifferent = $compareImages->callProtectedMethod('performCompare', [$image1, $image3]);

        $this->assertEquals(0, $expectedEqual);
        $this->assertGreaterThan(0, $expectedDifferent);
    }

    public function testAssertImageSimilarity()
    {
        $compareImages = new CompareImages();

        $compareImages->assertImageSimilarity('tests/images/default.jpg', 'tests/images/same.jpg', 0);

        try {
            $compareImages->assertImageSimilarity('tests/images/default.jpg', 'tests/images/different.jpg', 0);
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            return;
        }
        $this->fail();
    }

    public function testAssertImagesSame()
    {
        $compareImages = new CompareImages();

        $compareImages->assertImagesSame('tests/images/default.jpg', 'tests/images/same.jpg');

        try {
            $compareImages->assertImagesSame('tests/images/default.jpg', 'tests/images/different.jpg');
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            return;
        }
        $this->fail();
    }

    public function testAssertImageDifference()
    {
        $compareImages = new CompareImages();

        $compareImages->assertImageDifference('tests/images/default.jpg', 'tests/images/different.jpg', 0.1);

        try {
            $compareImages->assertImageDifference('tests/images/default.jpg', 'tests/images/same.jpg', 0.1);
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            return;
        }
        $this->fail();
    }

    public function testAssertImagesDifferent()
    {
        $compareImages = new CompareImages();

        $compareImages->assertImagesDifferent('tests/images/default.jpg', 'tests/images/different.jpg');

        try {
            $compareImages->assertImagesDifferent('tests/images/default.jpg', 'tests/images/same.jpg');
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            return;
        }
        $this->fail();
    }

}
