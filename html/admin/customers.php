<?php 
session_start();
require './assets/includes/header.php';
require './assets/includes/navbar.php';
require './assets/includes/toastMessage.php';
require '../database/connectdb.php';
require '../utils/utils.php';
// Get số trang 
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = (int)$_GET['page'];
}
//Xử lí xoá khách hàng
if(isset($_GET['id'])){
$id = (int)$_GET['id'];
if(deleteById('users',$id)){
  $_SESSION['message'] = "Xoá khách hàng thành công";
  $_SESSION['type-message'] = "success";
  header('location: customers');
}else{
  $_SESSION['message'] = "Xoá khách hàng thất bại";
  $_SESSION['type-message'] = "fail";
  header('location: customers');
}
}

$results_per_page = 6;
$total_pages = getTotalPage('users',$results_per_page);
$users = getItemsPagination('users',$page, $results_per_page);
// Xử lí tìm kiếm khách hàng
if(isset($_POST['name'])){
$name = $_POST['name'];
$total_pages = getSearchByUserNameTotalPage('users',$name, $results_per_page=10);
$users = getSearchByUserNameItemsPagination('users',$name, $page, $results_per_page=10);
}
?> 
    <div class="container-fluid">
        <div class="row">
          <?php require './assets/includes/sidebar.php' ?>
            <div class="col-md-3 col-lg-2"></div>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
            <?php require './assets/includes/breadcumbs.php' ?>
                <h1 class="h2">Khách hàng</h1>
                <div class="row">
                    <div class="col-12 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Khách hàng</h5>
                            <div class="my-3 mx-2 row">
                            <div class="col-lg-8 col-12">
                                  <a href="./add-customers.php">
                                    <button class="btn btn-success"><i class="bi bi-plus-lg">
                                    </i> Thêm khách hàng</button>
                                  </a>
                              </div>
                                <div class="col-lg-4 col-12">
                                  <form action="customers" class="d-flex" method="post">
                                    <label for="search" class="col-form-label w-25">Tìm kiếm: </label>
                                    <div class="input-group mb-3">
                                      <input type="text" class="form-control" placeholder="Tìm username" name="name">
                                      <button class="btn btn-success" type="submit">Tìm kiếm</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col"></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                            foreach($users as $user){
                                              $status = $user['status'] == 1? 'Hoạt động' : 'Tạm dừng';
                                              $status_css = $user['status'] == 1? 'bg-success' : 'bg-danger';
                                              echo ' <tr>
                                            <th scope="row">'.$user['id'].'</th>
                                            <td>'.$user['username'].'</td>
                                            <td><span class="badge badge-pill '.$status_css.'">'.$status.'</span></td>
                                            <td><a href="edit-customers?id='.$user['id'].'" class="btn btn-sm btn-primary d-inline-block"><i class="bi bi-pencil-square"></i> Sửa</a>
                                                <button type="button" class="btn btn-sm btn-danger d-inline-block" data-bs-toggle="modal" data-bs-target="#modal" onclick="confirmDelete('.$user['id'].')"><i class="bi bi-trash"></i> Xoá</button>
                                            </tr>
                                          ';
                                            }
                                          ?>
                                         
                                        </tbody>
                                      </table>
                                </div>
                                <ul class="pagination justify-content-end">
                                      <li class="page-item <?php if($page == 1) echo "disabled" ?>">
                                        <a class="page-link" href="categories?page=<?php echo $page - 1 ?>">Trước</a>
                                      </li>
                                      <?php
                                        $paginations = pagination($page, $total_pages);
                                
                                        foreach($paginations as $p){
                                          $isActive = $page == $p ? "active" : ""; //active class
                                          $isDisabled = $p == '...' ? "disabled" : ""; //disabled class
                                          echo '<li class="page-item '. $isActive .' '.  $isDisabled .'"><a class="page-link" href="categories?page='. $p .'">'. $p .'</a></li>';
                                        }
                                        
                                      ?>         
                                      <li class="page-item <?php if($page == $total_pages) echo "disabled" ?>">
                                        <a class="page-link" href="categories?page=<?php echo $page + 1 ?>">Sau</a>
                                      </li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal"
      tabindex="-1"
      aria-labelledby="modalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalLabel">XOÁ DANH MỤC</h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div
            class="modal-body w-100 d-flex justify-content-center align-items-center flex-column"
          >
            <h3>Bạn có chắc muốn xoá không?</h3>
          </div>
          <div class="modal-footer w-100 d-flex justify-content-center">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Huỷ
            </button>
            <button
              type="button"
              class="btn btn-danger"
              id="btn-delete"
              data-bs-dismiss="modal"
            >
              Xoá
            </button>
          </div>
        </div>
      </div>
    </div>
    <?php require './assets/includes/footer.php' ?> 
    <script>
       function confirmDelete(id){
        $('#btn-delete').on('click', function(){
            location.href = `customers?id=${id}`
        })
      }
      $(document).ready(function(){
        const toast = document.querySelector('.toast');
        if(toast){
          const myToast = new bootstrap.Toast('.toast');
          myToast.show()
        }
      })

    </script>
</body>
</html>