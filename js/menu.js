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
        })

    }
toggleMenu();
