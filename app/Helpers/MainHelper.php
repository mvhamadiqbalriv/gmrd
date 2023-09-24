<?php

use GuzzleHttp\Client;

if (!function_exists('array_to_object')) {

    /**
     * Convert Array into Object in deep
     *
     * @param array $array
     * @return
     */
    function array_to_object($array)
    {
        return json_decode(json_encode($array));
    }
}

if (!function_exists('empty_fallback')) {

    /**
     * Empty data or null data fallback to string -
     *
     * @return string
     */
    function empty_fallback ($data)
    {
        return ($data) ? $data : "-";
    }
}

if (!function_exists('create_button')) {

    function create_button ($action, $model)
    {
        $action = str_replace($model, "", $action);

        return [
            'submit_text' => ($action == "update") ? "Update" : "Submit",
            'submit_response' => ($action == "update") ? "Updated." : "Submited.",
            'submit_response_notyf' => ($action == "update") ? "Data ".$model." updated successfully" : "Data ".$model." added successfully"
        ];
    }
}

if (!function_exists('api_desa_post')) {
    
    function api_desa_post ($endpoint,$params)
    {
        $client = new Client();

        $main_url = 'https://e-officedesa.sumedangkab.go.id/api/kkn/';
        $url = $main_url.$endpoint;

        $params['kkn_key'] = 'KuliahBsiAJA!';
        $params['state'] = 'kkn_ipdn';

        try {
            $res = $client->request('POST', $url, [
                'form_params' => $params,
                'verify' => false
            ]);
            $result = json_decode($res->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                // var_dump($response->getStatusCode()); // HTTP status code;
                // var_dump($response->getReasonPhrase()); // Response message;
                // var_dump((string) $response->getBody()); // Body, normally it is JSON;
                // var_dump(json_decode((string) $response->getBody())); // Body as the decoded JSON;
                // var_dump($response->getHeaders()); // Headers array;
                // var_dump($response->hasHeader('Content-Type')); // Is the header presented?
                // var_dump($response->getHeader('Content-Type')[0]); // Concrete header value;
                $result = null;
            }
        }


        return $result;
    }
    
    function api_desa_get ($endpoint,$params)
    {
        $client = new Client();

        $main_url = 'https://e-officedesa.sumedangkab.go.id/api/kkn/';
        $url = $main_url.$endpoint;

        $params['kkn_key'] = 'KuliahBsiAJA!';
        $params['state'] = 'kkn_ipdn';

        try {
            $res = $client->request('GET', $url, [
                'query' => $params,
                'verify' => false
            ]);
            $result = json_decode($res->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                // var_dump($response->getStatusCode()); // HTTP status code;
                // var_dump($response->getReasonPhrase()); // Response message;
                // var_dump((string) $response->getBody()); // Body, normally it is JSON;
                // var_dump(json_decode((string) $response->getBody())); // Body as the decoded JSON;
                // var_dump($response->getHeaders()); // Headers array;
                // var_dump($response->hasHeader('Content-Type')); // Is the header presented?
                // var_dump($response->getHeader('Content-Type')[0]); // Concrete header value;
                $result = null;
            }
        }


        return $result;
    }

}

function percentage($jumlah,$total)
{
    $result = ($jumlah / $total) * 100;
    $result = number_format($result, 2);
    
    if ($result > 50) {
        $badge = 'text-success';
    }else{
        $badge = 'text-danger';
    }

    $result = '<span class="'.$badge.'">'.$result.' %</span>';
    return $result;
}
