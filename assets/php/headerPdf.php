<?php
require_once("requetes.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="pdf.css">
    <title>Mon document PDF</title>
</head>

<body>
    <!-- Ceci est la page de couverture.-->
    <section id="header">
        <div class="title-info">
            <h3 class="title-diag">Mon diagnostic numérique</h3>
            <h3 class="name-company"><?= $entreprise->denomination ?></h3>
            <h3 class="adress-company">
                <span class="CEO-name"><?= $ceo->prenom . " " . $ceo->nom ?></span><br>
                <span class="street-adress"><?= $entreprise->adresse ?></span><br>
                <span class="country-code"><?= $entreprise->code_postal . " " . $entreprise->ville ?></span><br>
                <span class="cell-number"><?= changeSyntaxePhone($ceo->telephone) ?></span>
            </h3>
        </div>
        <div class="coaching-info">
            <span class="line"></span>
            <?php if ($conseiller != null) : ?>
                <h3 class="coach-info">
                    <span class="coaching-subtitle">Mon conseiller</span>
                    <span class="coach-name"><?= $conseiller->prenom . " " . $conseiller->nom ?></span><br>
                    <span class="coach-cell"><?= changeSyntaxePhone($conseiller->telephone) ?></span>
                </h3>
                <img class="logo-cci" alt="logo cci" src=<?= $conseiller->photo ?>>
            <?php else : ?>
                <div class="logo-conseiller-none">
                <!-- link le logo "un service de la cci"-->
                    <img src="logocci.svg" alt="">
                </div>
            <?php endif; ?>
        </div>
        <div class="photo-header" style="background-image: url('photo-header.jpg');">
        </div>
        <!-- pour chaque images mettre le lien dans la balise image. 5 images max par région  -->
        <?php if ($partenaires != [null,null,null,null,null]) : ?>
            <div class="logo-financeurs">
            <?php for ($i = 0; $i < 5; $i++) :
                if ($partenaires[$i]) : ?>
                    <img src=<?= $partenaires[$i] ?>>
                <?php endif; ?>
            <?php endfor; ?>
            </div>
        <?php else :?>
        <div class="logo-financeurs-none">
        <!-- link le logo un service cci-->
            <img src="logo-laboutic.png" alt="">
        </div>
        <?php endif; ?>
    </section>

    <!-- Page intercalaire type.-->
    <section id="intercalaire">
        <div class="intercalaire-legend">
            <span class="line"></span>
            <span class="intercalaire-title">Résultats</span>
        </div>
        <div class="intercalaire-introduction">
            <p>
                Le chiffre d'affaires des ventes sur internet continue à enregistrer des progressions à 2 chiffres.<br><br>
                Le canal mobile poursuit son développement. Il représente aujourd'hui 22% du chiffre d'affaires des sites de e-commerce
                et 35% pourles sites leader (+5% sur un an).
            </p>
        </div>
    </section>

    <!-- Page de récap des questions -->
    <section id="recap-diagnostic">
        <div class="inner-recap">
            <div class="recap-info">
                <h1>Mes réponses au test <span>réalisé le <?= changeDate($ceo->date) ?></span></h1>
            </div>
            <div class="positive-answers">
                <div class="diag-title un">
                    <img src="yes-cross.svg" alt="yes"><h1>J'ai répondu oui à <span><?= count($positiveResponse) ?> </span> questions</h1>
                </div>
                <?php foreach ($positiveResponse as $response) : ?>
                    <p><?= $response->positiondiag ?> | <?= $response->question ?></p>
                <?php endforeach; ?>
            </div>
            <div class="negative-answers">
                <div class="diag-title deux">
                    <img src="no-cross.svg" alt="no"><h1>J'ai répondu non à <span><?= count($negativeResponse) ?></span> questions</h1>
                </div>
                <?php foreach ($negativeResponse as $response) : ?>
                    <p><?= $response->positiondiag ?> | <?= $response->question ?></p>
                <?php endforeach; ?>
            </div>
            <div class="jauge">
                <!-- jauge -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 630 80">
                <rect id="Rectangle_150" data-name="Rectangle 150" width="630" height="80" rx="10" fill="#fff"/>
                <g id="Rectangle_146" data-name="Rectangle 146" fill="#9bce7a" stroke="#222" stroke-width="4">
                    <rect width="<?= getIntegrationNumerique($_GET['id_entreprise'], $_GET['id_ceo']) . "%" ?>" height="80" rx="10" stroke="none"/>
                    <rect x="2" y="2" width="626" height="76" rx="8" fill="none"/>
                </g>
                <path id="Rectangle_147" data-name="Rectangle 147" d="M6,0h6a0,0,0,0,1,0,0V72a0,0,0,0,1,0,0H6a6,6,0,0,1-6-6V6A6,6,0,0,1,6,0Z" transform="translate(4 4)" fill="#4aa528"/>
                <rect id="Rectangle_148" data-name="Rectangle 148" width="613" height="9" rx="4" transform="translate(11 67)" fill="#4aa528"/>
                <ellipse id="Ellipse_11" data-name="Ellipse 11" cx="6" cy="4.5" rx="6" ry="4.5" transform="translate(614 67)" fill="#4aa528"/>
                <rect id="Rectangle_149" data-name="Rectangle 149" width="9" height="5" transform="translate(617 67)" fill="#4aa528"/>
                </svg>
                <h1>Débloquez 100% du potentiel de votre commerce !<br><span>Avec les conseils pratiques :</span></h1>
                <h2><?= getIntegrationNumerique($_GET['id_entreprise'], $_GET['id_ceo']) . "%" ?> des outils numériques à disposition de votre commerce sont déjà mobilisés.</h2>
                <img class="logo" src="laboutic_logotext.png" alt="">
            </div>
        </div>
    </section>

    <!-- Page intercalaire type.-->
    <section id="intercalaire">
        <div class="intercalaire-legend">
            <span class="line"></span>
            <span class="intercalaire-title">Conseils pratiques</span>
        </div>
        <div class="intercalaire-introduction">
            <p>
                La fréquence d'achat sur internet continue à augmenter et le montant moyen d'une transaction à baisser.
                Ces évolution sont le reflet des comportements d'achat sur internet qui concernent de plus en plus tous les produits du quotidien.
            </p>
        </div>
    </section>
