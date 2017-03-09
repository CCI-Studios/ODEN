(function(){
  var calendar = document.querySelector(".view-calendar .calendar-calendar");
  if (!calendar) return;
  var days = calendar.querySelectorAll("td.single-day");
  for (var i=0; i<days.length; i++) {
    var d = days[i];
    if (d.classList.contains("empty")) continue;
    if (d.querySelector(".content-type--oden-event")) {
      d.classList.add("has-oden-event");
    }
  }
})();
