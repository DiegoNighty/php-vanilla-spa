<?php
function Home(): string {
    return "
    <link rel='stylesheet' href='/frontend/style/home.css'>

    <section class='hero'>
        <h2 class='logo-icon-big'>LyricNote</h2>
        <p class='slogan'>Descubre tu banda sonora perfecta.</p>
        
        <p class='description'>Explora, encuentra y disfruta de la música que se ajusta a tu estado de ánimo.</p>
    </section>
    
       <section class='features'>
        <div class='feature'>
            <h3 class='feature-title'>Explora</h3>
            <p class='feature-description'>Explora la música que se ajusta a tu estado de ánimo.</p>
        </div>
        <div class='feature'>
            <h3 class='feature-title'>Encuentra</h3>
            <p class='feature-description'>Encuentra la música que se ajusta a tu estado de ánimo.</p>
        </div>
        <div class='feature'>
            <h3 class='feature-title'>Disfruta</h3>
            <p class='feature-description'>Disfruta la música que se ajusta a tu estado de ánimo.</p>
        </div>
    </section>
    ";
}