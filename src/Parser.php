<?php

namespace vahidkaargar\pasargad;

class Parser
{
    public function makeXMLTree($data)
    {
        return json_decode(json_encode((array)simplexml_load_string($data)), 1);
    }

    public function post2https($fields_arr, $url)
    {
        $fields_string = "";
        foreach ($fields_arr as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        $fields_string = substr($fields_string, 0, -1);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields_arr));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $res = curl_exec($ch);

        //close connection
        curl_close($ch);
        return $res;
    }
}