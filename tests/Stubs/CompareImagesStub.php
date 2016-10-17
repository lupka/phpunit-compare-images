<?php

namespace Lupka\PHPUnitCompareImages\Stubs;

use PHPUnit_Framework_TestCase;
use Lupka\PHPUnitCompareImages\CompareImagesTrait;

class CompareImagesStub extends PHPUnit_Framework_TestCase
{
    use CompareImagesTrait;

    /**
     * Since all of the assertions are protected methods, this allows access to them.
     *
     * @param string $method_name
     * @param array  $args
     *
     * @return mixed
     */
    public function callProtectedMethod($methodName, array $args = [])
    {
        $reflection = new \ReflectionClass(get_class($this));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($this, $args);
    }
}
