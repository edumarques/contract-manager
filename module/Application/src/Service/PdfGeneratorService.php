<?php
declare(strict_types=1);

namespace Application\Service;

use Laminas\Stdlib\Parameters;
use Laminas\View\Model\ViewModel;

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
        $viewModel     = $this->helper->getViewModel($viewVariables, $this->helper->getContractTemplateName());

        return $this->getPdfContent($viewModel);
    }


    /**
     * @param Parameters $parameters
     *
     * @return string
     */
    public function generateReceipt(Parameters $parameters): string
    {
        $viewVariables = $this->helper->parseViewVariablesFromParams($parameters);
        $viewModel     = $this->helper->getViewModel($viewVariables, $this->helper->getReceiptTemplateName());

        return $this->getPdfContent($viewModel);
    }


    /**
     * @param ViewModel $viewModel
     *
     * @return string
     */
    protected function getPdfContent(ViewModel $viewModel): string
    {
        $phpRenderer = $this->helper->getPhpRenderer();
        $html        = $phpRenderer->render($viewModel);
        $domPdfModel = $this->helper->getDomPdfModel($html);

        return $this->helper->getPdfContent($domPdfModel);
    }

}