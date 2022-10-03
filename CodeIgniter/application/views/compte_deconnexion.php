<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
						<?php
						session_destroy();
						unset($_SESSION['username']);
						echo "<h1>Déconnexion réussie, redirection en cours</h1>";
						header("refresh:5 ; url=" .base_url(). "");
						?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
