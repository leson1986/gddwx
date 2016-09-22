<?php
/***********************************************************
 * Document Type: Package
 * Update: 2006/11/08
 * Author: Akon
 * Remark: 中文内核语言包.
 ***********************************************************/

$ptitle = array (
    "system" => "系统设置",
    "admin_user_list" => "管理员设置",
    "admin_user_edit" => "编辑管理员",
    "admin_user_add" => "新增管理员",
    "admin_group_list" => "权限组设置",
    "admin_group_edit" => "编辑权限组",
    "admin_group_add" => "新增权限组",
    "news_list" => "信息列表",
    "news_search" => "搜索",
    "news_edit" => "编辑信息",
    "news_add" => "新增信息",
    "article" => "编辑文档",
    "imgs_list" => "分店列表",
    "imgs_search" => "分店搜索",
    "imgs_edit" => "编辑分店",
    "imgs_add" => "新增分店",
    "products_list" => "产品列表",
    "products_search" => "产品搜索",
    "products_edit" => "编辑产品",
    "products_add" => "新增产品",
    "job_add" => "添加招聘信息",
    "job_list" => "招聘信息",
    "job_edit" => "编辑招聘信息",
);

$clang = array (
    // ----------------------------------------------
    // All Page
    // ----------------------------------------------
    "username" => "用户名",
    "password" => "密码",
    "power_group" => "权限组",
    "admin_group_id" => "权限组排序",
    "admin_group_name" => "权限组名称",
    "admin_group_info" => "权限组介绍",
    "status" => "状态",
    "yes" => "是",
    "no" => "否",
    "valid" => "有效",
    "invalid" => "无效",
    "is_confirm" => "已确认",
    "no_confirm" => "未确认",
    "is_verify" => "已审核",
    "no_verify" => "未审核",
    "no_power" => "您的权限无法执行该操作，请与管理员联系!",
    "jobs" => "招聘职位",
    "jobs_number" > "招聘人数",
    // ----------------------------------------------
    // checkform.func.php && common.func.php
    // ----------------------------------------------
    "not_empty" => "不能为空!",
    "not_empty_en" => "not empty!",
    "not_less_than" => "不能小于",
    "not_than" => "不能大于",
    "characters" => "个字符!",
    "pwd_not_empty" => "密码不能为空!",
    "pwd_different" => "两次输入的密码不一致!",
    "invalid_numeric" => "不是有效的数字!",
    "invalid_mail" => "不是有效的邮件地址!",
    "invalid_date" => "不是有效的日期格式!",
    "invalid_url" => "不是有效的URL地址\n请输入例如：http://www.zhqiao.cn",
    "only_english" => "只允许存在(a-z,A-Z,0-9)英文字符!",
    "idcard_not_empty" => "身份证号码不能为空!",
    "invalid_idcard" => "身份证号码格式错误,15-18位!",
    "goto_back" => "返回上一页",
    "goto_back_en" => "Return",
    // ----------------------------------------------
    // system.php
    // ----------------------------------------------
    "char_set" => "页面字符集",
    "site_name" => "网站名称",
    "site_url" => "网站URL地址",
    "site_open" => "网站对外开放",
    "site_cert" => "网站备案号",
    "site_mail" => "管理员邮箱",
    "site_is_test_space" => "网站位于测试空间",
    "site_test_space_name" => "测试空间目录名称",
    "site_test_space_no_empty" => "网站位于测试空间,但测试空间目录名称为空或小于2个字符!",
    "site_test_space_inexistence" => "找不到测试空间目录,请输入正确的目录名称!",
    "allow_upload_size" => "允许上传的文件大小",
    "allow_upload_files" => "允许上传的文件格式",
    "product_thumb_width" => "产品缩略图宽",
    "product_thumb_height" => "产品缩略图高",
    "product_image_width" => "产品大图宽",
    "product_image_height" => "产品大图高",
    "gbook_open" => "是否开放留言本",
    "gbook_page_size" => "每页显示留言数量",
    "gbook_post_time" => "留言间隔时间",
    "gbook_post_verfify" => "发布留言是否需要审核",
    "gbook_post_guest" => "允许匿名用户发表留言",
    // ----------------------------------------------
    // sql_dump.php
    // ----------------------------------------------
    "db_bak_successful" => "数据库备份文件已经成功创建!",
    "db_bak_file_inexistence" => "您要下载的文件不存在，或者已经被删除!",
    // ----------------------------------------------
    // admin_login.php
    // ----------------------------------------------
    "pls_username" => "请输入用户名!",
    "pls_password" => "请输入密码!",
    "verifycode_err" => "验证码输入错误!",
    "invalid_user" => "该用户名已经失效，请与管理员联系!",
    "inexistent_user" => "该用户不存在或密码错误!",
    // ----------------------------------------------
    // admin_user_*.php
    // ----------------------------------------------
    "can_not_del_self" => "对不起，您无法删除自己!",
    "can_not_del_sys_usr" => "这是一个系统管理员，您没有权限删除!",
    "admin_exist" => "该用户已经存在，请更换其他用户名!",
    "can_not_add_admin" => "您无法添加一个大于自身权限的用户!",
    "can_not_edit_admin" => "您无法修改一个大于自身权限的用户!",
    // ----------------------------------------------
    // admin_group_*.php
    // ----------------------------------------------
     "can_not_del_admin_group" => "对不起，这是一个系统管理员组，您无法删除!",
     "can_not_edit_admin_group" => "您无法编辑一个大于自身权限的组!",
     "can_not_add_admin_group" => "您无法添加一个大于自身权限的组!",
     "admin_group_exist" => "您想要添加权限组已经存在!",
    // ----------------------------------------------
    // news_*.php
    // ----------------------------------------------
    "pls_enter_news_class" => "请指定文档分类!",
    "news_title" => "文档标题",
    "news_isnew" => "是否推荐",
    "news_confirm" => "信息状态",
    "news_tags" => "关键字",
    "news_content" => "文档内容",
    "news_summary" => "内容摘要",
    "news_posttime" => "录入时间",
    "news_author" => "录入作者",
    // ----------------------------------------------
    // imgs_*.php
    // ----------------------------------------------
    "imgs_classid" => "所属分店",
    "imgs_name" => "分店名称",
    "imgs_title" => "分店标题",
    "imgs_url" => "分店地址",
    "imgs_thumb" => "分店截图",
    "imgs_desc" => "关键字",
    "imgs_detail" => "详细信息",
    "imgs_tags" => "分店介绍",
    "imgs_isvalid" => "是否有效",
    "imgs_istop" => "分类置顶",
    "imgs_index" => "首页显示",
    "imgs_pubtime" => "录入时间",
    "imgs_author" => "录入作者",
);

