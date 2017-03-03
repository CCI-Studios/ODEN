(function(){
  var filter = document.querySelector(".view-member-list .view-filters select[name=field_organization_value]");
  if (!filter) return;
  if (filter.value && filter.value != "All") {
    var active = document.querySelector(".view-member-list .member-filter .active");
    if (active) {
      active.classList.remove("active");
    }
    var newActive = document.querySelector(".view-member-list .member-filter .filter-"+filter.value);
    if (newActive) {
      newActive.classList.add("active");
    }
    var view = document.querySelector(".view-member-list");
    view.classList.add("filter-"+filter.value);
    view.classList.add("has-member-filter");
  }
})();
