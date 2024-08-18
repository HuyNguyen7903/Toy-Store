<?php 
session_start();
require './assets/includes/header.php';
require './assets/includes/navbar.php';
require '../database/connectdb.php';
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = (float)$_POST['price'];
    $description = $_POST['description'];
    $cate_id = $_POST['cate_id'];
    $brand = $_POST['brand'];
    
    //Xử lí lưu hình ảnh lên imgur 
    $client_id = "da2aeb99e6715be";
    $image = $_FILES['image']['tmp_name'];
    $filename = $_FILES['image']['name'];
    if($filename != ''){
        $handle = fopen($image, "r");
        $data = fread($handle, filesize($image));
        fclose($handle);
    
        $pvars = array('image' => base64_encode($data));
        $timeout = 30;
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL verification
    
        $out = curl_exec($curl);
        curl_close($curl);
    
        $pms = json_decode($out, true);
        $url = $pms['data']['link'];
    }
    else{
        $url = $_POST['old_image'];
    }
    //Sửa sản phẩm
    if(updateById("UPDATE products SET name=?,price=?, img=?, description=?, cate_id=?, brand=? WHERE id=?",array($name,$price, $url, $description, $cate_id,$brand,$id))){
        $_SESSION['message'] = "Sửa sản phẩm thành công";
        $_SESSION['type-message'] = "success";
        header('location: products');
    }
    else{
        $_SESSION['message'] = "Sửa sản phẩm thất bại";
        $_SESSION['type-message'] = "fail";
        header('location: products');
    }
}
$categories = getAll('categories');
?> 
    <div class="container-fluid">
        <div class="row">
        <?php require './assets/includes/sidebar.php' ?>
            <div class="col-md-3 col-lg-2"></div>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
            <?php require './assets/includes/breadcumbs.php' ?>
            <?php 
                if(isset($_GET['id'])){
                    $id = (int)$_GET['id'];
                    $product = getById('products',$id);
                    if($product){
                ?>
                <h1 class="h2">Sửa sản phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Sửa sản phẩm</h5>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group mb-3">
                                              <label for="name">Tên sản phẩm:</label>
                                              <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                              <input type="text" class="form-control" value="<?= $product['name'] ?>" id="name" name="name" oninvalid="setCustomValidity('Vui lòng nhập tên')" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="price">Giá:</label>
                                                <input type="text" class="form-control" value="<?= $product['price'] ?>" id="price" name="price" pattern="[0-9,]*" oninvalid="setCustomValidity('Vui lòng nhập giá là số')" required>
                                              </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="price">Hình ảnh:</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                                <input type="hidden" value=" <?= $product['img'] ?>" name="old_image">
                                              </div>
                                              <img src="<?= $product['img'] ?>" class="img-fluid" id="image-show">
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="description">Mô tả:</label>
                                                <input type="hidden" class="form-control" id="description" name="description">
                                                <div id="toolbar-container">
                                                <span class="ql-formats">
                                                    <select class="ql-font"></select>
                                                    <select class="ql-size"></select>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-bold"></button>
                                                    <button class="ql-italic"></button>
                                                    <button class="ql-underline"></button>
                                                    <button class="ql-strike"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <select class="ql-color"></select>
                                                    <select class="ql-background"></select>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-script" value="sub"></button>
                                                    <button class="ql-script" value="super"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-header" value="1"></button>
                                                    <button class="ql-header" value="2"></button>
                                                    <button class="ql-blockquote"></button>
                                                    <button class="ql-code-block"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-list" value="ordered"></button>
                                                    <button class="ql-list" value="bullet"></button>
                                                    <button class="ql-indent" value="-1"></button>
                                                    <button class="ql-indent" value="+1"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-direction" value="rtl"></button>
                                                    <select class="ql-align"></select>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-link"></button>
                                                    <button class="ql-image"></button>
                                                    <button class="ql-video"></button>
                                                    <button class="ql-formula"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-clean"></button>
                                                </span>
                                                </div>
                                                <div id="editor" style="height: 200px;">
                                                <?= $product['description'] ?>
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
                        <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                            <div class="card">
                                <h5 class="card-header">Danh mục</h5>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="category">Danh mục:</label>
                                        <select class="form-select" aria-label="category" name="cate_id">
                                            <?php
                                                foreach($categories as $cate):
                                            ?>
                                            <option  <?php if($product['cate_id']==$cate['id']) echo 'selected' ?> value="<?= $cate['id']?>"><?= $cate['name'] ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="brand">Thương hiệu:</label>
                                        <input type="text" value="<?= $product['brand'] ?>" class="form-control" id="brand" name="brand">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="image-input" style="display:none">
                </form>
                <?php
                    }else{
                        echo '<div class="alert alert-danger" role="alert">
                                Không tồn tại danh mục này
                            </div>';
                    }
                } else{
                    echo '<div class="alert alert-danger" role="alert">
                            Yêu cầu không hợp lệ
                        </div>';
                }
                ?>
            </main>
        </div>
        
    </div>
    
    <?php require './assets/includes/footer.php' ?> 
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        $(document).ready(function(){
            const quill = new Quill('#editor', {
               modules: {
               toolbar: '#toolbar-container',
               },
               theme: 'snow',

            });
            //Xử lí hình ảnh upload lên imgur cho trường description với Quill editor
            const imageInput = document.getElementById('image-input');
    
            quill.getModule('toolbar').addHandler('image', () => {
                imageInput.click();
            });
    
            imageInput.addEventListener('change', () => {
                const file = imageInput.files[0];
                if (file) {
                    const formData = new FormData();
                    formData.append('image', file);
    
                    fetch('upload.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.status === 'success') {
                            const range = quill.getSelection();
                            quill.insertEmbed(range.index, 'image', result.url);
                        } else {
                            console.error(result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
            // When the form is submitted, populate the hidden input with the editor's content
            document.querySelector('form').onsubmit = function() {
                document.querySelector('#description').value = quill.root.innerHTML;
            }
            $('#btn-cancel').click(function(){
                history.go(-1);
            })
           
            $(document).ready(function() {
            $('#image').change(function() {
                var file = this.files[0];
                // Kiểm tra extention của hình ảnh
                var validImageTypes = ['image/gif', 'image/jpeg', 'image/png','image/jpg'];
                var maxSize = 1024 * 1024; // 1MB in bytes
                if ($.inArray(file.type, validImageTypes) < 0 || !file) {
                    alert('Vui lòng chọn tệp hình ảnh');
                    $(this).val(''); // Không hợp lệ thì clear input
                    return;
                }

                 // Check file size
                if (file.size > maxSize) {
                    alert('Hình ảnh phải nhỏ hơn 1MB');
                    $(this).val('');
                    return;
                }
                $('#image-show').attr('src', URL.createObjectURL(file));
            });
        });
        })
    </script>
</body>
</html>