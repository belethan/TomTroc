<?php

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('home');
 */
class Utils {
    private const MAX_FILE_SIZE = 5000000; // File size limit in bytes (5 Mo)
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif'];
    private const IMAGE_DIR = "../images/";

    /**
     * Convertit une date vers le format de type "Samedi 15 juillet 2023" en francais.
     * @param DateTime $date : la date à convertir.
     * @return string : la date convertie.
     */
    public static function convertDateToFrenchFormat(DateTime $date) : string
    {
        // Attention, s'il y a un soucis lié à IntlDateFormatter c'est qu'il faut
        // activer l'extension intl_date_formater (ou intl) au niveau du serveur apache.
        // Ca peut se faire depuis php.ini ou parfois directement depuis votre utilitaire (wamp/mamp/xamp)
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('EEEE d MMMM Y');
        return $dateFormatter->format($date);
    }

    /**
     * Redirige vers une URL.
     * @param string $action : l'action que l'on veut faire (correspond aux actions dans le routeur).
     * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
     * @return void
     */
    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    /**
     * Cette méthode retourne le code js a insérer en attribut d'un bouton.
     * pour ouvrir une popup "confirm", et n'effectuer l'action que si l'utilisateur
     * a bien cliqué sur "ok".
     * @param string $message : le message à afficher dans la popup.
     * @return string : le code js à insérer dans le bouton.
     */
    public static function askConfirmation(string $message) : string
    {
        return "onclick=\"return confirm('$message');\"";
    }

    /**
     * Cette méthode protège une chaine de caractères contre les attaques XSS.
     * De plus, elle transforme les retours à la ligne en balises <p> pour un affichage plus agréable.
     * @param string $string : la chaine à protéger.
     * @return string : la chaine protégée.
     */
    public static function format(string $string) : string
    {
        // Etape 1, on protège le texte avec htmlspecialchars.
        $finalString = htmlspecialchars($string, ENT_QUOTES);

        // Etape 2, le texte va être découpé par rapport aux retours à la ligne,
        $lines = explode("\n", $finalString);

        // On reconstruit en mettant chaque ligne dans un paragraphe (et en sautant les lignes vides).
        $finalString = "";
        foreach ($lines as $line) {
            if (trim($line) != "") {
                $finalString .= "<p>$line</p>";
            }
        }

        return $finalString;
    }

    /**
     * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
     * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
     * ou celle qui est passée en paramètre si elle existe.
     * @param string $variableName : le nom de la variable à récupérer.
     * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
     * @return mixed : la valeur de la variable ou la valeur par défaut.
     */
    public static function request(string $variableName, mixed $defaultValue = null) : mixed
    {
         return $_REQUEST[$variableName] ?? $defaultValue;
    }

    Public static function userMenu(string $nomstyle='navbar-link-right')
    {
        if ($nomstyle ==='navbar-link-right') {
            echo '<li class="navbar-msg-left navbar-link-right"><a href="index.php?action=dialoguser&keyIdUser=0" class="bulle">Messagerie <span class="badge">'.$_SESSION['msgnonlu'].'</span> </a></li>';
        }
        else{
               echo '<li class="navbar-link-burger"><a href="index.php?action=dialoguser&keyIdUser=0">Messagerie</a></li>';
        }
        if (isset($_SESSION['user']) && (!empty($_SESSION['user'])) && ($_SESSION['user']->getId()>0) ) {
            echo '<li  class="'.$nomstyle.'"><a href="index.php?action=infouser">'.$_SESSION['user']->getPseudoUtilisateur().'</a></li>';
            echo '<li  class="'.$nomstyle.'"><a href="index.php?action=disconnectUser">Déconnexion</a></li>';
        }
        else{

            echo '<li  class="'.$nomstyle.'"><a href="index.php?action=connectUser">Mon Compte</a></li>';
            echo '<li  class="'.$nomstyle.'"><a href="index.php?action=connectUser">Comnexion</a></li>';
        }
    }

