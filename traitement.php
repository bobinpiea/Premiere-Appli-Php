<?php
    // On démarre la session pour accéder à $_SESSION
    session_start();

    // On vérifie si une action est présente dans l’URL
    if (isset($_GET['action'])) {

        // Action selon la valeur
        switch ($_GET['action']) {

            // ici, si ajout d'un produit 
            case "add":

                // On récupère et sécurise les données du formulaire
                $name  = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt   = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                // On vérifie que toutes les données sont valides
                if ($name && $price && $qtt) {

                    // On prépare un tableau contenant les infos du produit
                    $product = [
                        "name"  => $name,
                        "price" => $price,
                        "qtt"   => $qtt,
                        "total" => $price * $qtt
                    ];

                    // On ajoute ce produit dans le tableau $_SESSION['products']
                    $_SESSION['products'][] = $product;

                    // Message de confirmation
                    $_SESSION['message'] = "Produit ajouté avec succès";

                } else {
                    // Message d’erreur si le formulaire est incomplet
                    $_SESSION['message'] = "Incomplet ! Veuillez remplir tous les champs"; 
                }

                break;

            // Si l’action est "clear"
            case "clear":
                    // On vide entièrement la session
                    unset($_SESSION['products']); // supprime toutes les variables de $_SESSION
                    // On redémarre la variable message
                    $_SESSION['message'] = "Le panier a été vidé avec succès";
                break;

           // Delete"
            case "delete":
                // 
                unset($_SESSION['products'][$_GET['id']]);
                // Message de confirmation
                $_SESSION['message'] = "Produit supprimé avec succès";
                break;     

              // 
                case "plus":

                    // On augmente la quantité de 1
                    $_SESSION['products'][$_GET['id']]['qtt']++;

                    // On recalcule le total pour ce produit
                    $_SESSION['products'][$_GET['id']]['total'] =
                        $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt'];

                    // Message de confirmation
                    $_SESSION['message'] = "Quantité augmentée";

                    break;

                case "moins":

                    // Si la quantité est supérieure à 1, on la diminue
                    if ($_SESSION['products'][$_GET['id']]['qtt'] > 1) {
                        $_SESSION['products'][$_GET['id']]['qtt']--;

                        // On recalcule le total pour ce produit
                        $_SESSION['products'][$_GET['id']]['total'] =
                            $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt'];

                        $_SESSION['message'] = "Quantité diminuée";
                    } else {
                        $_SESSION['message'] = "Quantité minimale atteinte";
                    }

                    break;
                    }

    }

        if (isset($_GET['action']) && $_GET['action'] === "add") {
            header("Location: index.php");
        } else {
            header("Location: recap.php");
        }