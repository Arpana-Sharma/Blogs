<html>
    <head>
        <style>
        .error {
            color: #FF0000;
        }
        #contact label {
			color: white;
		}

		#contact-btn:hover {
			background-color: rgb(128, 9, 9);
			color: white;
			opacity: 1.1;
		}

		#contact-btn {
			border: 2px solid white;
			border-radius: 30px;
			cursor: pointer;
			display: block;
			font-size: 1.8rem;
			width: 133px;
			height: 47px;
			opacity: 0.48;
			align-items: center;
			justify-content: center;
			margin: auto;
			margin-top: 50px;
			background-color: black;
			color: white;
		}

		#contact h1 {
			text-align: center;
			font-size: 3.5rem;
			color: white;
			padding: 40px 10px;
			padding-bottom: 20px;
		}

		#contact::before {
			background-color: black;
			content: "";
			position: absolute;
			background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('coffee.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			height: 100%;
			width: 100%;
			z-index: -1;
			opacity: 1.89;
		}

		#contact {
			position: relative;
		}

		#contact-box {
			display: flex;
			justify-content: center;
			align-items: center;
			padding-bottom: 34px;
			margin-bottom: 50px;
		}

		#contact-box input,
		#contact-box textarea {
			width: 100%;
			padding: 0.5rem;
			border-radius: 9px;
			font-size: 1.1rem;
			color: white;
		}

		input {
			background: transparent none repeat scroll 0 0;
			border: 1px solid #f5f2f2;
			box-shadow: none;
			color: #3f3f3f;
			font-size: 14px;
			/* height: 32px; */
			/* padding-left: 20px; */
			/* width: 100%; */
		}

		#contact-box form {
			width: 25%;
		}

		#contact-box label {
			font-size: 1.3rem;
			font-family: 'Bree Serif', serif;

		}
        #success{
            display: block;
            padding: 10px;
            text-align: centre;
            color: white;
        }
        .form-group{
            color: white;
        }
        </style>
    </head>
    <body> 
        
        <?php
            $name = $email = $message = $passwd = "";
            $nameErr = $emailErr = $passwdErr = "";
            $e = 0;

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $nameErr = "Name is required";
                    $e = 1;
                } else {
                    $name = test_input($_POST["name"]);
                }
                
                if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                    $e = 1;
                } else {
                    $email = test_input($_POST["email"]);
                }
            
                if(!preg_match("/^[a-zA-Z-']*$/",$name)){
                    $nameErr = "Only letters and white space allowed";
                    $e = 1;
                }
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Invalid Email";
                    $e = 1;
                }
                if($e == 0){
                    $message = "You have been successfully logged in";
                }
            }  
        ?>
        <section id="contact">
            <h1 id="h">Login</h1>
            <div id="contact-box">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                    <div class="form-group">
                        Name: <input type="text" name="name">
                        <span class="error">* <?php echo $nameErr;?></span>
                        <br><br>
                    </div>
                    <div class="form-group">
                        E-mail: <input type="text" name="email">
                        <span class="error">* <?php echo $emailErr;?></span>
                        <br><br>
                    </div>
                    <div class="form-group">               
                        Password: <input type="password" name = "password">
                        <span class="error">* <?php echo $passwdErr;?></span>
                        <br><br>
                    </div>           
                    <div>
                        <input type="submit" name="submit" value="Submit" id = "btn">
                        <span id = "success"> <?php echo $message;?></span>
                        <br><br>
                    </div>
                </form>
                <p id = "last"></p>
            </div>
        </section>        
        <?php
            if($e == 0){
                $name = htmlspecialchars($name);
                $email = htmlspecialchars($email);
                $passwd = htmlspecialchars($passwd);
                $servername = "localhost";
                $username = "root";
                $password = "";
                $conn = mysqli_connect($servername,$username,$password);
                if(!$conn){
                    echo "Could not connect to MySQL <br>";
                }
                $sql = "create database mydata4;";
                mysqli_query($conn,$sql);
                $sql2 = "CREATE TABLE `mydata4`.`candidate` ( `sNo` INT(3) NOT NULL AUTO_INCREMENT , `Name` VARCHAR(30) NOT NULL , `Email` VARCHAR(20) NOT NULL , `Password` VARCHAR(50));";
                $sql4 = "use mydata4;";
                mysqli_query($conn,$sql2);
                mysqli_query($conn,$sql4);
                // echo $name . $email;
                $sql3 = "INSERT INTO `candidate` (`Name`, `Email`, `Password`) VALUES ('$name' , '$email' , '$passwd');";
                mysqli_query($conn,$sql3);
                $_POST = array();
            }
        ?>
        
    </body>
</html>