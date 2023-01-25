<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;

class Auth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //Memfilter Routers Dengan JWT
        //Ambil Secret Key
        $key = getenv('JWT_SECRET_KEY');
        //Ambil Header
        $header = $request->getServer('HTTP_AUTHORIZATION');
        //Jika Gak Ada Token / User Gak Ngirim Token
        if (!$header) return Services::response()
            ->setJSON(['msg' => 'Butuh Tokennya !'])
            ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        //Jika Ada Tokennya Di Pecah Atau Explode
        $token = explode(' ', $header)[1];
        try {
            //Kalau Tokennya Valid
            JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Throwable $th) {
            //Kalau Tokennya Tidak Valid
            return Services::response()
                ->setJSON(['msg' => $th->getMessage()])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            //throw $th;
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
