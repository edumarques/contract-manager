<?php
declare(strict_types=1);

namespace Application\Factory\Controller;

use Application\Controller\IndexController;
use Interop\Container\ContainerInterface;
use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * @codeCoverageIgnore
 */
class IndexControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): IndexController
    {
        return new IndexController(
            $container->get(TranslatorInterface::class)
        );
    }

}