window.addEventListener("load", () => {

    const logo = document.getElementById("logo");
    const intro = document.getElementById("intro");
    const content = document.getElementById("content");

    setTimeout(() => {
        logo.classList.add("small");
    }, 600);

    setTimeout(() => {

        intro.style.opacity = "0";
        intro.style.transition = "opacity 0.6s";

        content.classList.add("show");

        setTimeout(()=>{
            intro.style.display="none";
        },600);

    }, 2000);

});