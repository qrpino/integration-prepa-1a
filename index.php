<?php
function csvLastValue($path, $unitType)
{
    $dateTimeFormat = 'Y-m-d H:i:s';
    $handle = fopen($path, "r");
    $data = fgetcsv($handle);
   // $timestamp = $data[count($data) - 2];
   // $date = new \DateTime();
   // $date->setTimestamp($timestamp);
    $value = $data[count($data) - 1];
    echo (/*$date->format($dateTimeFormat) . " " . */ $value . $unitType);
    fclose($handle);
};
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="twitter:site" content="@metroui">
    <meta name="twitter:creator" content="@pimenov_sergey">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Metro 4 Components Library">
    <meta name="twitter:description" content="Metro 4 is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with responsive grid system, extensive prebuilt components, and powerful plugins  .">
    <meta name="twitter:image" content="https://metroui.org.ua/images/m4-logo-social.png">

    <meta property="og:url" content="https://metroui.org.ua/index.html">
    <meta property="og:title" content="Metro 4 Components Library">
    <meta property="og:description" content="Metro 4 is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with responsive grid system, extensive prebuilt components, and powerful plugins  .">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://metroui.org.ua/images/m4-logo-social.png">
    <meta property="og:image:secure_url" content="https://metroui.org.ua/images/m4-logo-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="968">
    <meta property="og:image:height" content="504">

    <meta name="author" content="Sergey Pimenov">
    <meta name="description" content="The most popular HTML, CSS, and JS library in Metro style.">
    <meta name="keywords" content="HTML, CSS, JS, Metro, CSS3, Javascript, HTML5, UI, Library, Web, Development, Framework">

    <link href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css?ver=@@b-version" rel="stylesheet">
    <link href="start.css" rel="stylesheet">

    <title>FABLAB IMERIR</title>
</head>

<body class="bg-dark fg-white h-vh-100 m4-cloak">

    <div class="container-fluid start-screen h-100">
        <h1 class="start-screen-title">FabLab</h1>

        <div class="tiles-area clear">
            <div class="tiles-grid tiles-group size-2 fg-white" data-group-title="Télémétrie">
                <div data-role="tile" class="bg-cyan fg-white" data-size="medium">
                    <span>//Todo Température ext</span>
                    <span class="branding-bar">Température Ext</span>
                </div>
                <div data-role="tile" class="bg-orange fg-white" data-size="medium">
                    <span>
                        <?php
                        csvLastValue("data-csv/data-fablab-thermo-int.csv", "°C");
                        ?>
                    </span>
                    <span class="branding-bar">Température Int</span>
                </div>
                <div data-role="tile" class="bg-cyan fg-white" data-size="medium">
                    <span>
                        <?php
                        csvLastValue("data-csv/data-fablab-wind.csv", "km/h");
                        ?>
                    </span>
                    <span class="branding-bar">Vitesse du vent</span>
                </div>
                <div data-role="tile" class="bg-orange fg-white" data-size="medium">
                    <span>
                        <?php
                        csvLastValue("data-csv/data-fablab-weather-hydro.csv", "% d'humidité");
                        ?>
                    </span>
                    <span class="branding-bar">Humidité Ext</span>
                </div>
                <div data-role="tile" class="bg-orange fg-white" data-size="medium">
                    <span>
                        <?php
                        csvLastValue("data-csv/data-fablab-weather-pression.csv", "hPa");
                        ?>
                    </span>
                    <span class="branding-bar">Pression Atmo</span>
                </div>
                <div data-role="tile" class="bg-orange fg-white" data-size="medium">
                    <span>
                        <?php
                        //csvLastValue("data-csv/data-fablab-weather-pression.csv", "hPa");
                        ?>
                    </span>
                    <span class="branding-bar">Personnes FabLab</span>
                </div>

            </div>

            <div class="tiles-grid tiles-group size-2 fg-white" data-group-title="Graphiques Télémétrie">
                <a data-role="tile" data-cover="graph/thermo-ext.png" data-size="wide" href="graph/thermo-ext.png">
                    <span class="branding-bar">Température Extérieure 24H</span>
                </a>
                <a data-role="tile" data-cover="graph/thermo-int.png" data-size="wide" href="graph/thermo-int.png">
                    <span class="branding-bar">Température Intérieure 24H</span>
                </a>
                <a data-role="tile" data-cover="graph/wind-graph.png" data-size="wide" href="graph/wind-graph.png">
                    <span class="branding-bar">Vitesse du vent 24H</span>
                </a>
                <a data-role="tile" data-cover="graph/hydro-graph.png" data-size="wide" href="graph/hydro-graph.png">
                    <span class="branding-bar">Taux d'humidité</span>
                    </span>
                </a>
                <a data-role="tile" data-cover="graph/pression-graph.png" data-size="wide" href="graph/pression-graph.png">
                    <span class="branding-bar">Pression </span>
                    </span>
                </a>
                <a data-role="tile" data-cover="graph/personnes-graph.png" data-size="wide" href="graph/personnes-graph.png">
                    <span class="branding-bar">Personnes au sein du FabLab</span>
                </a>
            </div>

            <div class="tiles-grid tiles-group size-2 fg-white" data-group-title="Twitter" data-size="wide">
                <a class="twitter-timeline" data-lang="fr" data-width="500" data-height="800" data-theme="light" href="https://twitter.com/imerir?ref_src=twsrc%5Etfw">Tweets by imerir</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </div>


    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
    <script src="start.js"></script>

</body>

</html>