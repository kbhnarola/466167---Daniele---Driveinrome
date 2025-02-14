<?php
$password = "password"; //Change to whatever you want your password to be
$passWrong = false;
if (isset($_POST['submit'])) {
    if ($_POST['password'] == $password) {
        //EXECUTE YOUR CODE HERE
        echo "welcome to the password protected area!";
    } else {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>Password Required</title>
        </head>

        <body>
            <h1 style="text-align:center;">Password Required</h1>
            <form method="post" style="text-align:center;">
                <p><input type="password" autocomplete="current-password" name="password" /></p>
                <p>sorry the password were incorrect</p>
                <p><input type="submit" value="Submit Password" name="submit" /></p>
            </form>
        </body>

        </html>
    <?php
        exit();
    }
} else { //IF THE FORM WAS NOT SUBMITTED
    //SHOW FORM
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Password Required</title>
    </head>

    <body>
        <h1 style="text-align:center;">Password Required</h1>
        <form method="post" style="text-align:center;">
            <p><input type="password" autocomplete="current-password" name="password" /></p>
            <p><input type="submit" value="Submit Password" name="submit" /></p>
        </form>
    </body>

    </html>
<?php
    exit();
}
