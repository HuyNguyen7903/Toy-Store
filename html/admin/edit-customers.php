<?php 
session_start();
require './assets/includes/header.php';
require './assets/includes/navbar.php';
require '../database/connectdb.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user = getById('users',$id);
}
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $status =  isset($_POST['status']) ? 1 : 0;
    if(updateById("UPDATE users SET username=?, email=?, status=? WHERE id=?",array($username, $email,$status,$id))){
        $_SESSION['message'] = "Sửa khách hàng thành công";
        $_SESSION['type-message'] = "success";
        header('location: customers');
    }
    else{
        $_SESSION['message'] = "Sửa khách hàng thất bại";
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
                <h1 class="h2">Sửa khách hàng</h1>
                <form action="./edit-customers.php" method="post">
                <div class="row">
                    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Sửa khách hàng</h5>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group mb-3">
                                              <label for="username">Username:</label>
                                              <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                              <input type="text" class="form-control" value="<?= $user['username'] ?>" id="username" name="username" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group mb-3">
                                                <label for="email">Email:</label>
                                                <input type="email" class="form-control" value="<?= $user['email'] ?>" id="email" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="status">Hoạt động</label>
                                                <input class="form-check-input"  <?php if($user['status'] == 1) echo 'checked'; ?> type="checkbox" role="switch" id="status" name="status">
                                            </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <button class="btn btn-danger" type="button" id="btn-cancel">Huỷ</button>
                                        <button class="btn btn-success" type="submit">Sửa</button>
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