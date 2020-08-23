<?php
declare(strict_types=1);

namespace Application\Service;

use Laminas\Stdlib\Parameters;

class PdfGeneratorService
{
    protected PdfGeneratorServiceHelper $helper;


    /**
     * @param PdfGeneratorServiceHelper $helper
     */
    public function __construct(PdfGeneratorServiceHelper $helper)
    {
        $this->helper = $helper;
    }


    /**
     * @param Parameters $parameters
     *
     * @return string
     */
    public function generateContract(Parameters $parameters): string
    {
        $viewVariables = $this->helper->parseViewVariablesFromParams($parameters);
//        var_dump($viewVariables);die;
        $viewModel     = $this->helper->getViewModel($viewVariables);
        $phpRenderer   = $this->helper->getPhpRenderer();
        $html          = $phpRenderer->render($viewModel);
        $domPdfModel   = $this->helper->getDomPdfModel($html);

        return $this->helper->getPdfContent($domPdfModel);
    }

}