if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        document.getElementById('location').value = latitude+','+longitude;
      },
      function(error) {
        console.error("Error getting location: ", error);
      }
    );
  } else {
    console.error("Geolocation not supported");
  }