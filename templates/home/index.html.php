<!--   Icon Section   -->

<div class="row">
    <h2 class="center blue-text">
        <?php if (! empty($name)) : ?>
            <p>
                Hey <strong>
                    <?= $view->escape($name) ?>!
                </strong>
            </p>
        <?php else : ?>
            <p>Welcome to Sarah's PHP Project!</p>
        <?php endif ?>
    </h2>
</div>

<div class="row">
    <div class="col s12 m4">
        <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Buy Me A Coffee ☕️</h5>

            <p class="light">
                .
            </p>
        </div>
    </div>

    <div class="col s12 m4">
        <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">A place for learning!</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework
                that incorporates components and animations that provide more feedback to users. Additionally, a single
                underlying responsive system across all platforms allow for a more unified user experience.</p>
        </div>
    </div>

    <div class="col s12 m4">
        <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users
                get started. We are also always open to feedback and can answer any questions a user may have about
                Materialize.</p>
        </div>
    </div>
</div>