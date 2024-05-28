<?php declare(strict_types=1);

namespace SoftRules\Laravel;

use DOMDocument;
use Illuminate\Support\HtmlString;
use SoftRules\PHP\HtmlRenderer;
use SoftRules\PHP\SoftRulesForm as BaseForm;
use SoftRules\PHP\UI\SoftRulesFormData;

final class SoftRules
{
    public function form(string $product, string $xml): HtmlString
    {
        return BaseForm::make($product)
            ->withInitialXml($xml)
            ->withCsrfProtection(csrf_field())
            ->setJavascriptPath(url('vendor/softrules/js'))
            ->setCSSPath(url('vendor/softrules/css'))
            ->setFirstPageRoute(route('softrules.first-page'))
            ->setNextPageRoute(route('softrules.next-page'))
            ->setPreviousPageRoute(route('softrules.previous-page'))
            ->setRenderXmlRoute(route('softrules.render-xml'))
            ->setUpdateUserInterfaceRoute(route('softrules.update-user-interface'))
            ->setScriptActionsRoute(route('softrules.script-actions'))
            ->render();
    }

    public function renderXml(string|DOMDocument $xml): string
    {
        $form = is_string($xml)
            ? SoftRulesFormData::fromXmlString($xml)
            : SoftRulesFormData::fromDomDocument($xml);

        return (string) new HtmlRenderer($form);
    }
}
