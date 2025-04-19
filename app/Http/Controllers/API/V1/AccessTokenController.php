<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\DataResponse;
use Laravel\Passport\Client;
use Laravel\Passport\Http\Controllers\AccessTokenController as BaseAccessTokenController;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\JwtFacade;
use Lcobucci\JWT\Parser;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class AccessTokenController extends BaseAccessTokenController
{
    public function issueToken(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $this->validateRequest($data);
        $token = $this->withErrorHandling(function () use ($request) {
            return $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Response)
            );
        });
        $token = json_decode($token->getContent(), true);
        $user = $this->resolveUserResource(data_get($data, 'client_id'), data_get($token, 'access_token'));
        return DataResponse::data([
            'user' => $user,
            'token' => $token
        ])->create();
    }

    private function validateRequest($data)
    {
        validator($data, [
            'client_id' => 'required|int|exists:oauth_clients,id',
            'client_secret' => 'required|string|exists:oauth_clients,secret',
            'username' => 'required|email',
            'password' => 'required|string',
        ])->validate();
    }

    private function resolveUserResource(int $clientId, string $accessToken)
    {
        $client = Client::find($clientId);
        $provider = $client->provider;
        $modelClass = config("auth.providers.{$provider}.model");
        $resourceClass = config("auth.providers.{$provider}.resource");
        $parser = new \Lcobucci\JWT\Token\Parser(new JoseEncoder());
        $userId = $parser->parse($accessToken)->claims()->get('sub');
        $user = $modelClass::find($userId);
        return new $resourceClass($user);
    }
}
