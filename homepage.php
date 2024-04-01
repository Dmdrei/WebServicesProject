<?php  require 'header.php'; ?>

<?php 
echo "hello  ".$_SESSION['user_name'];

?>

<?php if(isset($_GET['message'])): ?>
  <div dir="rtl" class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong > <?php  echo $_GET['message'] ;?> </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif ;?>
