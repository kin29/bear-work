<?php
namespace MyVendor\WellSaid\Resource\Page;

use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public function onGet() : ResourceObject
    {
        $url = "http://127.0.0.1:8080/said?mode=random";
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す

        $response = curl_exec($curl);
        $this->body = json_decode($response, true);

        curl_close($curl);
        return $this;
    }
}
