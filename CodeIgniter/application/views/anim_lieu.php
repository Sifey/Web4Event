<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
                    	<h2 class="section-heading mb-4">
                            <span class="section-heading-lower">Lieu</span>
                        </h2>
						<?php
						// affichage des lieux et leurs services associés s'ils existent dans un tableau
						if ($lieu != NULL){
						?>
							<table class="table table-bordered">
								<thead>
									<tr class='table-active'>
										<th>Lieu</th>
										<th>Description</th>
										<th>Service</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($lieu as $l){
										if (!isset($traite[$l["lie_id"]])){
											$id = $l['lie_id'];
											echo "<tr>";
												echo "<td>";echo $l["lie_nom"];echo "</td>";
												echo "<td>";echo $l["lie_descriptif"];echo "</td>";								
												echo "<td>";
												echo "<ul>";
												foreach($lieu as $lie){
													if(strcmp($id,$lie["lie_id"])==0){
														if ($lie['srv_nom']==NULL){
															echo "Pas de service dans ce lieu !";
														} else {
															echo "<li>";
															echo $lie["srv_nom"];
															echo "</li>";
														}
													}
												}
												echo "</ul>";
												echo "</td>";
												$traite[$l["lie_id"]]=1;
											echo "</tr>";
										}
									}
							}
							// Si aucune animation : message d'erreur
							else {
								echo "<br />";
								echo "<h2 class=\"text-center\">Aucun lieu pour l'instant !</h2>";
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