<?php
require_once '../database/connectdb.php';
/**
 * Hàm này dùng để kiểm tra user đăng nhập admin
 * @param string $username username
 * @param string $password password của user
 */
function checkUser($username, $password){
    try {
        $sql = "SELECT username, password, role_id FROM users WHERE username=? AND password=? LIMIT 1";
        $stmt = db()->prepare($sql);
        if($stmt->execute(array($username, $password))) {
            return $stmt->fetch();
        } else {
            return null;
        }
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return null;
    }
}
?>