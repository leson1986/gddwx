<?php
##################################
//定义一些变量
$redhat["name"]="redhat";//管理员登陆帐号
$redhat["pass"]="redhat";//管理员登陆密码
$redhat["offset"]=20;//偏量(默认每页显示的记录数)
$redhat["ipdata"]="ip.csv";//IP数据库文件
$redhat["path"]="count/data/";//访问者数据存储路径
$redhat["data1"]="data1.txt";//存储访问者时间（年月日）
$redhat["data2"]="data2.txt";//存储访问者时间（24小时）
$redhat["data3"]="data3.txt";//存隼访问者IP
$redhat["data4"]="data4.txt";//存储访问者浏览器
$redhat["data5"]="data5.txt";//存储操作系统
$redhat["data6"]="data6.txt";//存储访问者来访URL
$redhat["data7"]="data7.txt";//统计在线人数
$redhat["badip"]="data8.txt";//里面的IP无法访问本站
$redhat["copyright"]="Copyright(c)[2002-2002] http://2002.buyionline.net All Rights Reserved ";//版权信息
$redhat["redhat"]="Redhat";//程序作者
$redhat["mail"]=array("redhat@2002.buyionline.net","zxhcxd@163.net","redhat@hnwj.net");//邮箱
$redhat["ip"]=$HTTP_SERVER_VARS["REMOTE_ADDR"]; //访问者的IP
$redhat["ipfrom"]="";//把IP转换成地理位置的值
$redhat["onlinetime"]=900;//在线人数多少时间不在就掉线处理
$redhat["time"]=time();//当前时间
$redhat["homepage_name"]="PHP开放代码";//站点名称
$redhat["homepage_url"]="http://2002.buyionline.net";//站点URL
$os=$HTTP_SERVER_VARS["HTTP_USER_AGENT"];//访问者操作系统与浏览器
//------------------变量定义结束------------------//
?>