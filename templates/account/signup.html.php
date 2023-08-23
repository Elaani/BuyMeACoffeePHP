<div class="center">
    <form method="POST" action="<?= site_url('/signup') ?>">
        <p>
            <label for="name">Name:</label>
            <input type="text" name="fullname" id="name" required="required">
        </p>

        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required="required">
        </p>

        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required="required">
        </p>
        <p>
            <button type="submit" name="signup_submit" value="1">Sign Up</button>
        </p>
    </form>
</div>