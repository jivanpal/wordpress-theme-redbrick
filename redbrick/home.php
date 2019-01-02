<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main class="fallback">
    <ul class="showcase">
        <li class="showcase-item"><a href="#">
            <div class="temp-container"><img class="thumbnail" src="#"/></div>
            <h1 class="title">Article One</h1>
        </a></li>
        <li class="showcase-item"><a href="#">
            <div class="temp-container"><img class="thumbnail" src="#"/></div>
            <h1 class="title">Article Two</h1>
        </a></li>
        <li class="showcase-item"><a href="#">
            <div class="temp-container"><img class="thumbnail" src="#"/></div>
            <h1 class="title">Article Three</h1>
        </a></li>
        <li class="showcase-item"><a href="#">
            <div class="temp-container"><img class="thumbnail" src="#"/></div>
            <h1 class="title">Article Four</h1>
        </a></li>
        <li class="showcase-item"><a href="#">
            <div class="temp-container"><img class="thumbnail" src="#"/></div>
            <h1 class="title">Article Five</h1>
        </a></li>
    </ul>
    <div class="banner">
        <div class="declaration-container"><div class="declaration-content">AD</div></div>
        <?php /* TODO: Make the content of `.banner` and the link here admin-configurable */ ?>
        <a href="#"><div class="content">Banner content</div></a>
    </div>
    <p>This is the main body of the home page.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut molestie ex
        eleifend tellus condimentum, non lacinia urna facilisis. Mauris non
        ultricies felis. Phasellus posuere neque neque. Aliquam quis enim ut sem
        pulvinar lobortis vel quis sem. Donec nulla justo, rutrum nec nulla
        vitae, iaculis fermentum eros. Aliquam ullamcorper, purus sed hendrerit
        pharetra, eros augue finibus orci, non semper dui felis sed nulla.
        Quisque vestibulum consequat turpis. Duis aliquam arcu egestas mi
        accumsan,eget euismod diam vestibulum. Fusce quis malesuada nunc.
        Vestibulum pretium lacinia quam nec pulvinar. Vivamus vitae velit sit
        amet magna vehicula aliquet. Sed elit mi, condimentum et purus ornare,
        blandit lobortis libero. Duis viverra metus eu efficitur consequat.</p>
    <p>Curabitur feugiat felis vel dictum convallis. Mauris nec magna porta,
        suscipit ante eu, tempus metus. Lorem ipsum dolor sit amet, consectetur
        adipiscing elit. In venenatis lacus non massa condimentum tincidunt.
        Nullam non justo dictum, consequat odio eget, dapibus justo. Vestibulum
        at ante id justo luctus suscipit non id turpis. Sed fringilla rutrum
        ligula, in placerat neque dapibus id. Suspendisse vestibulum ante
        sapien, rhoncus porttitor tortor mattis eget. Orci varius natoque
        penatibus et magnis dis parturient montes, nascetur ridiculus mus.
        Pellentesque lobortis arcu ligula, eget ultrices magna dignissim eget.
        Integer id leo at felis lacinia imperdiet. Ut viverra dui id interdum
        tempor.</p>
    <p>Pellentesque lectus nibh, convallis non nisi in, lobortis porttitor
        justo. Suspendisse condimentum nec lorem eget pulvinar. Cras dapibus
        eget ipsum vel fermentum. Integer ac felis porta, aliquam felis et,
        pharetra orci. Ut non metus elit. Quisque sapien lorem, congue ut dui
        vitae, dictum dignissim velit. Etiam aliquet in diam id eleifend. Ut at
        diam elit. Sed posuere nec sapien id tempor.</p>
    <p>Quisque fringilla sollicitudin orci, at malesuada nisl elementum sed.
        Quisque mattis gravida eros eu ultricies. Quisque vehicula, lectus eu
        dignissim mattis, dolor leo fringilla nisi, quis pharetra augue ante ut
        nibh. In blandit luctus velit, quis consequat purus mattis eget. Morbi
        consectetur facilisis tellus sit amet volutpat. Sed suscipit est ac mi
        dapibus viverra. Vestibulum tincidunt consequat tellus vel bibendum.</p>
    <p>Nunc placerat viverra metus, nec molestie turpis posuere in. Pellentesque
        ultrices ultricies tortor, posuere mollis lectus aliquet ac. Aliquam
        erat volutpat. Vivamus pellentesque est vitae orci ornare dignissim.
        Quisque faucibus eros sit amet rhoncus venenatis. In pretium tincidunt
        blandit. Maecenas tristique quis eros et vehicula. Quisque vitae sodales
        nunc. Proin magna sem, vehicula nec sollicitudin at, cursus sit amet
        justo. Vestibulum scelerisque mattis laoreet. Pellentesque euismod dui
        nunc, sit amet vulputate leo dignissim a. Proin condimentum dictum
        ligula, quis eleifend dui euismod a.</p>
</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
