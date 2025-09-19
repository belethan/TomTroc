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
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        $msgDe = filter_input(INPUT_POST, 'demsg', FILTER_SANITIZE_NUMBER_INT);
        $msgpour = filter_input(INPUT_POST, 'destinataire', FILTER_SANITIZE_NUMBER_INT);

        if (!$message) {
            Utils::logError("Message ou destinataire manquant");
            return;
        }

        $messageManager = new DialogueManager();
        if ($messageManager->addMessage($_SESSION['user']['id'], $recipientId, $message)) {
            Utils::logSuccess("Message envoyé avec succès");
        } else {
            Utils::logError("Erreur lors de l'envoi du message");
        }
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
        $Dekeyuser = $_GET['keyIdUser'];
        $dialogues=$messageManager->getDialogue($Dekeyuser, $usercnx);
        $useraskView = $messages[$messageManager->findIndexByPourMessagerie($messages,$Dekeyuser)]; //retourne indice dans le tableau
        $view = new View("Messagerie");
        $view->render("dialogue_user", ['msgUser' => $messages , 'dialogues'=>$dialogues, 'useraskView'=>$useraskView]);
    }
}

