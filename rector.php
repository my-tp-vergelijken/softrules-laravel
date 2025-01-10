<?php declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\PropertyProperty\RemoveNullPropertyInitializationRector;
use Rector\Php70\Rector\StaticCall\StaticCallOnNonStaticToInstanceCallRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php74\Rector\Property\RestoreDefaultNullToNullableTypePropertyRector;
use Rector\Php74\Rector\Ternary\ParenthesizeNestedTernaryRector;
use Rector\Php80\Rector\Class_\StringableForToStringRector;
use Rector\Php81\Rector\Array_\FirstClassCallableRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\Php82\Rector\Param\AddSensitiveParameterAttributeRector;

/**
 * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md
 */
return RectorConfig::configure()
    ->withCache(
        cacheDirectory: './.cache/rector',
        cacheClass: FileCacheStorage::class,
        containerCacheDirectory: './.cache/rectorContainer',
    )
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/routes',
        __DIR__ . '/src',
    ])
    ->withRules([
        ParenthesizeNestedTernaryRector::class,
    ])
    ->withConfiguredRule(AddSensitiveParameterAttributeRector::class, [
        'sensitive_parameters' => [
            'appKey',
            'config',
            'confirmPassword',
            'confirmedPassword',
            'currentPassword',
            'newPassword',
            'password',
            'plainTextPassword',
            'secret',
            'token',
            'two_factor_secret',
        ],
    ])
    ->withSkip([
        ArgumentAdderRector::class,
        ClosureToArrowFunctionRector::class,
        FirstClassCallableRector::class,
        ReadOnlyPropertyRector::class,
        RemoveNullPropertyInitializationRector::class,
        RestoreDefaultNullToNullableTypePropertyRector::class,
        StaticCallOnNonStaticToInstanceCallRector::class,
        StringableForToStringRector::class,
    ])
    ->withParallel(300, 14, 14)
    // here we can define, what prepared sets of rules will be applied
    ->withPreparedSets(
        deadCode: true,
        codeQuality: false,
        codingStyle: false,
        typeDeclarations: true,
        privatization: false,
        naming: false,
        instanceOf: false,
        earlyReturn: true,
        strictBooleans: false,
        carbon: true,
        rectorPreset: true,
    )
    ->withMemoryLimit('3G')
    ->withPhpSets(php82: true);
