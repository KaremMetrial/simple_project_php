<?php
require "includes/header.php"; ?>
<?php
require "config.php";
?>
<?php
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
$message = '';
//check form has been submitted
if (isset($_POST['submit'])) {

    // Sanitize and validate input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Check for empty fields
    if (empty($email) || empty($password)) {
        $message = 'Please fill out all fields.';

        // Validate email format
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';

    }else {
        try {
            // Prepare a statement to fetch data
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            //check if a correct password
            if ($data && password_verify($password, $data['password'])) {
//                $message = 'You are now logged in.';
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['username'] = $data['username'];

                header("Location:index.php");
                exit();
            }else {
                $message = "Invalid username or password.";
            }
        } catch (PDOException $e) {
            // Catch and display any errors
            $message = "Error: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<main class="form-signin w-50 m-auto">
    <form method="post" action="login.php">
        <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" aria-label="Email address" required>
            <label for="floatingEmail">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" aria-label="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
        <h6 class="mt-3">Don't have an account? <a href="register.php">Create your account</a></h6>

        <!-- Display any messages to the user -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-info mt-3"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
    </form>
</main>
<?php require "includes/footer.php"; ?>
