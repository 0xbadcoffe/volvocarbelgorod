<?php

ini_set("display_errors",1);
error_reporting(E_ALL);

include_once('config.php');

$total = 0;
$offset = 0;

$vehicles = [];

$bodyTypes = [
    'suv' => 'Внедорожник',
    'hatchback' => 'Хэтчбек',
    'sedan' => 'Седан',
    'universal' => 'Универсал'
];

$colm = array(
    "V90CC - silver metall" => "303",
    "V90CC - black metall" => "308",
    "V90CC - black" => "307",
    "V90CC - violet metall" => "306",
    "V90CC - grey metall" => "305",
    "V90CC - grey metall" => "304",
    "V90CC - blue metall" => "302",
    "V90CC - green metall" => "301",
    "V90CC - silver metall" => "300",
    "V90CC - silver metall" => "299",
    "V90CC - beige metall" => "298",
    "V90CC - brown metall" => "297",
    "V90CC - white metall" => "296",
    "V90CC - white" => "295",
    "V40CC - black metall" => "294",
    "V40CC - black" => "293",
    "V40CC - grey metall" => "292",
    "V40CC - blue metall" => "291",
    "V40CC - silver metall" => "290",
    "V40CC - silver metall" => "289",
    "V40CC - silver metall" => "288",
    "V40CC - beige metall" => "287",
    "V40CC - red metall" => "286",
    "V40CC - red" => "285",
    "XC90 - grey metall" => "265",
    "XC90 - grey metall" => "266",
    "XC90 - violet metall" => "267",
    "XC90 - black metall" => "268",
    "S90 - white" => "269",
    "S90 - white metall" => "270",
    "S90 - brown metall" => "271",
    "S90 - silver metall" => "272",
    "S90 - silver metall" => "273",
    "S90 - green metall" => "274",
    "S90 - blue metall" => "275",
    "S90 - silver metall" => "276",
    "S90 - grey metall" => "277",
    "S90 - violet metall" => "278",
    "S90 - black" => "279",
    "S90 - black metall" => "280",
    "V40CC - red metall" => "281",
    "V40CC - white" => "282",
    "V40CC - blue" => "283",
    "V40CC - white metall" => "284",
    "XC90 - silver metall" => "264",
    "XC90 - blue metall" => "263",
    "XC90 - green metall" => "262",
    "XC90 - silver metall" => "261",
    "XC90 - beige metall" => "260",
    "XC90 - brown metall" => "259",
    "XC90 - white metall" => "258",
    "XC90 - white" => "257",
    "XC60 - black metall" => "256",
    "XC60 - silver metall" => "255",
    "XC60 - blue metall" => "254",
    "XC60 - green metall" => "253",
    "XC60 - silver metall" => "252",
    "XC60 - beige metall" => "251",
    "XC60 - red metall" => "250",
    "XC60 - brown metall" => "249",
    "XC60 - white metall" => "248",
    "XC60 - white" => "247",
    "XC40 - black metall" => "246",
    "XC40 - black" => "245",
    "XC40 - silver metall" => "244",
    "XC40 - silver metall" => "243",
    "XC40 - white" => "242",
);

$gearboxTypes = [
    'automatic' => 'АКПП',
    'manual' => 'МКПП',
    'robotized' => 'РКПП'
];

$producturl = [
    'XC90' => 'https://motorlandgroup.ru/models/xc90/',
    'XC60' => 'https://motorlandgroup.ru/models/xc60_new/',
    'XC40' => 'https://motorlandgroup.ru/models/xc40/',
    'V40CC' => 'https://motorlandgroup.ru/models/v40_cross_country/',
    'V60CC' => 'https://motorlandgroup.ru/models/v60-cross-country/',
    'V90CC' => 'https://motorlandgroup.ru/models/v90_cross_country/',
    'S90' => 'https://motorlandgroup.ru/models/s90/',
    'S60' => 'https://motorlandgroup.ru/models/s60/'
];

$engineTypes = [
    'petrol' => 'Бензин',
    'diesel' => 'Дизель'
];

$driveTypes = [
    'front' => 'Передний',
    'rear' => 'Задний',
    'full_4wd' => 'Полный',
    'optional_4wd' => 'Полный',
];

$equipments = [];

