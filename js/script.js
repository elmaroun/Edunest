// Sélectionne l'élément HTML du bouton de profil par son ID
document.getElementById('profile-btn').onclick = function() {
     // Sélectionne la première fenêtre contextuelle de profil par sa classe et bascule sa visibilité
    document.querySelector('.profile-pop-up').classList.toggle('active');
}