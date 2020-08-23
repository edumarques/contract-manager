<?php
declare(strict_types=1);

namespace Application\Model\Form;

use Laminas\Form\Form;
use Laminas\I18n\Translator\TranslatorInterface;

abstract class AppAbstractForm extends Form
{
    protected TranslatorInterface $translator;


    protected function __construct(TranslatorInterface $translator)
    {
        parent::__construct();

        $this->translator = $translator;

        $this->init();
    }


    /**
     * @codeCoverageIgnore
     *
     * @param TranslatorInterface $translator
     *
     * @return static
     */
    public static function create(TranslatorInterface $translator): AppAbstractForm
    {
        return new static($translator);
    }


    public function init(): void
    {
        $this->setAttribute('name', $this->getFormName());
        $this->setAttribute('method', $this->getMethod());
        $this->setAttribute('action', $this->getAction());
    }


    /**
     * @return string|null
     */
    public function getFormName(): ?string
    {
        return null;
    }


    /**
     * @return string
     */
    public function getMethod(): string
    {
        return 'POST';
    }


    /**
     * @return string
     */
    public function getAction(): string
    {
        return '';
    }

}