    <?php 
    
        require '../header.php';
        require '../config.php';
    ?>
    <?php 
    //select info of worker from worker table
    $select = $conn->query("SELECT * FROM user WHERE id = 8");
    $select->execute();
    $worker = $select->fetch(PDO::FETCH_OBJ);

    //script for inserting the data into worker table
    if(isset($_POST['submit'])){
        //check if inputs are empty or not
            if(empty($_POST['age'])){
                header("location:workerRequest.php?age=الرجاء ادخال عمرك * ");
            }else{
                if(empty($_POST['phone'])){
                    header("location:workerRequest.php?phone=الرجاء ادخال رقم الهاتف * ");
                }else{
                    //create var to store the input data 
                    $workerId = $_SESSION['user_id'];
                    $name = $_SESSION['user_name']; 
                    $fullname = $_POST['fullname'];
                    $name = $_POST['email'];
                    $email = $_POST['email'];
                    $location = $_POST['location'] ;
                    $age = $_POST['age'];
                    $experience = $_POST['experience'];
                    $servicetype = $_POST['servertype'];
                    $Phone = $_POST['phone'];

                    //upload image name into the file
                    $img = $_FILES['img']['name'];
                    $fileTmpName = $_FILES['img']['tmp_name'];
                    $fileDestination = 'img/'.$img;
                    move_uploaded_file($fileTmpName , $fileDestination);

                    // query to insert data into worker table
                    $insert = $conn->prepare("INSERT INTO worker ( workerId ,name,fullname, email, Phone, age, img, servicetype, experience, location) VALUES(
                     :workerId,:name, :fullname,:email, :Phone, :age ,:img, :experience, :servicetype, :location)");
                    $insert->execute([
                        ':workerId'=>$workerId,
                        ':name' => $name,
                        ':fullname'=>$fullname ,
                        ':email' => $email,
                        ':Phone' => $Phone,
                        ':age' => $age,
                        ':img' => $img,
                        ':experience' => $experience,
                        ':servicetype' => $servicetype,
                        ':location' => $location,
                ]);
                header('location:homepage.php?message=تم ارسال طلبك الى المسؤول .ويستم الرد لاحقا ');

        }
    }

            
        
        }

    ?>


<div class="row p-5" >
    <div class="col-4"></div>
    <div class="col-5">
<form class="row g-3" action="workerRequest.php" method="post" dir="rtl" enctype="multipart/form-data">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label"> الالكتروني</label>
    <input type="email" name="email" class="form-control" id="inputEmail4"  placeholder="name@gmail.com">
    <p class="text-secondary small"> * بريد الكتروني فعال ليتم التواصل معك من خلاله  </p>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label"> الاسم الثلااثي</label>
    <input type="text"  name="fullname" class="form-control" id="inputEmail4" placeholder="">
  </div>
   
  <div class="col-12">
  <label for="inputState" class="form-label">الموقع</label>
    <select id="inputState"  name="location" class="form-select">
      <option selected>المفرق</option>
      <option>الزرقاء</option>
      <option>عمان</option>
    </select>
</div>
  <div class="col-md-5">
    <label for="inputCity" class="form-label">العمر</label>
    <input type="number" name="age" class="form-control" id="inputCity">
    <?php if(isset($_GET['age'])): ?>
    <p class="text-danger"><?php echo $_GET['age'] ;?></p>
    <?php endif ; ?>
  </div>
   
  <div class="col-md-5">
  <label for="formFile" class="form-label">صورة شخصية </label>
  <input class="form-control" name="img" type="file" id="formFile">
</div>
<div class="col-md-12">
    <label for="inputCity" class="form-label">رقم الهاتف</label>
    <input type="number" name="phone" class="form-control" id="inputCity">
    <?php if(isset($_GET['phone'])): ?>
    <p class="text-danger"><?php echo $_GET['phone'] ;?></p>
    <?php endif ; ?>
  </div>
<div class="col-12">
  <label for="inputState" class="form-label">الخبرة</label>
    <select id="inputState"  name="experience" class="form-select">
      <option selected>1-3 سنوات</option>
      <option>3-5 سنوات</option>
      <option>5سنين واكثر</option>
    </select>
</div>
<div class="col-12">
  <label for="inputState" class="form-label">نوع الخدمة </label>
    <select id="inputState"  name="servertype" class="form-select">
      <option selected>صيانة كهربائية</option>
      <option>صيانة سباكة</option>
      <option>صيانة اجهزة كهربائية</option>
      <option>صيانة نجارة</option>
    </select>
</div>
  <div class="col-12">
    <button type="submit" name="submit" class="btn btn-primary">ارسال </button>
  </div>
</form>


</div>
</div>