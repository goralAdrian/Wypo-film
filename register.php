<?php
include("includes/dbConfig.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<head>
    <title>REGISTER</title>
    <link rel="stylesheet" type="text/css" href="assets/style/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
<?php
if (isset($_POST['registerButton'])) {
    echo '<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
} else {
    echo '<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>';
}

?>

<div id="background">
    <div id="loginContainer">
        <div id="inputContainer">
            <form id="loginForm" action="register.php" method="POST">
                <h2>LOGIN TO YOUR ACCOUNT</h2>
                <p>
                    <?php echo $account->getError(Constants::$incorrectCredits) ?>
                    <label for="usernameBox">Nazwa użytkownika</label>
                    <input id="usernameBox" name="usernameBox" type="text" placeholder="Nazwa użytkownika" required>
                </p>
                <p>
                    <label for="passwordBox">Hasło</label>
                    <input id="passwordBox" name="passwordBox" type="password" placeholder="Hasło" required>
                </p>
                <button id="loginButton" type="submit" name="loginButton">Log In</button>

                <div class="hasAccountText">
                    <span id="hideLogin">Don't have an account yet? Signup here.</span>
                </div>
            </form>
            <form id="registerForm" action="register.php" method="POST">
                <h2>Create your free account</h2>
                <p>
                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$checkUsernameQuery); ?>
                    <label for="loginBox">Nazwa użytkownika</label>
                    <input id="loginBox" name="loginBox" type="text" placeholder="Nazwa użytkownika" required
                           value="<?php getInputValue('loginBox') ?>" >
                </p>
                <p>
                    <?php echo $account->getError(Constants::$checkEmailQuery) ?>
                    <label for="emailBox">E-mail</label>
                    <input id="emailBox" name="emailBox" type="text" placeholder="E-mail" required
                           value="<?php getInputValue('emailBox') ?>">
                    <?php echo $account->getError(Constants::$emailInvalid); ?>

                </p>
                <p>
                    <?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordCharacters); ?>
                    <label for="pswrdBox">Hasło</label>
                    <input id="pswrdBox" name="pswrdBox" type="password" placeholder="Hasło" required
                    >
                </p>
                <p>
                    <label for="pswrd2Box">Potwierdź hasło</label>
                    <input id="pswrd2Box" name="pswrd2Box" type="password" placeholder="Hasło" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <label for="nameBox">Imię</label>
                    <input id="nameBox" name="nameBox" type="text" placeholder="Imię"
                           value="<?php getInputValue('nameBox') ?>">
                </p>
                <p>
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <label for="surnameBox">Nazwisko</label>
                    <input id="surnameBox" name="surnameBox" type="text" placeholder="Nazwisko"
                           value="<?php getInputValue('surnameBox') ?>">
                </p>
                <button id="registerButton" type="submit" name="registerButton">Sign Up</button>
                <div class="hasAccountText">
                    <span id="hideRegister">Already have an account? Log in here.</span>
                </div>
            </form>


        </div>
    </div>
</div>
</body>
</html>
