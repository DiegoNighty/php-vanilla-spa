<?php
function UserLogin(): string {
    return '
    <link rel="stylesheet" href="../frontend/style/login.css">
    <div class="login-container">
        <div class="login-form-container">
            <h2>Inicia Sesión</h2>
            <form class="login-form" action="index.html" method="post">
                <div>
                    <div>
                        <label for="mail"></label>
                        <input class="login-input login-text" placeholder="Email" type="text" name="mail" id="mail" required>
                    </div>
                    <div>
                        <label for="password"></label>
                        <input class="login-input login-text" placeholder="Password" type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="login-button-wrapper">
                    <input class="login-input login-button" type="submit" value="CONFIRMAR">
                </div>
            </form>

            <p class="form-extra-text"><span><a href="user/register.php">Registrate dando clic aquí</a></span></p>
        </div>
    </div>
    ';
}