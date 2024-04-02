<?php declare(strict_types=1);

namespace SoftRules\Laravel\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use SoftRules\PHP\SoftRulesForm as BaseForm;

final class SoftRulesForm extends Component
{
    public readonly BaseForm $form;

    public function __construct(
        public readonly string $product,
        string                 $xml,
    ) {
        $this->form = BaseForm::make($product)
            ->withInitialXml($xml)
            ->withCsrfProtection(csrf_field())
            ->setFirstPageRoute(route('softrules.first-page'))
            ->setNextPageRoute(route('softrules.next-page'))
            ->setPreviousPageRoute(route('softrules.previous-page'))
            ->setRenderXmlRoute(route('softrules.render-xml'))
            ->setUpdateUserInterfaceRoute(route('softrules.update-user-interface'));
    }

    public function render(): View
    {
        return view('components.softrules-form');
    }
}
