<?php


namespace App\Service\Responder;

use Symfony\Component\HttpFoundation\Response;

/**
 * Interface Responder
 * @package App\Service\Responder
 */
interface Responder
{
    /**
     * @param $data
     * @param int $statusCode
     * @param array $headers
     * @return Response
     */
    public function respond($data, int $statusCode, array $headers = []): Response;
}
