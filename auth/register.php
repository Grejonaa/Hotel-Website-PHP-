<?php

session_start();

require_once "../includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validation
    if (
        empty($fullname) ||
        empty($email) ||
        empty($password)
    ) {

        $message = "Please fill all fields!";

    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Invalid email format!";

    }
    elseif (strlen($password) < 6) {

        $message = "Password must be at least 6 characters!";

    }
    else {

        try {

            // Check if email exists
            $checkStmt = $conn->prepare(
                "SELECT id FROM users WHERE email = ?"
            );

            $checkStmt->bind_param("s", $email);

            $checkStmt->execute();

            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {

                $message = "Email already exists!";

            } else {

                // Hash password
                $hashedPassword = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                // Insert user
                $stmt = $conn->prepare(
                    "INSERT INTO users(fullname,email,password,role)
                     VALUES(?,?,?,?)"
                );

                $role = "client";

                $stmt->bind_param(
                    "ssss",
                    $fullname,
                    $email,
                    $hashedPassword,
                    $role
                );

                if ($stmt->execute()) {

                    $_SESSION["success"] =
                        "Registration successful!";

                    header("Location: login.php");
                    exit();

                } else {

                    $message = "Registration failed!";
                }
            }

        } catch (Exception $e) {

            $message = "Something went wrong!";
        }
    }
}
?>

<?php include "../includes/header.php"; ?>

<div class="login-container">

    <h2>Register</h2>

    <form method="POST">

        <input
            type="text"
            name="fullname"
            placeholder="Full Name"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Email"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <button type="submit">
            Register
        </button>
        <p style="margin-top: 10px;margin-bottom:10px;">
    Already have an account?
    <a href="login.php">Login here</a>
        </p>

    </form>

    <?php if ($message): ?>

        <p class="error-msg">
            <?php echo htmlspecialchars($message); ?>
        </p>

    <?php endif; ?>

</div>