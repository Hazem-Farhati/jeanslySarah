<?php

@include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['add_to_wishlist'])){
	if($user_id==''){
		header('location:login.php');
	}else{
   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}
}

if(isset($_POST['add_to_cart'])){
	if($user_id==''){
		header('location:login.php');
	}else{
   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_stock = $_POST['p_stock'];
   $p_stock = filter_var($p_stock, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($p_stock =='rupture stock'){
	   $message[] = 'Rupture !';
   }elseif($check_cart_numbers->rowCount() > 0){
	   $message[] = 'déjà ajouté au panier !';
   }else{
	   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
	   $check_wishlist_numbers->execute([$p_name, $user_id]);
	   if($check_wishlist_numbers->rowCount() > 0){
		   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
		   $delete_wishlist->execute([$p_name, $user_id]);
	   }
	   $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
	   $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
	   $message[] = 'ajouté au panier !';
   }
	

   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>
   <link rel="icon" type="image/x-icon" href="images/jeansv.jpeg">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/styles.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<body>
   
<?php include 'header.php'; ?>

<br><br><section class="products">

   <h1 class="title">CATÉGORIES DE PRODUITS  </h1>
   

   <div class="box-container">

   <?php

   
      $category_name = $_GET['category'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
      $select_products->execute([$category_name]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      	  <p> <span class="stock-n" style="color:<?php if($fetch_products['stock'] == 'En stock'){ echo 'green'; }elseif($fetch_products['stock'] == 'proche'){ echo 'orange'; }  else{ echo 'red'; }; ?>"><?= $fetch_products['stock']; ?></span> </p>

      <!-- <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a> -->
       <div class="heartc">
            <button class="button" type="submit" name="add_to_wishlist" ><i class="far fa-heart"></i></button>
        </div>

      <!-- <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt=""> -->
<div class="carousel-all">
      <div >
  <div id="myCarousel" class="carousel slide" >
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" >

      <div class="item active">
        <img src="./images/b.jpeg" alt="First"  style="width:100%;">
       
      </div>

      <div class="item">
        <img src="./images/box.jpg" alt="Second" style="width:100%;">
        
      </div>
    
      <div class="item">
        <img src="./images/b.jpeg" alt="First" style="width:100%;">
      
      </div>
  
    </div>

    <!-- Left and right controls -->
    <div class="carousel-controls">
      <a class="left carousel-control" href="#myCarousel" data-slide="prev" onclick="$('#myCarousel').carousel('prev');">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next" onclick="$('#myCarousel').carousel('next');">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>
</div>





</body>
</html>

      <pre class="name"><?= $fetch_products['name'].""; ?></pre>
            <div class="price-new"> <span><?= $fetch_products['price'];  ?> TND</span></div>


     

	  <div class="stock">
	  
	  </div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
	  <input type="hidden" name="p_stock" value="<?= $fetch_products['stock']; ?>">
     <div class="panier-number">
           <input type="submit" value=" 🛒 Ajouter au panier" class="a-panier-btn" name="add_to_cart"> 
     <input type="number" min="1" value="1" name="p_qty" class="qty">

     </div>
 
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">aucun produit disponible !</p>';
         
      }
   ?><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>

   </div>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>