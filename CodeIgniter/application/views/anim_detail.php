<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
                    	<h2 class="section-heading mb-4">
                            <span class="section-heading-lower">Détail</span>
                        </h2>
						<?php
						if ($anim != NULL) {
							// Affichage des détails de l'animation
							echo "<h4><u>Intitulé</u> : "; echo "<br />"; echo $anim->ani_intitule;echo "</h4>";
							echo "<br />";
							echo "<br />";
	                        echo "<h4><u>Description</u> : "; echo "<br />"; echo $anim->ani_descriptif;echo "</h4>";
	                        echo "<br />";
	                        echo "<br />";
	                        echo "<h4><u>Début</u> : ";  echo $anim->ani_dateDebut;echo "</h4>";
	                        echo "<br />";
	                        echo "<br />";
	                        echo "<h4><u>Fin</u> : "; echo $anim->ani_dateFin;echo "</h4>";
						}
						else
						{	
							// Passage d'un mauvais id en adresse
							echo "<h4>Aucune animation à détailler !</h4>";
						}
						?>
	                </div> 
                </div>
            </div>
        </div>
    </div>
</section>