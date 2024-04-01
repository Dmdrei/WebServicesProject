
<?php 
        
        require '../header.php';
        ob_start();
        require '../config.php';
        ?>

        <?php
            if(isset($_GET['id'])){
            $id = $_GET['id'];
              
             $select = $conn->query("SELECT * FROM worker WHERE id = '$id'");
            $select->execute();
            $worker = $select->fetch(PDO::FETCH_OBJ);
            }
            else{
                header('location:Profile.php?id='.$_SESSION['worker_id'].'&error=غير مصرح لك بتعديل المعلومات');
                exit();
            }
            // script to update info inside the table
            if(isset($_POST['submit'])){
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];
                $img = $_FILES['img']['name'];
                $Phone = $_POST['phone'];
                //upload image name into the file
                $fileTmpName = $_FILES['img']['tmp_name'];
                $fileDestination = '../img/'.$img;
                $Update =$conn->prepare("UPDATE worker SET fullname = :fullname ,email = :email , Phone = :Phone , img = :img  WHERE id ='$id'");
                if(!empty($img) OR !empty($cv)){
                    unlink("../img/".$worker->img."");
                    $Update->execute([
                    ":fullname" =>$fullname  ,
                    ":email" =>$email  ,
                    ":Phone" =>$Phone  ,
                    ":img" =>$img  ,
                    ]);
                }else{
                    $Update->execute([
                        ":fullname" =>$fullname  ,
                        ":email" =>$email  ,
                        ":Phone" =>$Phone  ,
                        ":img" =>$img  ,
                        ]);
                }
                move_uploaded_file($fileTmpName,$fileDestination);
                    header('location:Profile.php?id='.$_SESSION['worker_id'].'');
                

        
            }
            ob_end_flush();
        ?>
<div class="row p-5" >
    <div class="col-4"></div>
    <div class="col-5">
<form class="row g-3" action="UpdateProfile.php?id=<?php echo $worker->id ;?>" method="post" dir="rtl" enctype="multipart/form-data">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label"> الالكتروني</label>
    <input type="email" name="email" class="form-control" id="inputEmail4"  placeholder="<?php  echo $worker->email ;?>"  value="<?php echo $worker->email ;?> " >
    <p class="text-secondary small"> * بريد الكتروني فعال ليتم التواصل معك من خلاله  </p>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label"> الاسم الثلااثي</label>
    <input type="text"  name="fullname" class="form-control" id="inputEmail4" placeholder="<?php echo  $worker->fullname ; ?>"  value="<?php echo $worker->fullname ; ?>">
  </div>
  <div class="col-md-12">
  <label for="formFile" class="form-label">صورة شخصية </label>
  <input class="form-control" name="img" type="file" id="formFile" value="<?php $worker->img ; ?>">
</div>
<div class="col-md-12">
    <label for="inputCity" class="form-label">رقم الهاتف</label>
    <input type="number" name="phone" class="form-control" id="inputCity"  placeholder="<?php echo  $worker->Phone ; ?>"  value="<?php echo $worker->Phone ; ?>">
  </div>
  <div class="col-12">
    <button type="submit" name="submit" class="btn btn-primary">تعديل </button>
  </div>
</form>


</div>
</div>