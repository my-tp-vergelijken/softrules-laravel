<?php declare(strict_types=1);

namespace SoftRules\Laravel\Services;

use GuzzleHttp\Psr7\Uri;
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

    public function cacheIdentifier(): string
    {
        $uri = new Uri($this->uri);

        $uriIdentifier = str($uri->getHost() . $uri->getPath())->ascii()->trim('/');

        // @phpstan-ignore disallowed.function
        return md5("{$uriIdentifier}-{$this->username}-{$this->product}", true);
    }

    protected function createSession(): string
    {
        $cacheKey = "softrules-laravel:{$this->cacheIdentifier()}:session-id";

        $sessionId = cache()->get($cacheKey);

        if ($sessionId) {
            return $sessionId;
        }

        $sessionId = parent::createSession();

        if ($sessionId) {
            cache()->put($cacheKey, $sessionId, now()->addMinutes(10));
        }

        return $sessionId;
    }
}
