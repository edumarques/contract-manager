<?php
declare(strict_types=1);

namespace Application\Service;

use Application\Model\Contract\Contract;
use Application\Model\Contract\ContractItem;
use Application\Model\Customer\Customer;
use Application\Model\Form\NewContractForm;
use Application\Model\Item\Item;
use Application\Model\Receipt\Receipt;
use Application\Util\Cast;
use Dompdf\Dompdf;
use Laminas\Stdlib\Parameters;
use Laminas\View\Model\ViewModel;
use Laminas\View\Renderer\PhpRenderer;
use Laminas\View\Resolver\AggregateResolver;
use Laminas\View\Resolver\TemplateMapResolver;
use Laminas\View\Resolver\TemplatePathStack;

class PdfGeneratorServiceHelper
{
    public const VARIABLE_CONTRACT = 'contract';
    public const VARIABLE_RECEIPT  = 'receipt';

    protected const CONTRACT_TEMPLATE_NAME = 'contract';
    protected const RECEIPT_TEMPLATE_NAME  = 'receipt';
    protected const BASE_PATH              = __DIR__ . '/../../../../public';
    protected const PATH_CONTRACT_TEMPLATE = __DIR__ . '/../../view/application/contract-manager/contract.phtml';
    protected const PATH_RECEIPT_TEMPLATE  = __DIR__ . '/../../view/application/contract-manager/receipt.phtml';
    protected const TEMPLATE_PATH_VIEW     = __DIR__ . '/../../view';


