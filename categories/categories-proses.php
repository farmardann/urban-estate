<?php 
if(isset($_POST['simpan'])) {
    $categories = $_POST['categories'];
    $price = $_POST['price'];
    $Description= $_POST['Description'];
    $image = $_FILES['photo']['name'];

    echo
    'Categories : ' . $categories . 
    '<br> Price : ' . $price .
    '<br> Description : '. $Description .
    '<br> File name : ' . $image; 
}
?>