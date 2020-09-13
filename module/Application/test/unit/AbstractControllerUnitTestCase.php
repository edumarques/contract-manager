<?php
declare(strict_types=1);

namespace ApplicationUnitTest;

use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\Controller\Plugin\Url;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

abstract class AbstractControllerUnitTestCase extends TestCase
{
    /**
     * @param AbstractController $controller
     *
     * @return MockObject|Url
     */
    protected function createMockForUrlPlugin(AbstractController $controller): MockObject
    {
        $urlPlugin = $this->createMock(Url::class);
        $controller->getPluginManager()->setService('url', $urlPlugin);

        return $urlPlugin;
    }

}