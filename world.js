document.addEventListener("DOMContentLoaded", function () {
  var lookup = document.getElementById("lookup");
  var countryname = document.getElementById("country");
  var result = document.getElementById("result");

  lookup.onclick = function () {
    var httpRequest = new XMLHttpRequest();
    var country = encodeURIComponent(countryname.value);
    var url = "world.php?country=" + country;

    httpRequest.onreadystatechange = dothis;
    httpRequest.open("GET", url, true);
    httpRequest.send();

    function dothis() {
      if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
          var response = httpRequest.responseText;
          result.innerHTML = response;
        } else {
          alert("There was a problem with the request.");
        }
      }
    }
  };


  lookupcities.onclick = function () {
    var httpRequest = new XMLHttpRequest();
    var country = encodeURIComponent(countryname.value);

    httpRequest.onreadystatechange = dothis;
    httpRequest.open("GET", "world.php?country=" + encodeURIComponent(country) + "&lookup=cities", true);
    httpRequest.send();

    function dothis() {
      if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
          var response = httpRequest.responseText;
          result.innerHTML = response;
        } else {
          alert("There was a problem with the request.");
        }
      }
    }
  };
});
