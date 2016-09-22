<?php
/***********************************************************
 * Document Type: Function
 * Update: 2006/09/13
 * Author: akon
 * Remark: ����֤���Զ�����
 ***********************************************************/

    if (!defined('__SITE_ROOT')) {
        exit();
    }

    /**
     * ����ַ����Ƿ�Ϊ��
     *
     * @param string $string    ��Ҫ���Ե��ַ���
     * @param string $tip       ��ʾ��Ϣǰ׺
     * @return mixed ����ǿ��򷵻�ԭʼ�ַ���,���򵯳���ʾ��Ϣ
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
     * ����ַ��������Ƿ�Ϸ�
     *
     * @param string $string    ��Ҫ���Ե��ַ���
     * @param string $tip       ��ʾ��Ϣǰ׺
     * @param integer $num1     �ַ�����С����
     * @param integer $num2     �ַ�����󳤶�
     * @param boolean $null     True:�����/False:�ǿ�
     * @return mixed ������������ԭʼ�ַ���,���򵯳���ʾ��Ϣ
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
     * У���������ȷ��
     *
     * @param string $pwd       ԭʼ����
     * @param string $confirm   У������
     * @param boolean $null     True:�����/False:�ǿ�
     * @return mixed ����������������md5���ܵ��ַ���,���򵯳���ʾ��Ϣ
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
     * ����Ƿ���Ч������
     *
     * @param string $string    ��Ҫ���Ե��ַ���
     * @param string $tip       ��ʾ��Ϣǰ׺
     * @param boolean $null     True:�����/False:�ǿ�
     * @return mixed ������������ԭʼ�ַ���,���򵯳���ʾ��Ϣ
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
     * ����Ƿ���Ч���ʼ���ַ
     *
     * @param string $string    ��Ҫ���Ե��ַ���
     * @param string $tip       ��ʾ��Ϣǰ׺
     * @param boolean $null     True:�����/False:�ǿ�
     * @return mixed ������������ԭʼ�ַ���,���򵯳���ʾ��Ϣ
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
     * ����Ƿ���Ч������
     *
     * @param string $string    ��Ҫ���Ե��ַ���
     * @param string $tip       ��ʾ��Ϣǰ׺
     * @param boolean $null     True:�����/False:�ǿ�
     * @return mixed ������������ԭʼ�ַ���,���򵯳���ʾ��Ϣ
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
     * ����Ƿ���Ч��URL��ַ
     *
     * @param string $string    ��Ҫ���Ե��ַ���
     * @param string $tip       ��ʾ��Ϣǰ׺
     * @param boolean $null     True:�����/False:�ǿ�
     * @return mixed ������������ԭʼ�ַ���,���򵯳���ʾ��Ϣ
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
     * ����ַ��Ƿ�ֻ����Ӣ��
     *
     * @param string $string    ��Ҫ���Ե��ַ���
     * @param string $tip       ��ʾ��Ϣǰ׺
     * @param boolean $null     True:�����/False:�ǿ�
     * @return mixed ������������ԭʼ�ַ���,���򵯳���ʾ��Ϣ
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
     * ����ַ��Ƿ���Ч�����֤����
     *
     * @param string $string    ��Ҫ���Ե��ַ���
     * @param string $tip       ��ʾ��Ϣǰ׺
     * @param boolean $null     True:�����/False:�ǿ�
     * @return mixed ������������ԭʼ�ַ���,���򵯳���ʾ��Ϣ
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