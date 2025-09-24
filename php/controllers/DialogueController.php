<?php

class DialogueController
{
    /**
     * Checks if the user is connected. If not, redirects to the connection form.
     *
     * @return void
     */
    private function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    /**
     * Sends a message from one user to another
     *
     * @return void
     */
    public function sendMessage(): void
    {
        $this->checkIfUserIsConnected();
        //$message = filter_input(INPUT_POST, 'message',  FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        $message = htmlspecialchars($_POST['message'] ?? '');
        if (trim($message) === '' || preg_replace('/\s+/', '', $message) === '') {
            Utils::logError("Vous ne pouvez pas envoyer un message vide.");
            return;
        }
        $msgDe = filter_input(INPUT_POST, 'demsg', FILTER_SANITIZE_NUMBER_INT);
        $msgpour = filter_input(INPUT_POST, 'destinataire', FILTER_SANITIZE_NUMBER_INT);

        $messageManager = new DialogueManager();
        if ($messageManager->addMessage($msgDe, $msgpour, $message)) {
            Utils::logSuccess("Message envoyé avec succès");
        } else {
            Utils::logError("Erreur lors de l'envoi du message");
        }
        utils::redirect("dialoguser", ['keyIdUser' => $msgpour]);
    }

    /**
     * Lists all user for the current user with the last message
     *
     * @return void
     */
    public function listUserMessages(): void
    {
        $this->checkIfUserIsConnected();
        $messageManager = new DialogueManager();
        $usercnx = $_SESSION['keyIdUser'];
        $messages = $messageManager->getUserMessages($usercnx);
        $pourkeyuser = $_GET['keyIdUser'];    //Message pour l' utilisateur avec KeyIdUser
        if ($pourkeyuser === "0") {
            $pourkeyuser = $messages[0]->getDeMessagerie();
        }
        $indice = $messageManager->findIndexByPourMessagerie($messages, $pourkeyuser); //recherche indice dans le tableau
        $dialogues = $messageManager->getDialogue($pourkeyuser, $usercnx); //Message POUR iduser de la personne connecté DE
        if (($indice === 0) && ($pourkeyuser !== $usercnx)) {
            $indice = 1;
        }
        $useraskView = $messages[$indice]; //retourne le 1er dialogue avec l'utilisateur Pour
        $view = new View("Messagerie");
        if (isset($_GET['mobile']) && $_GET['mobile'] === "1") {
            $view->render("messageUserOnly", ['msgUser' => $messages, 'dialogues' => $dialogues, 'useraskView' => $useraskView]);
        } else {
            $view->render("dialogue_user", ['msgUser' => $messages, 'dialogues' => $dialogues, 'useraskView' => $useraskView]);
        }

    }

    public function showDialogUser(): void
    {
        /* Ecrire un Message */
        $EcrireA = $_GET['keyIdUser'];      // clé Utilisateur à envoyer le message
        $DelaPart = $_SESSION['keyIdUser'];     //Clé Utilisateur connecté et Identifié
            /* Afficher les dialogues de l'utilisateur DeLaPart Celui qui est connecté*/
        $messageManager = new DialogueManager();
        $messages = $messageManager->getUserMessages($DelaPart);
        /* Définir l'utilisateur a qui on envoie le message */
        $utilisateurAquiOnEcrite = new UtilisateurManager();
        if ($EcrireA === "0") {
            $EcrireA = $messages[0]->getDeMessagerie();
        }
        $useraskView=$utilisateurAquiOnEcrite->getUtilisateurById($EcrireA);
        /* Afficher les messages de l'utilisateur EcrireA */
        $dialogues = $messageManager->getDialogue($EcrireA, $DelaPart); //Message POUR iduser de la personne connecté DE

        $view = new View("Dialogue Utilisateur");
        if (isset($_GET['mobile']) && $_GET['mobile'] === "1") {
            $view->render("messageUserOnly", ['msgUser' => $messages, 'dialogues' => $dialogues, 'useraskView' => $useraskView]);
        } else {
            $view->render("dialogue_user", ['msgUser' => $messages, 'dialogues' => $dialogues, 'useraskView' => $useraskView]);
        }


    }
}
