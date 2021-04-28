<?php

function changeSyntaxePhone($phone) {
    $newPhone = "";
    for ( $i = 0; $i < 5; $i ++) {
        $newPhone[$i*3] = $phone[$i*2];
        $newPhone[$i*3+1] = $phone[$i*2+1];
        if($i !== 4) {
            $newPhone[$i*3+2] = ".";
        }
    }
    return $newPhone;
}

function getDepartement($code) {
    return $code[0] . "" . $code[1];
}

function changeDate($date) {
    $date = explode(" ", $date);
    $date = explode("-", $date[0]);
    $date = array_reverse($date);
    $date = implode("/", $date);
    return $date;
}
// Aurélien ne sait pas faire une fonction :P
// Aurélien ne sait pas faire une fonction :P
// Aurélien ne sait pas faire une fonction :P

// function createPdf($test, $name) {
//     ob_start();
//     require('./testGotenberg/assets/php/'.$test);
//     $content = ob_get_clean();

//     $client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
//     $index = DocumentFactory::makeFromString('index.html', $content);
//     $assets = [
//         DocumentFactory::makeFromPath('pdf.css', '../css/pdf.css'),
//         DocumentFactory::makeFromPath('photo-header.jpg', '../img/photo-header.jpg'),
//         DocumentFactory::makeFromPath('photo-promo1.jpg', '../img/photo-promo1.jpg'),
//         DocumentFactory::makeFromPath('photo-promo2.jpg', '../img/photo-promo2.jpg'),
//         DocumentFactory::makeFromPath('photo-promo3.jpg', '../img/photo-promo3.jpg'),
//         DocumentFactory::makeFromPath('photo-promo4.jpg', '../img/photo-promo4.jpg')
//     ];
//     $request = new HTMLRequest($index);
//     $request->setAssets($assets);
//     $request->setPaperSize(Request::A4);
//     $request->setMargins(Request::NO_MARGINS);
//     $request->setScale(0.378);
//     $client->store($request, '../../pdf/'.$name.'.pdf');
// }