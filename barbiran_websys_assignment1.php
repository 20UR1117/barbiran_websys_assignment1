<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #738678; }
        form { background-color: #fff; padding: 20px; max-width: 900px; margin: 20px auto; border-radius: 0px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 0px; }
        .error { color: red; font-size: 0.9em; }
        .submit-btn { background-color: #24b5f8; color: white; border: none; padding: 10px; width: 100%; cursor: pointer; border-radius: 0px; }
        
    </style>
</head>
<body>

<?php

$name = $email = $password = $gender = $country = $biography = "";
$skills = [];
$nameErr = $emailErr = $passwordErr = $genderErr = $countryErr = $skillsErr = $bioErr = "";


function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;

    
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $isValid = false;
    } else {
        $name = sanitizeInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $isValid = false;
        }
    }

    
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $isValid = false;
    } else {
        $email = sanitizeInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $isValid = false;
        }
    }

    
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $isValid = false;
    } else {
        $password = sanitizeInput($_POST["password"]);
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters";
            $isValid = false;
        }
    }

    
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $isValid = false;
    } else {
        $gender = sanitizeInput($_POST["gender"]);
    }

   
    if (empty($_POST["country"])) {
        $countryErr = "Country is required";
        $isValid = false;
    } else {
        $country = sanitizeInput($_POST["country"]);
    }

    
    if (empty($_POST["skills"])) {
        $skillsErr = "At least one skill is required";
        $isValid = false;
    } else {
        $skills = $_POST["skills"];
    }

   
    if (empty($_POST["biography"])) {
        $bioErr = "Biography is required";
        $isValid = false;
    } else {
        $biography = sanitizeInput($_POST["biography"]);
    }

    
    if ($isValid) {
        echo "<h3>Registration Successful!</h3>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Gender:</strong> $gender</p>";
        echo "<p><strong>Country:</strong> $country</p>";
        echo "<p><strong>Skills:</strong> " . implode(", ", $skills) . "</p>";
        echo "<p><strong>Biography:</strong> $biography</p>";
    }
}
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
    </div>

    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
    </div>

    
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>">
        <span class="error"><?php echo $passwordErr; ?></span>
    </div>

    
    <div class="form-group">
        <label>Gender:</label>
        <label><input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>> Male</label>
        <label><input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>> Female</label>
        <span class="error"><?php echo $genderErr; ?></span>
    </div>

    
    <div class="form-group">
        <label for="country">Country:</label>
        <select id="country" name="country">
            <option value="">Select your country</option>
            <option value="Philippines" <?php if ($country == "Philippines") echo "selected"; ?>>Philippines</option>
            <option value="USA" <?php if ($country == "USA") echo "selected"; ?>>USA</option>
            <option value="Canada" <?php if ($country == "Canada") echo "selected"; ?>>Canada</option>
        </select>
        <span class="error"><?php echo $countryErr; ?></span>
    </div>

    
    <div class="form-group">
        <label>Skills:</label>
        <label><input type="checkbox" name="skills[]" value="HTML" <?php if (in_array("HTML", $skills)) echo "checked"; ?>> HTML</label>
        <label><input type="checkbox" name="skills[]" value="CSS" <?php if (in_array("CSS", $skills)) echo "checked"; ?>> CSS</label>
        <label><input type="checkbox" name="skills[]" value="JavaScript" <?php if (in_array("JavaScript", $skills)) echo "checked"; ?>> JavaScript</label>
        <span class="error"><?php echo $skillsErr; ?></span>
    </div>

    
    <div class="form-group">
        <label for="biography">Biography:</label>
        <textarea id="biography" name="biography" rows="4"><?php echo $biography; ?></textarea>
        <span class="error"><?php echo $bioErr; ?></span>
    </div>

    
    <div class="form-group">
        <button type="submit" class="submit-btn">Register</button>
    </div>
</form>

</body>
</html> 