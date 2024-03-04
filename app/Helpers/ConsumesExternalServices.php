<?php


namespace App\Helpers;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{
    public function makeRequest($method, $requestUrl, $queryParams = [],
                                $formParams = [], $headers = [], $isJsonRequest = false){

        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        //add the capability to decode specific response
        if (method_exists($this, 'resolveAuthorization')){
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }
        $response = $client->request($method, $requestUrl, [
            $isJsonRequest ? 'json' : 'form_params' => $formParams,
            'headers' => $headers,
            'query' => $queryParams,
        ]);

        $response = $response->getBody()->getContents();

        //obtain decode response
        if (method_exists($this, 'decodeResponse')){
            $response = $this->decodeResponse($response);
        }

        return $response;

    }
}
