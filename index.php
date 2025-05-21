<?php
session_start();
ob_start();

$nbArticles = 0;

if (isset($_SESSION["products"])) {
   $nbArticles = array_sum(array_column($_SESSION["products"], "qtt"));
}
?>

            <form action="traitement.php?action=add" method="post">
                <p>
                    <label>
                        Nom du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit :
                        <input type="number" step="any" name="price">
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée :
                        <input type="number" name="qtt" value="1">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit">
                </p>
            </form>
     
<?php
$content = ob_get_clean();
require_once("template.php");
?>