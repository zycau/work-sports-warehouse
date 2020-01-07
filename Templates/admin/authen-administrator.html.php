<div class="panel">
	<?php if(count($admin)>1): ?>
	<table>
		<thead>
			<tr>
				<th>Username</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($admin as $v): ?>				
			<?php if($v['username'] != $_SESSION['username']): ?>
			<tr>
				<td><?= $v['username'] ?></td>
				<td><a href="authen-administrator.php?name=<?= $v['username'] ?>&act=delete" class='delete' data-name="<?= $v['username'] ?>">Delete</a></td>
			</tr>
			<?php endif; ?>
			<?php endforeach; ?>
		</tbody>		
	</table>
	<?php else: ?>
	<p>There is no other users!</p>
	<?php endif; ?>
	<p class='msg'><?= $message ?></p>
	<form action="authen-administrator.php" method="post">
		<fieldset>
			<legend>Create New User</legend>
			<p>
				<label for="newUser">Username:</label>
				<input type="text" name='newUser' id='newUser'>
			</p>
			<p>
				<label for="newUserPw">Password:</label>
				<input type="password" name='newUserPw' id='newUserPw'>
			</p>
			<p>
				<label for="repUserPw">Confirm Password:</label>
				<input type="password" name='repUserPw' id='repUserPw'>
			</p>
		</fieldset>
		<p>
			<input type="submit" name="submitNewUser" value='Confirm'>
		</p>
		
	</form>

</div>



<!-- 
in: $admin, $message
out: submitNewUser (newUser, newUserPw, repUserPw)
-->