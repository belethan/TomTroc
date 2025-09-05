    function toggleMenu () {
        const navbar = document.querySelector(' .burger');
        const burger = document.querySelector('.btn-burger');

        burger.addEventListener('click', (e) => {
            navbar.classList.toggle('show-burger');
        });
        // bonus
        const navbarLinks = document.querySelectorAll('.navbar-links-burger a');
        navbarLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                navbar.classList.toggle('show-burger');
            });
        });
    }
    function initConfirmDeleteModal() {
        const confirmDeleteModal = document.getElementById('confirmDellivreModal');

        if (!confirmDeleteModal) return; // sécurité si le modal n'existe pas

        confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const id = button.getAttribute('data-id');
            const titre = button.getAttribute('data-titre');
            const auteur = button.getAttribute('data-auteur');

            // Mettre à jour le message du modal
            const message = document.getElementById('modal-message');
            if (message) {
                message.textContent = `Voulez-vous vraiment supprimer le livre "${titre}" écrit par ${auteur} ?`;
            }

            // Mettre l'ID dans le champ hidden
            const hiddenInput = document.getElementById('delete-id');
            if (hiddenInput) {
                hiddenInput.value = id;
            }
        });
    }
toggleMenu();
initConfirmDeleteModal();

