<?php

use function Pest\Laravel\{getJson};

it('can return the about information', function () {
    $response = getJson('/expose-about/json');

    $jsonData = $response->json('data');
    $arrayData = json_decode($jsonData, true);

    expect($response->status())
        ->toBe(200)
        ->and($jsonData)
        ->toBeJson()
        ->and(array_keys($arrayData))
        ->toContain('environment');
});

it('can reject unauthenticated requests', function () {
    $token = '07fd0d25-d243-4af2-9572-e06e537a4b57';

    config()->set('expose-about.token', $token);

    $response = getJson('/expose-about/json', [
        'Authorization' => 'Bearer asdjklasdjasdjaslkd',
    ]);

    expect($response->status())
        ->toBe(403);
});

it('can reject wrong IP requests', function () {
    $token = '07fd0d25-d243-4af2-9572-e06e537a4b57';

    config()->set('expose-about.token', $token);
    config()->set('expose-about.ip_whitelist', [
        '127.0.0.123',
    ]);

    $response = getJson('/expose-about/json', [
        'Authorization' => "Bearer $token",
    ]);

    expect($response->status())
        ->toBe(403);
});

it('can allow IP requests', function () {
    $token = '07fd0d25-d243-4af2-9572-e06e537a4b57';

    config()->set('expose-about.token', $token);
    config()->set('expose-about.ip_whitelist', [
        '127.0.0.1',
    ]);

    $response = getJson('/expose-about/json', [
        'Authorization' => "Bearer $token",
    ]);

    expect($response->status())
        ->toBe(200);
});
