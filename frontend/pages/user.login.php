<?php

function UserLoginAction(): string {
    return "
    <script> 
        document.getElementById('login-form-id').addEventListener('submit', event => {
    event.preventDefault();
    const form = document.getElementById('login-form-id')
    const data = new FormData(form)
    const object = {}
    data.forEach((value, key) => {
        object[key] = value
    })

    fetch(
        'http://diegonoches.ninja/lyricnote/web/backend/api.php?route=auth', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(object)
        }
    ).then(response => {
        if (!response.ok) {
            alert('Hubo un error')
        }

        response.json().then(data => {
            const token = data.token;
            if (!token) {
                alert('Nombre o contraseña incorrectos')
                return
            }
            
            localStorage.setItem('lyricnote_token', token)
            alert('Bienvenido')
        })
    }).catch(error => {
        console.error(error)
    })


});
    </script>
    ";
}

function UserLogin(): string {
    $action = UserLoginAction();

    return "
    <link rel='stylesheet' href='http://diegonoches.ninja/lyricnote/web/frontend/style/login.css'>
    <div class='login-container'>
        <div class='login-form-container'>
            <h2>Inicia Sesión</h2>
            <form class='login-form' id='login-form-id'>
                <div>
                    <div>
                        <label for='username'></label>
                        <input class='login-input login-text' placeholder='Usuario' type='text' name='username' id='username' required>
                    </div>
                    <div>
                        <label for='password'></label>
                        <input class='login-input login-text' placeholder='Contraseña' type='password' name='password' id='password' required>
                    </div>
                </div>
                <div class='login-button-wrapper'>
                    <input class='login-input login-button' type='submit' value='CONFIRMAR'>
                </div>
            </form>

            <p class='form-extra-text'><span><a href='user/register.php'>Registrate dando clic aquí</a></span></p>
        </div>
    </div>
    $action
    ";
}