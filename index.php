<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML, PHP, AJAX</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="logo.png">
</head>
<body>
    <div class="main-con">
        <div class="main-wrap">
            <h1>XML, PHP, AJAX</h1>
            <div class="search-button">
                <div class="sb-wrap">
                    <div class="search-field">
                        <input type="text" onkeyup="showResult(this.value)" placeholder="Search by Product Details">
                        <i class='bx bx-search'></i>
                    </div>
                    <button onclick="formShow()">Add Product</button>
                </div>
            </div>
            <div id="result"></div>
            <span id="end">========== End Result ==========</span>
        </div>
    </div>
    <div id="form-con">
        <div class="form-wrap">
            <div class="form-header">
                <h3>Add Product</h3>
                <button onclick="formClose()"><i class='bx bx-x'></i></button>
            </div>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="option-con">
                    <label for="company">Choose a Company</label>
                    <br>
                    <select name="company" id="company">
                        <optgroup label="Company">
                          <option value="Amazon">Amazon</option>
                          <option value="Alibaba">Alibaba</option>
                          <option value="eBay">eBay</option>
                          <option value="Walmart">Walmart</option>
                          <option value="Groupon">Groupon</option>
                          <option value="Macys">Macys</option>
                          <option value="Samsung">Samsung</option>
                          <option value="IKEA">IKEA</option>
                          <option value="LTT Store">LTT Store</option>
                          <option value="Chewy">Chewy</option>
                        </optgroup>
                      </select>
                </div>
                <div class="input-con">
                    <label for="product">Product</label>
                    <br>
                    <input id="product" type="text" name="product">
                </div>
                <div class="input-con">
                    <label for="prices">Prices</label>
                    <br>
                    <input id="prices" type="text" pattern="[0.0-9.9]+" name="prices">
                </div>
                <div class="image-con">
                    <label class="iamge-label" for="image">Image</label>
                    <br>
                    <label class="inputImage" for="image">Choose product image</label>
                    <input id="image" type="file" name="image" accept="image/*">
                </div>
                <div class="input-con">
                    <label for="url">URL</label>
                    <input id="url" type="url" name="url">
                </div>
                <input name="send" type="submit" value="Submit">
              </form>
        </div>
    </div>
<?php
if(isset($_POST['send'])){
    $target_path = "product image/";  
    $imageName = $_FILES['image']['name'];
    $target_path = $target_path.basename($imageName);   

    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {  
        echo "File uploaded successfully!";
        if(isset($_POST['send'])){
            $xml = new DOMDocument("1.0", "UTF-8");
            $xml -> load("data.xml");
          
            $rootTag = $xml -> getElementsByTagName("pages") -> item(0);
          
            $linkTag = $xml -> createElement("link");
            $companyTag = $xml -> createElement("company", $_POST['company']);
            $productTag = $xml -> createElement("product", $_POST['product']);
            $pricesTag = $xml -> createElement("prices", $_POST['prices']);
            $urlTag = $xml -> createElement("url", $_POST['url']);
            $imageTag = $xml -> createElement("image", $imageName);
        
            $linkTag -> appendChild($companyTag);
            $linkTag -> appendChild($productTag);
            $linkTag -> appendChild($pricesTag);
            $linkTag -> appendChild($imageTag);
            $linkTag -> appendChild($urlTag);
            
            $rootTag -> appendChild($linkTag);
        
            $xml -> save("data.xml");
          }
    } else{  
        echo "Sorry, file not uploaded, please try again!";  
    }
}
?>
    <script>
        function showResult(str) {
            var xmlhttp=new XMLHttpRequest();
            if (str.length==0) {
                document.getElementById("result").innerHTML="";
                document.getElementById("end").style.display = "none";
                return;
            }
            xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("result").innerHTML = this.responseText;
                if(document.getElementById("result").innerHTML == "No results found"){
                    document.getElementById("end").style.display = "none";
                }else{
                    document.getElementById("end").style.display = "block";
                }
            }
            }
            xmlhttp.open("GET","serverScript.php?q="+str,true);
            xmlhttp.send();
        }

        let formCon = document.getElementById('form-con');
        function formShow(){
            formCon.style.display = "flex"
        }
        function formClose(){
            formCon.style.display = "none"
        }
    </script>
</body>
</html>