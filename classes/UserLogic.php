<?php
require_once '../common/dbc.php';
ini_set('display_errors', true); //エラー確認

class UserLogic{
    /**
     * ユーザを登録する
     * @param array $userData
     * @return bool $res
     */
    public static function createUser($userData){
        $res = false;

        $sql = 'INSERT INTO users (login_id, name, pass) VALUES (?,?,?)';

        //ユーザデータを配列に入れる
        $arr = [];
        $arr[] = $userData['login_id'];
        $arr[] = $userData['user_name'];
        $arr[] = password_hash($userData['pass'], PASSWORD_DEFAULT);
        
        try {
            $stm = dbConnect()->prepare($sql);
            $res = $stm->execute($arr);
            return $res;
        } catch(\Exception $e) {
            return $res;
        }
    }

    /**
     * ログイン処理
     * @param string $login_id
     * @param string $pass
     * @return bool $res
     */
    public static function login($login_id, $pass){
        //結果
        $res = false;
        // ユーザをログインIDから検索して取得
        $user = self::getUserByLoginId($login_id);

        if(!$user){
            $_SESSION['msg'] = 'ログインIDが一致しません';
            return $res;
        }

        // パスワードの照会
        if(password_verify($pass, $user['pass'])){
            //ログイン成功
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $res = true;
            return $res;
        }

        $_SESSION['msg'] = 'パスワードが一致しません';
        return $res;
    }

    /**
     * ログインIDからユーザを取得
     * @param string $login_id     
     * @return array|bool $user|false
     */
    public static function getUserByLoginId($login_id){
        // SQLの準備
        // SQLの実行
        // SQLの結果を返す
        $sql = 'SELECT * FROM users WHERE login_id = ?';

        //ログインIDを配列に入れる
        $arr = [];
        $arr[] = $login_id;
        
        try {
            $stm = dbConnect()->prepare($sql);
            $stm->execute($arr);
            // SQLの結果を返す
            $user = $stm->fetch();
            return $user;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * ログインチェック
     * @param void    
     * @return bool $res
     */
    public static function checkLgoin(){
        $res = false;

        //セッションにログインユーザが入っていなかったらfalse
        if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0){
            return $res = true;
        }
    }

    /**
     * ログアウト処理
     * @param void    
     * @return bool $res
     */
    public static function logout(){
        $_SESSION = aaray();
        session_destroy();
    }

}
?>