<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("data.xml");

$x=$xmlDoc->getElementsByTagName('link');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {

    $y=$x->item($i)->getElementsByTagName('company');
    $z=$x->item($i)->getElementsByTagName('product');
    $prices=$x->item($i)->getElementsByTagName('prices');
    $image=$x->item($i)->getElementsByTagName('image');
    $url=$x->item($i)->getElementsByTagName('url');


    if ($y->item(0)->nodeType==1) {
      //find a link matching the search text
      if (stristr($z->item(0)->childNodes->item(0)->nodeValue,$q) || stristr($y->item(0)->childNodes->item(0)->nodeValue,$q) || stristr($prices->item(0)->childNodes->item(0)->nodeValue,$q)) {
        if ($hint=="") {
          $hint="
          <div class='productConWrap'><img src='product image/" .
          $image->item(0)->childNodes->item(0)->nodeValue .
          "'alt='Product Image'><br><span><b>Company :</b>" .
          $y->item(0)->childNodes->item(0)->nodeValue .
          "</span><br><span><b>Product: </b>" .
          $z->item(0)->childNodes->item(0)->nodeValue .
          "</span><br><span><b>Prices: </b>" .
          $prices->item(0)->childNodes->item(0)->nodeValue .
          "</span><br><a id='productLink' href='" .
          $url->item(0)->childNodes->item(0)->nodeValue .
          "' target='_blank'>Product Link</a></div>";
        } else {
          $hint=$hint . "<div class='productConWrap'><img src='product image/" .
          $image->item(0)->childNodes->item(0)->nodeValue .
          "'alt='Product Image'><br><span><b>Company :</b>" .
          $y->item(0)->childNodes->item(0)->nodeValue .
          "</span><br><span><b>Product: </b>" .
          $z->item(0)->childNodes->item(0)->nodeValue .
          "</span><br><span><b>Prices: </b>" .
          $prices->item(0)->childNodes->item(0)->nodeValue .
          "</span><br><a id='productLink' href='" .
          $url->item(0)->childNodes->item(0)->nodeValue .
          "' target='_blank'>Product Link</a></div>";
        }
      }
    }
  }
}
// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="No results found";
} else {
  $response=$hint;
}
//output the response
echo $response;
?>