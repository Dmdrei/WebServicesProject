<?php ob_start(); ?>
<?php  require "header.php " ; ?>

<?php require "config.php" ;?>

<?php 
if(isset($_SESSION['user_name'])){
header('location:homepage.php');
}
    if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
    header("location:login.php?error=يجب عليك ادخال البريد الالكتروني");
    exit();
    }else if(empty($_POST['passw'])){
    header("location:login.php?error=يجب عليك ادخال كلمة السر");
    exit();
    }else {
        //set the data into a variables
        $email = $_POST['email'];
        $password = $_POST['passw'];
         // query to select the data from db
         $result = $conn->query("SELECT * FROM user Where email ='$email' "); 
         // $result = $conn->query("SELECT * FROM uers Where Uemail ='$email' ");  
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if( $result->rowCount()>0){
            // $password == $row['password1'] password_verify($password,$row['Upassword'])
        echo  password_verify($password,$row['password1']);
            //if(password_verify($password,$row['Upassword'])){
            $_SESSION['user_name']= $row['username'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['usertype'];
            $_SESSION['user_email'] = $row['email'];
            //$_SESSION['user_img'] =$row['Uimg'];
            //$_SESSION['user_cv'] =$row['Ucv'];
            header("location:homepage.php");
            ////} else{ 
           // header("location:login.php?error=كلمة السر غير صحيحة");
            //exit();
            //}    
        }else{
            header('location:login.php?error=بريدك الالكتروني غير صحيح');
                }

    }
}

ob_end_flush();
?>
<div class="container position-relative wow fadeInUp p-5" data-wow-delay="0.1s">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-light text-center p-5">
                        <h1 class="mb-4">  سجل الدخول لحسابك</h1>
                        <h5>ليس لديك حساب على خدماتي <a href="register.php">  انشأ حساب</a></h5>
                        <form action="login.php" method="post">
                            <div class="row g-3">
                                <?php if(isset($_GET['error'])){ ?>
                                    <p class="alert alert-danger text-end "> <?php echo $_GET['error'] ; }?> </p>
                                <div>
                                    <input type="email" name="email" class="form-control border-0 text-end" placeholder="يريدك الاكتروني" style="height: 55px;">
                                </div>
                                <div>
                                    <input type="password" name="passw" class="form-control border-0 text-end" placeholder=" كلمة السر" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3 " name="submit" type="submit"> سجل الدخول</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    