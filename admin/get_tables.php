<?php

include '../components/connect.php';

session_start();

// $admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'Order status updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>
<?php
  $select_orders = $conn->prepare("SELECT * FROM `orders`");
  $select_orders->execute();
  if($select_orders->rowCount() > 0){
     while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?>
<?= $fetch_orders['method']; ?> 
<?php
  }
}else{
  echo '<p class="empty">no orders placed yet!</p>';
}
?>
