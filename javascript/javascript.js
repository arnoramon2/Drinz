console.log("Javascript for Drinkz is loaded!");

function toonAlchohol(value){
    if(value.value == 0 || value.value == 1) {
        document.getElementById('alchohol').classList.add("d-none");
    } else {
        document.getElementById('alchohol').classList.remove("d-none");
    }

}

function scrollNaarBoven() {
    window.scroll({top: 0, left: 0, behavior: 'smooth' });
}

var div = document.getElementById("scroll");
div.style.cursor = "pointer";
div.addEventListener("click",function(){scrollNaarBoven();});