function getVehiclesEq() {
    global $equipments, $api_key;

    $ch = curl_init('https://api.maxposter.ru/partners-api/directories/vehicle-equipment.json');
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Basic '. $api_key
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
    $response = curl_exec($ch);
    
    if(curl_errno($ch)){
        return false;
    }
    
    
    $response = json_decode($response);
    
    foreach($response->data->vehicleEquipment as $eq) {
        $equipments[$eq->id] = $eq->name;
    }
}

function getVehicles($offs = 0){
    global $vehicles, $api_key, $url, $total, $offset, $gearboxTypes, $bodyTypes, $engineTypes, $driveTypes;
    
    $ch = curl_init($url);
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Basic '. $api_key
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['offset' => $offs, 'filters' => [['fields' => 'dealer', 'type' => 'equal', 'value' => 2298]]]));
    
    $response = curl_exec($ch);

    if(curl_errno($ch)){
        return false;
    }
    
    $response = json_decode($response);
    if($response->status == 'success'){
        $total = $response->data->meta->range->total;
        $offset = $response->data->meta->range->offset + $response->data->meta->range->limit;
        foreach($response->data->vehicles as $id=>$vehicle){
            $vehicles[] = [
                'id' => $vehicle->id,
                'name' => implode(' ', array($vehicle->brand->name, $vehicle->model->name)),
                'bodyType' => isset($bodyTypes[$vehicle->bodyType]) ? $bodyTypes[$vehicle->bodyType] : $vehicle->bodyType,
                'complectation' => $vehicle->complectation->name,
                'brand' => $vehicle->brand->name,
                'model' => $vehicle->model->name . ' ' . $vehicle->modification->name,
                'description' => $vehicle->description,
                'bodyColor' => $vehicle->bodyColor . ($vehicle->bodyColorMetall ? ' metall' : ''),
                'enginePower' => $vehicle->enginePower,
                'engineType' => $engineTypes[$vehicle->engineType],
                'engineVolume' => $vehicle->engineVolume,
                'gearboxType' => $gearboxTypes[$vehicle->gearboxType] . ($vehicle->gearboxGearCount > 0 ? $vehicle->gearboxGearCount : ''),
                'type' => $vehicle->type,
                'year' => $vehicle->year,
                'price' => $vehicle->price,
                'priceWithDiscount' => $vehicle->priceWithDiscount,
                'photos' => $vehicle->photos,
                'model_only' => $vehicle->model->name,
                'bodyConfiguration' => $vehicle->bodyConfiguration->name,
                'run' => $vehicle->mileage,
                'driveType' => $driveTypes[$vehicle->driveType],
                'equipments' => $vehicle->equipment
                
            ];
        }
        return true;
    }else{
        echo 'error';
    }
}

getVehiclesEq();
getVehicles();

if($total > 100){
    $chunks = intdiv($total, 100);
    for($i=1; $i<=$chunks; $i++){
        getVehicles($offset);
    }
}

//saveCriteoYML();
//saveCriteoCSV();
saveAvailableCSV();
//saveFacebookFeedAuto('Воронеж', 'fb_feed.xml', 'https://motorlandgroup.ru/');

$c = 0;
foreach($vehicles as $id=>$vehicle){
    
    $c++;
    if($vehicle['priceWithDiscount'] > 0){
        echo $c . ')' . $vehicle['name'] . ' - ' . $vehicle['priceWithDiscount'] . ' (DC)<br>';
    }else{
        echo $c . ')' . $vehicle['name'] . ' - ' . $vehicle['price'] . '<br>';
    }
    
    /*
    
    if($vehicle['priceWithDiscount'] > 0 && $vehicle['priceWithDiscount'] < $vehicle['price']){
        echo '<span style="color: red">';
        echo $vehicle['priceWithDiscount']. ' руб! ';
    }
    echo $id . '. ' . $vehicle['name'] . '<br>';
    if($vehicle['priceWithDiscount'] > 0 && $vehicle['priceWithDiscount'] < $vehicle['price']){
        echo '</span>';
    }*/
}

function prepareColor($model, $color){
    global $colm;
    $model = str_replace(' ', '', $model);
    $model = str_replace('CrossCountry', 'CC', $model);
    $result = '';
    if(isset($colm[$model . ' - ' . $color])){
        $result = $colm[$model . ' - ' . $color];
    }
    return $result;
}

