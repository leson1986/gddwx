<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/08
 * Author: Akon
 * Remark: ���޼�����Ŀ¼��
 ***********************************************************/

class Tree {

    var $_table;         // �洢����ı���
    var $_parent_id;     // ����ID
    var $_selID;         // ѡ��ֵ(�����������б�)
    var $_depth;         // Ŀ¼���
    var $_ret;           // ������

    function Tree($table,$parent_id) {
        $this->_table =$table;
        $this->_parent_id = $parent_id;
        $this->_depth = 0;
    }

    /**
     * ��������Ŀ¼����JS����
     * @param   string   $URL          ���ڵ���ת���URL��ַ
     * @param   string   $target       URLĿ�����
     * @param   string   $treename     Ŀ¼������
     * @return  string  HTML JS Code
     */
    function get_jstree($URL, $target, $treename='') {
        global $db;
        if (empty($treename)) $treename = $cmsg['tree_tree_name'];
        $sql = "select * from ".$this->_table." order by sort_order asc,id asc";
        $query = $db->query($sql);
        if ($query) {
            $jstree = "d = new dTree('d');d.add(0,-1,'{$treename}');\n";
            while($row = $db->fetch_array($query)) {
                $jstree .= "d.add(";
                $jstree .= "'{$row['id']}',"; // ����ID
                $jstree .= "'{$row['parent_id']}',"; // ���ڵ�ID
                $jstree .= "'{$row['class_name']}',"; // �ڵ�����
                $jstree .= "'{$URL}&id={$row['id']}',"; // URL��ַ
                $jstree .= "'{$row['class_info']}',"; // ALT��ʾ��Ϣ
                $jstree .= "'{$target}'"; // URLĿ��
                $jstree .= ");\n";
            }
            $jstree .= "document.write(d);";
            return $jstree;
        }
    }

    /**
     * ȡ��ָ����ID�µ������ӷ��ൽ����
     * @param   integer  $parent_id         ����ID
     * @return  array  ��������
     */
    function getClassToArray($parent_id) {
        if (is_numeric($parent_id)) {
            global $db;
            $sql = "select * from `".$this->_table."` where `parent_id`='{$parent_id}' order by `sort_order` asc,`id` asc";
            $query = $db->query($sql);
            if ($db->num_rows($query)) {
                while($row = $db->fetch_array($query)) {
                    $class_arr[] = array(
                        "parent_id" => $row["id"],
                        "class_name" => $row["class_name"],
                    );
                }
            }
            return $class_arr;
        }
    }

    /**
     * ���������б�ѡ��
     * @return  string  HTML�����б�ѡ��
     */
    function _makeSelBoxOption() {
        $class_arr = $this->getClassToArray($this->_parent_id);
        for ($i=0;$i<count($class_arr);$i++) {
            $this->_ret .= '<option value="'.$class_arr[$i][parent_id].'"';
            if ($this->_selID==$class_arr[$i][parent_id]) $this->_ret .= 'selected="selected"';
            $this->_ret .= '>';
            for ($j=0;$j<$this->_depth;$j++) $this->_ret .= '&nbsp;&nbsp;';
            $this->_ret .= $class_arr[$i][class_name]."</option>\n";
            $this->_parent_id = $class_arr[$i][parent_id];
            $this->_depth++;
            $this->_makeSelBoxOption();
            $this->_depth--;
        }
    }

    /**
     * ���������б�
     * @param   string   $selName       �����б�������ID
     * @param   integer  $selID         �����б�ֵ
     * @param   string   $selScript     onchage�¼��������Ľű�
     * @return  string  HTML�����б�
     */
    function _makeSelBox($sel_box_name, $selID, $addEmpty=false, $selScript="") {
        $this->_selID = $selID;
        $this->_makeSelBoxOption();
        if (!empty($selScript)) $selScript = " onchange=\"{$selScript}\"";
        if ($addEmpty) $addEmpty = "<option value=\"0\">{$cmsg['tree_select_class']}</option>\n";
        return "<select name=\"{$sel_box_name}\" id=\"{$sel_box_name}\" {$selScript}>\n{$addEmpty}".$this->_ret."</select>\n";
    }
}