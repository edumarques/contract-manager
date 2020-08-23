<?php
declare(strict_types=1);

namespace Application\Factory\Service;

use Application\Service\PdfGeneratorService;
use Application\Service\PdfGeneratorServiceHelper;
use Interop\Container\ContainerInterface;
use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * @codeCoverageIgnore
 */
class ContractManagerServiceFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): PdfGeneratorService
    {
        return new PdfGeneratorService(
            $container->get(PdfGeneratorServiceHelper::class)
        );
    }

}