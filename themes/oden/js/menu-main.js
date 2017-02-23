(function(){
  //main menu dropdowns
  document.querySelector(".menu--main").addEventListener("click", openDropdown);
  function openDropdown(e) {
    if (e.target.tagName.toLowerCase() != "a") return;
    if (!e.target.parentNode.classList.contains("menu-item--expanded")) return;
    e.preventDefault();
    var open = document.querySelector(".menu--main .open");
    if (open && open != e.target.parentNode) {
      open.classList.remove("open");
    }
    e.target.parentNode.classList.toggle("open");
  }
  
  //mobile menu button
  document.querySelector(".menu-button").addEventListener("click", openMenu);
  function openMenu(e) {
    e.preventDefault();
    document.querySelector("body").classList.toggle("menu-open");
  }
})();
