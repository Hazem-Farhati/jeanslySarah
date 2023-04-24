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
      $message[] = 'déjà ajouté à la liste de souhaits !';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'déjà ajouté au panier !';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'ajouté à la liste de souhaits !';
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
   <title>jeans'ly</title>
   <link rel="icon" type="image/x-icon" href="images/jeansv.jpeg">

   <!-- font awesome cdn link  -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Teko:wght@700&display=swap" rel="stylesheet">  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link href="http://fonts.cdnfonts.com/css/amiable-forsythia-free-2" rel="stylesheet">
   <link href='https://fonts.googleapis.com/css?family=Italiana' rel='stylesheet'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- slick slider CSS library files -->
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">

<!-- slick slider JS library file -->
   <style>

      .carousel {
width: 100%;
height: 540px;
border-radius: 3px;
overflow: hidden;
position: relative;
box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
}

.carousel:hover .controls {
opacity: 1;
}

.carousel .controls {
opacity: 0;
display: flex;
position: absolute;
top: 50%;
left: 0;
justify-content: space-between;
width: 100%;
z-index: 99999;
transition: all ease 0.5s;
}

.carousel .controls .control {
margin: 0 5px;
display: flex;
align-items: center;
justify-content: center;
height: 40px;
width: 40px;
border-radius: 50%;
background-color: rgba(255, 255, 255, 0.7);
opacity: 0.5;
transition: ease 0.3s;
cursor: pointer;
}

.carousel .controls .control:hover {
opacity: 1;
}

.carousel .slides {
position: absolute;
top: 50%;
left: 0;
transform: translateY(-50%);
display: flex;
width: 100%;
transition: 1s ease-in-out all;
}

.carousel .slides .slide {
min-width: 100%;
min-height: 250px;
height: auto;
}
   #p1{
	   width:60%;
	   float:left;
	   margin:0 auto;
   }
   #p2{
	   width:40%;
	   float:right;  
   }
   </style>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/styles.css">
   <link rel="stylesheet" href="./css/components1.css">


</head>
<body>
   
<?php include 'header.php'; ?>
<!-- <div class="home-bg1">
<section class="home">
   <div class="swiper home-slider"> 
   <div class="swiper-wrapper">
      <div class="swiper-slide slide">
	    <div id="p1">  
        
            <img style=' width:fit-content ' src="images/homebg.jpeg" alt="">
    
		</div>
		<div id="p2">
         <div class="content">
           
         </div> 
		</div>	
      </div>
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/homeimg2.jpeg" alt="">
         </div>
        
      </div>
   </div>
      <div class="swiper-pagination"></div>
   </div>

</section>

</div> -->


































<!-- scrool categorie















<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/homes.png" alt="">
			<span class="raf">Welcome a beadedart </span>
         </div>
         <div class="content">
            <span class="raf">Welcome a beadedart </span>
            <h3 class="rafed">Your favourite shop </h3>
            <a href="shop.php" class="btn">Achetez maintenant</a><br><br><br><br><br>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/a.jpeg" alt="">
         </div>
         <div class="content">
            <span></span>
            <h3 class="rafed">Handmade jewellery </h3>
            <a href="shop.php" class="btn">Achetez maintenant</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/car.png" alt="">
         </div>
         <div class="content">
            <span>8DT</span>
            <h3 class="rafed">livraison à domicile </h3>
           
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>




 -->


<!-- scrool categorie



<div class="home-category">
<section class="home">
    <div class="swiper home-slider">
     <div class="swiper-wrapper">
	
        <div class="swiper-slide slide">
		
		
			<div class="box-container">
		
						<div class="box">
						<img src="project images/nike-sb-dunk-low-chicago-red-low-j.jpg" alt="">
						<h3>Bracelet</h3>
						<p>tout les Bracelets ici.</p>
						<a href="category.php?category=Bracelet" class="btn" >Bracelet 😍</a>
						</div>
			  
			</div>

		</div>
        <div class="swiper-slide slide">
		
		
			<div class="box-container">
		
						<div class="box">
						<img src="images/adidas-Yeezy-Boost-350-v2-BY9612-Core-Red-2.webp" alt="">
						<h3>necklace </h3>
						<p>TOUT<br> LES necklaces ici</p>
						 <a href="category.php?category=necklace" class="btn">necklace 🦋</a>
						</div>
			  
			</div>

		</div>
		 <div class="swiper-slide slide">
			<div class="box-container">
				<div class="box">
				<img src="images/Original_Adidas_logo.svg.png" alt="">
				<h3>Charm Phone 💖</h3>
				<p>TOUT LES Charms Phone 💖 ICI.</p>
				<a href="category.php?category=Charm_Phone" class="btn">Charm Phone 💖</a>
			</div>  
			</div>
		</div>
		 <div class="swiper-slide slide">
			<div class="box-container">
      <div class="box">
         <img src="images/ring.png" alt="">
         <h3>rings</h3>
         <p>tout les rings ici.</p>
         <a href="category.php?category=rings" class="btn">rings !</a>
      </div>
			</div>
		</div>
	 </div>
	
	<div class="swiper-pagination"></div><br><br><br><br><br>



	</div>
