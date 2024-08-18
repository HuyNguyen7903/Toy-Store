<?php
/**
 * Hàm này dùng để lấy tổng số trang
 * @param string $table tên bảng
 * @param int $result_per_page số lượng danh mục mỗi trang 
 * @return int Returns tổng số trang
 */
function getTotalPage($table, $results_per_page=10){
    $sql = "SELECT COUNT(id) AS total FROM $table";
    // Find out the number of results stored in the database
    $stmt = db()->query($sql);
    $total_results = $stmt->fetch()['total'];
    $total_pages = ceil($total_results / $results_per_page); // total number of pages
    return $total_pages;
}

/**
 * Hàm này dùng để phân trang danh mục sản phẩm 
 * @param string $table tên bảng
 * @param int $page số trang
 * @param ínt $result_per_page số lượng danh mục mỗi trang 
 * @return array Return danh sách danh mục mỗi trang
 */
function getItemsPagination($table, $page, $results_per_page=10){

    // Determine the SQL LIMIT starting number for the results on the displaying page
    $start_from = ($page-1) * $results_per_page;
    //GET Products PAGINATION AND SORT BY CATE_ID
    $data = db()->query("SELECT * FROM $table ORDER BY id DESC LIMIT $start_from, $results_per_page")->fetchAll();
    return $data;
}

function getSearchByNameTotalPage($table,$name, $results_per_page=10){
    $sql = "SELECT COUNT(id) AS total FROM $table WHERE name LIKE '%$name%'";
    // Find out the number of results stored in the database
    $stmt = db()->query($sql);
    $total_results = $stmt->fetch()['total'];
    $total_pages = ceil($total_results / $results_per_page); // total number of pages
    return $total_pages;
}

function getSearchByNameItemsPagination($table,$name, $page, $results_per_page=10){

    // Determine the SQL LIMIT starting number for the results on the displaying page
    $start_from = ($page-1) * $results_per_page;
    //GET Products PAGINATION AND SORT BY CATE_ID
    $data = db()->query("SELECT * FROM $table WHERE name LIKE '%$name%' ORDER BY id DESC LIMIT $start_from, $results_per_page")->fetchAll();
    return $data;
}

function getSearchByUserNameTotalPage($table,$name, $results_per_page=10){
  $sql = "SELECT COUNT(id) AS total FROM $table WHERE username LIKE '%$name%'";
  // Find out the number of results stored in the database
  $stmt = db()->query($sql);
  $total_results = $stmt->fetch()['total'];
  $total_pages = ceil($total_results / $results_per_page); // total number of pages
  return $total_pages;
}

function getSearchByUserNameItemsPagination($table,$name, $page, $results_per_page=10){

  // Determine the SQL LIMIT starting number for the results on the displaying page
  $start_from = ($page-1) * $results_per_page;
  //GET Products PAGINATION AND SORT BY CATE_ID
  $data = db()->query("SELECT * FROM $table WHERE username LIKE '%$name%' ORDER BY id DESC LIMIT $start_from, $results_per_page")->fetchAll();
  return $data;
}
/**
 * Hàm này dùng để xử lí phân trang
 * @param int $currentPage trang hiện tại
 * @param int $totalPages tổng số trang
 * @return array Returns danh sách trang. Ví dụ: [1,'...',4,5,6,'...',10]
 */
function pagination($currentPage,$totalPages){
    $current = $currentPage;
    $last = $totalPages;
    $delta = 1;
    $left = $current - $delta;
    $right = $current + $delta + 1;
    $range = array();
    $rangeWithDots = [];
    $l= null;
    for($i = 1; $i<=$last;$i++){
      if($i == 1 || $i == $last || $i >= $left && $i < $right){
        array_push($range, $i);
      }
    }
    foreach($range as $r){
      if($l){
        if($r - $l !== 1){
          array_push($rangeWithDots,'...');
        }
      }
      array_push($rangeWithDots, $r);
      $l = $r;
    }
    return $rangeWithDots;
}
