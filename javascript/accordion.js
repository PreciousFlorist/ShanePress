var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {

  acc[i].addEventListener("click", function() {

    if (!e) var e = window.event;
    e.cancelBubble = true;
    if (e.stopPropagation) e.stopPropagation();
    
    this.classList.toggle("open");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
