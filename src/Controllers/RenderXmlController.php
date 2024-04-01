<?php declare(strict_types=1);

namespace SoftRules\Laravel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SoftRules\Laravel\Facades\SoftRules;

final class RenderXmlController
{
    public function __invoke(Request $request): Response
    {
        $validated = $request->validate([
            'xml' => [
                'required',
                'string',
            ],
        ]);

        return response(SoftRules::renderXml($validated['xml']));
    }
}