function saveAvailableCSV(){
    
    global $vehicles, $equipments;
    
    $f = fopen('available.csv', 'w');
    foreach($vehicles as $vehicle){
        $data = [];
        $data['ID'] = $vehicle['id'];
        $data['NAME'] = $vehicle['name'];
        $data['BODY'] = $vehicle['bodyType'];
        $data['GEARBOX'] = $vehicle['gearboxType'];
        $data['COMPLECTATION'] = $vehicle['complectation'];
        $data['POWER'] = $vehicle['enginePower'];
        $data['PRICE'] = $vehicle['price'];
        
        $data['SPECIAL'] = '';
        $data['PRICE_WITH_DISCOUNT'] = '';
        if($vehicle['priceWithDiscount'] > 0 && $vehicle['priceWithDiscount'] < $vehicle['price']){
            $data['SPECIAL'] = 'Y';
            $data['PRICE_WITH_DISCOUNT'] = $vehicle['priceWithDiscount'];
        }
        
        /*$data['COL_EL'] = '';
        if(count($vehicle['photos']) == 1){
            $data['COL_EL'] = prepareColor($vehicle['model_only'], $vehicle['bodyColor']);
        }*/
        
        $data['YEAR'] = $vehicle['year'];
        $data['RUN'] = $vehicle['run'];
        $data['ENGINE_TYPE'] = $vehicle['engineType'];
        $data['DRIVE_TYPE'] = $vehicle['driveType'];
        $data['ENGINE_VOLUME'] = $vehicle['engineVolume'];
        $data['COLOR'] = $vehicle['bodyColor'];
        $data['MODEL_ONLY'] = $vehicle['model_only'];
        
        $data['DESCRIPTION'] = $vehicle['description'];
        
        $maxArray = $vehicle['equipments'];
        if(count($vehicle['photos']) >= count($vehicle['equipments'])){
            $maxArray = $vehicle['photos'];
        }
        $c = 0;
        foreach($maxArray as $key => $el) {
            $data['PHOTO'] = '';
            $data['EQUIPMENT'] = '';
            if(isset($vehicle['photos'][$c])){
                $data['PHOTO'] = str_replace('http:', '', $vehicle['photos'][$c]->url);
            }
            if(isset($vehicle['equipments'][$key])){
                $data['EQUIPMENT'] = $equipments[$vehicle['equipments'][$key]];
            }
            fputcsv($f, $data,',','"');
            $c++;
        }
        
        /*foreach($vehicle['photos'] as $photo){
            $data['PHOTO'] = str_replace('http:', '', $photo->url);
            fputcsv($f, $data,',','"');
        }*/
    }
    fclose($f);
}


function saveAvailableCSV_OLD(){
    
    global $vehicles, $equipments;
    
    $f = fopen('available.csv', 'w');
    foreach($vehicles as $vehicle){
        $data = [];
        $data['ID'] = $vehicle['id'];
        $data['NAME'] = $vehicle['name'];
        $data['COLOR'] = $vehicle['bodyColor'];
        $data['BODY'] = $vehicle['bodyType'];
        $data['POWER'] = $vehicle['enginePower'];
        $data['COMPLECTATION'] = $vehicle['complectation'];
        $data['GEARBOX'] = $vehicle['gearboxType'];
        $data['PRICE'] = $vehicle['price'];
        $data['SPECIAL'] = '';
        $data['PRICE_WITH_DISCOUNT'] = '';
        if($vehicle['priceWithDiscount'] > 0 && $vehicle['priceWithDiscount'] < $vehicle['price']){
            $data['SPECIAL'] = 'Y';
            $data['PRICE_WITH_DISCOUNT'] = $vehicle['priceWithDiscount'];
        }
        $data['COL_EL'] = '';
        if(count($vehicle['photos']) == 1){
            $data['COL_EL'] = prepareColor($vehicle['model_only'], $vehicle['bodyColor']);
        }
        $data['ENGINE_TYPE'] = $vehicle['engineType'];
        $data['ENGINE_VOLUME'] = $vehicle['engineVolume'];
        $data['MODEL_ONLY'] = $vehicle['model_only'];
        $data['RUN'] = $vehicle['run'];
        $data['DESCRIPTION'] = $vehicle['description'];
        
        $maxArray = $vehicle['equipments'];
        if(count($vehicle['photos']) >= count($vehicle['equipments'])){
            $maxArray = $vehicle['photos'];
        }
        $c = 0;
        foreach($maxArray as $key => $el) {
            $data['PHOTO'] = '';
            $data['EQUIPMENT'] = '';
            if(isset($vehicle['photos'][$c])){
                $data['PHOTO'] = str_replace('http:', '', $vehicle['photos'][$c]->url);
            }
            if(isset($vehicle['equipments'][$key])){
                $data['EQUIPMENT'] = $equipments[$vehicle['equipments'][$key]];
            }
            fputcsv($f, $data,',','"');
            $c++;
        }
        
        /*foreach($vehicle['photos'] as $photo){
            $data['PHOTO'] = str_replace('http:', '', $photo->url);
            fputcsv($f, $data,',','"');
        }*/
    }
    fclose($f);
}

