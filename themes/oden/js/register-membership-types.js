(function(){
  var container = document.getElementById("edit-field-membership-type-wrapper");
  if (!container) return;
  var labels = container.querySelectorAll("label.option");
  for (var i=0; i<labels.length; i++) {
    labels[i].innerHTML += "<span class='membership-helper' tabindex='0'>?</span>";
  }
  
  var descriptions = container.querySelectorAll(".description > span");
  hideAllDescriptions();
  
  var buttons = container.querySelectorAll(".membership-helper");
  for (var i=0; i<buttons.length; i++) {
    buttons[i].addEventListener("focus", (function(i){return function(e){showDescription(e, i);}})(i));
    buttons[i].addEventListener("click", function(e){e.stopPropagation();e.preventDefault();});
  }
  
  function showDescription(e, i) {
    hideAllDescriptions();
    descriptions[i].classList.remove("hide");
  }
  function hideAllDescriptions() {
    for (var i=0; i<descriptions.length; i++) {
      descriptions[i].classList.add("hide");
    }
  }
})();
