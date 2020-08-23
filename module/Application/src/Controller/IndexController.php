<?php
declare(strict_types=1);

namespace Application\Controller;

use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\View\Model\ViewModel;

final class IndexController extends AppAbstractActionController
{
    /**
     * @var TranslatorInterface
     */
    private TranslatorInterface $translator;


    public function __construct(
        TranslatorInterface $translator
    )
    {
        $this->translator = $translator;
    }


    /**
     * @return ViewModel
     */
    public function indexAction(): ViewModel
    {
        return new ViewModel(
            [
                'welcomeMessage'         => $this->translator->translate('welcome_message'),
                'descriptionMessage'     => $this->translator->translate('description_message'),
                'newContractButtonLabel' => $this->translator->translate('new_contract_button_label'),
                'newContractLink'        => $this->url()->fromRoute('new-contract'),
            ]
        );
    }

}
