let reference = function(e) {
    e.preventDefault();
    const chapt = new Chapters('chapters','http://localhost/jean_forteroche/chapter.html');
    chapt.displayChapters();
};

let elements = document.getElementsByClassName("chapt");
for(let i = 0; i<elements.length; i++) { 
    elements[i].addEventListener("click", reference, true);
};
