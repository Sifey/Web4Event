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
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('compte_creer'); ?>
                            <label for="id"><h4>Identifiant</h4></label>
                            <input type="input" name="id" /><br />
                            <label for="mdp"><h4>Mot de passe</h4></label>
                            <input type="input" name="mdp" /><br />
                            <input type="submit" name="submit" value="Créer un compte" />
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>