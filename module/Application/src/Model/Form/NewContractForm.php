<?php
declare(strict_types=1);

namespace Application\Model\Form;

use Application\Util\Money;
use Laminas\Form\Element;
use Laminas\Form\Element\DateTimeLocal;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Tel;
use Laminas\Form\Element\Text;

class NewContractForm extends AppAbstractForm
{
    public const FORM_NAME = 'new_contract_form';

    public const FIELD_CUSTOMER_NAME              = 'customer-name';
    public const FIELD_CUSTOMER_ID                = 'customer-id';
    public const FIELD_CUSTOMER_STREET            = 'customer-street';
    public const FIELD_CUSTOMER_HOUSE_NUMBER      = 'customer-house-number';
    public const FIELD_CUSTOMER_BOROUGH           = 'customer-borough';
    public const FIELD_CUSTOMER_CITY              = 'customer-city';
    public const FIELD_CUSTOMER_ADDRESS_REFERENCE = 'customer-address-reference';
    public const FIELD_CUSTOMER_PHONE             = 'customer-phone';
    public const FIELD_CUSTOMER_MOBILE_PHONE      = 'customer-mobile-phone';
    public const FIELD_CUSTOMER_EMAIL             = 'customer-email';
    public const FIELD_ITEMS                      = 'customer-items';
    public const FIELD_PAYMENT_METHOD             = 'payment-method';
    public const FIELD_AMOUNT_PAID                = 'amount-paid';
    public const FIELD_START_DATE                 = 'start-date';
    public const FIELD_END_DATE                   = 'end-date';
    public const BUTTON_GENERATE_CONTRACT         = 'button-generate-contract';
    public const BUTTON_GENERATE_RECEIPT          = 'button-generate-receipt';

    protected Text $customerName;

    protected \Laminas\Form\Element\Number $customerId;

    protected Text $customerStreet;

    protected \Laminas\Form\Element\Number $customerHouseNumber;

    protected Text $customerBorough;

    protected Text $customerCity;

    protected Text $customerAddressReference;

    protected Tel $customerPhone;

    protected Tel $customerMobilePhone;

    protected Email $customerEmail;

    protected ItemsField $items;

    protected Radio $paymentMethodCash;

    protected Radio $paymentMethodDebitCard;

    protected Radio $paymentMethodCreditCard;

    protected Radio $paymentMethodBankTransferCard;

    protected \Laminas\Form\Element\Number $amountPaid;

    protected DateTimeLocal $startDate;

    protected DateTimeLocal $endDate;

    protected Submit $generateContractButton;

    protected Submit $generateReceiptButton;


    public function getFormName(): ?string
    {
        return self::FORM_NAME;
    }


    public function getAction(): string
    {
        return 'generate';
    }


