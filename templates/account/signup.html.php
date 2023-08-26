<div class="center">
    <h3 class="blue-text">
        Sign up for free today! 🚀
    </h3>

    <div class="row">
        <form method="post" action="<?= site_url('/?uri=signup') ?>" class="col s12">
            <p class="input-field">
                <input type="text" name="name" id="name" required="required">
                <label for="name">Name:</label>
            </p>

            <p class="input-field">
                <input type="email" name="email" id="email" required="required">
                <label for="email">Email:</label>
            </p>

            <p class="input-field">
                <input type="password" name="password" id="password" required="required">
                <label for="password">Password:</label>
            </p>

            <p>
                <button type="submit" name="signup_submit" value="1" class="bold btn-large waves-effect">
                    Sign Up
                </button>
            </p>
        </form>
    </div>
</div>