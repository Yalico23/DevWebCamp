<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo; ?></h2>
    <p class="devwebcamp__descripcion">Conoce la conferencia mas importante de latinoamerica</p>

    <div class="devwebcamp__grid">
        <div class="devwebcamp__imagen" <?php aos_animation(); ?> >
            <picture>
                <source srcset="/build/img/sobre_devwebcamp.webp" type="image/webp">
            <img loading="lazy"  src="/build/img/sobre_devwebcamp.jpg" alt="nosotros">
            </picture>
        </div>

        <div class="devwebcamp__contenido">
            <p class="devwebcamp__texto" <?php aos_animation(); ?> >Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore totam distinctio porro debitis ex aperiam error temporibus aut ullam, neque corrupti. Atque maiores, aperiam excepturi animi dignissimos eius doloribus cupiditate!</p>
            <p class="devwebcamp__texto" <?php aos_animation(); ?> >Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit consequatur nihil vitae, ad ratione consectetur sequi, ullam dolores optio odio deleniti placeat sed in magnam exercitationem dolorum ipsam, maiores pariatur?</p>
        </div>
    </div>
</main>