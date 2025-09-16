<?php
    include_once 'database.php';
    session_start();  
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function getId($conn, $email) {
    $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $id = '';
        $stmt->bind_result($id);
        $stmt->fetch();
        return $id;
    }
    return null;
}

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $action = $_POST['action'] ?? '';

    if (empty($email) || empty($password)) {
        $message = 'Both fields are required.';
    } 
    elseif (!is_valid_email($email)) {
        $message = 'Invalid email format.';
    } 
    else {
        if ($action === 'signup') {
            // Check if email already exists
            $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $message = 'Email already registered.';
            }
            elseif (empty($_POST['adress']) || empty($_POST['city']) || empty($_POST['fullname'])) {
                $message = 'All fields are required for registration.';
            }
            else {
                // Insert new user
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare('INSERT INTO users (email, password, adress, city, fullname) VALUES (?, ?, ?, ?, ?)');
                $stmt->bind_param('sssss', $email, $hashed, $_POST['adress'], $_POST['city'], $_POST['fullname']);
                if ($stmt->execute()) {
                    $_SESSION['user'] = $email;
                    $_SESSION['user_id'] = getId($conn, $email);
                    header('Location: index.php');
                } else {
                    $message = 'Sign up failed.';
                }
            }
            $stmt->close();
        } elseif ($action === 'login') {
            // Check credentials
            $stmt = $conn->prepare('SELECT password FROM users WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($hashed);
                $stmt->fetch();
                if (password_verify($password, $hashed)) {
                    $_SESSION['user'] = $email;
                    $_SESSION['user_id'] = getId($conn, $email);
                    header('Location: index.php');
                } else {
                    $message = 'Incorrect password.';
                }
            } else {
                $message = 'Email not registered.';
            }
            $stmt->close();
        }
    }
}
?>