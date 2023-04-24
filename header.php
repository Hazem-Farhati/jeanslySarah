<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">


   <style>
   @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Zeyada&display=swap');
   .dropdown a{
   margin:0 1rem;
   font-size: 2rem;
}
.home-bg .home {
  display: none;
  align-items: center;
  height: 100%;
}
.navbar{
   font-size: 15px;
   margin-bottom:0px;
margin: 0 0px;
display:flex;
}
.header .flex{
   display: flex;
   align-items: center;
   justify-content: start;
   padding:0rem;
   margin: 0 !important ;
   gap:40px;
   /* max-width: 1200px; */
   /* height: 200px; */
   position: relative;
   /* background-color: red; */
font-family: 'Bebas Neue', cursive;

}
.all-header{
   /* background-color: blue; */
   height: 100px;
   padding: 10px;
   display: flex;
   gap:20px
}
.header{
   /* background-color: red; */
width: 100%;
display: flex !important;
   justify-content: center;
left:0;
}
.dropbtn {
    background-color: transparent;
    color: white;
    padding: 16px 0;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    width:max-content;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    height: max-content;
    overflow: scroll;
}

.dropdown-content a {
    color: black;
    padding: 5px 16px;
    text-decoration: none;
    display: block;
    font-size: 20px !important;

}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #f1f1f1;
  text-decoration:none;  

}
.dropdown.dropbtn a {
  text-decoration:none;  
}
.dropbtn:hover{
   background-color:  #f1f1f1;
}
   .header .flex .navbar a{
   /* font-family: 'Dancing Script', cursive; */
font-size:20px;
padding: 10px !important;
   }
.logo-nvb{
  /* font-family: 'Dancing Script', cursive; */
  animation: spin 4s linear infinite;
  transform-style: preserve-3d;
  perspective: 1000px;
  padding-right: 60px;
  color : #000;
  font-weight:500;
}

@keyframes spin {
  0% {
    transform: rotateX(360deg) rotateY(0deg);
  }
  100% {
    transform: rotateX(360deg) rotateY(360deg);
  }
}


@media only screen and (max-width: 779px) {
 .header .flex {
   
    height: 67px;
 
}
}


@media only screen and (max-width: 1168px) {
  
 .header .flex {

    height: 70px;
}
.header .flex .navbar a {
    font-size: .5rem !important;
    width: max-content;
    font-weight: 700;
}
}

@media only screen and (max-width: 1137px) {
  

.header .flex .navbar a {
    font-size: 5px !important;
    font-weight: 700;
}
}
@media only screen and (max-width: 868px) {
   .navbar{
      margin:40px 0px
   }
 .header .flex {

    height: 70px;
}
.header .flex .navbar a {
    font-size: 1rem !important;
    font-weight: 700;
}
}

.form.example button {
   position: absolute;
   width: 0% !important;
     float: left;
  padding: 10px;
  background-color: red;
  color: white;
  font-size: 12px;
  cursor: pointer;
  right: 30px;
}
.form.example button:hover {
  background:red  ;
}
/* //search box  */
.search-form form{
   position: relative;
   justify-content: space-between;

}
.search-form form .box {
    width: 62% !important;
    padding-left: 3rem !important;
    border: var(--border);
    margin: 1rem 0;
    background-color: var(--white);
    box-shadow: var(--box-shadow);
    font-size: 2rem;
    color: var(--black);
    border-radius: 1.5rem;
}
.search-form form .box::placeholder{
   color: gray;
   font-weight:400;
   opacity: 0.5;
   font-size:18px;
   padding-left:10px
}
.search-form form .box:focus{
  outline: none;
  border-color: #FFDFC7;
  box-shadow: 0 0 2px #FFDFC7;
}
.search-form form .box:focus::placeholder {
  color: transparent;
}

</style>
</head>
   <link rel="stylesheet" href="./css/styles.css">

   <link rel="stylesheet" href="./css/components1.css">

<body>
   <div class="all-header">
<header class="header">

   <div class="flex">
   <div class="icons">
   <div id="menu-btn" class="fas fa-bars"></div>
   </div>
   <div class="flex">
      <a  style="text-decoration: none;"  href="index.php">

<h3  class="logo-nvb">JEANS'LY</h3>    
  </a>
	  </div>
	  


      <nav class="navbar">
         <button class="dropbtn">
                     <a style="text-decoration: none; " href="index.php">Home</a>
         </button>


       <div class="dropdown">
  <button class="dropbtn">
		 <a style="text-decoration: none;" >Women </a>

  </button>
  <div class="dropdown-content">
      <a style="text-decoration: none;" href="category.php?category=CHEMISES">Mom Jeans </a>
   <a style="text-decoration: none;" href="category.php?category=TOPS">Boyfriend Jeans </a>
   <a style="text-decoration: none;" href="category.php?category=GILETS">Cargo Jeans </a>
   <a style="text-decoration: none;" href="category.php?category=BLOUSES">Ripped Jeans </a>



  </div>
</div>

  
         <div class="dropdown">
  <button class="dropbtn">
         <a style="text-decoration: none;" >Men</a>

  </button>
  <div class="dropdown-content">
      <a  style="text-decoration: none;" href="category.php?category=PULLS1">Daddy Jeans</a>
   <a style="text-decoration: none;" href="category.php?category=M&V1">Boyfriend Jeans</a>
   <a style="text-decoration: none;" href="category.php?category=GILETS1">Cargo Jeans</a>
   <a style="text-decoration: none;" href="category.php?category=POLOS1">Ripped Jeans</a>


  </div>
</div>
      </nav>
		<section class="search-form">

	<form action="search_page.php" method="POST" class="example">
      <input type="text" class="box" name="search_box" placeholder="Search">
	  <button style='width:4%;position:absolute;left:8px ' type="submit" name="search_btn" ><i class="fa fa-search"></i></button>
               <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>

         <a href="wishlist.php"><i class="fa-solid fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
         <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
  


   </form>

</section>
      <div class="icons">
	  
         
         <div id="user-btn" class="fa-solid fa-address-card"></div>

         		

		 



 

         
      </div>
	  

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

         

		<?php 
         session_start();
         if(empty($_SESSION['user_id'])){
        ?>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">connexion</a>
            <a href="register.php" class="option-btn">S'inscrire</a>
         </div>
         <?php }
          else { ?>
          <a href="user_profile_update.php" class="btn">⚙️ Parametre</a>
          <a href="orders.php" class="btn">📦Mes commandes</a>
          <a href="logout.php" class="delete-btn">🚪 Se déconnecter</a>
          
          <?php } ?>
      </div>
      

   </div>

</header>
</div>
</body>
</html>