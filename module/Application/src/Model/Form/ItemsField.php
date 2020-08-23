<?php
declare(strict_types=1);

namespace Application\Model\Form;

use Laminas\Form\Fieldset;
use Laminas\I18n\Translator\TranslatorInterface;

class ItemsField extends Fieldset
{
    public const ITEM_1  = 'item-1';
    public const ITEM_2  = 'item-2';
    public const ITEM_3  = 'item-3';
    public const ITEM_4  = 'item-4';
    public const ITEM_5  = 'item-5';
    public const ITEM_6  = 'item-6';
    public const ITEM_7  = 'item-7';

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
        $this->add(new ItemField($this->translator, self::ITEM_1))
             ->add(new ItemField($this->translator, self::ITEM_2))
             ->add(new ItemField($this->translator, self::ITEM_3))
             ->add(new ItemField($this->translator, self::ITEM_4))
             ->add(new ItemField($this->translator, self::ITEM_5))
             ->add(new ItemField($this->translator, self::ITEM_6))
             ->add(new ItemField($this->translator, self::ITEM_7));
    }


    /**
     * @return array[]
     */
    public function getItems(): array
    {
        $itemFields = [];

        /** @var ItemField[] $items */
        $items = $this->getFieldsets();

        foreach ($items as $item) {
            $itemFields[] = $item->getElements();
        }

        return $itemFields;
    }

}