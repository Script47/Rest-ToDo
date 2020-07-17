<?php

namespace App\Service\Responder;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class XmlResponder
 * @package App\Service\Responder
 */
class XmlResponder implements Responder
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * JsonResponder constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param mixed $data
     * @param int $statusCode
     * @param array $headers
     * @return Response
     */
    public function respond($data, int $statusCode, $headers = []): Response
    {
        $json = $this->serializer->serialize($data, XmlEncoder::FORMAT);
        $headers = array_merge(
            [
                'Content-Type' => 'application/xml'
            ],
            $headers
        );

        return new Response($json, $statusCode, $headers);
    }
}
