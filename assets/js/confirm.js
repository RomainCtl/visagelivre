var act = document.getElementsByClassName('confirmation'),
    confirmIt = function(e){
        if (!confirm('Etes-vous sûr de vouloir supprimer votre compte ?, cette action est irréversible et supprimera tous vos posts et commentaires')){
            e.preventDefault();
    }
};

for (var i=0 ; i < act.length ; i++){
    act[i].addEventListener('click', confirmIt, false);
}