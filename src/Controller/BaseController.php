<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    /**
     * @param mixed $data Usually an object you want to serialize
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->get('serializer')
            ->serialize($data, 'json');

        return new JsonResponse($json, $statusCode, [], true);
    }

    /**
     * Remove parameter from request URI
     * @param Request $request
     * @param $parameterName
     * @param null $value if null, remove all values of parameter
     * @return string
     */
    protected function stripParameter(Request $request, $parameterName, $value = null)
    {
        $url = $request->getUri();
        $parsed = [];

        parse_str(substr($url, strpos($url, '?') + 1), $parsed);

        if ($value != null) {
            if (false !== $key = array_search($value, $parsed[$parameterName])) {
                unset($parsed[$parameterName][$key]);
            }

            if (empty($parsed[$parameterName])) {
                unset($parsed[$parameterName]);
            }
        } else {
            unset($parsed[$parameterName]);
        }

        $url = $request->getSchemeAndHttpHost()
            . $request->getBaseUrl()
            . $request->getPathInfo();

        if(empty($parsed))
        {
            return $url;
        }

        return $url . '?' . http_build_query($parsed);
    }
}