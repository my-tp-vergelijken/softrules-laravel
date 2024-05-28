<?php declare(strict_types=1);

namespace SoftRules\Laravel\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use SoftRules\PHP\EvaluateExpressions;
use SoftRules\PHP\UI\SoftRulesFormData;

final class ScriptActionsController
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'xml' => [
                'required',
                'string',
            ],
        ]);

        $actions = new EvaluateExpressions(SoftRulesFormData::fromXmlString($validated['xml']));

        return response()->json($actions->actionList->toArray());
    }
}
