<?php
function csvLastValue($path, $unitType)
{

    $rows = file($path);
    $last_row = array_pop($rows);
    $data = str_getcsv($last_row);
    echo($data[1] . $unitType);
};
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="30" > 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">

    <title>FABLAB IMERIR</title>
</head>
<body>
    <div id="affichage">

        <div id="col1">
            <div class="box">
                <!--  1 Température Exterieur -->
                <a>Température actuelle exterieur <p class="value"><?php csvLastValue("data-csv/data-fablab-weather-thermo.csv", "°C");?></p></a>
            </div>    

            <div class="box">
                <!-- 2 Pourcentage Humidité Exterieur -->
                <a>Pourcentage actuelle d'humidité exterieur <p class="value"><?php csvLastValue("data-csv/data-fablab-weather-hydro.csv", "%");?></p></a>
            </div> 
            
            <div class="box">
                <!-- 3 Pression Exterieur -->
                <a>Préssion actuelle <p class="value"><?php csvLastValue("data-csv/data-fablab-weather-pression.csv", "hPa");?></p></a>
            </div>

            <div class="box">
                <!--  4 Température Interieur -->
                <a>Température actuelle intérieur <p class="value"><?php csvLastValue("data-csv/data-fablab-thermo-int.csv", "°C");?></p></a>
            </div>    

            <div class="box">
                <!-- 5 Pourcentage Humidité Interieur -->
                <a>Pourcentage actuelle d'humidité interieur <p class="value"><?php csvLastValue("data-csv/data-fablab-hydro-int.csv", "%");?></p></a>
            </div> 
            
            <div class="box">
                <!-- 6 Vitesse vent  -->
                <a>Vitesse du vent actuelle <p class="value"><?php csvLastValue("data-csv/data-fablab-weather-wind.csv", "km/h");?></p></a>
            </div>

            <div class="box">
                <!-- 7 Entrer Sortie -->
                <a>Nommbre de personne dans le Fablab actuelle <p class="value"><?php csvLastValue("data-csv/data-fablab-number-person2.csv", " Personnes");?></p></a>
            </div>
            
        </div>

        <div class="col2">
            <div class="image">
                <!-- Température Exterieur Courbe -->
                <img src="graph/pression-graph.png" alt="Temperature exterieur graphique" height="null" width="400">
            </div>

            <div class="image">
                <!-- Humidité Courbe -->
                <img src="graph/hydro-graph.png" alt="Humidite graphique" height="null" width="400">
            </div>    
        </div>

        <div class="col3">
            <div><a class="twitter-timeline" data-lang="fr" data-width="400" data-height="800" data-theme="dark" href="https://twitter.com/imerir?ref_src=twsrc%5Etfw">Tweets by imerir</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>
        </div>
    </div>
</body>
</html>