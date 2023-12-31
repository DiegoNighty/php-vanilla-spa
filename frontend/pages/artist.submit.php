<?php

function SubmitArtist(): string {
    return '
    <form action="../../backend/controller/artist.controller.php" method="post">
        <label for="artist_name">
            Artista:
        </label>
        <input type="text"
               name="artist_name"
               id="artist_name"
               required
               placeholder="The Weeknd"
        >
    
        <label for="artist_description">
            Descripción:
        </label>
        <input type="text"
               name="artist_description"
               id="artist_description"
               required
               placeholder="Abel Makkonen Tesfaye, conocido artísticamente como The Weeknd, es un cantante, rapero, compositor, productor discográfico y actor canadiense nacionalizado estadounidense."
        >
    
        <label for="artist_avatarURL">
            Foto:
        </label>
        <input type="url"
               name="artist_avatarURL"
               id="artist_avatarURL"
               placeholder="https://imgur.com/2321031.png"
               pattern="(http(s?):)|([/|.|\w|\s])*\.(?:jpg|gif|png)"
               oninput="renderImage()"
        >
        <img class="avatar" id="artist_avatar_img" style="display: none;" src="https://www.clipartkey.com/mpngs/m/152-1520367_user-profile-default-image-png-clipart-png-download.png" alt="Imagen del artista">
</form>

<script>
    function renderImage() {
        const avatarDisplay = document.querySelector("#artist_avatar_img")
        let value = document.querySelector("#artist_avatarURL").value

        avatarDisplay.style.display = "block"
        avatarDisplay.src = value
    }
</script>
    ';
}