</section>

</div>
-->

<div class="carousel">
  <div class="slides">
    <img src="images/homebg.jpeg" alt="slide image" class="slide">
    <img src="images/homeimg2.jpeg" alt="slide image" class="slide">
  </div>
  <div class="controls">
    <div class="control prev-slide">&#9668;</div>
    <div class="control next-slide">&#9658;</div>
  </div>
</div>
<section class="home-category">

   <br><br><h1 class="title">Our New Products</h1>
   
   
   
   

   <div class="box-container">

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts s</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>

      <div class="box">
      <a href="category.php?category=TD1">
         <img src="images/tshirt.jpg" alt="">
         <h3>T-Shirts</h3>
         <p>les T-shirts</p>
         </a>
      </div>
	  
	  
	  
	  
	  
	  
	  
	  

</div>


</section>




<br><br><div class="home-category">
</div>

<section class="icons-container">

    <div class="icons">
        <img src="images/icon-1.png" alt="">
        <div class="info">
            <h3>Free Shipping</h3>
            <span>All over Tunisia</span>
        </div>
    </div>

    <div class="icons">
        <img src="images/icon-2.png" alt="">
        <div class="info">
            <h3>Guarantee of exchange</h3>
            <span>  Limited date : 15 Days </span>
        </div>
    </div>

    <div class="icons">
        <img src="images/icon-3.png" alt="">
        <div class="info">
            <h3> Products </h3>
            <span> Special & Unique </span>
        </div>
    </div>

    <div class="icons">
        <img src="images/icon-4.png" alt="">
        <div class="info">
            <h3>Paiement's Security </h3>
            <span> Hand to hand paiement </span>
        </div>
    </div>
   
</section>





<!-- icons section ends -->


<!-- <section class="home-contact">

   <div class="content">
      <br><br><h3>AVEZ VOUS DES QUESTIONS ET DES RECLAMATION ?</h3>
      <p>si vous avez des questions ,des reclamation, veuillez les déposer dans la section contact.</p>
      <a href="contact.php" class="btn">Contactez-nous</a><br><br>
   </div>

</section> -->










<!-- custom css file link  




<section class="products">

   <h1 class="title">DERNIERS PRODUITS</h1>

   <div class="box-container">

   <?php
     // $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
     // $select_products->execute();
      //if($select_products->rowCount() > 0){
        // while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST" class="swiper-slide slide">
      <div class="price">TND : <span><//?= $fetch_products['price']; ?></span></div>
      <a href="view_page.php?pid=<//?= //$fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?//= //$fetch_products['image']; ?>" alt="">
      <div class="name"><?//=$fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<//?//= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?//= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?//= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?//= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="ajouter à la liste de souhaits" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="Ajouter au panier" class="btn" name="add_to_cart">
   </form>
   <?php
      //}
   //}else{
     // echo '<p class="empty">no products added yet!</p>';
   //}
   ?>

   </div>

</section>
-->






<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>



<script>
const delay = 7000; //ms

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});


const slides = document.querySelector(".slides");
const slidesCount = slides.childElementCount;
const maxLeft = (slidesCount - 1) * 100 * -1;

let current = 0;

function changeSlide(next = true) {
  if (next) {
    current += current > maxLeft ? -100 : current * -1;
  } else {
    current = current < 0 ? current + 100 : maxLeft;
  }

  slides.style.left = current + "%";
}

let autoChange = setInterval(changeSlide, delay);
const restart = function() {
  clearInterval(autoChange);
  autoChange = setInterval(changeSlide, delay);
};

// Controls
document.querySelector(".next-slide").addEventListener("click", function() {
  changeSlide();
  restart();
});

document.querySelector(".prev-slide").addEventListener("click", function() {
  changeSlide(false);
  restart();
});


</script>

</body>
</html>