
<?php
session_start();

// Redirect to the registration form if no student data exists
if (!isset($_SESSION["student"])) {
    header("Location: student_registration_assigment3.php");
    exit;
}

$student = $_SESSION["student"];

// Safely display student information
function e($value) {
    return htmlspecialchars((string)($value ?? ""), ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Registration Result</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f9;
        }

        .result-container {
            max-width: 900px;
            margin: 35px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        }

        .student-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #0d6efd;
        }

        .section-title {
            background: #0d6efd;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            margin: 25px 0 15px;
        }

        .detail-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 13px;
            height: 100%;
            overflow-wrap: anywhere;
        }

        .detail-label {
            display: block;
            font-weight: bold;
            color: #475569;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #111827;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .result-container {
                box-shadow: none;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>

<div class="container result-container">

    <h1 class="text-center text-primary mb-3">
        Student Registration Result
    </h1>

    <div class="alert alert-success text-center">
        <strong>Registration Successful!</strong>
        Student information has been submitted successfully.
    </div>

    <div class="text-center mb-4">
        <?php
        $imagePath = __DIR__ . "/uploads/" . basename($student["image"] ?? "");
        $imageUrl = "uploads/" . rawurlencode(basename($student["image"] ?? ""));
        ?>

        <?php if (!empty($student["image"]) && is_file($imagePath)): ?>
            <img
                src="<?= e($imageUrl) ?>"
                alt="Student Image"
                class="student-image"
            >
        <?php else: ?>
            <p class="text-danger">Student image is unavailable.</p>
        <?php endif; ?>

        <h4 class="mt-3"><?= e($student["name"] ?? "") ?></h4>
        <p class="text-muted">
            Student ID: <?= e($student["student_id"] ?? "") ?>
        </p>
    </div>

    <h4 class="section-title">Personal Information</h4>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Student Name</span>
                <span class="detail-value"><?= e($student["name"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Place of Birth</span>
                <span class="detail-value"><?= e($student["pob"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Date of Birth</span>
                <span class="detail-value"><?= e($student["dob"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Gender</span>
                <span class="detail-value"><?= e($student["gender"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Address</span>
                <span class="detail-value"><?= e($student["address"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Telephone</span>
                <span class="detail-value"><?= e($student["telephone"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Email</span>
                <span class="detail-value"><?= e($student["email"] ?? "") ?></span>
            </div>
        </div>
    </div>

    <h4 class="section-title">Parent Information</h4>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="detail-box">
                <span class="detail-label">Parent Name</span>
                <span class="detail-value"><?= e($student["parent_name"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="detail-box">
                <span class="detail-label">Parent Telephone</span>
                <span class="detail-value"><?= e($student["parent_phone"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="detail-box">
                <span class="detail-label">Relationship</span>
                <span class="detail-value"><?= e($student["relationship"] ?? "") ?></span>
            </div>
        </div>
    </div>

    <h4 class="section-title">Academic Information</h4>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Student ID</span>
                <span class="detail-value"><?= e($student["student_id"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Faculty</span>
                <span class="detail-value"><?= e($student["faculty"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Department</span>
                <span class="detail-value"><?= e($student["department"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Class</span>
                <span class="detail-value"><?= e($student["class"] ?? "") ?></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-box">
                <span class="detail-label">Registration Date</span>
                <span class="detail-value"><?= e($student["reg_date"] ?? "") ?></span>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4 no-print">
        <a
            href="student_registration_assigment3.php?new=1"
            class="btn btn-primary flex-fill"
        >
            Register Another Student
        </a>

        <button
            type="button"
            onclick="window.print()"
            class="btn btn-secondary flex-fill"
        >
            Print Result
        </button>
    </div>

</div>

</body>
</html>
