<?php


namespace App\Factory;

use App\Service\Responder\JsonResponder;
use App\Service\Responder\Responder;
use App\Service\Responder\XmlResponder;

/**
 * Class ResponderFactory
 * @package App\Factory
 */
class ResponderFactory
{
    private const RESPONSE_TYPE = 'json';

    /**
     * @var JsonResponder
     */
    private JsonResponder $jsonResponder;

    /**
     * @var XmlResponder
     */
    private XmlResponder $xmlResponder;

    /**
     * ResponseFactory constructor.
     * @param JsonResponder $jsonResponder
     * @param XmlResponder $xmlResponder
     */
    public function __construct(JsonResponder $jsonResponder, XmlResponder $xmlResponder)
    {
        $this->jsonResponder = $jsonResponder;
        $this->xmlResponder = $xmlResponder;
    }

    public function get($responseType = self::RESPONSE_TYPE): Responder
    {
        switch ($responseType) {
            case 'json':
                return $this->jsonResponder;
                break;
            case 'xml':
                return $this->xmlResponder;
                break;
            default:
                return $this->jsonResponder;
        }
    }
}
