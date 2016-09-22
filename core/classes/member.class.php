<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: ��Ա��¼/ע��/�����޸���
 ***********************************************************/

 class Member {
    var $Username;      // �û���
    var $Password;      // ����
    var $GroupID;       // ��ID
    var $MemberStatus;  // ��Ա״̬
    var $Error;         // �Ƿ���ڴ���
    var $MsgCode;       // ��Ϣ����
    var $UseCookie;     // �Ƿ�ʹ��Cookie

    function Member($UseCookie=true) {
        if ($UseCookie) $this->UseCookie = true;
        else $this->UseCookie = false;
    }

    /**
     * ��ѯ�û��Ƿ����
     *
     * @param string $username  �û���
     * @return boolean �����򷵻�true,���򷵻�false
     */
    function UserExist($username) {
        global $db,$tablepre;
        $sql = "select * from `{$tablepre}member` where `Username`='$username'";
        $query = $db->query($sql);
        if (!$db->num_rows($query)) return false;
        else return true;
    }

    /**
     * �û���½
     *
     * @param string $username  �û���
     * @param string $password  ����
     * @return boolean ��½�ɹ�����true,���򷵻�false
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
     * �˳���½
     *
     */
    function Logout() {
        session_start();
        unset($_SESSION['Username']);
        if(setcookie('SID','',time()-3600)) return true;
        else return false;
    }

    /**
     * �ж��û��Ƿ��Ѿ���½
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
     * ����Session
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