    public function init(): void
    {
        $suffixElementPrice = sprintf(
            ' (%s %s)',
            $this->translator->translate('in'),
            Money::getCurrencySymbol()
        );

        $this->customerName = (new Text(self::FIELD_CUSTOMER_NAME))
            ->setLabel($this->translator->translate('name'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('name'))
            ->setAttribute('required', true);

        $this->customerId = (new Number(self::FIELD_CUSTOMER_ID))
            ->setLabel($this->translator->translate('cpf'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('cpf'))
            ->setAttribute('required', true);

        $this->customerStreet = (new Text(self::FIELD_CUSTOMER_STREET))
            ->setLabel($this->translator->translate('address'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('address'))
            ->setAttribute('required', true);

        $this->customerHouseNumber = (new Number(self::FIELD_CUSTOMER_HOUSE_NUMBER))
            ->setLabel($this->translator->translate('number'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('number'))
            ->setAttribute('required', true);

        $this->customerBorough = (new Text(self::FIELD_CUSTOMER_BOROUGH))
            ->setLabel($this->translator->translate('borough'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('borough'))
            ->setAttribute('required', true);

        $this->customerCity = (new Text(self::FIELD_CUSTOMER_CITY))
            ->setLabel($this->translator->translate('city'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('city'))
            ->setAttribute('required', true);

        $this->customerAddressReference = (new Text(self::FIELD_CUSTOMER_ADDRESS_REFERENCE))
            ->setLabel($this->translator->translate('address_reference'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('address_reference'));

        $this->customerPhone = (new Tel(self::FIELD_CUSTOMER_PHONE))
            ->setLabel($this->translator->translate('phone'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('phone'));

        $this->customerMobilePhone = (new Tel(self::FIELD_CUSTOMER_MOBILE_PHONE))
            ->setLabel($this->translator->translate('mobile_phone'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('mobile_phone'))
            ->setAttribute('required', true);

        $this->customerEmail = (new Email(self::FIELD_CUSTOMER_EMAIL))
            ->setLabel($this->translator->translate('email'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('email'));

        $this->items = (new ItemsField($this->translator, self::FIELD_ITEMS))
            ->setLabel($this->translator->translate('items'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('items'))
            ->setAttribute('required', true);

        $this->startDate = (new DateTimeLocal(self::FIELD_START_DATE))
            ->setLabel($this->translator->translate('start_date'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('start_date'))
            ->setAttribute('required', true);

        $this->endDate = (new DateTimeLocal(self::FIELD_END_DATE))
            ->setLabel($this->translator->translate('end_date'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', $this->translator->translate('end_date'))
            ->setAttribute('required', true);

        $this->paymentMethodCash = (new Radio(self::FIELD_PAYMENT_METHOD))
            ->setLabel($this->translator->translate('payment_method_cash'))
            ->setValue($this->translator->translate('payment_method_cash'));

        $this->paymentMethodDebitCard = (new Radio(self::FIELD_PAYMENT_METHOD))
            ->setLabel($this->translator->translate('payment_method_debit_card'))
            ->setValue($this->translator->translate('payment_method_debit_card'));

        $this->paymentMethodCreditCard = (new Radio(self::FIELD_PAYMENT_METHOD))
            ->setLabel($this->translator->translate('payment_method_credit_card'))
            ->setValue($this->translator->translate('payment_method_credit_card'));

        $this->paymentMethodBankTransferCard = (new Radio(self::FIELD_PAYMENT_METHOD))
            ->setLabel($this->translator->translate('payment_method_bank_transfer'))
            ->setValue($this->translator->translate('payment_method_bank_transfer'));

        $this->amountPaid = (new Number(self::FIELD_AMOUNT_PAID))
            ->setLabel($this->translator->translate('amount_paid'))
            ->setAttribute('class', 'form-control')
            ->setAttribute('step', '.01')
            ->setAttribute('placeholder', $this->translator->translate('amount_paid') . $suffixElementPrice);

        $this->generateContractButton = (new Submit(self::BUTTON_GENERATE_CONTRACT))
            ->setAttribute('class', 'btn btn-primary btn-lg')
            ->setValue($this->translator->translate('button_generate_contract_label') . ' »');

        $this->generateReceiptButton = (new Submit(self::BUTTON_GENERATE_RECEIPT))
            ->setAttribute('class', 'btn btn-primary btn-lg')
            ->setValue($this->translator->translate('button_generate_receipt_label') . ' »');

        $this->add($this->customerName)
             ->add($this->customerId)
             ->add($this->customerStreet)
             ->add($this->customerHouseNumber)
             ->add($this->customerBorough)
             ->add($this->customerCity)
             ->add($this->customerAddressReference)
             ->add($this->customerPhone)
             ->add($this->customerMobilePhone)
             ->add($this->customerEmail)
             ->add($this->items)
             ->add($this->paymentMethodCash)
             ->add($this->paymentMethodDebitCard)
             ->add($this->paymentMethodCreditCard)
             ->add($this->paymentMethodBankTransferCard)
             ->add($this->amountPaid)
             ->add($this->startDate)
             ->add($this->endDate)
             ->add($this->generateContractButton)
             ->add($this->generateReceiptButton);
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Text
     */
    public function getCustomerName(): Text
    {
        return $this->customerName;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return \Laminas\Form\Element\Number
     */
    public function getCustomerId(): \Laminas\Form\Element\Number
    {
        return $this->customerId;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Text
     */
    public function getCustomerStreet(): Text
    {
        return $this->customerStreet;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return \Laminas\Form\Element\Number
     */
    public function getCustomerHouseNumber(): \Laminas\Form\Element\Number
    {
        return $this->customerHouseNumber;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Text
     */
    public function getCustomerBorough(): Text
    {
        return $this->customerBorough;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Text
     */
    public function getCustomerCity(): Text
    {
        return $this->customerCity;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Text
     */
    public function getCustomerAddressReference(): Text
    {
        return $this->customerAddressReference;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Tel
     */
    public function getCustomerPhone(): Tel
    {
        return $this->customerPhone;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Tel
     */
    public function getCustomerMobilePhone(): Tel
    {
        return $this->customerMobilePhone;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Email
     */
    public function getCustomerEmail(): Email
    {
        return $this->customerEmail;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return ItemsField
     */
    public function getItems(): ItemsField
    {
        return $this->items;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Radio
     */
    public function getPaymentMethodCash(): Radio
    {
        return $this->paymentMethodCash;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Radio
     */
    public function getPaymentMethodCreditCard(): Radio
    {
        return $this->paymentMethodCreditCard;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Radio
     */
    public function getPaymentMethodDebitCard(): Radio
    {
        return $this->paymentMethodDebitCard;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Radio
     */
    public function getPaymentMethodBankTransfer(): Radio
    {
        return $this->paymentMethodBankTransferCard;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return DateTimeLocal
     */
    public function getStartDate(): DateTimeLocal
    {
        return $this->startDate;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return DateTimeLocal
     */
    public function getEndDate(): DateTimeLocal
    {
        return $this->endDate;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Number
     */
    public function getAmountPaid(): \Laminas\Form\Element\Number
    {
        return $this->amountPaid;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Submit
     */
    public function getGenerateContractButton(): Submit
    {
        return $this->generateContractButton;
    }


    /**
     * @codeCoverageIgnore
     *
     * @return Submit
     */
    public function getGenerateReceiptButton(): Submit
    {
        return $this->generateReceiptButton;
    }


    /**
     * @return Element[]
     */
    public function getSingleFields(): array
    {
        return [
            $this->getCustomerName(),
            $this->getCustomerId(),
            $this->getCustomerStreet(),
            $this->getCustomerHouseNumber(),
            $this->getCustomerBorough(),
            $this->getCustomerCity(),
            $this->getCustomerAddressReference(),
            $this->getCustomerPhone(),
            $this->getCustomerMobilePhone(),
            $this->getCustomerEmail(),
            $this->getStartDate(),
            $this->getEndDate(),
            $this->getAmountPaid(),
        ];
    }


    /**
     * @return array[]
     */
    public function getItemsField(): array
    {
        return $this->getItems()->getItems();
    }


    /**
     * @return string
     */
    public function getLabelForPaymentMethodGroup(): string
    {
        return $this->translator->translate('payment_method');
    }


    /**
     * @return Element[]
     */
    public function getPaymentMethodFields(): array
    {
        return [
            $this->getPaymentMethodCash(),
            $this->getPaymentMethodDebitCard(),
            $this->getPaymentMethodCreditCard(),
            $this->getPaymentMethodBankTransfer(),
        ];
    }

}