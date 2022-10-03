<?php
  /* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
  autorisé à un utilisateur connecté. */
  if(!isset($_SESSION['username']) || !isset($_SESSION['statut']))
  {
    //Si la session n'est pas ouverte, redirection vers la page du formulaire
    redirect(base_url()."index.php/compte/connecter");
    exit();
  }
?>
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
                       <h2 class="section-heading mb-4">
                            <span class="section-heading-lower">Profil</span>
                        </h2> 
                        <?php
                            // Affichage du pseudo de l'utilisateur
                            echo "<h4><u>Pseudo</u> : "; echo $profil->cpt_pseudo;echo "</h4>";
                            echo "<br />";
                            echo "<br />";
                            // Affichage des données de l'utilisateur selon son statut
                            // Affichage des données d'un administrateur
                            if ($_SESSION['statut'] =='A'){
                                echo "<h4><u>Nom</u> : "; echo $profil->org_nom;echo "</h4>";
                                echo "<h4><u>Prénom</u> : "; echo $profil->org_prenom;echo "</h4>";
                                echo "<br />";
                                echo "<br />";
                                echo "<h4><u>Adresse e-mail</u> : "; echo $profil->org_mail;echo "</h4>";
                            // Affichage des données d'un invité
                            } else {
                                echo "<h4><u>Nom</u> : "; echo $profil->ivt_nom;echo "</h4>";
                                echo "<br />";
                                echo "<br />";
                                echo "<h4><u>Prénom</u> : "; echo $profil->ivt_prenom;echo "</h4>";
                                echo "<br />";
                                echo "<br />";
                                echo "<h4><u>Discipline</u> : "; echo $profil->ivt_discipline;echo "</h4>";
                                echo "<br />";
                                echo "<br />";
                                echo "<br />";
                                echo "<h4><u>Présentation</u> : </h4>"; echo $profil->ivt_presentation;
                                echo "<br />";
                                echo "<br />";
                                echo "<h4><u>Biographie</u> : </h4>"; echo $profil->ivt_biographie;
                                echo "<br />";
                                echo "<br />";
                                echo "<h4><u>Réseaux Sociaux</u> : </h4>";
                                // Si aucun réseau : message d'erreur, sinon, affichage de ses réseaux
                                if ($reseau == NULL) {
                                    echo "<h5>Pas de réseau social !</h5>";
                                } else {
                                    echo "<p>";
                                    foreach ($reseau as $rs){
                                        echo " -- ";
                                        echo "<a href='" .$rs["rsl_URL"]. "'>" .$rs["rsl_nom"]. "</a>";
                                    }
                                    echo " -- ";
                                    echo "</p>";
                                }
                            }
                            echo "<br />";
                            echo "<br />";
                            echo "<br />";
                        ?>
                        <!-- Affichage d'un bouton pour modifier son mot de passe -->
                        <div class="intro-button mx-auto"><a class="btn btn-primary btn-xl" href="<?php echo base_url();?>index.php/compte/modification">Modifier</a></div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>