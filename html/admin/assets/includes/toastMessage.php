<?php
//XỬ lí toast message
if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    $type_message = $_SESSION['type-message'] == "success" ? "bg-success":"bg-danger"; 
    echo '
    <div class="toast align-items-center text-white '. $type_message .' border-0 position-fixed top-10 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
      <div class="d-flex">
        <div class="toast-body">
          '. $message .'
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>';
    unset($_SESSION['message'],$_SESSION['type-message']);
  }
?>