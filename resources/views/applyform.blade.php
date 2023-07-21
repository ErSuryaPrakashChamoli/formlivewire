<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone_no = $_POST['phone_no'];
    $occupation = $_POST['occupation'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $message = $_POST['message'];
    $ch = curl_init();

    $fortype = "personal loan";

    curl_setopt($ch, CURLOPT_URL, "http://192.168.0.231/loancrm/api/cutomer-data-wp-post");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        "name=sangeeta&phone_no =8427168733&occupation=salary&pincode=110096&city=Delhi&message=hello"
    );
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, 'myCurlCallback');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // In real life you should use something like:
    // curl_setopt($ch, CURLOPT_POSTFIELDS, 
    //          http_build_query(array('postvar1' => 'value1')));

    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



    $server_output = curl_exec($ch);

    curl_close($ch);
    header("Location:https://www.myzeon.com/");

    // Further processing ...
    if ($server_output == "OK") {
    } else {
    }
    //header("Location:https://www.myzeon.com/");
    //exit;
}

function myCurlCallback()
{
    header("Location:https://www.myzeon.com/");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .error-message {
            color: red;
            display: none;
        }
    </style>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Loan Apply Now</h2>
        <form id="loan-form" method="post" action="http://192.168.0.231/loancrm/api/cutomer-data-wp-post">
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="full_name">Enter Full Name</label><span style="color: red;">*</span>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
                    <div class="error-message" id="name-error">Please enter a valid name.</div>
                </div>
                <div class="col-md-6 form-group">
                    <label for="phone_number">Enter Number</label><span style="color: red;">*</span>
                    <input type="number" name="phone_no" id="number" class="form-control" placeholder="Enter your phone number" required>
                    <div class="error-message" id="phone-error">Please enter a valid phone number.</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="occupation">Occupation</label><span style="color: red;">*</span>
                    <select name="occupation" id="occupation" class="form-control" onchange="handleOccupationChange()" required>
                        <option value="" selected> Select occupation</option>
                        <option value="Salaried">Salaried</option>
                        <option value="Business Owner">Business Owner</option>
                        <option value="Self-employed Professional">Self-employed Professional</option>
                        <option value="Independent Worker">Independent Worker</option>
                        <option value="Student">Student</option>
                        <option value="Retired">Retired</option>
                        <option value="Homemaker">Homemaker</option>
                    </select>
                    <div class="error-message" id="occupation-error">Please enter a valid name.</div>
                </div>
                <div class="col-md-6 form-group">
                    <label for="loan_type">Loan Type</label><span style="color: red;">*</span>
                    <select name="loan_type" id="loan_type" class="form-control" required>
                        <option value="">Select loan type</option>
                    </select>
                    <div class="error-message" id="loan-error">Please enter a valid name.</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 form-group">
                    <label for="pincode">Enter Pincode</label><span style="color: red;">*</span>
                    <input type="number" name="pincode" id="pincode" class="form-control" placeholder="Enter your city pincode" onchange="getCityStateFromPincode(this.value)" required>
                    <div class="error-message" id="pincode-error">Please enter a valid name.</div>

                </div>
                <div class="col-md-4 form-group">
                    <label for="city">Enter City</label><span style="color: red;">*</span>
                    <input type="text" name="city" id="city" class="form-control" placeholder="Enter your city" required>
                    <div class="error-message" id="city-error">Please enter a valid name.</div>
                </div>
                <div class="col-md-4 form-group">
                    <label for="message">State</label><span style="color: red;">*</span>
                    <select id="stateName" class="form-control">
                        <option value="nocityenter">Select state</option>
                    </select>
                    <div class="error-message" id="state-error">Please enter a valid name.</div>
                </div>



                <div class="col-md-12 form-group">
                    <label for="message">Message or Comment</label><span style="color: red;">*</span>
                    <textarea name="message" id="message" value="message" class="form-control" rows="4" placeholder="Write your message"></textarea>
                    <div class="error-message" id="message-error">Please enter a valid name.</div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" onclick="validateForm(event)">Submit</button>
                </div>
        </form>
    </div>


    <script>
        function getCityStateFromPincode(pincode) {
            const url = `https://api.postalpincode.in/pincode/${pincode}`;

            // Make an HTTP GET request to the API
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Check if the API response is successful
                    if (data && data[0].Status === "Success") {
                        const city = data[0].PostOffice[0].District;
                        const state = data[0].PostOffice[0].State;
                        document.getElementById("city").value = city;
                        document.getElementById("stateName").innerHTML = `<option value="${state}">${state}</option>`;
                        console.log(`City: ${city}`);
                        console.log(`State: ${state}`);
                    } else {
                        console.log("Invalid pincode");
                    }
                })
                .catch(error => {
                    console.log("An error occurred:", error);
                });
        }

        function handleOccupationChange() {
            var occupationSelect = document.getElementById("occupation");
            var loanTypeSelect = document.getElementById("loan_type");
            var selectedOccupation = occupationSelect.value;

            // Reset loan type options
            loanTypeSelect.innerHTML = '<option value="">Select loan type</option>';

            if (selectedOccupation === "Salaried") {
                // Add loan types for salaried individuals
                loanTypeSelect.innerHTML += '<option value="Personal Loan">Personal Loan</option>' +
                    '<option value="Home Loan">Home Loan</option>' +
                    '<option value="Car Loan">Car Loan</option>';
            } else if (selectedOccupation === "Business Owner") {
                // Add loan types for business owners
                loanTypeSelect.innerHTML += '<option value="Business Loan">Business Loan</option>';
            } else if (selectedOccupation === "Self-employed Professional") {
                // Add loan types for self-employed professionals
                loanTypeSelect.innerHTML += '<option value="Business Loan">Business Loan</option>' +
                    '<option value="Personal Loan">Personal Loan</option>';
            }
            // Add other occupation-specific loan types as needed
        }


        function validateForm(event) {
            // Prevent form submission
            event.preventDefault();

            // Reset error messages
            document.getElementById("name-error").style.display = "none";
            document.getElementById("phone-error").style.display = "none";

            document.getElementById("occupation-error").style.display = "none";
            document.getElementById("loan-error").style.display = "none";

            document.getElementById("pincode-error").style.display = "none";
            document.getElementById("city-error").style.display = "none";

            document.getElementById("state-error").style.display = "none";
            document.getElementById("message-error").style.display = "none";

            // Check if all fields are filled
            var nameField = document.getElementById("name");
            var phoneField = document.getElementById("number");

            var occupation = document.getElementById("occupation");
            var loan_type = document.getElementById("loan_type");


            var pincode = document.getElementById("pincode");
            var city = document.getElementById("city");

            var stateName = document.getElementById("stateName");
            var message = document.getElementById("message");

            var isValid = true;

            if (nameField.value.trim() == '' && phoneField.value.trim() == '' && occupation.value.trim() == '' && loan_type.value.trim() == '' && pincode.value.trim() == '' && city.value.trim() == '' && stateName.value.trim() == '' && message.value.trim() == '') {
                isValid = false;
                alert("Please fill all required Fields");
                return false;
            }

            var namePattern = /^[A-Za-z\s]+$/;
            var phonePattern = /^(\+91)?[6789]\d{9}$/;

            if (!namePattern.test(nameField.value.trim())) {
                document.getElementById("name-error").style.display = "block";
                isValid = false;
                return false;
            }

            if (!phonePattern.test(phoneField.value.trim())) {
                document.getElementById("phone-error").style.display = "block";
                isValid = false;
                return false;
            }

            if (nameField.value.trim() == '' || phoneField.value.trim() == '' || occupation.value.trim() == '' || loan_type.value.trim() == '' || pincode.value.trim() == '' || city.value.trim() == '' || stateName.value.trim() == '' || message.value.trim() == '') {
                isValid = false;
                alert("Please fill all required Fields");
                return false;
            }
            // If all fields are filled, submit the form
            if (isValid) {
                document.getElementById("loan-form").submit();
            }
        }


        function isValidPhoneNumber(phoneNumber) {

            const phoneRegex = /^(\+91)?[6789]\d{9}$/;
            return phoneRegex.test(phoneNumber);
        }

        const phoneInput = document.getElementById("phoneInput");
        const validationMessage = document.getElementById("validationMessage");

        phoneInput.addEventListener("input", () => {
            const phoneNumber = phoneInput.value.trim();

            if (phoneNumber === "") {
                validationMessage.textContent = "Please enter a phone number.";
            } else if (isValidPhoneNumber(phoneNumber)) {
                validationMessage.textContent = "Phone number is valid!";
            } else {
                validationMessage.textContent = "Invalid phone number!";
            }
        });

        function isFieldEmpty(inputField) {
            return inputField.value.trim() === '';
        }
    </script>
</body>

</html>