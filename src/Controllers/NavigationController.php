<?php declare(strict_types=1);

namespace SoftRules\Laravel\Controllers;

use Illuminate\Http\Response;
use SoftRules\Laravel\Requests\NavigationRequest;

final class NavigationController
{
    public function updateUserInterface(NavigationRequest $request): Response
    {
        $xml = $request->client()->updateUserInterface($request->id(), $request->xml());

        $xmlString = $xml->saveHTML($xml->documentElement);

        return response($xmlString)->header('Content-Type', 'application/xml');
    }

    public function firstPage(NavigationRequest $request): Response
    {
        $xml = $request->client()->firstPage($request->xml());

        $xmlString = $xml->saveHTML($xml->documentElement);

        return response($xmlString)->header('Content-Type', 'application/xml');
    }

    public function nextPage(NavigationRequest $request): Response
    {
        $xml = $request->client()->nextPage($request->id(), $request->xml());

        $xmlString = $xml->saveHTML($xml->documentElement);

        return response($xmlString)->header('Content-Type', 'application/xml');
    }

    public function previousPage(NavigationRequest $request): Response
    {
        $xml = $request->client()->previousPage($request->id(), $request->xml());

        $xmlString = $xml->saveHTML($xml->documentElement);

        return response($xmlString)->header('Content-Type', 'application/xml');
    }
}
