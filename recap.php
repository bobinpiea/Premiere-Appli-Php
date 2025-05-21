<?php
session_start();
ob_start();

$nbArticles = 0;

if (isset($_SESSION["products"])) {
$nbArticles = array_sum(array_column($_SESSION["products"], "qtt"));
}
?>

        <?php
            // On vérifie si le tableau 'products' existe et n'est pas vide
            if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
                echo "<p>Aucun produit en session...</p>";
            } else {
                // Affichage du tableau si des produits existent
                echo "<table>",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                                "<th>Action</th>",
                            "</tr>",
                        "</thead>",
                        "<tbody>";

                // Initialisation du total général
                $totalGeneral = 0;

                // Affichage ligne par ligne des produits
                // $_SESSION est un tableau associatif spécial fourni par PHP.

                // Permet de stocker des données qui resteront disponibles sur pls pages
                // tant que la session est active. Chaque utilisation a sa propre $_SESSION
                foreach ($_SESSION['products'] as $index => $product) {
                    echo "<tr>",
                            "<td>" . $index . "</td>",
                            "<td>" . $product['name'] . "</td>",
                            "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
                             "<td>
                                <a href='traitement.php?action=moins&id=$index'>–</a>
                                     " . $product['qtt'] . "
                                <a href='traitement.php?action=plus&id=$index'>+</a>
                             </td>",
                            "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
                            "<td><a href='traitement.php?action=delete&id=$index'>Supprimer</a></td>",
                        "</tr>";

                    // Ajout au total général
                    $totalGeneral += $product['total'];
                }

                // Affichage de la dernière ligne avec le total général
                echo "<tr>",
                        "<td colspan=4>Total général : </td>",
                        "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>",
                    "</tr>";

                echo    "</tbody>",
                        "</table>";
            }
                // Affichage du bouton 'clear"
                echo '<div class="effacer-panier">
                        <a href="traitement.php?action=clear">Effacer mon panier</a>
                    </div>';
        ?>
  
<?php
$content = ob_get_clean();
require_once("template.php");
?>