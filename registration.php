<?php
include 'header.php';
?>
<div class="box">
<form action="test.php" method="get" class="formBloc">
    <h3>Enregistrez-vous</h3>
    <div class="formGroupe">
        <label for="nom">NOM</label>
        <input type="text" id="sexe" name="nom" required>
    </div>
    <div class="formGroupe">
        <label for="prenoms">PRENOMS</label>
        <input type="text" id="prenoms" name="prenoms" required>
    </div>
    <div>
        <label for="" class="labelsexe">SEXES </label>
        <div class="sexe">
            <input  type="radio" id="sexe" name="sexe" value="H" required>
            <label class="labelsexy"for="sexe">HOMME</label>
            <input type="radio" id="sexe" name="sexe" value="F" required>
            <label  class="labelsexy" for="sexe">FEMME</label>
        </div>
    </div>
    <div class="formGroupe">
        <label for="age">AGE</label>
        <input type="number" id="age" name="age" min="0">
    </div>
    <div class="formGroupe">
        <label for="adresse">ADRESSE</label>
        <input type="text" id="adresse" name="adresse">
    </div>
    <div class="formGroupe">
        <label for="telephone">TELEPHONE</label>
        <input type="text" id="telephone" name="telephone" min="0">
    </div>
    <div class="formGroupe">
        <button type="submit" name="enregistrer" class="btn btnEnregistre">Enregistrer</button>
        <button type="reset" class="btn btnReset">Annuler</button>
    </div>
    <hr>
    <div class="allerListe">
        <a href="test.php">Aller à la liste</a>
    </div>
</form>
</div>

<?php
include 'footer.php'
?>