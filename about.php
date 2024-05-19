<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> <span> / about</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>At Grito, we are committed to providing hygienic drinks and food that prioritize your well-being. Our dedication extends beyond taste, ensuring a wholesome experience that aligns with the highest standards of cleanliness and quality. Trust us for a refreshing and nourishing journey at Grito!</p>
         <a href="menu.php" class="btn">our menu</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order</h3>
         <p>Please Select the food items you want to add on your cart to order them.</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>fast delivery</h3>
         <p>Our Robot will deliver your order at your table with super reliability and fast delivery.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy food</h3>
         <p>Enjoy your Food with the amazing view of Horizon.</p>
      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="title">customer's reivews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/pic-1.png" alt="">
            <p>Absolutely delicious! The flavors at Horizonfood are unmatched. The presentation of the dishes is top-notch, and every bite is a burst of culinary perfection. Highly recommended!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Syed Hussain</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-2.png" alt="">
            <p>Horizonfood never disappoints! The quality of ingredients is evident in every dish. From appetizers to desserts, the menu offers a diverse range of options, and each one is a delightful journey for the taste buds.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Fatima Ali</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-3.png" alt="">
            <p>The staff is friendly and attentive, and the food is a true gastronomic delight. The blend of textures and flavors in each dish showcases the chef's expertise. It is a must go place for drinks.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Ahmed Khan</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-4.png" alt="">
            <p>The menu boasts a creative fusion of flavors that truly elevates the dining experience. The attention to detail is impressive, and the ambiance adds a touch of sophistication to the overall meal.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Rabia batool</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-5.png" alt="">
            <p>The chefs here clearly have a passion for creating memorable culinary experiences. A must-try for food enthusiasts! Truly, a culinary gem with a great experience in hands.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Daniyal khan</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-6.png" alt="">
            <p>The menu offers a delightful mix of traditional and innovative dishes. The portions are generous, and the prices are reasonable for the quality of food you receive. </p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>li han</h3>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>