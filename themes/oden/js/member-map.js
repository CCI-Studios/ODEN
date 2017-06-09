(function($){
  var key = "AIzaSyBdeyJodUvidd3zx74pxNfuBGy_QkpF9Dw";
  var map;
  var geocoder;
  var infoWindows = [];
  var members;
  
  createMap();
  prepareMembersData();
  createMemberMarkers();
  
  function createMap()
  {
    var mapOptions = {
      zoom: 6,
      center: getCenter(),
      scrollwheel: false
    };
    map = new google.maps.Map(document.querySelector(".map--members"),mapOptions);
    geocoder = new google.maps.Geocoder();
  }
  function getCenter()
  {
    if ($(window).width() > 760) {
      return new google.maps.LatLng(45.84957, -82.890768);
    } else {
      return new google.maps.LatLng(45.00157, -82.005168);
    }
  }
  function prepareMembersData()
  {
    members = [];
    var membersData = document.querySelectorAll(".view-member-map .views-row");
    for (var i=0; i<membersData.length; i++)
    {
      var organization = membersData[i].querySelector(".views-field-field-organization").innerText.trim();
      var address = membersData[i].querySelector(".views-field-field-add").innerText.trim().replace(/[^a-zA-Z0-9\,\.\-\s]/g,"");
      var website = membersData[i].querySelector(".views-field-field-website").innerText.trim();
      if (!address) {
        continue;
      }
      var member = {
        organization: organization,
        address: address,
        website: website
      };
      members.push(member);
    }
  }
  function createMemberMarkers(skip)
  {
    if (!skip)
    {
      skip = 0;
    }
    var queryLimit = 10;
    var waitTime = 1010;
    for (var i=skip; i<members.length && i-skip<queryLimit; i++)
    {
      var member = members[i];
      addMemberMarker(member);
    }
    if (skip + queryLimit < members.length) {
      setTimeout((function(nextSkip){
        return function(){
          createMemberMarkers(nextSkip);
        };
      })(skip+queryLimit), waitTime);
    }
  }
  function addMemberMarker(member)
  {
    getAddressLatLng(member.address, function(latlng){
      showMarkerLatLng(latlng, member);
    });
  }
  function getAddressLatLng(address, callback)
  {
    var url = "https://maps.googleapis.com/maps/api/geocode/json?key="+key+"&address="+address+"&sensor=false";
    $.ajax({url:url, dataType:"json"}).done(function(data){
      if (data.status == google.maps.GeocoderStatus.OK) {
        callback(data.results[0].geometry.location, address);
      } else {
        if (console && console.log) {
          // console.error('Geocode was not successful for the following reason: ' + data.status+"\n"+address);
        }
      }
    });
  }
  function showMarkerLatLng(latlng, member)
  {
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      icon: "/themes/oden/img/icon-map-marker.png"
    });
    var infowindow = new google.maps.InfoWindow({
      content: "<h2>"+member.organization+"</h2><p>"+member.address+"<br><a target='_blank' href='"+member.website+"'>"+member.website+"</a></p>",
      maxWidth: 200
    });
    infoWindows.push(infowindow);
    google.maps.event.addListener(marker, 'click', function() {
      closeInfoWindows();
      infowindow.open(map, marker);
    });
  }
  function closeInfoWindows()
  {
    for (var i=0; i<infoWindows.length; i++)
    {
      infoWindows[i].close();
    }
  }
})(jQuery);
