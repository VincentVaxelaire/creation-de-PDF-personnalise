<?php 

$pdo = new PDO('mysql:dbname=cci_laboutic;charset=utf8;host=localhost', "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

function getAllQuestion() {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM diagnostic INNER JOIN diagnostic_domaines ON diagnostic_domaines.id = diagnostic.id_domaine ORDER BY positiondiag");
    $req->execute(); 
    return $req->fetchAll();
}

function getQuestion($q1) {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM diagnostic WHERE positiondiag = :q1 ORDER BY positiondiag");
    $req->execute(["q1" => $q1]); 
    return $req->fetch();
}

function getDomaine($d1) {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM diagnostic_domaines WHERE position = :d1 ORDER BY position");
    $req->execute(["d1" => $d1]);
    return $req->fetch();
}

function getInfoEntreprise($id_entreprise) {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM entreprises WHERE id = :id");
    $req->execute(["id" => $id_entreprise]);
    return $req->fetch();
}

function getCeoEntreprise($id_ceo, $id_entreprise) {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id_ceo AND id_entreprises = :id_entreprise");
    $req->execute([
        "id_ceo" => $id_ceo,
        "id_entreprise" => $id_entreprise
    ]);
    return $req->fetch();
}

function getConseillerInfo($code) {
    global $pdo;
    $req = $pdo->prepare("SELECT utilisateurs.id, prenom, nom, fonction, telephone, email, id_entreprises, denomination, code_postal, entreprises.photo AS photo FROM utilisateurs INNER JOIN entreprises ON utilisateurs.id_entreprises = entreprises.id WHERE utilisateurs.actif = 1 AND denomination LIKE 'cci%' AND code_postal LIKE :code ORDER BY rand();");
    $req->execute(["code" => $code."%"]);
    return $req->fetch();
}

function getAllCci() {
    global $pdo;
    $req = $pdo->prepare("SELECT distinct(id), photo FROM entreprises WHERE denomination LIKE 'CCI%'");
    $req->execute();
    return $req->fetchAll();
}

function getResponse($question, $id_entreprise, $id_ceo) {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM diagnostic_reponses WHERE positiondiag = :question AND id_entreprise = :id_entreprise AND id_utilisateur = :id_ceo");
    $req->execute([
        "question" => $question,
        "id_entreprise" => $id_entreprise,
        "id_ceo" => $id_ceo
    ]);
    return $req->fetch();
}

function getTotalReponse($bool, $id_entreprise, $id_ceo) {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM diagnostic_reponses INNER JOIN diagnostic ON diagnostic_reponses.id_question = diagnostic.id WHERE reponse = :reponse AND id_entreprise = :id_entreprise AND id_utilisateur = :id_ceo");
    $req->execute([
        "reponse" => $bool,
        "id_entreprise" => $id_entreprise,
        "id_ceo" => $id_ceo
    ]);
    return $req->fetchAll();
}

function getIntegrationNumerique($id_entreprise, $id_ceo) {
    global $pdo;
    $req = $pdo->prepare("SELECT sum(indicenumerique) as addition, id_entreprise, id_utilisateur FROM diagnostic INNER JOIN diagnostic_reponses ON diagnostic.id = diagnostic_reponses.id_question WHERE reponse = 1 AND id_entreprise = :id_entreprise AND id_utilisateur = :id_ceo");
    $req->execute([
        "id_entreprise" => $id_entreprise,
        "id_ceo" => $id_ceo
    ]);
    $value = $req->fetch();
    return round(($value->addition / 57) * 100,0);
}

function getPdf($question) {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM produits INNER JOIN _affectation ON produits.id = _affectation.id_solution WHERE categorie = 7 AND id_question = :id_question");
    $req->execute(["id_question" => $question]);
    return $req->fetch();
}

function getPartenaires($id_cci) {
    global $pdo;
    $req = $pdo->prepare("SELECT * FROM partenaires WHERE id_cci = :id");
    $req->execute(["id" => $id_cci]);
    $value = $req->fetch();
    return [$value->partenaire_1, $value->partenaire_2, $value->partenaire_3, $value->partenaire_4, $value->partenaire_5];
}

require_once("functions.php");