    /**
     * @param Parameters $parameters
     *
     * @return array
     */
    public function parseViewVariablesFromParams(Parameters $parameters): array
    {
        $formParams = $parameters->toArray();

        $customer = Customer::createFromArray(
            [
                Customer::ID                => Cast::toInt(
                    $formParams[NewContractForm::FIELD_CUSTOMER_ID] ?? null
                ),
                Customer::NAME              => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_NAME] ?? null
                ),
                Customer::STREET            => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_STREET] ?? null
                ),
                Customer::HOUSE_NUMBER      => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_HOUSE_NUMBER] ?? null
                ),
                Customer::BOROUGH           => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_BOROUGH] ?? null
                ),
                Customer::CITY              => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_CITY] ?? null
                ),
                Customer::ADDRESS_REFERENCE => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_ADDRESS_REFERENCE] ?? null
                ),
                Customer::PHONE             => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_PHONE] ?? null
                ),
                Customer::MOBILE_PHONE      => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_MOBILE_PHONE] ?? null
                ),
                Customer::EMAIL             => Cast::toString(
                    $formParams[NewContractForm::FIELD_CUSTOMER_EMAIL] ?? null
                ),
            ]
        );

        $itemsArray = [];
        foreach ($formParams as $param => $value) {
            if (strpos($param, '-item-') !== false) {
                $itemsArray[$param] = $value;
            }
        }

        $itemContractObjs = [];
        for ($i = 1; $i <= 7; $i++) {
            $tempItemObj         = new Item;
            $tempContractItemObj = new ContractItem;
            foreach ($itemsArray as $key => $value) {
                if (strpos($key, Cast::toString($i)) !== false) {
                    if (strpos($key, 'code') !== false && !empty($value)) {
                        $tempItemObj->setCode(Cast::toInt($value));
                    }
                    if (strpos($key, 'description') !== false && !empty($value)) {
                        $tempItemObj->setDescription(Cast::toString($value));
                    }
                    if (strpos($key, 'price') !== false && !empty($value)) {
                        $tempItemObj->setPrice(Cast::toFloat($value));
                    }
                    if (strpos($key, 'quantity') !== false && !empty($value)) {
                        $tempContractItemObj->setQuantity(Cast::toInt($value));
                    }
                }
            }
            if ($tempItemObj->getCode() !== null) {
                $tempContractItemObj->setItem($tempItemObj);
                $itemContractObjs[] = $tempContractItemObj;
            }
        }

        $dateNow = new \DateTime('now', new \DateTimeZone('UTC'));

        $contract = Contract::createFromArray(
            [
                Contract::START_DATE     => Cast::toDateTime($formParams[NewContractForm::FIELD_START_DATE] ?? null),
                Contract::END_DATE       => Cast::toDateTime($formParams[NewContractForm::FIELD_END_DATE] ?? null),
                Contract::PAYMENT_METHOD => Cast::toString($formParams[NewContractForm::FIELD_PAYMENT_METHOD] ?? null),
                Contract::ISSUE_DATE     => $dateNow,
                Contract::CUSTOMER       => $customer,
                Contract::ITEMS          => $itemContractObjs,
            ]
        );

        $receipt = Receipt::createFromArray(
            [
                Receipt::CUSTOMER    => $customer,
                Receipt::ISSUE_DATE  => $dateNow,
                Receipt::TOTAL_VALUE => $contract->getTotalValue(),
                Receipt::AMOUNT_PAID => Cast::toFloat($formParams[NewContractForm::FIELD_AMOUNT_PAID] ?? null),
            ]
        );

        return [
            self::VARIABLE_CONTRACT => $contract,
            self::VARIABLE_RECEIPT  => $receipt,
        ];
    }


    /**
     * @param array  $variables
     * @param string $templateName
     *
     * @return ViewModel
     */
    public function getViewModel(array $variables, string $templateName): ViewModel
    {
        $viewModel = new ViewModel();
        $viewModel->setVariables($variables);
        $viewModel->setTemplate($templateName);

        return $viewModel;
    }


    /**
     * @param array|null $templateMap
     * @param array|null $templatePathStack
     *
     * @return PhpRenderer
     */
    public function getPhpRenderer(?array $templateMap = null, ?array $templatePathStack = null): PhpRenderer
    {
        $templateMapResolver = new TemplateMapResolver();
        $templateMapResolver->setMap($templateMap ?? $this->getTemplateMap());

        $templatePathStackModel = new TemplatePathStack();
        $templatePathStackModel->setPaths($templatePathStack ?? $this->getTemplatePathStack());

        $aggregateResolver = new AggregateResolver();
        $aggregateResolver->attach($templateMapResolver);
        $aggregateResolver->attach($templatePathStackModel);

        $phpRenderer = new PhpRenderer();
        $phpRenderer->setResolver($aggregateResolver);

        return $phpRenderer;
    }


    /**
     * @param string|null $html
     *
     * @return Dompdf
     */
    public function getDomPdfModel(?string $html = null): Dompdf
    {
        $domPdfModel = new Dompdf();
        $domPdfModel->setBasePath(self::BASE_PATH);

        if ($html !== null) {
            $domPdfModel->loadHtml($html);
        }

        return $domPdfModel;
    }


    /**
     * @param Dompdf $domPdfModel
     *
     * @return string
     */
    public function getPdfContent(Dompdf $domPdfModel): string
    {
        $domPdfModel->render();

        return $domPdfModel->output();
    }


    /**
     * @return string[]
     */
    public function getTemplateMap(): array
    {
        return [
            self::CONTRACT_TEMPLATE_NAME => self::PATH_CONTRACT_TEMPLATE,
            self::RECEIPT_TEMPLATE_NAME  => self::PATH_RECEIPT_TEMPLATE,
        ];
    }


    /**
     * @return string[]
     */
    public function getTemplatePathStack(): array
    {
        return [
            self::TEMPLATE_PATH_VIEW,
        ];
    }


    /**
     * @return string
     */
    public function getContractTemplateName(): string
    {
        return self::CONTRACT_TEMPLATE_NAME;
    }


    /**
     * @return string
     */
    public function getReceiptTemplateName(): string
    {
        return self::RECEIPT_TEMPLATE_NAME;
    }

}