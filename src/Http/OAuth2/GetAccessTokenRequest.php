<?php

declare(strict_types=1);

namespace Saloon\Http\OAuth2;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\WithBody;
use Saloon\Traits\Body\HasFormBody;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Traits\Plugins\AcceptsJson;

class GetAccessTokenRequest extends Request implements WithBody
{
    use HasFormBody;
    use AcceptsJson;

    /**
     * Define the method that the request will use.
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Define the endpoint for the request.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return $this->oauthConfig->getTokenEndpoint();
    }

    /**
     * Requires the authorization code and OAuth 2 config.
     *
     * @param string $code
     * @param OAuthConfig $oauthConfig
     */
    public function __construct(protected string $code, protected OAuthConfig $oauthConfig)
    {
        //
    }

    /**
     * Register the default data.
     *
     * @return array
     */
    public function defaultBody(): array
    {
        return [
            'grant_type' => 'authorization_code',
            'code' => $this->code,
            'client_id' => $this->oauthConfig->getClientId(),
            'client_secret' => $this->oauthConfig->getClientSecret(),
            'redirect_uri' => $this->oauthConfig->getRedirectUri(),
        ];
    }
}
