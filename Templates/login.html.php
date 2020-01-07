
<div id='login-wraper'>    
    <form action="login.php" method="post" class='login-form'>
        <fieldset class='form-field'>
            <legend>Administrator Login</legend>
            <p>
                <label for="username" >Username:</label>
                <input type="text" id='username' name='username' placeholder="John" />                
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" id='password' name='password' placeholder='123456' />                
            </p>            
        </fieldset>
        <p><input type="submit" name='loginSubmit' value='Log in'></p>
        <p class='login-message'><?= $message ?></p>
    </form>
</div>

<!-- 
in: $message    
out: loginSubmit (username, password) -->