<?php
declare(strict_types=1);

namespace ApplicationUnitTest\Controller;

use Application\Controller\IndexController;
use ApplicationUnitTest\AbstractControllerUnitTestCase;
use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\Mvc\Controller\Plugin\Url;
use Laminas\View\Model\ViewModel;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @group Unit
 */
final class IndexControllerTest extends AbstractControllerUnitTestCase
{
    /**
     * @var TranslatorInterface|MockObject
     */
    private MockObject $translator;

    private IndexController $indexController;

    /**
     * @var Url|MockObject
     */
    private MockObject $url;


    protected function setUp(): void
    {
        parent::setUp();
        $this->translator      = $this->createMock(TranslatorInterface::class);
        $this->indexController = new IndexController($this->translator);

        $this->url = $this->createMockForUrlPlugin($this->indexController);
    }


    public function testIndexAction(): void
    {
        $this->translator->expects(static::exactly(3))
                         ->method('translate')
                         ->withConsecutive(
                             ['welcome_message'],
                             ['description_message'],
                             ['new_contract_button_label']
                         )
                         ->willReturnArgument(0);

        $this->url->expects(static::once())
                  ->method('fromRoute')
                  ->with('new-contract')
                  ->willReturn('new/contract/link');

        $expectedVariables = [
            'welcomeMessage'         => 'welcome_message',
            'descriptionMessage'     => 'description_message',
            'newContractButtonLabel' => 'new_contract_button_label',
            'newContractLink'        => 'new/contract/link',
        ];

        static::assertEquals(new ViewModel($expectedVariables), $this->indexController->indexAction());
    }

}