<?php
/***********************************************************
 * Document Type: Function
 * Update: 2006/09/13
 * Author: akon
 * Remark: 表单验证类自定函数
 ***********************************************************/

    if (!defined('__SITE_ROOT')) {
        exit();
    }

    /**
     * 检测字符串是否为空
     *
     * @param string $string    需要测试的字符串
     * @param string $tip       提示信息前缀
     * @return mixed 如果非空则返回原始字符串,否则弹出提示信息
    */
  function check_empty($string, $tip) {
        global $clang;
        $len = strlen(trim($string));
        if ($len<1) feedback($tip.$clang[not_empty]);
        return trim($string);
   }
    function check_empty_en($string, $tip) {
        global $clang;
        $len = strlen(trim($string));
        if ($len<1) feedback_en($tip.$clang[not_empty_en]);
        return trim($string);
 }
    /**
     * 检测字符串长度是否合法
     *
     * @param string $string    需要测试的字符串
     * @param string $tip       提示信息前缀
     * @param integer $num1     字符串最小长度
     * @param integer $num2     字符串最大长度
     * @param boolean $null     True:允许空/False:非空
     * @return mixed 符合条件返回原始字符串,否则弹出提示信息
     */
    function str_len_between($string,$tip,$num1=1,$num2=1,$null=false) {
        global $clang;
        $len = strlen(trim($string));
        if ($len<1) {
            if ($null) return trim($string);
            else feedback($tip.$clang[not_empty]);
         }
        if ($len<$num1) feedback($tip.$clang[not_less_than].$num1.$clang[characters]);
        if ($len>$num2) feedback($tip.$clang[not_than].$num2.$clang[characters]);
        return trim($string);
    }

    /**
     * 校验密码的正确性
     *
     * @param string $pwd       原始密码
     * @param string $confirm   校验密码
     * @param boolean $null     True:允许空/False:非空
     * @return mixed 符合条件返回两次md5加密的字符串,否则弹出提示信息
     */
    function comp_pwd($pwd,$confirm,$null=false) {
        global $clang;
        if (empty($pwd)) {
            if ($null) return $pwd;
            else feedback($clang[pwd_not_empty]);
        }
        if (strcmp($pwd,$confirm)) feedback($clang[pwd_different]);
        else return md5(md5($pwd));
    }

    /**
     * 检测是否有效的数字
     *
     * @param string $string    需要测试的字符串
     * @param string $tip       提示信息前缀
     * @param boolean $null     True:允许空/False:非空
     * @return mixed 符合条件返回原始字符串,否则弹出提示信息
     */
    function check_numeric($string,$tip,$null=false) {
        global $clang;
        if (strlen($string)<1) {
            if ($null) $string = 0;
            else feedback($tip.$clang[not_empty]);
        }
        if (!is_numeric($string)) feedback($tip.$clang[invalid_numeric]);
          return $string;
    }

    /**
     * 检测是否有效的邮件地址
     *
     * @param string $string    需要测试的字符串
     * @param string $tip       提示信息前缀
     * @param boolean $null     True:允许空/False:非空
     * @return mixed 符合条件返回原始字符串,否则弹出提示信息
     */
    function check_email($string,$tip,$null=false) {
        global $clang;
        if (empty($string)) {
            if ($null) return $string;
            else  feedback($tip.$clang[not_empty]);
        }
        if (!is_email($string)) feedback($tip.$clang[invalid_mail]);
        return $string;
    }

    /**
     * 检测是否有效的日期
     *
     * @param string $string    需要测试的字符串
     * @param string $tip       提示信息前缀
     * @param boolean $null     True:允许空/False:非空
     * @return mixed 符合条件返回原始字符串,否则弹出提示信息
     */
    function check_date($string,$tip,$null=false) {
        global $clang;
        if (empty($string)) {
            if ($null) return $string;
            else feedback($tip.$clang[not_empty]);
        }
        if (!is_date($string)) feedback($tip.$clang[invalid_date]);
        return $string;
    }

    /**
     * 检测是否有效的URL地址
     *
     * @param string $string    需要测试的字符串
     * @param string $tip       提示信息前缀
     * @param boolean $null     True:允许空/False:非空
     * @return mixed 符合条件返回原始字符串,否则弹出提示信息
     */
    function check_url($string,$tip,$null=false) {
        global $clang;
        if (empty($string)) {
            if ($null) return $string;
            else feedback($tip.$clang[not_empty]);
        }
        if (!is_url($string)) feedback($tip.$clang[invalid_url]);
        return $string;
    }

    /**
     * 检测字符是否只包含英文
     *
     * @param string $string    需要测试的字符串
     * @param string $tip       提示信息前缀
     * @param boolean $null     True:允许空/False:非空
     * @return mixed 符合条件返回原始字符串,否则弹出提示信息
     */
    function check_english($string,$tip,$null=false) {
        global $clang;
        if (empty($string)) {
            if ($null) return $string;
            else feedback($tip.$clang[not_empty]);
        }
        if (!is_english($string)) feedback($tip.$clang[only_english]);
        return $string;
    }

    /**
     * 检测字符是否有效的身份证号码
     *
     * @param string $string    需要测试的字符串
     * @param string $tip       提示信息前缀
     * @param boolean $null     True:允许空/False:非空
     * @return mixed 符合条件返回原始字符串,否则弹出提示信息
     */
    function check_idcard($string,$null=false) {
        global $clang;
        if (empty($string)) {
            if ($null) return $string;
            else feedback($clang[idcard_not_empty]);
        }
        if (!is_idcard($string)) feedback($clang[invalid_idcard]);
        return $string;
    }