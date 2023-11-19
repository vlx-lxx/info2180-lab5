// world.js

window.onload = function () {
  var lookup = document.getElementById("lookup");
  var countryname = document.getElementById("country");
  var result = document.getElementById("result");

  lookup.onclick = function () {
    var httpRequest = new XMLHttpRequest();
    var url;
    url =
      "http://localhost:8888/info2180-lab5/world.php" +
      "?country=" +
      countryname.value;
    console.log(countryname);
    httpRequest.onreadystatechange = dothis;
    httpRequest.open("GET", url);
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
};