function saveCriteoCSV(){
    global $vehicles, $producturl;
    $f = fopen('criteo.csv', 'w');
    $data = ['id', 'name', 'bigname', 'oldprice', 'price', 'description', 'producturl', 'picture', 'category'];
    fputcsv($f, $data,',','"');
    foreach($vehicles as $vehicle){
        if($vehicle['priceWithDiscount'] > 0 && $vehicle['priceWithDiscount'] < $vehicle['price']){
            $data = [];
            $prefix_name = explode(' ', $vehicle['bodyConfiguration']);
            $data['ID'] = $vehicle['id'];
            $data['NAME'] = $prefix_name[0] . ' ' . $vehicle['name'];
            $data['BIGNAME'] = $vehicle['model'];
            $data['PRICE'] = $vehicle['price'];
            $data['PRICE_WITH_DISCOUNT'] = $vehicle['priceWithDiscount'];
            $data['DESCRIPTION'] = $vehicle['description'];
            $model = str_replace(' ', '', $vehicle['model_only']);
            $model = str_replace('CrossCountry', 'CC', $model);
            $data['PRODUCTURL'] = $producturl[$model];
            $data['PICTURE'] = $vehicle['photos'][0]->url;
            $data['CATEGORY'] = 'Vehicles & Parts > Vehicles > Motor Vehicles > Cars, Trucks & Vans';
            fputcsv($f, $data,',','"');
        }
    }
    fclose($f);
}

