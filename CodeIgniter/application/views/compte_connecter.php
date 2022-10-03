<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <div class="row">
                        <?php 
                        if (validation_errors()){
                           echo "<h1>";echo validation_errors();echo "</h1>";
                           echo "<h3>";echo "Redirection en cours";echo "</h3>";
                           header("refresh:5 ; url=" .base_url(). "index.php/compte/connecter");
                        }else{
                            echo form_open('compte/connecter'); ?>
                                <label><span class="fs-3">Saisissez vos identifiants ici :</span></label><br>
                                <br />
                                <br />
                                <p><b>Votre pseudo :</b></p><input type="text" name="pseudo" />
                                <br />
                                <br />
                                <p><b>Votre mot de passe :</b></p><input type="password" name="mdp" />
                                <br />
                                <br />
                                <input type="submit" class="btn btn-primary btn-xs" value="Connexion"/>
                            </form>
                        <?php } ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>