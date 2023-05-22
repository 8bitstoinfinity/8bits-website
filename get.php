<?php

error_reporting(-1);
ini_set('display_errors', 'On');

class Jam
{
    public $name;
    public $url;
    public $month;
    public $logo;
}

$data = ['jams' => []];
$jam_dirs = scandir("jam");
$i = 0;
foreach ($jam_dirs as $jam_dir) {
    if ($jam_dir[0] == '.')
        continue;
    $jam = new Jam();

    $exploded = explode('_', $jam_dir);
    $count = count($exploded);
    if ($count != 2)
        die("Error: Expected 2 elements in exploded dir '$jam_dir', got $count");

    $jam->month = $exploded[0];
    $jam->name = $exploded[1];
    $img = "jam/$jam_dir/logo";
    if (file_exists("$img.png"))
        $jam->logo = "$img.png";
    else if (file_exists("$img.gif"))
        $jam->logo = "$img.gif";
    else
        die("Error: No logo for $jam_dir, checked '$img.gif' and '$img.png'");

    $url_file = fopen("jam/$jam_dir/url.txt", "r") or die("Error: No URL file for $jam_dir");
    $jam->url = fgets($url_file);
    fclose($url_file);

    $data['jams'][$i] = $jam;
    $i++;
}

$json = json_encode($data);
echo ($json);
