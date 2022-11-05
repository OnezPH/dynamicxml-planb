function showResult(str) {
  if (str.length == 0) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      myFunction(this);
    }
    xhttp.open("GET", "dynamicXML.xml");
    xhttp.send();
  }
}
function myFunction(xml) {
  const xmlDoc = xml.responseXML;
  const x = xmlDoc.getElementsByTagName("link");
  let table = "";
  for (let i = 0; i < x.length; i++) { 
    table += "<div class='item_wrap'> <h1>" +
    x[i].getElementsByTagName("company")[0].childNodes[0].nodeValue +
    "</h1><br>" +
    x[i].getElementsByTagName("product")[0].childNodes[0].nodeValue +
    "</div>";
  }
  document.getElementById("item").innerHTML = table;
}
console.log(showResult);
console.log(myFunction);