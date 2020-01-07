
<div id='authen-user'>
	<h2>^_^ <?= $_SESSION['username'] ?>, welcome to SportsWarehouse administration system.</h2>
	<div class="panel">
		<div>
			<a href="authen-user.php?fun=theme">Select a theme</a>
			<a href="authen-user.php?fun=pw">Change password</a>
		</div>
		<div>
			<!-- 如果点击了theme，则可以更换用户主题 -->
			<?php if($_SESSION['fun']=='theme'): ?>
			<?php $themeArr = [['warm','Warm theme'],['cold','Cold theme']]; ?>
				<form action="authen-user.php" method='post'>
					<fieldset>
						<legend>Choose Theme</legend>
						<select name='themes' id='themes'>
							<?php foreach ($themeArr as $v): ?>
								<?php if($_SESSION['userTheme']==$v[0]): ?>
								<option value="<?= $v[0] ?>" selected><?= $v[1] ?></option>
								<?php else: ?>
								<option value="<?= $v[0] ?>"><?= $v[1] ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</fieldset>
					<p>
						<input type="submit" name="submitTheme" value='Confirm'>
					</p>
				</form>			
			<!-- 如果点击了更改密码 -->
			<?php elseif($_SESSION['fun']=='pw'): ?>
				<form action='authen-user.php' method="post">
					<fieldset>
						<p>
							<label for="curPw">Current Password:</label>
							<input type="password" name='curPw' id='curPw'>
						</p>
						<p>
							<label for="newPw">New Password:</label>
							<input type="password" name='newPw' id='newPw'>
						</p>
						<p>
							<label for="repPw">Repeat Password:</label>
							<input type="password" name='repPw' id='repPw'>
						</p>
					</fieldset>
					<p>
						<input type="submit" name="submitChangePw" value='Confirm'>
					</p>
					<p class='msg'><?= $message ?></p>
				</form>
			
			<?php endif; ?>
		</div>
	</div>
	
</div>

<!-- 
in: $_SESSION['fun'], $_SESSION['userTheme'], $message, 
out: $_GET['fun'], submitTheme (themes), submitChangePw (curPw, newPw, repPw), $_GET['act'], 
-->