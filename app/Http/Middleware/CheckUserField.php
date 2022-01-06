<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

use App\Exceptions\AuthException;
use App\Services\PostService;

class CheckUserField extends BaseMiddleware
{
    private $exception;
    private $postService;
    public function __construct(
        AuthException $exception,
        PostService $postService
    ) {
        $this->exception   = $exception;
        $this->postService = $postService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $userData = auth('api')->user();
        
        if (isset($request->post_id)) {
            $postData    = $this->postService->getPost((int)$request->post_id);
            $postFieldId = isset($postData->field_id) ? $postData->field_id : 0;

            // 判斷user與request的領域是否相同
            $postFieldId !== $userData->field_id && $this->exception->error(905);
        }

        // 增加user_id在request
        $request->request->add([
            'user_id'  => $userData->id,
            'field_id' => $userData->field_id,
        ]);

        return $next($request);
    }
}
