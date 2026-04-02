let div1 = document.querySelector(".menu2");
let ul1 = document.querySelector("#compareMenu");
let bool = false;

let imgReplace = document.querySelector("#menuImage")
function click(){
    bool = !bool;
    console.log("jf")
    if(bool == true){
        ul1.style.visibility = "visible";
        imgReplace.src = "../imgs/userWhite.png";
    } else{
        ul1.style.visibility = "hidden";
        imgReplace.src = "../imgs/user.png";
    }

}

/*function color(){
    if()
}
svg.addEventListener("mouseover", () => {svg.setAttribute("stroke", "e10000");})*/

div1.addEventListener("click", click);