
<?php 

require '../header.php';
ob_start();
 require '../config.php' ;
 if(isset($_GET['id'])){
    $id = $_GET['id'];
    

 $select = "SELECT * FROM worker WHERE workerId = '$id' ";
 $select = $conn->query($select);
 $select->execute();
 $worker = $select->fetch(PDO::FETCH_OBJ);
 $_SESSION['worker_id'] = $worker->workerId;
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="row p-5">
      <?php  if(isset($_GET['error'])):?>
        <div dir="rtl" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong > <?php  echo $_GET['error'] ;?> </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php endif ; ?>
        <div class="col-4"></div>
        <div class="col-4">
<div class="card" style="width: 18rem;">
  <img src="../img/<?php  echo $worker->img ;?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Profile </h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"></li>
    <li class="list-group-item"><?php  echo $worker->fullname ;?></li>
    <li class="list-group-item"><?php  echo $worker->email ;?></li>
    <li class="list-group-item"><?php  echo $worker->age ;?></li>
    <li class="list-group-item"><?php  echo $worker->location ;?></li>
    <li class="list-group-item"><?php  echo $worker->Phone ;?></li>
    <li class="list-group-item"><?php  echo $worker->servicetype ;?></li>
    <li class="list-group-item"><?php  echo $worker->rating ;?></li>
    <li class="list-group-item"> status : <?php  echo $worker->status ;?></li>


  </ul>
  <div class="card-body">
    
    <a href="UpdateProfile.php?id=<?php echo $worker->id;?>&status=<?php echo $worker->status; ?>" class="card-link btn btn-primary">update info</a>
  </div>
</div>
</div>
</div>
</body>
</html>