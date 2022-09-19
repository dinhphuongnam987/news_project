<?php

namespace App\Helpers;


class Feed
{
    public static function read($itemsRss)
    {
        $result = [];
        foreach ($itemsRss as $value) {
            if (Feed::checkSourceLink($value['source'], $value['link'])) {
                switch ($value['source']) {
                    case 'vnexpress':
                        $data = Feed::readVNExpress($value['link']);
                        break;
                    case 'tuoitre':
                        $data = Feed::readTuoiTre($value['link']);
                        break;
                }
                $result = array_merge_recursive($result, $data);
            }
        }
        return $result;
    }

    public static function checkSourceLink($source, $link)
    {
        $sourceFromLink = explode('.', parse_url($link, PHP_URL_HOST))[0];
        return ($source == $sourceFromLink);
    }

    public static function readVNExpress($link) // name
    {
        try {
            $data = simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);
            $data = json_encode($data);
            $data = json_decode($data, TRUE);
            $data = $data['channel']['item'];

            foreach ($data as $key => $value) {
                unset($data[$key]['guid']);
                $tmp1 = [];
                $tmp2 = [];

                preg_match('/src="([^"]*)"/i', $value['description'], $tmp1);
                $pattern = '.*br>(.*)';
                preg_match('/' . $pattern . '/', $value['description'], $tmp2);

                $data[$key]['description'] = $tmp2[1] ?? $value['description'];
                $data[$key]['thumb'] = $tmp1[1] ?? '';
            }
            return $data;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public static function readTuoiTre($link) // name
    {
        try {
            $data = simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);
            $data = json_encode($data);
            $data = json_decode($data, TRUE);
            $data = $data['channel']['item'];

            foreach ($data as $key => $value) {
                unset($data[$key]['guid']);
                $tmp1 = [];
                $tmp2 = [];

                preg_match('/src="([^"]*)"/i', $value['description'], $tmp1);
                preg_match('/.*<\/a>(.*)/', $value['description'], $tmp2);

                $data[$key]['description'] = $tmp2[1] ?? $value['description'];
                $data[$key]['thumb'] = $tmp1[1] ?? '';
            }
            return $data;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public static function getGold()
    {
        $context = stream_context_create(['ssl' => [
            'verify_peer' => false,
            "verify_peer_name" => false
        ]]);

        libxml_set_streams_context($context);
        $link = 'https://www.sjc.com.vn/xml/tygiavang.xml';
        $data = simplexml_load_file($link);
        $data = json_encode($data);
        $data = json_decode($data, TRUE);
        $data = $data['ratelist']['city'][0]['item'];
        $data = array_column($data, '@attributes');
        return $data;
    }

    public static function getCoin()
    {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
            'start' => '1',
            'limit' => '10',
            'convert' => 'USD'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: 2e80a8cb-d753-4236-897c-55b86ca8ed83'
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers 
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        $data = json_decode($response, TRUE); // print json decoded response
        $data = $data['data'];
        curl_close($curl); // Close request

        $result = [];
        foreach ($data as $key => $value) {
            $result[$key]['name'] = $value['name'];
            $result[$key]['price'] = $value['quote']['USD']['price'];
            $result[$key]['percent_change_24h'] = $value['quote']['USD']['percent_change_24h'];
        }
        return $result;
    }
}
