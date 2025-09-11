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

        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        $recipientId = filter_input(INPUT_POST, 'recipient_id', FILTER_SANITIZE_NUMBER_INT);

        if (!$message || !$recipientId) {
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
     * Lists all messages for the current user
     *
     * @return void
     */
    public function listMessages(): void
    {
        $this->checkIfUserIsConnected();

        $messageManager = new DialogueManager();
        $messages = $messageManager->getUserMessages($_SESSION['user']['id']);

        $view = new View("Messages");
        $view->render("messageList", ['messages' => $messages]);
    }
}

