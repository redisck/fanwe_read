<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
<title>方维o2o商业系统安装程序  -- 升级向导</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/style.css" />
<script type="text/javascript" src="__TMPL__Public/js/jquery.js"></script>
<script type="text/javascript" src="__TMPL__Public/js/script.js"></script>

</head>
<body>
<div class="install block">
<form name="install" action="<?php echo u("Index/do_update");?>" method="POST" target="update_msg" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  	<td colspan="2" style="height:10px;">
	  		
	  	</td>
	  </tr>
	  <tr>
	  	<td colspan="2">
	  		
				请确保update目录下有升级脚本update.sql&nbsp;&nbsp;
			<input type="button" value="立即升级" id="update" onclick="do_update();" />
	  	</td>
	  </tr>
	  <tr>
	  	<td colspan="2" style="text-align: center;">
	  		方维o2o商业系统
	  	</td>
	  </tr>
	</table>
</form>

<iframe class="msg" name="update_msg">

</iframe>	
</div>

</body>
</html>