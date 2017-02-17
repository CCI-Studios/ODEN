(function(){
  document.querySelector(".menu--main").addEventListener("click", openDropdown)
  
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
})();
