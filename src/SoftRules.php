<?php declare(strict_types=1);

namespace SoftRules\Laravel;

use DOMDocument;
use Illuminate\Support\Facades\Blade;
use SoftRules\PHP\HtmlRenderer;
use SoftRules\PHP\UI\SoftRulesForm;

final class SoftRules
{
    public function form(string $product, string $xml): string
    {
        return Blade::render("<x-softrules-form product='{$product}' xml='{$xml}'/>");
    }

    public function renderXml(string|DOMDocument $xml): string
    {
        $form = is_string($xml)
            ? SoftRulesForm::fromXmlString($xml)
            : SoftRulesForm::fromDomDocument($xml);

        return (string) new HtmlRenderer($form);
    }
}
