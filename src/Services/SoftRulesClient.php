<?php declare(strict_types=1);

namespace SoftRules\Laravel\Services;

use RuntimeException;
use SoftRules\PHP\Services\SoftRulesClient as BaseClient;

final class SoftRulesClient extends BaseClient
{
    public static function fromConfig(string $product): self
    {
        $config = collect(config('softrules.forms'))
            ->firstWhere('product', $product);

        if (! $config) {
            throw new RuntimeException('No form found for product "' . $product . '" in the config');
        }

        return new self(
            product: $product,
            uri: $config['uri'],
            username: $config['username'],
            password: $config['password'],
        );
    }

    protected function createSession(): string
    {
        $cacheKey = 'softrules-laravel:session-id';

        $sessionId = cache()->get($cacheKey);

        if ($sessionId) {
            return $sessionId;
        }

        $sessionId = parent::createSession();

        cache()->put($cacheKey, $sessionId, now()->addMinutes(10));

        return $sessionId;
    }
}
