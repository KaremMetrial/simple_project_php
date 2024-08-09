<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>

<?php
$message = '';

//check form has been submitted
if (isset($_POST['submit'])) {

    // Sanitize and validate input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // Check for empty fields
    if (empty($email) || empty($username) || empty($password)) {
        $message = 'Please fill out all fields.';

        // Validate email format
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';

        // Check password length
    } elseif (strlen($password) < 6) {
        $message = 'Password must be at least 6 characters long.';
    } else {
        try {

            // Prepare a statement to check if the email already exists
            $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // If email is already registered, set an error message
            if ($stmt->rowCount() > 0) {
                $message = 'This email is already registered.';
            } else {

                // Hash the password for secure
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare a statement to insert the new user into the database
                $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (:email, :username, :password)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->execute();
                // Set a success message
                $message = 'Registration successful!';
            }
        } catch (PDOException $e) {
            // Catch and display any errors
            $message = "Error: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<main class="form-signin w-50 m-auto">
    <form method="POST" action="register.php">
        <h1 class="h3 mt-5 fw-normal text-center">Please Register</h1>

        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
            <label for="floatingEmail">Email address</label>
        </div>

        <div class="form-floating">
            <input name="username" type="text" class="form-control" id="floatingUsername" placeholder="Username" required>
            <label for="floatingUsername">Username</label>
        </div>

        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        <h6 class="mt-3">Already have an account? <a href="login.php">Login</a></h6>

        <!-- Display any messages to the user -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-info mt-3"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
    </form>
</main>

<?php require "includes/footer.php"; ?>
