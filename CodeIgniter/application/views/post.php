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
                           header("refresh:5 ; url=" .base_url(). "index.php/invite/post");
                        }else{
                            echo form_open('invite/post'); ?>
                                <label><span class="fs-3">Saisissez vos identifiants ici :</span></label><br>
                                <br />
                                <br />
                                <p><b>PassID :</b></p><input type="text" name="id" />
                                <br />
                                <br />
                                <p><b>Mot de passe :</b></p><input type="password" name="mdp" />
                                <br />
                                <br />
                                <div class="form-group">
                                  <label for="post"><b>Post :</b></label>
                                  <br />
                                  <br />
                                  <textarea class="form-control" rows="5" name="post"></textarea>
                                </div>
                                <br />
                                <br />
                                <input type="submit" class="btn btn-primary btn-xs" value="Valider"/>
                            </form>
                        <?php } ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
