<?php

use TheCodingMachine\Gotenberg\Client;
use TheCodingMachine\Gotenberg\DocumentFactory;
use TheCodingMachine\Gotenberg\HTMLRequest;
use TheCodingMachine\Gotenberg\Request;

require 'vendor/autoload.php';
require_once 'assets/php/functions.php';
require_once 'assets/php/requetes.php';
$ccis = getAllCci();

$entreprise = getInfoEntreprise($_GET['id_entreprise']);
$ceo = getCeoEntreprise($_GET['id_ceo'], $_GET['id_entreprise']);
$conseiller = getConseillerInfo(getDepartement($entreprise->code_postal));
$positiveResponse = getTotalReponse(1, $_GET['id_entreprise'], $_GET['id_ceo']);
$negativeResponse = getTotalReponse(0, $_GET['id_entreprise'], $_GET['id_ceo']);
$partenaires = getPartenaires($conseiller->id_entreprises);

$questions[0] = "";
$domaines[0] = "";
for ($i = 1; $i <= 20; $i++) {
    $questions[] = getQuestion($i);
}
for ($i = 1; $i <= 4; $i++) {
    $domaines[] = getDomaine($i)->nom;
}
/* Création des Pdf */

ob_start();
require('assets/php/headerPdf.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$assets = [
    DocumentFactory::makeFromPath('pdf.css', 'assets/css/pdf.css'),
    DocumentFactory::makeFromPath('photo-header.jpg', 'assets/img/photo-header.png'),
    DocumentFactory::makeFromPath('fondentreprise.jpg', '../adminlb/assets/images/entreprises/fondentreprise.jpg'),
    DocumentFactory::makeFromPath($conseiller->photo, '../adminlb/assets/images/entreprises/' . $conseiller->photo),
    DocumentFactory::makeFromPath('logo-financeurs.svg', 'assets/img/logo-financeurs.svg'),
    DocumentFactory::makeFromPath('no-cross.svg', 'assets/img/no-cross.svg'),
    DocumentFactory::makeFromPath('yes-cross.svg', 'assets/img/yes-cross.svg'),
    DocumentFactory::makeFromPath('domaine1.svg', 'assets/img/domaine1.svg'),
    DocumentFactory::makeFromPath('domaine2.svg', 'assets/img/domaine2.svg'),
    DocumentFactory::makeFromPath('domaine3.svg', 'assets/img/domaine3.svg'),
    DocumentFactory::makeFromPath('domaine4.svg', 'assets/img/domaine4.svg'),
    DocumentFactory::makeFromPath('laboutic_logotext.png', 'assets/img/laboutic_logotext.png'),
    DocumentFactory::makeFromPath('logo-laboutic.png', 'assets/img/logo-laboutic.png'),
    DocumentFactory::makeFromPath('logocci.svg', 'assets/img/logocci.svg')
];
foreach ($partenaires as $partenaire) {
    if ($partenaire) {
        array_push($assets, DocumentFactory::makeFromPath($partenaire, '../adminlb/assets/images/partenaires/' . $partenaire));
    }
}
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/header.pdf');
ob_end_clean();

/* ------- */
ob_start();
require('assets/php/googleMyBusiness.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/googleMyBusiness.pdf');

/* ------- */
ob_start();
require('assets/php/footerPdf.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/footer.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q1_q2.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q1_q2.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q3_q4.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q3_q4.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q5_q6.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q5_q6.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q7_q8.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q7_q8.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q9_q10.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q9_q10.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q11_q12.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q11_q12.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q13_q14.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q13_q14.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q15_q16_q17.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q15_q16_q17.pdf');

/* ------- */
ob_start();
require('assets/php/conseils/q18_q19_q20.php');
$content = ob_get_clean();

$client = new Client('http://localhost:3000', new \Http\Adapter\Guzzle6\Client());
$index = DocumentFactory::makeFromString('index.html', $content);
$request = new HTMLRequest($index);
$request->setAssets($assets);
$request->setPaperSize(Request::A4);
$request->setMargins(Request::NO_MARGINS);
$request->setScale(0.378);
$client->store($request, 'pdf/q18_q19_q20.pdf');

/* Fusion des différents Pdf */
$pdf = new \Clegginabox\PDFMerger\PDFMerger;
$pdf->addPDF('pdf/header.pdf', 'all');

$pdf->addPDF('pdf/q1_q2.pdf', 'all');
for($i = 1; $i <= 2; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/q3_q4.pdf', 'all');
for($i = 3; $i <= 4; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/q5_q6.pdf', 'all');
for($i = 5; $i <= 6; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/q7_q8.pdf', 'all');
for($i = 7; $i <= 8; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/q9_q10.pdf', 'all');
for($i = 9; $i <= 10; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/q11_q12.pdf', 'all');
for($i = 11; $i <= 12; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/q13_q14.pdf', 'all');
for($i = 13; $i <= 14; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/q15_q16_q17.pdf', 'all');
for($i = 15; $i <= 17; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/q18_q19_q20.pdf', 'all');
for($i = 18; $i <= 20; $i++) {
    $question = getResponse($i, $_GET['id_entreprise'], $_GET['id_ceo']);
    $id = $question->id_question;
    $reponse = $question->reponse;
    $accompagnement = $question->accompagner;
    if($id != "1" && $id != "21") {
        if($reponse == "0" && $accompagnement == "1") {
            $actualPdf = getPdf($id);
            $pdf->addPDF('../adminlb/assets/images/fichiers/' . $actualPdf->documentation, 'all');
        }
    }
}

$pdf->addPDF('pdf/googleMyBusiness.pdf', 'all');
$pdf->addPDF('pdfkeep/gmb.pdf', 'all');
$pdf->addPDF('pdf/footer.pdf', 'all');

$pdf->merge('file', 'pdf/fusion.pdf');
?>
<a href="pdf/fusion.pdf" download="fusion.pdf">Télécharger le pdf</a>