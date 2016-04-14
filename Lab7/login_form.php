<?php
	echo'							
        <form action="login.php" method="post" name="login">
            <h1>Login</h1>
            <ul>
                <li class="username">
                    <input name = "email" type = "text" class = "login-input" />
                </li>
                <li class="password">
                    <input name = "password" type = "password" class = "login-input" />
                </li>
            </ul>
            <input type = "submit" value = "Entrar" name = "Entrar"/>
        </form>';
?>