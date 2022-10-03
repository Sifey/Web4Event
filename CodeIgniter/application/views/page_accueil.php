<section class="page-section clearfix">
	<div class="container">
		<div class="intro">
			<img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="<?php echo base_url();?>style/assets/img/intro.png" alt="..." />
			<div class="intro-text left-0 text-center bg-faded p-5 rounded">
				<h2 class="section-heading mb-4">
					<span class="section-heading-lower">Japan Expo</span>
					<span class="section-heading-upper">21ème Impact</span>
				</h2>
				<p class="mb-3">Japan Expo est LE rendez-vous des amoureux du Japon et de sa culture, du manga aux arts martiaux, du jeu vidéo au folklore nippon, de la J-music à la musique traditionnelle : un évènement incontournable pour tous ceux qui s’intéressent à la culture japonaise et une infinité de découvertes pour les curieux. Le tout à 30 minutes de Paris !</p> 
				<p>Cet événement se déroule au "Parc Des Expositions De Paris Nord Villepinte".</p>
				<p>La 21ème édition se tiendra du 15 au 17 juillet 2022.</p>
				<div class="intro-button mx-auto"><a class="btn btn-primary btn-xl">Venez nombreux !</a></div>
			</div>
		</div>
	</div>
</section>
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
                    	 <h2 class="section-heading mb-4">
                            <span class="section-heading-lower">Actualités</span>
                        </h2>
						<?php
						//affichage des 5 plus récentes actualités (visibles)
						if ($actu != NULL){
						?>
							<table class="table table-bordered">
								<thead>
									<tr class='table-active'>
										<th>Titre</th>
										<th>Description</th>
										<th>Date de publication</th>
										<th>Auteur</th>		
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($actu as $a){
											echo "<tr>";
											echo "<td>";echo $a["act_intitule"];echo "</td>";
											echo "<td>";echo $a["act_texte"];echo "</td>";
											echo "<td>";echo $a["act_datePublication"];echo "</td>";
											echo "<td>";echo $a["cpt_pseudo"];echo "</td>";
											echo "</tr>";							
									}

						}
						// Si aucune actualité : message d'erreur
						else {
							echo "<br />";
							echo "<h2 class=\"text-center\">Aucune Actualité !</h2>";
						}

								?>
							</tbody>
						</table>
					</div> 
                </div>
            </div>
        </div>
    </div>
</section>

