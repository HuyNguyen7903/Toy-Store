<?php

const DB_HOST = 'localhost';
const DB_NAME = 'toystore';
const DB_USER = 'root';
const DB_PASSWORD = '';

/**
 * Hàm này để kết nối cơ sở dữ liệu
 * @return PDO
 */
function db(): PDO
{
    static $pdo;

    if (!$pdo) {
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // Disable emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Disable errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Make the default fetch be an associative array
          ];
        $pdo = new PDO(
            sprintf("mysql:host=%s;dbname=%s;charset=UTF8", DB_HOST, DB_NAME),
            DB_USER,
            DB_PASSWORD,
            $options
        );
    }
    return $pdo;
}

/**
 * Hàm này dùng để thêm vào csdl
 * 
 * @param string $sql câu lệnh sql
 * @return bool Returns true nếu thành công, false thất bại
 */
function insert($sql,$data) {
    try {
        $stmt = db()->prepare($sql);
        if($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return false;
    }
}

/**
 * Hàm này dùng để lấy tất cả dữ liệu
 * @param string $table tên bản
 * @return array Returns danh sách sản phẩm
 */
function getAll($table) {
    try {
        $sql = "SELECT * FROM $table";
        if($stmt = db()->query($sql)) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return null;
    }
}
/**
 * Hàm này dùng để lấy item theo id
 * @param int $id
 * @return array returns danh mục
 */
function getById($table, $id){
    try {
        $sql = "SELECT * FROM $table WHERE id=?";
        $stmt = db()->prepare($sql);
        if($stmt->execute(array($id))) {

            return $stmt->fetch();
        } else {
            return null;
        }
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return null;
    }
}

/**
 * Hàm này dùng để cập nhật item theo id
* @param string $sql câu lệnh sql
 * @param array $data dữ liệu cần thêm
 * @return boolean returns true thành công, false thất bại
 */
function updateById($sql,$data){
try {
        $stmt = db()->prepare($sql);
        if($stmt->execute($data)) {

            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return false;
    }
}

/**
 * Hàm này dùng để xoá item
 * @param int $id id item
 * @return boolean
 */
function deleteById($table, $id){
    try {
        $sql = "DELETE FROM $table WHERE id=?";
        $stmt = db()->prepare($sql);
        if($stmt->execute(array($id))) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return false;
    }
}

/**
 * Hàm này dùng để tìm kiêm theo tên
 * @param string $table tên bảng
 * @param string $name tên cần tìm
 */
function searchByName($table, $name){
    try {
        $sql = "SELECT * FROM $table WHERE name LIKE '%?%'";
        $stmt = db()->prepare($sql);
        if($stmt->execute(array($name))) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return null;
    }
}
?>