<?php

session_start();

require_once "../includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Server-side validation
    if (empty($email) || empty($password)) {

        $message = "Please fill all fields!";

    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Invalid email format!";

    } 
    else {

        try {

            // Prepared statement
            $stmt = $conn->prepare(
                "SELECT * FROM users WHERE email = ?"
            );

            $stmt->bind_param("s", $email);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows === 1) {

                $user = $result->fetch_assoc();

                // Verify password
                if (
                    password_verify(
                        $password,
                        $user["password"]
                    )
                ) {

                    // Sessions
                    $_SESSION["user"] = $user["id"];
                    $_SESSION["fullname"] = $user["fullname"];
                    $_SESSION["role"] = $user["role"];

                    // Redirect by role
                    if ($user["role"] === "admin") {

                        header(
                            "Location: ../admin/dashboard.php"
                        );

                    } else {

                        header(
                            "Location: ../index.php"
                        );
                    }

                    exit();

                } else {

                    $message = "Incorrect password!";
                }

            } else {

                $message = "User not found!";
            }

        } catch (Exception $e) {

            $message = "Something went wrong!";
        }
    }
}
?>

<?php include "../includes/header.php"; ?>

<div class="login-container">

    <h2>Login</h2>

    <form method="POST">

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
            Login
        </button>

    </form>

    <p style="margin-top: 10px;margin-bottom:10px;">
        Don't have an account?
        <a href="register.php">
            Register here
        </a>
    </p>

    <?php if ($message): ?>

        <p class="error-msg">

            <?php
                echo htmlspecialchars($message);
            ?>

        </p>

    <?php endif; ?>

</div>