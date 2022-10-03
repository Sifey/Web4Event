<?php
  /* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
  autorisé à un utilisateur connecté. */
  if(!isset($_SESSION['username']) || !isset($_SESSION['statut']) || $_SESSION['statut']=='A')
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
                          <span class="section-heading-lower">Passeport/Post</span>
                      </h2>
                      <?php
                      // affichage des lieux et leurs services associés s'ils existent dans un tableau
                      if ($passeport != NULL){
                      ?>
                        <table class="table table-bordered">
                          <thead>
                            <tr class='table-active'>
                              <th>Passeport</th>
                              <th>Post</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach($passeport as $p){
                              if (!isset($traite[$p["psp_passID"]])){
                                $id = $p['psp_passID'];
                                echo "<tr>";
                                  echo "<td>";echo $p["psp_passID"];echo "</td>";              
                                  echo "<td>";
                                  echo "<ul>";
                                  // Affichage des posts pour un passeport s'ils existent, sinon affichage d'un message d'erreur
                                  foreach($passeport as $psp){
                                    if(strcmp($id,$psp["psp_passID"])==0){
                                      if ($psp['pst_message']==NULL){
                                        echo "Aucun post !";
                                      } else {
                                        echo "<li>";
                                        echo $psp["pst_message"]; echo " -- ["; echo $psp["pst_date"];echo "]";
                                        echo "</li>";
                                      }
                                    }
                                  }
                                  echo "</ul>";
                                  echo "</td>";
                                  $traite[$p["psp_passID"]]=1;
                                echo "</tr>";
                              }
                            }
                        }
                        // Si aucune animation : message d'erreur
                        else {
                          echo "<br />";
                          echo "<h2 class=\"text-center\">Aucun passeport</h2>";
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