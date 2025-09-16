<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $FirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
    $LastName = isset($_POST['LastName']) ? $_POST['LastName'] : '';
    $EmailID = isset($_POST['EmailID']) ? $_POST['EmailID'] : '';
    $PhoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : '';
    $Country = isset($_POST['Country']) ? $_POST['Country'] : '';
    $PostCode = isset($_POST['PostCode']) ? $_POST['PostCode'] : '';
    $Address = isset($_POST['Address']) ? $_POST['Address'] : '';
    $LinkedInID = isset($_POST['LinkedInID']) ? $_POST['LinkedInID'] : '';

    if (!empty($FirstName) && !empty($LastName) && !empty($EmailID) && !empty($PhoneNumber) && !empty($Country) && !empty($PostCode) && !empty($Address) && !empty($LinkedInID)) {
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "dbms";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        } //else {
            //$SELECT = "SELECT EmailID FROM first WHERE EmailID = ? LIMIT 1";
            $INSERT = "INSERT INTO first (FirstName, LastName, EmailID, PhoneNumber, Country, PostCode, Address, LinkedInID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            //$stmt = $conn->prepare($SELECT);
            //$stmt->bind_param("s", $EmailID);
            //$stmt->execute();
            //$stmt->bind_result($EmailID);
            //$stmt->store_result();
            //$rnum = $stmt->num_rows;

            //if ($rnum == 0) {
                //$stmt->close();

                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("ssssssss", $FirstName, $LastName, $EmailID, $PhoneNumber, $Country, $PostCode, $Address, $LinkedInID);
                $stmt->execute();

                $_SESSION['user_id'] = $conn->insert_id;
                header("Location: second.php");
                exit();
            } //else {
               // echo "Someone already registered using this EmailID";
           // }
            $stmt->close();
            $conn->close();
        }
 //   }
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"  content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color:rgb(245, 245, 245);
            margin:0;
            font-family: 'Times New Roman', Times, serif;
        }
        #new1 {
            background-color: rgb(235, 158, 15);
            height:60px;
            padding:5px;
        }
        #new3 {
            margin-right:400px;
            font-size:40px;
            font-style:italic;
            padding:10px;
        }
        #new2 {
            text-align:center;
            padding:5px;
            font-size:40px;
            color: rgb(69, 68, 68);
            margin:0;
        }
        .divide {
            display: flex;
            justify-content: space-between;
            margin:15px;
        }
        #li {
            margin-right:20px;
            background-color:aliceblue;
        }
        .name {
            font-size:20px;
            width:300px;
            height:35px;
            font-family: 'Times New Roman', Times, serif;
        }
        .error {
            color: rgb(255, 0, 0);
            font-size: 18px;
            margin-top: 6px;
        }
        #continue {
            text-align: center;
            margin-right:30px;
            font-size: 30px;
            border-radius: 10px;
            border: 5px solid rgb(235, 158, 15);
            background-color: rgb(235, 158, 15);
            padding: 10px 20px;
            cursor: pointer;
        }
        #continue:hover {
            background-color: coral;
        }
        #pd {
            padding:10px;
            border-radius:40px;
            margin: 0 auto;
            max-width:800px;
        }
        #form1 {
            display: flex;
            justify-content: space-between;
            margin-bottom:5px;
        }
        #form2 {
            flex:2;
            margin-right:20px;
            position:relative;
            text-align:left;
        }
        #class2 {
            text-align:center;
            margin-bottom:20px;
        }
        li {
            padding:10px;
            color:brown;
        }
        label {
            font-family:'Times New Roman', Times, serif;
            font-size:20px;
            font-style:italic;
        }
        footer {
            background-color: rgb(251, 189, 4);
            padding: 10px;
            text-align: center;
            color: white;
        }
        @media (max-width: 768px) {
            body {
                overflow-x: hidden;
            }
            .divide,
            #new1,
            footer {
                width:100%;
            }
            #class2 {
                margin-right: 0;
            }
        }
        .center{
            max-width:800px;
            margin:0 auto;
        }
    </style>
