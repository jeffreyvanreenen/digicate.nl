<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        // zet de XML file om in een php-string
        $buienradar = "http://xml.buienradar.nl/";

        // laad de XML file
        $weerdata = @simplexml_load_file($buienradar) or die ("no file loaded");

        // creëer de variabelen
        $voorbeeld = array([
        'opgemaakt' => $weerdata->weergegevens->verwachting_vandaag->tijdweerbericht,
        'verwachting' => $weerdata->weergegevens->verwachting_vandaag->titel,
        'verwachtingtekst' => $weerdata->weergegevens->verwachting_vandaag->tekst,
        'buienradar' => $weerdata->weergegevens->actueel_weer->buienradar->url,
        'weertype' => $weerdata->weergegevens->actueel_weer->buienradar->icoonactueel,
        'weertypetekst' => $weerdata->weergegevens->actueel_weer->buienradar->icoonactueel['zin'],
        'buienindex' => $weerdata->weergegevens->actueel_weer->buienindex->waardepercentage,
        ]);

        foreach($weerdata->weergegevens->actueel_weer->weerstations->children() as $station) {
            if ($station->stationcode == '6330') { break; }
        }

        return view('welcome')->with('station', $station);
    }
}
