<?php
declare(strict_types=1);

namespace Application\Controller;

use Application\Model\Form\NewContractForm;
use Application\Service\PdfGeneratorService;
use Laminas\Http\PhpEnvironment\Response;
use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\View\Model\ViewModel;

final class ContractManagerController extends AppAbstractActionController
{
    private TranslatorInterface $translator;

    private PdfGeneratorService $pdfGeneratorService;


    /**
     * @param TranslatorInterface $translator
     * @param PdfGeneratorService $pdfGeneratorService
     */
    public function __construct(TranslatorInterface $translator, PdfGeneratorService $pdfGeneratorService)
    {
        $this->translator          = $translator;
        $this->pdfGeneratorService = $pdfGeneratorService;
    }


    /**
     * @return ViewModel
     */
    public function newAction(): ViewModel
    {
        $newContractForm = NewContractForm::create($this->translator);

        $view = new ViewModel();
        $view->setVariable('newContractForm', $newContractForm);

        return $view;
    }


    /**
     * @return Response
     */
    public function generateAction(): Response
    {
        $request  = $this->getRequest();
        $response = $this->getResponse();

        $response->setStatusCode(Response::STATUS_CODE_405);
        $response->setContent('HTTP method not allowed');

        if ($request->isPost() === false) {
            return $response;
        }

        $postParams = $request->getPost();
        $pdfContent = null;
        $filename   = null;

        if ($postParams->get(NewContractForm::BUTTON_GENERATE_CONTRACT) !== null) {
            $pdfContent = $this->pdfGeneratorService->generateContract($postParams);
            $filename   = $this->translator->translate('contract') . '_'
                          . str_replace(' ', '', $postParams->get(NewContractForm::FIELD_CUSTOMER_NAME, uniqid()));
        }

        if ($postParams->get(NewContractForm::BUTTON_GENERATE_RECEIPT) !== null) {
            $pdfContent = $this->pdfGeneratorService->generateReceipt($postParams);
            $filename   = $this->translator->translate('receipt') . '_'
                          . str_replace(' ', '', $postParams->get(NewContractForm::FIELD_CUSTOMER_NAME, uniqid()));
        }

        if (isset($pdfContent)) {
            $response->setStatusCode(Response::STATUS_CODE_200);
            $response->setContent($pdfContent);
            $headers = $response->getHeaders();
            $headers->addHeaderLine('content-type: application/pdf');
            $headers->addHeaderLine("content-disposition: attachment; filename=$filename.pdf");
        }

        return $response;
    }

}