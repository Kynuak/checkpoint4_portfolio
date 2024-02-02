document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    // Écoutez l'événement de clic sur chaque lien
    anchor.addEventListener('click', function (e) {
        // Empêcher le comportement de lien par défaut
        e.preventDefault();

        // Récupérer l'élément cible lié à l'ancre
        const target = document.querySelector(this.getAttribute('href'));

        // Vérifiez si l'élément cible existe
        if (target) {
            // Calculer la distance entre le haut de la page et la position de l'élément cible
            const offsetTop = target.offsetTop;

            // Animer le défilement jusqu'à la position de l'élément cible
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth' // Défilement en douceur
            });
        }
    });
});