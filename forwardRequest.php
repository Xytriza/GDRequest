<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['url'])) {
        $url = $_GET['url'];

        $request_url = "http://www.boomlings.com/" . $url;

        $ch = curl_init($request_url);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_PROXY, 'ip:port');
        //curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'user:pass');

        $response = curl_exec($ch);

        curl_close($ch);

        echo $response;
    } else {
        echo "Please provide a 'url' parameter in the query string.";
    }
} else {
    echo "GDRequest only accepts GET and POST requests.";
}
?>