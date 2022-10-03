<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
                        <!-- Affichage du message d'erreur puis redirection vers le formulaire-->
                        <?php
                        echo "<h1>Code(s) erroné(s), aucun passeport trouvé !</h1>";
                        echo "<h3>";echo "Redirection en cours";echo "</h3>";
                        header("refresh:5 ; url=" .base_url(). "index.php/invite/post"); ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>