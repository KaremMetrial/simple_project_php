<?php require "includes/header.php"; ?>

<main class="form-signin w-50 m-auto">
    <form method="post" action="login.php">
<!--         <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
        <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" aria-label="Email address" required>
            <label for="floatingEmail">Email address</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingUsername" placeholder="user.name" aria-label="Username" required>
            <label for="floatingUsername">Username</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" aria-label="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <h6 class="mt-3">Don't have an account? <a href="register.php">Create your account</a></h6>
    </form>
</main>
<?php require "includes/footer.php"; ?>
