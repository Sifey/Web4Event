<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-lower">Invités</span>
                        </h2>
                        <?php
                        // affichage des invités dans un galerie
                        if ($ivt != NULL){
                            foreach($ivt as $i){
                                echo "<div class=\"col-md-3\">";
                                // affichage du nom - prénom
                                echo "<b>";echo $i["ivt_nom"];echo " ";echo $i["ivt_prenom"]; echo "</b>";
                                echo "<br />";
                                // affichage d'une photo si elle existe ou une photo par défaut le cas échéant 
                                if ($i["ivt_photo"]==NULL){
                                    echo "<a><img class=\"img-rounded\" width='100' src='";echo base_url();echo "images/profil.png'></a>";
                                } else {
                                    echo "<a><img class=\"img-rounded\" width='100' src='";echo base_url();echo "images/";echo $i["ivt_photo"];echo "'></a>";
                                }
                                echo "<br />";
                                echo "<br />";
                                echo "<h5>Discipline</h5>";
                                echo $i["ivt_discipline"];
                                echo "<br />";
                                echo "<br />";
                                echo "<h5>Biographie</h5>";
                                echo $i["ivt_biographie"];
                                echo "<br />";
                                echo "<br />";
                                echo "<h5>Présentation</h5>";
                                echo $i["ivt_presentation"];
                                echo "<br />";
                                echo "<br />";
                                // affichage des réseaux s'ils existent, un message sinon
                                $query = $this->db->query("SELECT * FROM t_reseau_social_rsl JOIN t_present_prt USING (rsl_id) WHERE ivt_id=" .$i["ivt_id"]. ";");
                                $query->result_array();
                                if ($query->result_array()==NULL){
                                    echo "Pas de réseau social pour cet invité !";
                                } else {
                                    foreach ($query->result_array() as $r)
                                    {
                                        echo "<a href='" .$r["rsl_URL"]. "'>" .$r["rsl_nom"]. "</a>";
                                        echo " ";    
                                    }
                                }
                                echo "</div>";                       
                            }
                        }
                        // Si aucune animation : message d'erreur
                        else {
                            echo "<br />";
                            echo "<h2 class=\"text-center\">Aucun invité</h2>";
                        }
                        ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>