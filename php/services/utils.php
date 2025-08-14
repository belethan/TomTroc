<?php

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('home');
 */
class Utils {
    private const MAX_FILE_SIZE = 500000; // File size limit in bytes
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

    Public static function UserMenu(string $nomstyle='navbar-link-right')
    {
        if ($nomstyle ==='navbar-link-right') {
            echo '<li class="navbar-msg-left navbar-link-right"><a href="#" class="bulle">Messagerie <span class="badge">'.$_SESSION['msgcpt'].'</span> </a></li>';
        }
        else{
               echo '<li class="navbar-link-burger"><a href="#">Messagerie</a></li>';
        }

        if (isset($_SESSION['user'])) {
            echo '<li  class="'.$nomstyle.'"><a href="index.php?action=infouser">'.$_SESSION['pseudo'].'</a></li>';
            echo '<li  class="'.$nomstyle.'"><a href="index.php?action=disconnectUser">Déconnexion</a></li>';
        }
        else{

            echo '<li  class="'.$nomstyle.'"><a href="#">Compte</a></li>';
            echo '<li  class="'.$nomstyle.'"><a href="index.php?action=connectUser">comnexion</a></li>';
        }
    }



    public static function uploadImage(): ?string
    {
        if (!isset($_FILES["fileToUpload"])) {
            return null;
        }

        $targetFile = self::IMAGE_DIR . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (!self::isImage($_FILES["fileToUpload"]["tmp_name"])) {
            self::logError("Le fichier n'est pas une image.");
            return null;
        }

        if (file_exists($targetFile)) {
            self::logError("Désolé, le fichier existe déjà.");
            return null;
        }

        if (!self::isValidSize($_FILES["fileToUpload"]["size"])) {
            self::logError("Désolé, le fichier est trop volumineux.");
            return null;
        }

        if (!self::isValidExtension($imageFileType)) {
            self::logError("Désolé, seulement des fichiers avec extensions JPG, JPEG, PNG & GIF sont autorisés.");
            return null;
        }

        if (!self::moveFile($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            self::logError("Désolé, une erreur a été détectée lors du téléchargement.");
            return null;
        }

        return htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
    }

    /**
     * Checks if the file is a valid image.
     *
     * @param string $filePath
     * @return bool
     */
    private static function isImage(string $filePath): bool
    {
        return getimagesize($filePath) !== false;
    }

    /**
     * Checks if the file size is within the allowed limit.
     *
     * @param int $size
     * @return bool
     */
    private static function isValidSize(int $size): bool
    {
        return $size <= self::MAX_FILE_SIZE;
    }

    /**
     * Checks if the file extension is allowed.
     *
     * @param string $extension
     * @return bool
     */
    private static function isValidExtension(string $extension): bool
    {
        return in_array($extension, self::ALLOWED_EXTENSIONS, true);
    }

    /**
     * Moves the uploaded file to the target directory.
     *
     * @param string $tempPath
     * @param string $targetPath
     * @return bool
     */
    private static function moveFile(string $tempPath, string $targetPath): bool
    {
        return move_uploaded_file($tempPath, $targetPath);
    }

    /**
     * Logs an error message. Replace with a proper logging system in production.
     *
     * @param string $message
     */
    private static function logError(string $message): void
    {
        echo $message;
    }
}