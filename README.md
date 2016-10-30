# PHPUnit Compare Images

PHPUnit assertions for assessing image similarity.

## Installation

```
composer require lupka/phpunit-compare-images
```

## Usage

Add the `CompareImagesTrait` trait to enable the use of the assertions.

```php
<?php
use Lupka\PHPUnitCompareImages\CompareImagesTrait;

class YourTestCase extends PHPUnit_Framework_TestCase
{
    use CompareImagesTrait;

    ...
}
```

### Assertions

This package includes several assertions.

The first two parameters of each assertion are the images to be compared, which can either be Imagick objects or string file paths.

#### assertImageSimilarity

```
assertImageSimilarity($image1, $image2, $threshold = 0)
```

Will fail if the two images are not within the given similarity threshold.

#### assertImageDifference

```
assertImageDifference($image1, $image2, $threshold = 0)
```

Will fail if the two images are within the given similarity threshold.

#### assertImagesSame

```
assertImagesSame($image1, $image2)
```

Will fail if the two images are not exactly the same.

#### assertImagesDifferent

```
assertImagesDifferent($image1, $image2)
```

Will fail if the two images are exactly the same.

## Notes/Links

* PHP.net Imagick Compare docs: http://php.net/manual/en/imagick.compareimages.php
