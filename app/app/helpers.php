<?php

use \GuzzleHttp\Client;

/**
 * Verify if the giver user id is valid
 *
 * @param integer $id
 * @return mixed|\Psr\Http\Message\ResponseInterface
 */
function verifyUserId($id)
{
    $url = str_replace(
        '{id}', $id,
        'http://private-d65c6-phpdevtest.apiary-mock.com/user/{id}/isvalid'
    );

    $client = new Client(['base_uri' => $url]);

    try {
        $response = (string)$client->request('GET')->getBody();
        if (!$response || !@json_decode($response, true)) {
            return false;
        }
        $data = json_decode($response, true);

        return isset($data['validate']) && $data['validate'];
    } catch (Exception $e) {
        return false;
    }
}
