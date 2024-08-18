<?php 
session_start();
require './assets/includes/header.php';
require './assets/includes/navbar.php';
require '../database/connectdb.php';
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    if(updateById("UPDATE categories set name=$name, description=$description",array($name, $description,$id))){
        $_SESSION['message'] = "Sửa danh mục thành công";
        $_SESSION['type-message'] = "success";
        header('location: categories');
    }
    else{
        $_SESSION['message'] = "Sửa danh mục thất bại";
        $_SESSION['type-message'] = "fail";
        header('location: categories');
    }
}
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
                    $category = getById('categories',$id);
                    if($category){
                ?>
                <h1 class="h2">Sửa danh mục</h1>
                <form action="./edit-categories.php" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                            <div class="card">
                                <h5 class="card-header">Sửa danh mục</h5>
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-8">
                                                <div class="form-group mb-3">
                                                <input type="hidden" value="<?= $category['id']?>" name="id">
                                                <label for="name">Tên danh mục:</label>
                                                <input type="text" value="<?= $category['name'] ?>" class="form-control" id="name" name="name" require>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="editor">Mô tả:</label>
                                                    <input type="hidden" name="description" id="description" value="<?= $category['description'] ?>">
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
                                                        <?= $category['description'] ?>
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
            $('form').submit(function() {
                $('#description').val(quill.root.innerHTML);
            });
            // quill.root.innerHTML = $('#description').val()
            $('#btn-cancel').click(function(){
                history.go(-1);
            })
        })
        </script>
</body>
</html>