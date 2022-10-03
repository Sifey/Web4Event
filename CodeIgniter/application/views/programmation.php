<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
                    	<h2 class="section-heading mb-4">
                            <span class="section-heading-lower">Programmation</span>
                        </h2>
						<?php
						// affichage des animations dans un tableau
						if ($ani != NULL){
						?>
							<table class="table table-bordered">
								<thead>
									<tr class='table-active'>
										<th>Animation</th>
										<th>Horaire Début</th>
										<th>Horaire Fin</th>
										<th>Lieu</th>
										<th>Invité(s)</th>
										<th>Etat</th>
										<th>Détail</th>
										<th>Invités</th>
										<th>Lieu/Service</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($ani as $a){
										if ($a["ETAT"]==-1){
											echo "<tr class='table-info'>";
										}
										else if ($a["ETAT"]==0){
											echo "<tr class='table-success'>";
										}
										else {
											echo "<tr class='table-danger'>";
										}
											echo "<td>";echo $a["ani_intitule"];echo "</td>";
											echo "<td>";echo $a["ani_dateDebut"];echo "</td>";
											echo "<td>";echo $a["ani_dateFin"];echo "</td>";
											// affichage du lieu s'il existe
											if ($a["lie_nom"]==NULL){
												echo "<td>";echo "Aucun lieu";echo "</td>";
											} else {
												echo "<td>";echo $a["lie_nom"];echo "</td>";
											}
											//affichage des invités s'il y en a au moins un
											if ($a["IVT"]==NULL){
												echo "<td>";echo "Aucun invité";echo "</td>";
											} else {
												echo "<td>";echo $a["IVT"];echo "</td>";
											}
											//affichage de l'état de l'animation : passé, en cours ou à venir
											if ($a["ETAT"]==-1){
												echo "<td>";echo "Passé";echo "</td>";
											} else if ($a["ETAT"]==0){
												echo "<td>";echo "En cours";echo "</td>";
											} else if ($a["ETAT"]==1){
												echo "<td>";echo "A venir";echo "</td>";
											}
											// affichage d'un bouton de redirection vers le détails de l'animation et les invités (A completer avec des liens)
											echo ("<td>");echo "<a href='";echo base_url();echo "index.php/programmation/detail/" .$a["ani_id"]. "'><img width='40' src='";echo base_url();echo "style/assets/img/redirection.png'></a>";echo ("</td>");
											echo ("<td>");echo "<a href='";echo base_url();echo "index.php/programmation/invite/" .$a["ani_id"]. "'><img width='40' src='";echo base_url();echo "style/assets/img/redirection.png'></a>";echo ("</td>");
											// Vérification s'il y a un lieu ou non
											if ($a["lie_id"] == NULL){
												echo ("<td>");echo "<a href='";echo base_url();echo "index.php/programmation/lieu/0'><img width='40' src='";echo base_url();echo "style/assets/img/redirection.png'></a>";
											}
											else {
												echo ("<td>");echo "<a href='";echo base_url();echo "index.php/programmation/lieu/" .$a["lie_id"]. "'><img width='40' src='";echo base_url();echo "style/assets/img/redirection.png'></a>";	
											}
											echo ("</td>");
											echo "</tr>";							
									}
							}
							// Si aucune animation : message d'erreur
							else {
								echo "<br />";
								echo "<h2 class=\"text-center\">Aucune animation pour l'instant !</h2>";
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