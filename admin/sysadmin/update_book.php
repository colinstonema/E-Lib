<?php 
	session_start();
	if(@$_SESSION['admin_value']=="")
	{
		Header("Location: ../");
	}
		if(@$_SESSION['is_super']=="0")
	{
		echo "<br><br><br><h3>權限不足</h3><br><br>";
		exit;
	}
?>
<?php
	$id=$_GET['id'];
	include("../../dbconf.php");
	$sql="select * from bookinfo where bookid='".$id."'";
	$rows=mysqli_query($link,$sql);
	$num=mysqli_num_rows($rows);
	$row=mysqli_fetch_row($rows);
	$htmlData=$row[4];
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>修改圖書信息</title>
	<link rel="stylesheet" type="text/css" href="admin.css"/>
	<link rel="stylesheet" href="../../editor/themes/default/default.css" />
	<link rel="stylesheet" href="../../editor/plugins/code/prettify.css" />
	<script charset="utf-8" src="../../editor/kindeditor.js"></script>
	<script charset="utf-8" src="../../editor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="../../editor/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content1"]', {
				cssPath : '../../editor/plugins/code/prettify.css',
				uploadJson : 'upload_json.php',
				fileManagerJson : 'file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
</head>
<body>
	<?php
	$id=$_GET['id'];
	 include("../../dbconf.php");
	$sql="select * from bookinfo where bookid='".$id."'";
	$rows=mysqli_query($link,$sql);
	$num=mysqli_num_rows($rows);
	$row=mysqli_fetch_row($rows);
	?>
	<div style="text-align:center">
	<div style="margin: 2 auto; text-align:left;">
	<img src="../../public/img/news.gif" height=30>E-LIB館藏圖書信息修改
	<a class="myButton" style="float:right" href="book_m.php"><span>返回</span></a> 
	<hr>
	<form name="example" method="post" action="upadate_book_result.php">
	<p>書籍編號：<input type="text" name="bookID" size=10 readonly <?php echo "value=\"".$row[0]."\"" ?> /> *不可修改  書名：<input type="text" name="bookname"  size=50 <?php echo "value=\"".$row[1]."\"" ?> /> *必填</p>
	<p>ISBN：<input type="text" name="ISBN" size=70 <?php echo "value=\"".$row[2]."\"" ?> />  *必填</p>
	<p>出版社：<input type="text" name="publisher" size=70 <?php echo "value=\"".$row[3]."\"" ?> /> *必填</p>
	<p>簡介：<textarea name="content1" style="width:780px;height:250px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea></p>
	<p>剩餘數量：<input type="text" name="sysl" size=70 <?php echo "value=\"".$row[5]."\"" ?> /> *必填</p>
	<p><input type="submit" class="addBu" name="button" value="修改" style="margin-left:140px;" />
	<input type="reset" class="addBu" name="button" value="重置" style="margin-left:170px;" /></p></form>
	</div>
	</div>
</body>
</html>

