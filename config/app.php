<?php
return [
    'auth' => \Src\Auth\Auth::class,
    'identity'=>\Model\User::class,
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'bearer' => \Middlewares\BearerTokenMiddleware::class,
    ],
    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'positive' => \Validators\PositiveNumberValidator::class,
        'payerNumber' => \Validators\PayerNumberValidator::class,
        'insuranceNumber' => \Validators\InsuranceNumberValidator::class,
        'bankAccount' => \Validators\BankAccountValidator::class,
        'month' => \Validators\MonthValidator::class,
//        'dateNotFuture' => \Validators\DateNotFutureValidator::class,
//        'dateRange' => \Validators\DateRangeValidator::class,
        'digits' => \Validators\DigitsValidator::class,
//        'alphabet' => \Validators\AlphabetValidator::class
    ],
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
//        'json' => \Middlewares\JSONMiddleware::class,
    ],
    'providers' => [
        'kernel' => \Providers\KernelProvider::class,
        'route' => \Providers\RouteProvider::class,
        'db' => \Providers\DBProvider::class,
        'auth' => \Providers\AuthProvider::class,
    ]
];