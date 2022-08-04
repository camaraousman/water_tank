document.getElementById("Hidenews").style.display = "none";
document.getElementById("tab1").className = "highlight";

//Set classes and page ^ v
document.getElementById("tab1").addEventListener("click", highlight1);
document.getElementById("tab2").addEventListener("click", highlight2);

//What happens when you click on tab 1:
function highlight1() {
    document.getElementById("Hide1").style.display = "";
    document.getElementById("tab1").className = "highlight";
    document.getElementById("tab2").className = "none";
    document.getElementById("Hidenews").style.display = "none";
}
//What happens when you click on tab 2:
function highlight2() {
    document.getElementById("Hide1").style.display = "none";
    document.getElementById("tab2").className = "highlight";
    document.getElementById("tab1").className = "none";
    document.getElementById("Hidenews").style.display = "";

}
