document.getElementById('responsive_menu_icon').addEventListener('click', function(e) {
    let asideElement = document.getElementById('nav_aside');

    if(asideElement.style.display != "flex") {
        console.log('none');
        asideElement.style.display = "flex";
    } else {
        console.log('flex');

        asideElement.style.display = "none";
    };
});