function saveCriteoYML(){
    
    global $vehicles;
        
    # Создание XML файла
    $version = '1.0';
    $encoding = 'windows-1251';
    $rootName = 'yml_catalog';
    $shopName = 'shop';
    $itemName = 'item';
        
    $xml = new XMLWriter();               
        
    $xml->openMemory();
    $xml->setIndent(true);
    $xml->startDocument($version, $encoding);
        
    $xml->startElement($rootName);
        
        $xml->startAttribute('date');
            $xml->text(date('Y-m-d H:i'));
        $xml->endAttribute();
        
        $xml->startElement($shopName);
            
            $xml->startElement('name');
                $xml->text('Volvo Воронеж');
            $xml->endElement();
            
            $xml->startElement('company');
                $xml->text('Мотор Ленд Volvo Воронеж');
            $xml->endElement();
            
            $xml->startElement('url');
                $xml->text('http://motorlandgroup.ru/offers/');
            $xml->endElement();
            
            $xml->startElement('currencies');
                $xml->startElement('currency');
                    $xml->startAttribute('id');
                        $xml->text('RUR');
                    $xml->endAttribute();
                    $xml->startAttribute('rate');
                        $xml->text('1');
                    $xml->endAttribute();
                $xml->endElement();
            $xml->endElement();
            
            $xml->startElement('categories');
                $xml->startElement('category');
                    $xml->startAttribute('id');
                        $xml->text('1');
                    $xml->endAttribute();
                    $xml->text('Автомобили');
                $xml->endElement();
            $xml->endElement();
            
            $xml->startElement('offers');
                
                foreach($vehicles as $vehicle){
                    if($vehicle['priceWithDiscount'] > 0 && $vehicle['priceWithDiscount'] < $vehicle['price']){
                        
                    $xml->startElement('offer');
                    
                        $xml->startAttribute('id');
                            $xml->text($vehicle['id']);
                        $xml->endAttribute();
                        
                        $xml->startAttribute('available');
                            $xml->text('true');
                        $xml->endAttribute();
                        
                        $xml->startElement('url');
                            $xml->text('http://motorlandgroup.ru/offers/');
                        $xml->endElement();
                        
                        $xml->startElement('price');
                            $xml->text($vehicle['priceWithDiscount']);
                        $xml->endElement();
                        
                        $xml->startElement('oldprice');
                            $xml->text($vehicle['price']);
                        $xml->endElement();
                        
                        $xml->startElement('currencyId');
                            $xml->text('RUR');
                        $xml->endElement();
                        
                        $xml->startElement('categoryId');
                            $xml->text('1');
                        $xml->endElement();
                        
                        foreach($vehicle['photos'] as $photo){
                            
                            $xml->startElement('picture');
                                $xml->text($photo->url);
                            $xml->endElement();
                            
                        }
                        
                        $xml->startElement('name');
                            $xml->text($vehicle['name']);
                        $xml->endElement();
                        
                        $xml->startElement('vendor');
                            $xml->text($vehicle['brand']);
                        $xml->endElement();
                        
                        $xml->startElement('model');
                            $xml->text($vehicle['model']);
                        $xml->endElement();
                        
                        $xml->startElement('description');
                            $xml->text('<![CDATA[' . $vehicle['description'] . ']]>');
                        $xml->endElement();
                        
                    $xml->endElement();
                    
                    }
                }
            $xml->endElement();
            
        $xml->endElement();
        
    $xml->endElement();
    $xml->endDocument();
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/local/criteo.xml', $xml->outputMemory());
}

    function saveFacebookFeedAuto($city, $file, $link){
        
        global $vehicles;
        
        $param_names = ['year' => 'Год выпуска', 'engine' => 'Двигатель', 'run' => 'Пробег'];
        
        # Создание XML файла
        $version = '1.0';
        $encoding = 'UTF-8';
        $rootName = 'listings';
        $catName = '';
        $itemName = 'listing';
        
        $xml = new XMLWriter();               
        
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument($version, $encoding);
        
        $xml->startElement($rootName);
        
            $xml->startAttribute('xmlns:g');
                $xml->text('http://base.google.com/ns/1.0');
            $xml->endAttribute();
            
            $xml->startAttribute('version');
                $xml->text('2.0');
            $xml->endAttribute();
            
            //$xml->startElement($catName);
            
                $xml->startElement('title');
                    $xml->text('Мотор Ленд Вольво ' . $city);
                $xml->endElement();
                
                $xml->startElement('link');
                
                    $xml->startAttribute('rel');
                        $xml->text('self');
                    $xml->endAttribute();
                    
                    $xml->text($link);
                    
                $xml->endElement();
                
                foreach($vehicles as $car){
                        
                    $body_style = 'OTHER';
                    if (stripos($car['bodyType'], 'Седан') !== false) {
                        $body_style = 'SEDAN';
                    }
                    if (stripos($car['bodyType'], 'Внедорожник') !== false) {
                        $body_style = 'CROSSOVER';
                    }
                    if (stripos($car['bodyType'], 'Хэтчбек') !== false) {
                        $body_style = 'HATCHBACK';
                    }
                    if (stripos($car['bodyType'], 'Универсал') !== false) {
                        $body_style = 'WAGON';
                    }
                        
                    $drivetrain = 'Other';
                    if (stripos($car['gear-type'], 'полный') !== false) {
                        $drivetrain = 'AWD';
                        }
                        if (stripos($car['gear-type'], 'передний') !== false) {
                            $drivetrain = 'FWD';
                        }
                        if (stripos($car['gear-type'], 'задний') !== false) {
                            $drivetrain = 'RWD';
                        }
                        
                        $transmission = 'Automatic';
                        if (stripos($car['transmission'], 'механика') !== false) {
                            $transmission = 'Manual';
                        }
                        
                        /*
                        Condition of the vehicle. Expected values: excellent, good, fair, poor, or other.
                        */
                        
                        $condition = 'good';
                        if (stripos($car['state'], 'отличное') !== false) {
                            $condition = 'excellent';
                        }
                        if (stripos($car['state'], 'отличное') !== false) {
                            $condition = 'excellent';
                        }
                        
                        $xml->startElement($itemName);
                        
                            $xml->startElement('vehicle_id');
                                $xml->text($car['id']);
                            $xml->endElement();
                            
                            $xml->startElement('vin');
                                $xml->text($car['vin']);
                            $xml->endElement();
                            
                            $xml->startElement('title');
                                $xml->text($car['name']);
                            $xml->endElement();
                            
                            $xml->startElement('description');
                                if(!empty($car['comment'])){
                                    $xml->text($car['comment']);
                                }
                            $xml->endElement();
                            
                            $xml->startElement('url');
                                $xml->text($link . '/car/' . $car['url_code']);
                            $xml->endElement();
                            
                            $xml->startElement('make');
                                $xml->text($car['brand']);
                            $xml->endElement();
                            
                            $xml->startElement('model');
                                $xml->text($car['model']);
                            $xml->endElement();
                            
                            $xml->startElement('year');
                                $xml->text($car['year']);
                            $xml->endElement();
                            
                            $xml->startElement('image');
                                $xml->startElement('url');
                                    $xml->text($link . $car['image']);
                                $xml->endElement();
                                $xml->startElement('tag');
                                    $xml->text('Exterior');
                                $xml->endElement();
                            $xml->endElement();
                            
                            $xml->startElement('body_style');
                                $xml->text($body_style);
                            $xml->endElement();
                            
                            $xml->startElement('transmission');
                                $xml->text($transmission);
                            $xml->endElement();
                            
                            $xml->startElement('mileage');
                                $xml->startElement('value');
                                    $xml->text($car['run']);
                                $xml->endElement();
                                $xml->startElement('unit');
                                    $xml->text('KM');
                                $xml->endElement();
                            $xml->endElement();
                            
                            $xml->startElement('drivetrain');
                                $xml->text($drivetrain);
                            $xml->endElement();
                            
                            $xml->startElement('price');
                                $xml->text($car['price']);
                            $xml->endElement();
                            
                            $xml->startElement('state_of_vehicle');
                                $xml->text('USED');
                            $xml->endElement();
                            
                            $xml->startElement('exterior_color');
                                $xml->text($car['color']);
                            $xml->endElement();
                            
                            /*$xml->startElement('fuel_type');
                                $xml->text($car['engine-type']);
                            $xml->endElement();*/
                            
                            $xml->startElement('condition');
                                $xml->text($condition);
                            $xml->endElement();
                            
                            $xml->startElement('availability');
                                $xml->text('AVAILABLE');
                            $xml->endElement();
                            
                            $xml->startElement('address');
                                
                                $xml->startAttribute('format');
                                    $xml->text('simple');
                                $xml->endAttribute();
                                
                                $xml->startElement('component');
                                    $xml->startAttribute('name');
                                        $xml->text('addr1');
                                    $xml->endAttribute();
                                    $xml->text('ул. Изыскателей 23');
                                $xml->endElement();
                                
                                $xml->startElement('component');
                                    $xml->startAttribute('name');
                                        $xml->text('city');
                                    $xml->endAttribute();
                                    $xml->text($city);
                                $xml->endElement();
                                
                                $xml->startElement('component');
                                    $xml->startAttribute('name');
                                        $xml->text('region');
                                    $xml->endAttribute();
                                    $xml->text('Воронежская обл.');
                                $xml->endElement();
                                
                                $xml->startElement('component');
                                    $xml->startAttribute('name');
                                        $xml->text('country');
                                    $xml->endAttribute();
                                    $xml->text('Россия');
                                $xml->endElement();
                                
                            $xml->endElement();
                            
                            $xml->startElement('latitude');
                                $xml->text('51.663853');
                            $xml->endElement();
                            
                            $xml->startElement('longitude');
                                $xml->text('39.299749');
                            $xml->endElement();
                            
                        $xml->endElement();
                    
                }
            
            //$xml->endElement();
        
        $xml->endElement();
        $xml->endDocument();
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $file, $xml->outputMemory());
    }
