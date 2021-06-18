<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twiiter DEMO</title>
</head>
<body>
    <?php
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');

        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token' => "1034503428108627969-fYFa61FtCLjeilzKPKVQcMVrWV5oGU",
            'oauth_access_token_secret' => "tpPSuv1Z7GRlQDJ0j4WFRCR4hL6t0RCV6pNc2UFsKlUuD",
            'consumer_key' => "nrFCmpk4FMiSOyfZfg76fgOlJ",
            'consumer_secret' => "BeyydJWXjDdrYXzWTSkig3D9AfMasRYYaTpKQYj1c6tT929pH6"
        );

        /** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
        $url = 'https://api.twitter.com/1.1/blocks/create.json';
        $requestMethod = 'POST';

        /** POST fields required by the URL above. See relevant docs as above **/
        $postfields = array(
            'screen_name' => 'usernameToBlock', 
            'skip_status' => '1'
        );

        /** Perform a POST request and echo the response **/
        $twitter = new TwitterAPIExchange($settings);
        echo $twitter->buildOauth($url, $requestMethod)
                    ->setPostfields($postfields)
                    ->performRequest();

        /** Perform a GET request and echo the response **/
        /** Note: Set the GET field BEFORE calling buildOauth(); **/
        $url = 'https://api.twitter.com/1.1/followers/ids.json';
        $getfield = '?screen_name=J7mbo';
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        echo $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();
    ?>
</body>
</html>