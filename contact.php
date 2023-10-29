<?php
require_once './php/user.class.php';
require_once './php/session.class.php';
require_once './php/database.class.php';
require_once './php/query.class.php';
$user = Session::getUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact | Secure Website</title>
    <meta name="description" content="About author.">
    <meta name="keywords" content="HTML, CSS, PHP, JavaScript, jQuery, secure, website">
    <meta name="author" content="Ivan Šincek">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="./css/main.css" hreflang="en" type="text/css" media="all">
    <script src="./js/jquery.js"></script>
    <script src="./js/main.js" defer></script>
</head>

<body class="background-img">
    <?php require_once './components/navigation.php'; ?>
    <div class="about">
        <h1>Contact Us</h1>
        <?php
        if(isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) === 'post'){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];
            if (empty($username) || empty($email) || empty($subject) || empty($message)) {
                echo "<p>Please fill in all the required fields.</p>";
            } else {
                $params = array(
                    'username' => $username,
                    'email' =>$email,
                    'subject' => $subject,
                    'message' => $message,
                );
                // Insert the contact form data into the database
                $query = Query::insert('INSERT INTO `contacts` (`username`, `email`, `subject`, `message`) VALUES (:username, :email, :subject, :message)', $params);
                print_r($query);
                if ($query) {
                    if ($query) {
                        echo "<p>Thank you for your message. We will get back to you soon.</p>";
                    } else {
                        echo "<p>Email could not be sent. Please try again later.</p>";
                    }
                } else {
                    echo "<p>Oops! Something went wrong. Please try again later.</p>";
                }
            }
        }


        ?>
        <div class="front-form">
            <div class="layout">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <label for="Username">Username:</label>
                    <input type="text" id="Username" name="username" required>

                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                    <br />
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>

    </div>
    <?php require_once './components/footer.php'; ?>
</body>

</html>