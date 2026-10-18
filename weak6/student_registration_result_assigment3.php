
<?php
session_start();

// Redirect visitors who have not submitted the form.
if (!isset($_SESSION["student"])) {
    header("Location: student_registration_assigment3.php");
    exit;
}

$student = $_SESSION["student"];

// Escape values before displaying them.
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

// Retrieve student information safely.
$fullname = $student["fullname"] ?? "";
$email = $student["email"] ?? "";
$phone = $student["phone"] ?? "";
$gender = $student["gender"] ?? "";
$dob = $student["dob"] ?? "";
$address = $student["address"] ?? "";
$faculty = $student["faculty"] ?? "";
$department = $student["department"] ?? "";
$course = $student["course"] ?? "";
$year = $student["year"] ?? "";
$hobbies = $student["hobbies"] ?? [];
$bio = $student["bio"] ?? "";
$image = basename($student["image"] ?? "");

if (!is_array($hobbies)) {
    $hobbies = [];
}

// Locate the uploaded image in the Downloads/move files folder.
$uploadDir = "C:/Users/HP/Downloads/move files/";
$imagePath = $uploadDir . $image;

$imageExists = (
    $image !== "" &&
    is_file($imagePath) &&
    getimagesize($imagePath) !== false
);

// Convert the image to Base64 so it can be displayed
// without needing a separate student_image.php file.
$imageData = "";

if ($imageExists) {
    $imageInfo = getimagesize($imagePath);
    $mimeType = $imageInfo["mime"] ?? "";

    $allowedTypes = [
        "image/jpeg",
        "image/png",
        "image/gif",
        "image/webp"
    ];

    if (in_array($mimeType, $allowedTypes, true)) {
        $imageData = "data:" . $mimeType . ";base64," .
            base64_encode(file_get_contents($imagePath));
    } else {
        $imageExists = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration Result</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .card {
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="card shadow mx-auto" style="max-width: 900px;">

        <div class="card-header bg-success text-white text-center py-4">
            <h2>Student Registration Successful</h2>
            <p class="mb-0">Student information is shown below.</p>
        </div>

        <div class="card-body p-4">

            <div class="text-center mb-4">
                <?php if ($imageData !== ""): ?>
                    <img
                        src="<?= e($imageData) ?>"
                        alt="Student Image"
                        class="img-thumbnail rounded"
                        style="width: 160px; height: 160px; object-fit: cover;">
                <?php else: ?>
                    <p class="text-danger">
                        Student image could not be found.
                    </p>
                <?php endif; ?>

                <h3 class="mt-3"><?= e($fullname) ?></h3>
            </div>

            <h4 class="text-primary mb-3">Student Information</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <tbody>
                        <tr>
                            <th style="width: 35%;">Full Name</th>
                            <td><?= e($fullname) ?></td>
                        </tr>

                        <tr>
                            <th>Email Address</th>
                            <td><?= e($email) ?></td>
                        </tr>

                        <tr>
                            <th>Phone Number</th>
                            <td><?= e($phone) ?></td>
                        </tr>

                        <tr>
                            <th>Gender</th>
                            <td><?= e($gender) ?></td>
                        </tr>

                        <tr>
                            <th>Date of Birth</th>
                            <td><?= e($dob) ?></td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td><?= nl2br(e($address)) ?></td>
                        </tr>

                        <tr>
                            <th>Faculty</th>
                            <td><?= e($faculty) ?></td>
                        </tr>

                        <tr>
                            <th>Department</th>
                            <td><?= e($department) ?></td>
                        </tr>

                        <tr>
                            <th>Course / Program</th>
                            <td><?= e($course) ?></td>
                        </tr>

                        <tr>
                            <th>Year of Study</th>
                            <td><?= e($year) ?></td>
                        </tr>

                        <tr>
                            <th>Hobbies</th>
                            <td>
                                <?= !empty($hobbies)
                                    ? e(implode(", ", $hobbies))
                                    : "Not specified" ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Short Biography</th>
                            <td>
                                <?= $bio !== ""
                                    ? nl2br(e($bio))
                                    : "Not provided" ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4 no-print">
                <a href="student_registration_assigment3.php?new=1"
                   class="btn btn-primary">
                    Register Another Student
                </a>

                <button type="button"
                        onclick="window.print()"
                        class="btn btn-outline-secondary">
                    Print Result
                </button>
            </div>

        </div>
    </div>
</div>

</body>
</html>
