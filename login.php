<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher | Login</title>
    <link href="style.css" rel="stylesheet"/>
    <script>
        <!--
        function jsEnc(orgval){

            
            var pass = sha512(orgval);
            System.out.print(pass);

            //find online and return value of encrypted password
        }


        function encpwd(){
            var orgval = document.getElementByName('password').value;
            //call JS encryption method here
            var encVal = jsEnc(orgval);

            document.getElementByName('encKey').value = encVal;

        }

        -->
    </script>
</head>
<body>
    <center>
        <img src = "vmilogo.svg" id = "logo">
        <h1>E-Section Marcher</h1>
        <h2>Login to VMI Account</h2>
        <h3 style = "color: #ae122a;">Enter @vmi.edu email address</h3>

        <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<h2 style = 'color: #ae122a;'>$error</h2>";
                    }
                ?>


    <div class = "loginForm" border = "solid">
    <form class = "cadetLogin" action = "validateLogin.php" method="post" >

     
        <table class = "loginTable">
            <tr class="emailLog">
                <td><label>Email:</label></td>

                <td><input id = "email" name = "email" type = "email" required></td>
            </tr>
            <tr>
                <td><label class = "passLog">Password:</label></td>
                <td><input id = "password" name = "password" type = "password" required></td>
                <input type = "hidden" name = "encKey" >
            </tr>
            <tr>
                <td align = "center" colspan="2" class = "submitLine"><input type = "submit" name = "submit" id = "submitBtn"></td>
            </tr>
            </tr>
        </table>
    </form>  
    </div>
    <footer class="six" style = "margin-top: 5.5%;">
        <center>
            <p>&copy; Capstone Team 6</p>
        </center>
    </footer>
</center>

</body>
</html>

<?php
    unset($_SESSION["error"]);
?>