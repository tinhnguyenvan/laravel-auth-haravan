<?php

namespace App\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use Illuminate\Support\Arr;

class HaravanProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopeSeparator = ' ';

    protected $scopes = [
        'openid',
        'org',
        'phone',
        'email',
        'userinfo',
        'profile',
        'com.read_customers',
        'com.write_customers',
        'com.read_products',
        'com.write_products',
        'com.read_orders',
        'com.write_orders',
    ];

    /**
     * Get the authentication URL for the provider.
     *
     * @param  string $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://accounts.haravan.com/connect/authorize', $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return 'https://accounts.haravan.com/connect/token';
    }

    protected function getTokenFields($code)
    {
        return Arr::add(
            parent::getTokenFields($code),
            'grant_type',
            'authorization_code'
        );
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string $token
     * @return array
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://accounts.haravan.com/connect/userinfo', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => Arr::get($user, 'sub'),
            'name' => Arr::get($user, 'name'),
            'email' => Arr::get($user, 'email'),
            'locale' => Arr::get($user, 'locale'),
            'role' => Arr::get($user, 'role'),
            'org_id' => (int)Arr::get($user, 'orgid'),
            'org_name' => Arr::get($user, 'orgname'),
        ]);
    }
}
