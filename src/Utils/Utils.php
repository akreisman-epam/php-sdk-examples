<?php
namespace Utils;

use Hyperwallet\Model\BaseModel;
use Hyperwallet\Response\ListResponse;
use Symfony\Component\Config\Definition\Exception\Exception;

class Utils
{
    const CLIENT_PRIVATE_KEYSET_PATH = "/app/layer7/private-jwkset";
    const HYPERWALLET_KEYSET_PATH = "https://uat-api.paylution.com/jwkset";

    public static function toJson($obj)
    {
        if ($obj instanceof BaseModel) {
            return \GuzzleHttp\json_encode($obj->getProperties(), JSON_FORCE_OBJECT);
        } elseif ($obj instanceof ListResponse) {
            $data = array_map(function (BaseModel $value) {
                return $value->getProperties();
            },  $obj->getData());
            return \GuzzleHttp\json_encode(array(
                'count' => $obj->getCount(),
                'data' => $data,
            ));
        } else {
            throw new Exception("Illegal argument");
        }

    }

}