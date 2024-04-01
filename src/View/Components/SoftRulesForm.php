<?php declare(strict_types=1);

namespace SoftRules\Laravel\View\Components;

use DOMDocument;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use SoftRules\PHP\Contracts\ClientContract;

final class SoftRulesForm extends Component
{
    public readonly DOMDocument $xml;

    public function __construct(
        public readonly string $product,
        string $xml,
    ) {
        /** @var ClientContract $client */
        $client = app(ClientContract::class, ['product' => $product]);

        $this->xml = $client->firstPage($xml);
    }

    public function render(): View
    {
        return view('components.softrules-form');
    }
}
