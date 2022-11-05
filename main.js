function showResult(str) {
  if (str.length==0) {
    document.getElementById("item").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("item").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","server.php?q="+str,true);
  xmlhttp.send();
}
console.log(showResult);