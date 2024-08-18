<?php 
session_start();
require './assets/includes/header.php';
require './assets/includes/navbar.php';
require '../database/connectdb.php';
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(insert("INSERT INTO users(username, email,password) values(?,?,?)",array($username, $email,$password))){
        $_SESSION['message'] = "Thêm khách hàng thành công";
        $_SESSION['type-message'] = "success";
        header('location: customers');
    }
    else{
        $_SESSION['message'] = "Thêm khách hàng thất bại";
        $_SESSION['type-message'] = "fail";
        header('location: customers');
    }
}
?> 
    <div class="container-fluid">
        <div class="row">
        <?php require './assets/includes/sidebar.php' ?>
            <div class="col-md-3 col-lg-2"></div>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <?php require './assets/includes/breadcumbs.php' ?>
                <h1 class="h2">Thêm khách hàng</h1>
                <form action="./add-customers.php" method="post">
                <div class="row">
                    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Thêm khách hàng</h5>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group mb-3">
                                              <label for="username">Username:</label>
                                              <input type="text" class="form-control" id="username" name="username" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group mb-3">
                                                <label for="email">Email:</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group mb-3">
                                              <label for="password">Mật khẩu:</label>
                                              <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <button class="btn btn-danger" type="button" id="btn-cancel">Huỷ</button>
                                        <button class="btn btn-success" type="submit">Thêm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </main>
        </div>
        
    </div>
    
    <?php require './assets/includes/footer.php' ?> 

    <script>
        $(document).ready(function(){
            $('#btn-cancel').click(function(){
                history.go(-1);
            })
        })
    </script>
</body>
</html>