    public static function uploadImage(int $keyrecord, string $valueinit, string $prefixefile = "PROFIL-", ): ?string
    {
        $destPath = $valueinit;
        if (!isset($_FILES["img_tomtroc"])) {
            return $valueinit;
        }
        //extraction du fichier image et analyse du document
        if (isset($_FILES['img_tomtroc']) && $_FILES['img_tomtroc']['error'] === UPLOAD_ERR_OK) {
            //var_dump($_FILES);
            $fileTmpPath = $_FILES['img_tomtroc']['tmp_name'];
            $fileName = $_FILES['img_tomtroc']['name'];
            $fileSize = $_FILES['img_tomtroc']['size'];
            // Extension
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            //Vérificatio du Fichier Image récupérer
            $result =self::validateFile($fileExtension,$allowedExtensions,$fileSize,$fileTmpPath,$valueinit);

            if ($result !== true) {
                return $result;
            }
            //initialisation du chemin
            $uploadDir = JS_IMAGE ;
            // Date formatée MMAAAA
            $dateFormat = date("mY");
            $id = str_pad($keyrecord, 5, "0", STR_PAD_LEFT);
            if ($prefixefile == "PROFIL-"){
               $uploadDir = JS_IMAGE . "user_picture/";
            }
            // Nouveau nom : PRO-[id]-[MMAAAA].extension
            $newFileName = $prefixefile . $id . "-" . $dateFormat . "." . $fileExtension;
            // Chemin final
            $destPath = $uploadDir . $newFileName;
            // Déplacement
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                self::logsuccess("Image uploadée avec succès ");
            } else {
                self::logError("Erreur lors du déplacement du fichier.");
                $destPath = $valueinit;
            }
        }
      return $destPath;
    }
   /**
     * Logs an error message. Replace with a proper logging system in production.
     *
     * @param string $message
     */
    private static function logMessage(string $key, string $message): void
    {
        $_SESSION['alert'] = [
            'type' => $key,
            'message' => $message
        ];
    }
    public static function logError(string $message): void
    {
        self::logMessage('danger', $message);
    }
    public static function logsuccess(string $message): void
    {
           self::logMessage('success', $message);
    }

    public static function logwarning(string $message): void
    {
        self::logMessage('warning', $message);
    }

    public  static function checkExtension(string $fileExtension, array $allowedExtensions, $valueinit)
    {
        if (!in_array($fileExtension, $allowedExtensions)) {
            self::logError("Extension non autorisée. Formats valides : " . implode(", ", $allowedExtensions));
            return $valueinit;
        }
        return true;
    }

    /**
     * Vérifie que la taille du fichier ne dépasse pas la limite
     */
    public static function checkFileSize(int $fileSize, $valueinit)
    {
        if ($fileSize > self::MAX_FILE_SIZE) {
            self::logWarning("Fichier trop volumineux. Taille max : 5 Mo");
            return $valueinit;
        }
        return true;
    }

    /**
     * Vérifie que le fichier est bien une image
     */
    public static function checkFileType(string $fileTmpPath, $valueinit)
    {
        if (!exif_imagetype($fileTmpPath)) {
            self::logError("Le fichier n'est pas une image.");
            return $valueinit;
        }
        return true;
    }

    /**
     * Fonction centrale qui appelle toutes les vérifications
     */
    public static function validateFile(string $fileExtension, array $allowedExtensions, int $fileSize, string $fileTmpPath, $valueinit)
    {
        if (self::checkExtension($fileExtension, $allowedExtensions, $valueinit) !== true) {
            return $valueinit;
        }

        if (self::checkFileSize($fileSize, $valueinit) !== true) {
            return $valueinit;
        }

        if (self::checkFileType($fileTmpPath, $valueinit) !== true) {
            return $valueinit;
        }

        return true; // Tout est OK
    }

}