<?php /* Smarty version 2.6.14, created on 2013-01-10 13:45:22
         compiled from uploadfile.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->_tpl_vars['charset']; ?>
" lang="<?php echo $this->_tpl_vars['charset']; ?>
">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['charset']; ?>
" />
    <meta http-equiv="Content-Language" content="<?php echo $this->_tpl_vars['charset']; ?>
" />
    <title>文件上传</title>
    <style>
    body,form,input {margin:0;font:normal 12px "宋体"}
    body {text-align:center;background:#EFF0F5}
    form {width:360px;margin:15px auto;text-align:left}
    div {font-size:14px;font-weight:bold;color:#26435E;display:block}
    input.button {border:1px solid #ADBBCA;padding:3px 3px 1px 3px;background:#DCE1E7;color:#26435E}
    input.upload {border:1px solid #ADBBCA;padding:2px 3px 2px 3px;background:#FFF;color:#26435E}
    </style>
</head>

<body>

<form action="?action=upload" method="post" enctype="multipart/form-data" name="uploadfile">
<div>请选择您要上传的文件：</div>
<input name="upfile" type="file" size="50" style="margin:8px 0" class="upload" />
<center>
<input type="submit" name="Submit" value="开始上传" class="button" />&nbsp;&nbsp;
<input type="button" name="close" value="关闭窗口" onClick="self.close()" class="button" />
<input type="hidden" name="fName" value="<?php echo $this->_tpl_vars['fName']; ?>
" />
<input type="hidden" name="cName" value="<?php echo $this->_tpl_vars['cName']; ?>
" />
<input type="hidden" name="IsImage" value="<?php echo $this->_tpl_vars['IsImage']; ?>
" />
</center>
</form>
</body>
</html>
<script language="javascript" type="text/javascript">
document.uploadfile.onsubmit = function() {
    if (this.upfile.value.length<5){
        alert('请选择您要上传的文件!');
        this.upfile.focus();
        return false;
    }
}
</script>