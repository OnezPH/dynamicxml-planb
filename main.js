function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      myFunction(this);
      }
    };
    xhttp.open("GET", "dynamicXML.xml", true);
    xhttp.send();
  }
  function myFunction(xml) {
    var i;
    var xmlDoc = xml.responseXML;
    var table="<tr><th>Title</th><th>Artist</th></tr>";
    var x = xmlDoc.getElementsByTagName("link");
    for (i = 0; i <x.length; i++) {
      table += "<tr><td>" +
      x[i].getElementsByTagName("company")[0].childNodes[0].nodeValue +
      "</td><td>" +
      x[i].getElementsByTagName("product")[0].childNodes[0].nodeValue +
      "</td></tr>";
    }
    document.getElementById("data").innerHTML = table;
  }