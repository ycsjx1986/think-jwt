<?php

declare(strict_types=1);

namespace think\facade\middleware;

use think\facade\Jwt;

/**
 * Jwt 校验中间件
 * @see \think\facade\middleware\CheckJwt
 * @package think\facade\middleware\CheckJwt
 * @mixin \think\facade\middleware\CheckJwt
 */
class CheckJwt
{
    /**
     * @param $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        try {
            $dt = Jwt::getRequestToken();
            if (empty($dt)) {
                throw new \Exception('Authorization没有设置');
            }
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => $e->getMessage(), 'data' => null]);
        }
        return $next($request);
    }
}
