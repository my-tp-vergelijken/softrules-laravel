<?php declare(strict_types=1);

namespace SoftRules\Laravel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use SoftRules\PHP\Contracts\ClientContract;

final class NavigationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'string',
            ],
            'product' => [
                'required',
                'string',
                Rule::in(
                    Arr::pluck(config('softrules.forms'), 'product'),
                ),
            ],
            'xml' => [
                'required',
                'string',
            ],
        ];
    }

    public function client(): ClientContract
    {
        return app(ClientContract::class, ['product' => $this->product()]);
    }

    public function xml(): string
    {
        return $this->validated('xml');
    }

    public function id(): string
    {
        return $this->validated('id');
    }

    private function product(): string
    {
        return $this->validated('product');
    }
}