</head>
<body id="body">
    <form id="mainform" action="first.php" method="post">
        <div id="new1">
            <h1 id="new2"> Curriculum Vitae (CV)</h1>
        </div>

        <div class="divide">
            <div id="li">
                <h1>Contents in the CV</h1>
                <ol>
                    <li><h2>Personal Details</h2></li>
                    <li><h2>Qualifications</h2></li>
                    <li><h2>Skills</h2></li>
                    <li><h2>Work Experience</h2></li>
                </ol>
            </div>
            <div id="class2" class="center">
                <h1  id="new3">Tell us about you</h1>
                <p style="margin-right:200px; font-size:20px; font-style:italic">*Indicates required fields(Please use Capital Letters in starting)</p>

                <div id="pd" >
                    <div id="form1">
                        <div id="form2">
                            <label for="firstname">First Name*</label><br>
                            <input class="name"  type="text" id="fname" placeholder="Eg: Vinod" name="FirstName" required>
                            <p id="finame" class="error"></p>
                        </div>
                        <div id="form2">
                            <label for="lastname">Last Name*</label><br>
                            <input class="name" type="text" id="lname" placeholder="Eg: Kumar" name="LastName" required>
                            <p id="laname" class="error"></p>
                        </div>
                    </div>
                    
                    <div id="form1">
                        <div id="form2">
                            <label for="Emailid">Email ID*</label><br>
                            <input class="name" type="text" id="email" placeholder="Eg: abcd1234@gmail.com" name="EmailID" required>
                            <p id="Email" class="error"></p>
                        </div>
                        <div id="form2">
                            <label for="Phonenumber">PhoneNumber*</label><br>
                            <input class="name" type="tel" id="phone" placeholder="Eg: 999-999-9999" name="PhoneNumber" required>
                            <p id="Phone" class="error"></p>
                        </div>
                    </div>
                    
                    <div id="form1">
                        <div id="form2">
                            <label for="COUNTRY">Country*</label><br>
                            <input class="name"  type="text" id="country" placeholder="Country Name" name="Country" required>
                            <p id="Country" class="error"></p>
                        </div>
                        <div id="form2">
                            <label for="Postcode">Post Code*</label><br>
                            <input class="name"  type="text" id="post" placeholder="Eg: 500001" name="PostCode" required>
                            <p id="Postcode" class="error"></p>
                        </div>
                    </div>
                    
                    <div id="form1">
                        <div id="form2">
                            <label for="ADDRESS">Address*</label><br>
                            <input class="name"  type="text" id="address" placeholder="Eg: Area Name" name="Address" required>
                            <p id="Address" class="error"></p>
                        </div>
                        <div id="form2">
                            <label for="LinkedidID">LinkedIn ID:</label><br>
                            <input class="name"  id="linked" type="text" placeholder="Eg: abcd1234"  name="LinkedInID" required>
                            <p id="LinkedInID" class="error"></p>
                        </div>
                    </div>
                    
                    <button class="continue" id="continue" onclick="return myfunction(event)">Continue</button>

                </div>
            </div>
        </div>
    </form>

    <p style="padding: 30px; font-size: 20px; font-style: italic;">All rights belong to Pavan. If you have any queries, you can contact or mail him.</p>

    <footer>
        <h1>Author: Pavan</h1>
        &copy; All rights reserved<br>
        <a href="tel:+9999999999" style="color: white; text-decoration: none;">+99-99999-999</a><br>
        <a href="mailto:abc@gmail.com" style="color: white; text-decoration: none;">Gmail</a>
    </footer>

    <script>
        function myfunction(){

            const fname = document.getElementById("fname").value.trim();
            const lname = document.getElementById("lname").value.trim();
            const email = document.getElementById("email").value.trim();
            const phoneno = document.getElementById("phone").value.trim();
            const country = document.getElementById("country").value.trim();
            const address = document.getElementById("address").value.trim();
            const postcode = document.getElementById("post").value.trim();
            const linkedInID = document.getElementById("linked").value.trim();

            const firstname = document.getElementById("finame");
            const lastname = document.getElementById("laname");
            const Email = document.getElementById("Email");
            const Phone = document.getElementById("Phone");
            const Country = document.getElementById("Country");
            const Address = document.getElementById("Address");
            const Postcode = document.getElementById("Postcode");
            const LinkedInID = document.getElementById("LinkedIn");

            const fnameRegex = /^[A-Za-z\s]+$/;
            const lnameRegex = /^[A-Za-z\s]+$/;
            const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
            const phonenoRegex = /^[0-9]{10}$/;
            const addressRegex = /^[A-Za-z\s,.-]+$/;
            const postcodeRegex = /^[0-9]{6}$/;
            const countryRegex = /^[A-Za-z]+$/;
            const linkedInIDRegex = /^[A-Za-z0-9\s]+$/;

            if(fname === ''){
                firstname.innerHTML = "Enter the First Name";
                return;
            }
            else if(!fnameRegex.test(fname)){
                firstname.innerHTML = "You should enter only letters";
                return;
            }
            firstname.innerHTML = "";

            if(lname === ''){
                lastname.innerHTML = "Enter the Last Name";
                return;
            }
            else if(!lnameRegex.test(lname)){
                lastname.innerHTML = "You should enter only letters";
                return;
            }
            lastname.innerHTML = "";

            if(email === ''){
                Email.innerHTML = "Enter the Email";
                return;
            }
            else if(!emailRegex.test(email)){
                Email.innerHTML = "Enter correct Email Address"; 
                return;
            }
            Email.innerHTML = "";

            if(phoneno === ''){
                Phone.innerHTML = "Enter the 10 Digit Phone Number";
                return;
            }
            else if(!phonenoRegex.test(phoneno)){
                Phone.innerHTML = "Enter Phone Number properly";
                return;
            }
            Phone.innerHTML = "";

            if(country === ''){
                Country.innerHTML = "Enter the Country Name";
                return;
            }
            else if(!countryRegex.test(country)){
                Country.innerHTML = "Enter only letters";
                return;
            }
            Country.innerHTML = "";

            if(postcode === ''){
                Postcode.innerHTML = "Enter the PostCode";
                return;
            }
            else if(!postcodeRegex.test(postcode)){
                Postcode.innerHTML = "Enter only numbers";
                return;
            }
            Postcode.innerHTML = "";

            if(address === ''){
                Address.innerHTML = "Enter the Address";
                return;
            }
            else if(!addressRegex.test(address)){
                Address.innerHTML = "Enter only letters";
                return;
            }
            Address.innerHTML = "";

            if(linkedInID !== '' && !linkedInIDRegex.test(linkedInID)){
                LinkedInID.innerHTML = "LinkedIn ID should contain only letters";
                return;
            }
            LinkedInID.innerHTML = "";

            document.getElementById("mainform").submit();
        }
    </script>
</body>
</html>
