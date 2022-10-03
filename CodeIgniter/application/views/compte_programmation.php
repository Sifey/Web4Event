<?php
  /* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
  autorisé à un utilisateur connecté. */
  if(!isset($_SESSION['username']) || !isset($_SESSION['statut']) || $_SESSION['statut']=='I')
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
                        <span class="section-heading-lower">Programmation</span>
                      </h2>
                      <!-- Bouton d'ajout d'une animation -->
                      <div class="intro-button mx-auto"><a class="btn btn-primary btn-mx">Ajouter</a></div>
                      <br />
                      <br />
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
                              <th>Modifier</th>
                              <th>Supprimer</th>
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
                                echo "<td>";echo "<a href='#!'><img src='https://img.icons8.com/ios-glyphs/30/000000/edit--v4.png'/></a>";echo "</td>";       
                                echo "<td>";echo "<a href='";echo base_url();echo "index.php/compte/confirmation_suppression/" .$a["ani_id"]. "'><img width='40' src='";echo base_url();echo "style/assets/img/supprimer.png'></a>";echo "</td>";
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