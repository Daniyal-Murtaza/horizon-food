<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';

}
$insert_order = $conn->prepare("INSERT INTO `orders` (user_id, placed_on, time, name, email, number, address, total_products, total_price, method, payment_status) VALUES (?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?)");
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

// Pagination logic
$per_page = 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $per_page;

// Fetch orders for the current page
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
$search_condition = $search_query ? "WHERE CONCAT(user_id, placed_on, name, email, number, address, total_products, total_price, method, payment_status, time) LIKE '%$search_query%'" : '';
$select_orders = $conn->prepare("SELECT * FROM `orders` $search_condition LIMIT $start, $per_page");
$select_orders->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Placed Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-lA5WV9oNXi2b+L5I6X6Gr5U90vDwTpkbOeZp3YFkH4Z2ggfR8mvmltjZlCB/JOs0" crossorigin="anonymous">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Placed Orders</h1>

   <div style="display: grid; place-items: center;">
  <form action="" method="GET" style="margin-bottom: 20px;">
    <div class="input-group rounded">
      <input type="text" style="padding: 10px; border: .2rem solid #34495e; border-radius: .5rem" class="form-control rounded" name="search_query" placeholder="Search " aria-label="Search" aria-describedby="search-addon">
      <button class="input-group-text border-5" style="padding:10px" type="submit" id="search-addon">
        <i class="fas fa-search fa-lg"></i>
      </button>
    </div>
  </form>
</div>

   <div class="box-container">

   <?php
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" style="margin-bottom: 10px">
      <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> placed time : <span><?= $fetch_orders['time']; ?></span> </p> <!-- New field for placed time -->
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> total products :</p>
        <ul>
            <?php
            // Splitting total_products string into an array of products
            $products = explode(" - ", $fetch_orders['total_products']);
            foreach ($products as $product) {
                echo "<p> <span>$product</span></p>";
            }
            ?>
        </ul>
      <p> total price : <span>Rs.<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> Table Number : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="drop-down">
            <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="pending">pending</option>
            <option value="completed">completed</option>
         </select>
         <div class="flex-btn">
            <input type="submit" value="update" class="btn" name="update_payment">
            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
         </div>
      </form>
   </div>
   <?php
      }
   } else {
      echo '<p class="empty">No orders placed yet!</p>';
   }
   ?>

   </div>

   
   <?php
   $total_orders = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
   $pages = ceil($total_orders / $per_page);

   // Only display pagination if there are multiple pages
   if ($total_orders > $per_page) {
      echo '<nav aria-label="Page navigation">';
      echo '<div class="row justify-content-center">'; // Center alignment

      echo '<div class="pagination" style="text-align: center">'; // Centered pagination

      // Previous button (disabled if on first page)
      if ($page > 1) {
         echo '<span class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '"><i class="fas fa-chevron-left fa-2x"></i></a></span>';
      } else {
         echo '<span class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-left fa-2x"></i></span></span>';
      }

      // Current page number
      echo '<span class="page-item active"><span class="page-link" style="font-size: 16px; font-weight: bold; color: #4834d4">' . $page . '</span></span>';


      // Next button (disabled if on last page)
      if ($page < $pages) {
         echo '<span class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '"><i class="fas fa-chevron-right fa-2x"></i></a></span>';
      } else {
         echo '<span class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-right fa-2x"></i></span></span>';
      }

      echo '</div>';
      echo '</div>';
      echo '</nav>';
   }
   ?>

</section>

<!-- placed orders section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
