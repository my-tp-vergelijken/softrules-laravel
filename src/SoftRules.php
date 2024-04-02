<?php declare(strict_types=1);

namespace SoftRules\Laravel;

use DOMDocument;
use Illuminate\Support\Facades\Blade;
use SoftRules\PHP\HtmlRenderer;
use SoftRules\PHP\UI\SoftRulesFormData;

final class SoftRules
{
    public function form(string $product, string $xml): string
    {
        return Blade::render("<x-softrules-form product='{$product}' xml='{$xml}'/>");
    }

    public function renderXml(string|DOMDocument $xml, bool $addScripts = false): string
    {
        $form = is_string($xml)
            ? SoftRulesFormData::fromXmlString($xml)
            : SoftRulesFormData::fromDomDocument($xml);

        return (string) new HtmlRenderer($form, $addScripts);
    }
}
