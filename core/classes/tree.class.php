<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/08
 * Author: Akon
 * Remark: 无限级分类目录树
 ***********************************************************/

class Tree {

    var $_table;         // 存储分类的表名
    var $_parent_id;     // 父类ID
    var $_selID;         // 选中值(作用于下拉列表)
    var $_depth;         // 目录深度
    var $_ret;           // 输出结果

    function Tree($table,$parent_id) {
        $this->_table =$table;
        $this->_parent_id = $parent_id;
        $this->_depth = 0;
    }

    /**
     * 用于生成目录树的JS代码
     * @param   string   $URL          当节点点击转向的URL地址
     * @param   string   $target       URL目标对像
     * @param   string   $treename     目录树名称
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
                $jstree .= "'{$row['id']}',"; // 分类ID
                $jstree .= "'{$row['parent_id']}',"; // 父节点ID
                $jstree .= "'{$row['class_name']}',"; // 节点名称
                $jstree .= "'{$URL}&id={$row['id']}',"; // URL地址
                $jstree .= "'{$row['class_info']}',"; // ALT提示信息
                $jstree .= "'{$target}'"; // URL目标
                $jstree .= ");\n";
            }
            $jstree .= "document.write(d);";
            return $jstree;
        }
    }

    /**
     * 取出指定父ID下的所有子分类到数组
     * @param   integer  $parent_id         父类ID
     * @return  array  分类数组
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
     * 生成下拉列表选项
     * @return  string  HTML下拉列表选项
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
     * 生成下拉列表
     * @param   string   $selName       下拉列表名称与ID
     * @param   integer  $selID         下拉列表值
     * @param   string   $selScript     onchage事件可引发的脚本
     * @return  string  HTML下拉列表
     */
    function _makeSelBox($sel_box_name, $selID, $addEmpty=false, $selScript="") {
        $this->_selID = $selID;
        $this->_makeSelBoxOption();
        if (!empty($selScript)) $selScript = " onchange=\"{$selScript}\"";
        if ($addEmpty) $addEmpty = "<option value=\"0\">{$cmsg['tree_select_class']}</option>\n";
        return "<select name=\"{$sel_box_name}\" id=\"{$sel_box_name}\" {$selScript}>\n{$addEmpty}".$this->_ret."</select>\n";
    }
}