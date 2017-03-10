(function(){
  var map;
  var geocoder;
  var infoWindows = [];
  
  createMap();
  createMemberMarkers();
  
  function createMap()
  {
    var location = new google.maps.LatLng(45.84957, -82.890768);
    var mapOptions = {
      zoom: 6,
      center: location,
      scrollwheel: false
    };
    map = new google.maps.Map(document.querySelector(".map--members"),mapOptions);
    geocoder = new google.maps.Geocoder();
  }
  function createMemberMarkers()
  {
    var members = [];
    var membersData = document.querySelectorAll(".view-member-map .views-row");
    for (var i=0; i<membersData.length; i++)
    {
      var organization = membersData[i].querySelector(".views-field-field-organization").innerText.trim();
      var address = membersData[i].querySelector(".views-field-field-add").innerText.trim().replace(/[^a-zA-Z0-9\,\.\-\s]/g,"");
      var website = membersData[i].querySelector(".views-field-field-website").innerText.trim();
      var member = {
        organization: organization,
        address: address,
        website: website
      };
      members.push(member);
      addMemberMarker(member);
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
    geocoder.geocode( { 'address':address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        callback(results[0].geometry.location, address);
      } else {
        //alert('Geocode was not successful for the following reason: ' + status);
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
})();
