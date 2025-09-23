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
        $message =htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        if (trim($message) === '' || preg_replace('/\s+/', '', $message) === '') {
            Utils::logError("Vous ne pouvez pas envoyer un message vide.");
            return;
        }
        $msgDe = filter_input(INPUT_POST, 'demsg', FILTER_SANITIZE_NUMBER_INT);
        $msgpour = filter_input(INPUT_POST, 'destinataire', FILTER_SANITIZE_NUMBER_INT);

        $messageManager = new DialogueManager();
        if ($messageManager->addMessage($msgDe,$msgpour,$message)) {
            Utils::logSuccess("Message envoyé avec succès");
        } else {
            Utils::logError("Erreur lors de l'envoi du message");
        }
        utils::redirect("dialoguser",['keyIdUser'=>$msgpour]);
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
        $usercnx =$_SESSION['keyIdUser'];
        $messages=$messageManager->getUserMessages($usercnx);
        $pourkeyuser = $_GET['keyIdUser'];    //Message pour l' utilisateur avec KeyIdUser
        $Dekeyuser = $_SESSION['keyIdUser'];    // KeyUser pour la personne actuellement connecté au Site
        $dialogues=$messageManager->getDialogue($pourkeyuser, $usercnx); //Message POUR iduser de la personne connecté DE
        $indice = $messageManager->findIndexByPourMessagerie($messages,$pourkeyuser); //recherche indice dans le tableau
        $useraskView = $messages[$indice]; //retourne le 1er dialogue avec l'utilisateur Pour .
        $view = new View("Messagerie");
        $view->render("dialogue_user", ['msgUser' => $messages , 'dialogues'=>$dialogues, 'useraskView'=>$useraskView]);
    }
}

