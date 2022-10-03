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
                        <h2>Espace d'administration</h2>
                        <br />
                        <h2>Session ouverte ! Bienvenue
                        <?php
                        echo $this->session->userdata('username');
                        ?> !
                        </h2>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>