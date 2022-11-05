function showResult(str) {
  if (str.length == 0) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      myFunction(this);
    }
    xhttp.open("GET", "dynamicXML.xml");
    xhttp.send();
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    }
  }
  xmlhttp.open("GET","serverScript.php?q="+str,true);
  xmlhttp.send();
}
function myFunction(xml) {
  const xmlDoc = xml.responseXML;
  const x = xmlDoc.getElementsByTagName("link");
  let table = "";
  for (let i = 0; i < x.length; i++) { 
    table += "<div class='item_wrap'> <h1>" +
    x[i].getElementsByTagName("company")[0].childNodes[0].nodeValue +
    "</h1><b>Product : </b>" +
    x[i].getElementsByTagName("product")[0].childNodes[0].nodeValue +
    "<br><b>Prices : </b>" +
    x[i].getElementsByTagName("prices")[0].childNodes[0].nodeValue +
    "<br><img src='" +
    x[i].getElementsByTagName("image")[0].childNodes[0].nodeValue +
    "' alt='Product Image'><br><b>URL : </b><a href='" +
    x[i].getElementsByTagName("url")[0].childNodes[0].nodeValue +
    "'>Product Link</a></div>";
  }
  document.getElementById("item").innerHTML = table;
}
console.log(showResult);
console.log(myFunction);
