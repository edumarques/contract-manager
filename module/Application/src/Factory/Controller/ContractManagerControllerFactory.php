<?php
declare(strict_types=1);

namespace Application\Factory\Controller;

use Application\Controller\ContractManagerController;
use Application\Service\PdfGeneratorService;
use Interop\Container\ContainerInterface;
use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * @codeCoverageIgnore
 */
class ContractManagerControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): ContractManagerController
    {
        return new ContractManagerController(
            $container->get(TranslatorInterface::class),
            $container->get(PdfGeneratorService::class)
        );
    }

}