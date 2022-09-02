const searchInput = document.querySelector("[placeholder='Search']");
const textSearch = document.getElementById("textSearch");
const searchBtn = document.getElementById("searchBtn");
const xhrurl = textSearch.dataset.xhrurl;
let id_movie = "";

searchInput.addEventListener(
    "keyup",
    () => {
        // réponse à mon keyup
        // console.log("C'est pas faux !");
        // pour obtenir la valeur de mon champ :
        let resultat = searchInput.value;
        // console.log(`Le contenu de mon champ est ${resultat} c'est très joli !`);
        // j'ai besoin d'appeler request.php pour obtenir mes resultats
        // AJAX 
        fetch(xhrurl + "?resultat=" + resultat,{})
            // j'attend l'execution de ma requête
            .then((reponse) => {
                // ne pas oublié le return !!!
                // return reponse.text();
                return reponse.json();
                // console.dir(reponse);
            })
            // j'attend la reponse au format texte avec la fonction text()
            .then((json) => {
                console.dir(json);
                autoComp(json);
            })
    }
);
// Créer une fonction qui affichera mes résultats de request.php sous l'input
function autoComp(json) {
    if (json.length !== 0) {
        // reset autocomplete
        textSearch.innerHTML = "";
        let resultTitle = "";
        json.forEach(element => {
            console.log(element.title);
            resultTitle += `<div onclick="validComplete('${element.title}','${element.id_movie}')">${element.title}</div>`;
        });
        textSearch.innerHTML = resultTitle;
    } else {
        textSearch.innerHTML = "Aucun résultat";
    }

}
function validComplete(value, id) {
    console.log(value);
    searchInput.value = value;
    textSearch.innerHTML = "";
    resultTitle = "";
    id_movie = id;
}
searchBtn.addEventListener("click",()=>{
    if(id_movie !== ""){
        location.href = searchBtn.dataset.xhrurl+"?id_movie="+id_movie;
    }
}) 
