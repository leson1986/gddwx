<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: 会员登录/注册/资料修改类
 ***********************************************************/

 class Member {
    var $Username;      // 用户名
    var $Password;      // 密码
    var $GroupID;       // 组ID
    var $MemberStatus;  // 会员状态
    var $Error;         // 是否存在错误
    var $MsgCode;       // 信息代码
    var $UseCookie;     // 是否使用Cookie

    function Member($UseCookie=true) {
        if ($UseCookie) $this->UseCookie = true;
        else $this->UseCookie = false;
    }

    /**
     * 查询用户是否存在
     *
     * @param string $username  用户名
     * @return boolean 存在则返回true,否则返回false
     */
    function UserExist($username) {
        global $db,$tablepre;
        $sql = "select * from `{$tablepre}member` where `Username`='$username'";
        $query = $db->query($sql);
        if (!$db->num_rows($query)) return false;
        else return true;
    }

    /**
     * 用户登陆
     *
     * @param string $username  用户名
     * @param string $password  密码
     * @return boolean 登陆成功返回true,否则返回false
     */
    function Login($username,$password) {
        global $db,$tablepre;
        $username = dhtmlspecialchars($username);
        $password = dhtmlspecialchars($password);
        $this->Error = true;
        if (strlen($username)<4) $this->MsgCode = "0001";
        elseif (strlen($username)>30) $this->MsgCode = "0002";
        elseif (strlen($password)<4) $this->MsgCode = "0003";
        elseif (strlen($password)>40) $this->MsgCode = "0004";
        else {
            $sql = "select * from `{$tablepre}member` where `Username`='$username'";
            $query = $db->query($sql);
            if ($row = $db->fetch_array($query)) {
			    if ($row["MemberStatus"] == 1){
                if ($row["Password"] == md5(md5($password))) {
                    $this->Username = $username;
                    $this->Password = $row["Password"];
                    $this->GroupID = $row["GroupID"];
                    $this->MemberStatus = $row["MemberStatus"];
                    $this->setSession();
                    $this->Error = false;
                    $this->MsgCode = "0005";
                }	
                else {$this->MsgCode = "0007";}
				}
			   else {$this->MsgCode = "0008";};
            }
            else $this->MsgCode = "0006";
        }
        return $this->Error;
    }

    /**
     * 退出登陆
     *
     */
    function Logout() {
        session_start();
        unset($_SESSION['Username']);
        if(setcookie('SID','',time()-3600)) return true;
        else return false;
    }

    /**
     * 判断用户是否已经登陆
     *
     * @return boolean
     */
    function isLogin() {
        if(isset($_COOKIE['SID'])) {
            session_id($_COOKIE['SID']);
            session_start();
            $this->Username = $_SESSION['Username'];
            $this->Password = $_SESSION['Password'];
            $this->GroupID = $_SESSION['GroupID'];
            $this->MemberStatus = $_SESSION['MemberStatus'];
            return true;
        }
        else {
            session_start();
            if(isset($_SESSION['Username'])) return true;
        }
        return false;
    }

    /**
     * 设置Session
     *
     */
    function setSession() {
        global $cookie_path,$cookie_time;
        $sid=uniqid('SID');
        session_id($sid);
        session_start();
        $_SESSION['Username'] = $this->Username;
        $_SESSION['Password'] = $this->Password;
        $_SESSION['GroupID'] = $this->GroupID;
        $_SESSION['MemberStatus'] = $this->MemberStatus;
        if($this->UseCookie) {
            if(!setcookie('sid',$sid,time() + $cookie_time,$cookie_path)) {
                $this->Error = true;
                $this->MsgCode = "0008";
            }
        }
        else setcookie('SID','',time()-3600);
    }

    /***/
    function getUsername() {
        return $this->Username;
    }
 }