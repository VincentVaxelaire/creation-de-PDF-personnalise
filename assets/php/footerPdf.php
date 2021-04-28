<?php 
require_once("requetes.php");
require_once("functions.php");

?>
<head>
    <link rel="stylesheet" href="pdf.css">
</head>

    <!-- Page pied type.-->
    <section id="pied">
        <div class="recap-conseiller">

            <div class="top">
                <img src="laboutic_logotext.png" alt="">
            </div>

            <div class="laboutic-content">
                <h2>Retrouvez tous nos conseils sur</h2>
                <h1>laboutic.fr</h1>
            </div>

            <div class="facebook-content">
                <h2>Suivez-nous sur Facebook</h2>
                <h1>pour ne pas manquer nos dernières actualités</h1>
            </div>

            <div class="cofeeCom-content">
                <h2>Chaque mois recevez votre invitation</h2>
                <h1>pour assister au C@fé du commerce</h1>
                <br>
                <p>
                    Le C@fé du commerces est 100% numérique ! Retrouvez l'équipe laboutic.fr en direct pour aborder des sujets d'actualité.
                </p>
            </div>
            <?php if($conseiller !=null) :?>
            <div class="conseiller-info">
                <h1>Votre conseiller CCI <?= getDepartement($conseiller->code_postal) ?></h1>
                <h2><?= $conseiller->prenom . " " . $conseiller->nom ?></h2>
                <h2><?= changeSyntaxePhone($conseiller->telephone) ?></h2>
                <h2><?= $conseiller->email ?></h2>
            </div>
            <?php else:?>
                <div></div>
            <?php endif; ?>
            
            <!-- pour chaque images mettre le lien dans la balise image. 5 images max par région  -->
            <?php if ($partenaires != [null,null,null,null,null]) : ?>
                <div class="logo-financeurs margin">
                <?php for ($i = 0; $i < 5; $i++) :
                    if ($partenaires[$i]) : ?>
                        <img src=<?= $partenaires[$i] ?>>
                    <?php endif; ?>
                <?php endfor; ?>
                </div>
            <?php else :?>
            <div class="logo-financeurs-none margin">
            <!-- link le logo de la boutic-->
                <img src="logo-laboutic.png" alt="">
            </div>
            <?php endif; ?>
        </div>
        <div class="deco">
            <span class="line"></span>
        </div>
    </section>
</body>
</html>