
<?php
session_start();

$name = $pob = $dob = $address = $gender = $telephone = $email = "";
$parent_name = $parent_phone = $relationship = "";
$student_id = $faculty = $department = $class = $reg_date = "";

$fields = [
    "name", "pob", "dob", "address", "gender", "telephone", "email",
    "parent_name", "parent_phone", "relationship", "student_id",
    "faculty", "department", "class", "reg_date"
];

$errors = array_fill_keys($fields, "");
$errors["image"] = "";
$hasError = false;

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    foreach ($fields as $field) {
        $$field = trim($_POST[$field] ?? "");
    }

    // Validate required fields
    $labels = [
        "name" => "name",
        "pob" => "place of birth",
        "dob" => "date of birth",
        "address" => "address",
        "gender" => "gender",
        "telephone" => "telephone number",
        "email" => "email",
        "parent_name" => "parent name",
        "parent_phone" => "parent telephone",
        "relationship" => "relationship",
        "student_id" => "student ID",
        "faculty" => "faculty",
        "department" => "department",
        "class" => "class",
        "reg_date" => "registration date"
    ];

    foreach ($labels as $field => $label) {
        if ($$field === "") {
            $errors[$field] = "Please enter or select " . $label;
        }
    }

    if ($name !== "" && !preg_match("/^[a-zA-Z ]+$/", $name)) {
        $errors["name"] = "Name must contain only letters and spaces.";
    }

    if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    }

    if ($gender !== "" && !in_array($gender, ["Male", "Female"], true)) {
        $errors["gender"] = "Please select a valid gender.";
    }

    if ($dob !== "" && strtotime($dob) === false) {
        $errors["dob"] = "Please enter a valid date of birth.";
    }

    if ($reg_date !== "" && strtotime($reg_date) === false) {
        $errors["reg_date"] = "Please enter a valid registration date.";
    }

    // Validate uploaded image
    $imageName = "";
    $image = $_FILES["image"] ?? null;

    if (!$image || $image["error"] === UPLOAD_ERR_NO_FILE) {
        $errors["image"] = "Please upload an image.";
    } elseif ($image["error"] !== UPLOAD_ERR_OK) {
        $errors["image"] = "Image upload failed. Please try again.";
    } elseif ($image["size"] > 2 * 1024 * 1024) {
        $errors["image"] = "Image size must not exceed 2 MB.";
    } else {
        $allowedTypes = [
            "image/png" => "png",
            "image/jpeg" => "jpg",
            "image/gif" => "gif"
        ];

        $imageInfo = @getimagesize($image["tmp_name"]);
        $mimeType = $imageInfo["mime"] ?? "";

        if (!$imageInfo || !isset($allowedTypes[$mimeType])) {
            $errors["image"] = "Only valid PNG, JPG, JPEG, or GIF images are allowed.";
        } else {
            $imageName = bin2hex(random_bytes(16)) . "." . $allowedTypes[$mimeType];
        }
    }

    foreach ($errors as $error) {
        if ($error !== "") {
            $hasError = true;
            break;
        }
    }

    // Save the image and student information
    if (!$hasError) {
        $uploadDirectory = __DIR__ . "/uploads/";

        if (!is_dir($uploadDirectory)) {
            if (!mkdir($uploadDirectory, 0755, true)) {
                $errors["image"] = "Could not create the uploads folder.";
                $hasError = true;
            }
        }

        if (!$hasError && !is_writable($uploadDirectory)) {
            $errors["image"] = "The uploads folder is not writable.";
            $hasError = true;
        }

        if (!$hasError) {
            $destination = $uploadDirectory . $imageName;

            if (move_uploaded_file($image["tmp_name"], $destination)) {
                $student = [];

                foreach ($fields as $field) {
                    $student[$field] = $$field;
                }

                $student["image"] = $imageName;
                $_SESSION["student"] = $student;

                header("Location: result.php");
                exit;
            } else {
                $errors["image"] = "Could not save the image. Please try again.";
                $hasError = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4" style="max-width: 900px;">
    <h2 class="text-center mb-4">Student Registration Form</h2>

    <?php if ($hasError): ?>
        <div class="alert alert-danger">
            Please fix the errors shown below.
        </div>
    <?php endif; ?>

    <form method="post" action="index.php" enctype="multipart/form-data">

        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Personal Information</div>
            <div class="card-body row g-3">

                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control <?= $errors['name'] ? 'is-invalid' : '' ?>" value="<?= e($name) ?>">
                    <div class="invalid-feedback"><?= e($errors["name"]) ?></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Place of Birth (POB)</label>
                    <input type="text" name="pob" class="form-control <?= $errors['pob'] ? 'is-invalid' : '' ?>" value="<?= e($pob) ?>">
                    <div class="invalid-feedback"><?= e($errors["pob"]) ?></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date of Birth (DOB)</label>
                    <input type="date" name="dob" class="form-control <?= $errors['dob'] ? 'is-invalid' : '' ?>" value="<?= e($dob) ?>">
                    <div class="invalid-feedback"><?= e($errors["dob"]) ?></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label d-block">Gender</label>

                    <div class="form-check form-check-inline">
                        <input type="radio" name="gender" value="Male" class="form-check-input" <?= $gender === "Male" ? "checked" : "" ?>>
                        <label class="form-check-label">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="radio" name="gender" value="Female" class="form-check-input" <?= $gender === "Female" ? "checked" : "" ?>>
                        <label class="form-check-label">Female</label>
                    </div>

                    <div class="text-danger small"><?= e($errors["gender"]) ?></div>
                </div>

                <div class="col-12">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control <?= $errors['address'] ? 'is-invalid' : '' ?>" value="<?= e($address) ?>">
                    <div class="invalid-feedback"><?= e($errors["address"]) ?></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Telephone</label>
                    <input type="text" name="telephone" class="form-control <?= $errors['telephone'] ? 'is-invalid' : '' ?>" value="<?= e($telephone) ?>">
                    <div class="invalid-feedback"><?= e($errors["telephone"]) ?></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control <?= $errors['email'] ? 'is-invalid' : '' ?>" value="<?= e($email) ?>">
                    <div class="invalid-feedback"><?= e($errors["email"]) ?></div>
                </div>

                <div class="col-12">
                    <label class="form-label">Student Image (PNG, JPG, GIF — max 2 MB)</label>
                    <input type="file" name="image" accept="image/png,image/jpeg,image/gif" class="form-control <?= $errors['image'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback"><?= e($errors["image"]) ?></div>
                </div>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-success text-white">Parent Information</div>
            <div class="card-body row g-3">

                <div class="col-md-4">
                    <label class="form-label">Parent Name</label>
                    <input type="text" name="parent_name" class="form-control <?= $errors['parent_name'] ? 'is-invalid' : '' ?>" value="<?= e($parent_name) ?>">
                    <div class="invalid-feedback"><?= e($errors["parent_name"]) ?></div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Parent Telephone</label>
                    <input type="text" name="parent_phone" class="form-control <?= $errors['parent_phone'] ? 'is-invalid' : '' ?>" value="<?= e($parent_phone) ?>">
                    <div class="invalid-feedback"><?= e($errors["parent_phone"]) ?></div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Relationship</label>
                    <select name="relationship" class="form-select <?= $errors['relationship'] ? 'is-invalid' : '' ?>">
                        <option value="">-- Select --</option>
                        <?php foreach (["Father", "Mother", "Brother", "Sister", "Uncle", "Guardian"] as $option): ?>
                            <option value="<?= e($option) ?>" <?= $relationship === $option ? "selected" : "" ?>>
                                <?= e($option) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"><?= e($errors["relationship"]) ?></div>
                </div>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">Academic Information</div>
            <div class="card-body row g-3">

                <div class="col-md-4">
                    <label class="form-label">Student ID</label>
                    <input type="text" name="student_id" class="form-control <?= $errors['student_id'] ? 'is-invalid' : '' ?>" value="<?= e($student_id) ?>">
                    <div class="invalid-feedback"><?= e($errors["student_id"]) ?></div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Faculty</label>
                    <select name="faculty" class="form-select <?= $errors['faculty'] ? 'is-invalid' : '' ?>">
                        <option value="">-- Select --</option>
                        <?php foreach (["Computer and IT", "Engineering", "Business", "Law", "Medicine"] as $option): ?>
                            <option value="<?= e($option) ?>" <?= $faculty === $option ? "selected" : "" ?>>
                                <?= e($option) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"><?= e($errors["faculty"]) ?></div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" class="form-control <?= $errors['department'] ? 'is-invalid' : '' ?>" value="<?= e($department) ?>">
                    <div class="invalid-feedback"><?= e($errors["department"]) ?></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Class</label>
                    <input type="text" name="class" class="form-control <?= $errors['class'] ? 'is-invalid' : '' ?>" value="<?= e($class) ?>">
                    <div class="invalid-feedback"><?= e($errors["class"]) ?></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Registration Date</label>
                    <input type="date" name="reg_date" class="form-control <?= $errors['reg_date'] ? 'is-invalid' : '' ?>" value="<?= e($reg_date) ?>">
                    <div class="invalid-feedback"><?= e($errors["reg_date"]) ?></div>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Register Student</button>
    </form>
</div>

<script>
    const firstError = document.querySelector(".is-invalid");
    if (firstError) {
        firstError.scrollIntoView({ behavior: "smooth", block: "center" });
        firstError.focus();
    }
</script>

</body>
</html>