<?php

namespace App\Middleware;
use App\Utils\Session;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class Authentication extends BaseMiddleware
{

    public function __invoke(ServerRequestInterface $requestInterface, Response $responseInterface, callable $next)
    {
        $user = Session::getSession('session_user');

        //Check user logged session data
        if (isset($user['par1'])) {
            return $next($requestInterface, $responseInterface);
        } else {
            return $responseInterface->withRedirect('/login');
        }
    }
}
