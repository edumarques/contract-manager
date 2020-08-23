<?php
declare(strict_types=1);

namespace Application\Model\Form;

use Application\Util\Money;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Text;
use Laminas\Form\Fieldset;
use Laminas\I18n\Translator\TranslatorInterface;

class ItemField extends Fieldset
{
    public const ITEM_CODE        = 'item-code';
    public const ITEM_DESCRIPTION = 'item-description';
    public const ITEM_QUANTITY    = 'item-quantity';
    public const ITEM_UNIT_PRICE  = 'item-unit-price';

    protected TranslatorInterface $translator;


    /**
     * @param TranslatorInterface $translator
     * @param string|null         $name
     * @param array               $options
     */
    public function __construct(TranslatorInterface $translator, ?string $name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->translator = $translator;
        $this->init();
    }


    public function init(): void
    {
        $fieldName         = $this->getName();
        $suffixElementName = '-' . $fieldName;

        $suffixElementPrice = sprintf(
            ' (%s %s)',
            $this->translator->translate('in'),
            Money::getCurrencySymbol()
        );

        $this->add(
            (new Number(self::ITEM_CODE . $suffixElementName))
                ->setAttribute('class', 'form-control')
                ->setAttribute('placeholder', $this->translator->translate('item_code'))
        );

        $this->add(
            (new Text(self::ITEM_DESCRIPTION . $suffixElementName))
                ->setAttribute('class', 'form-control')
                ->setAttribute('placeholder', $this->translator->translate('item_description'))
        );

        $this->add(
            (new Number(self::ITEM_QUANTITY . $suffixElementName))
                ->setAttribute('class', 'form-control')
                ->setAttribute('placeholder', $this->translator->translate('item_quantity'))
        );

        $this->add(
            (new Number(self::ITEM_UNIT_PRICE . $suffixElementName))
                ->setAttribute('class', 'form-control')
                ->setAttribute('step', '.01')
                ->setAttribute('placeholder', $this->translator->translate('item_unit_price') . $suffixElementPrice)
        );
    }

}