$cmsg = array (
    // ----------------------------------------------
    // db_mysql_dump.class.php
    // ----------------------------------------------
    "dump_err_compress" => "压缩文件时发生错误!",
    "dump_err_file" => "打开文件时发生错误",
    "dump_err_base" => "所指定的数据库不存在!",
    "dump_err_mysql" => "所指定的服务器不存在",
    // ----------------------------------------------
    // db_mysql_error.inc.php
    // ----------------------------------------------
    "mysql_err_info" => "信息类型",
    "mysql_err_time" => "发生时间",
    "mysql_err_file" => "错误文件",
    "mysql_err_sql" => "SQL语句",
    "mysql_err_error" => "错误信息",
    "mysql_err_errno" => "错误代码",
    // ----------------------------------------------
    // page.class.php
    // ----------------------------------------------
    "page_total" => "Page Total",
    "page_pages" => ", ",
    "page_records" => " Records",
    // ----------------------------------------------
    // page_edit.class.php
    // ----------------------------------------------
    "edit_must_table" => "必须指定表名!",
    "edit_must_condition" => "必须指定查询条件!",
    "edit_record_inexistent" => "指定的记录不存在或已经被删除!",
    "edit_update_failed" => "编辑操作执行失败!",
    "edit_update_successful" => "编辑操作执行成功!",
    "edit_insert_failed" => "添加新数据失败!",
    "edit_insert_successful" => "添加新数据成功!",
    "edit_back_list" => "返回列表",
    // ----------------------------------------------
    // tree.class.php
    // ----------------------------------------------
    "tree_tree_name" => "目录树",
    "tree_select_class" => "请选择分类",
    // ----------------------------------------------
    // tree.class.php
    // ----------------------------------------------
    "imgs_class_null" => "所属分店不能为空!",
    "products_class_null" => "所属分类不能为空!",
);