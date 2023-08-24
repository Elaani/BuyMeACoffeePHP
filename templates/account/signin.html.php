<div class="center">
    <form method="post" action="<?= site_url('/signin') ?>">
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required="required">
        </p>

        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required="required">
        </p>

        <p>
            <button type="submit" name="signin_submit" value="1">Sign In</button>
        </p>
    </form>
</div>
<!-- all clear -->