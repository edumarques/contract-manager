<?php
declare(strict_types=1);

namespace ApplicationUnitTest\Controller;

use Application\Controller\IndexController;
use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\View\Model\ViewModel;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @group Unit
 */
final class IndexControllerTest extends TestCase
{
    /**
     * @var TranslatorInterface|MockObject
     */
    private MockObject $translator;

    private IndexController $indexController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->translator = $this->createMock(TranslatorInterface::class);
        $this->indexController = new IndexController($this->translator);
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

        $expectedVariables = [
            'welcomeMessage'         => 'welcome_message',
            'descriptionMessage'     => 'description_message',
            'newContractButtonLabel' => 'new_contract_button_label',
            'newContractLink'        => '',
        ];

        $expected = (new ViewModel())->setVariables($expectedVariables);

        static::assertEquals($expected, $this->indexController->indexAction());
    }

}