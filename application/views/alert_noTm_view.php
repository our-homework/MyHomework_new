<div id="wrap">
	<div id	="alert">未加入小组</div>
	<div id="button">
		<a href="#"><input onclick="window.location.href('#')" type="button" class="button" value="创建" /></a>
		<a href="#"><input type="button" class="button" value="加入" /></a>
		<a href="#"><input type="reset" class="button" value="取消" /></a>
	</div>
	<div id="errMsg"><?= isset($errorMsg) ? $errorMsg : '' ?></div>
</div>