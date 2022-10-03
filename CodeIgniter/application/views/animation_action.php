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
                            <span class="section-heading-lower">Suppression d'une animation</span>
                        </h2>
                        <?php
                        echo "<h3>Voulez-vous vraimment supprimer l'animation : " .$ani->ani_intitule. " ?</h3>";
                        ?>
                        <!--Bouton de confirmation de suppression de l'animation-->
                        <div class="intro-button mx-auto"><a class="btn btn-primary btn-mx" href='<?php echo base_url(); echo "index.php/compte/suppression_animation/" .$ani->ani_id. "";?>'>Confirmer</a>
                        <!--Bouton d'annulation de suppression de l'animation-->
                        <a class="btn btn-primary btn-mx" href='<?php echo base_url();?>index.php/compte/programmation'>Annuler</a></div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>