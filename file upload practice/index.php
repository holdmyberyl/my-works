<?php
// Define log file name
$logFile = "upload_log.txt";
$uploadDir = "uploads/";

// Create uploads directory if it doesn’t exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $targetFile = $uploadDir . $fileName;
    $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
    $fileSize = round($file['size'] / 1024, 2) . " KB";
    $timestamp = date("Y-m-d H:i:s");

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Write log entry
        $logEntry = "[$timestamp] File Uploaded: $fileName | Type: $fileType | Size: $fileSize" . PHP_EOL;
        file_put_contents($logFile, $logEntry, FILE_APPEND);
        $message = "File uploaded successfully.";
    } else {
        $message = "File upload failed.";
    }
}

// Read log contents
$logContents = file_exists($logFile) ? file_get_contents($logFile) : "No logs yet.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        /* --- Minimalist Black & White Theme --- */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 80px auto;
            background: #111;
            padding: 40px;
            border-radius: 12px;
            border: 1px solid #333;
            box-shadow: 0 0 20px rgba(255,255,255,0.05);
        }
        h1 {
            text-align: center;
            font-weight: 500;
            letter-spacing: 1px;
            margin-bottom: 30px;
            color: #fff;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }
        input[type="file"] {
            border: 1px solid #444;
            padding: 10px;
            border-radius: 6px;
            background: #000;
            color: #fff;
            cursor: pointer;
            width: 100%;
        }
        button {
            border: 1px solid #fff;
            background: transparent;
            color: #fff;
            padding: 10px 25px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        button:hover {
            background: #fff;
            color: #000;
        }
        .message {
            text-align: center;
            margin-bottom: 25px;
            color: #aaa;
        }
        .logs {
            border-top: 1px solid #333;
            padding-top: 20px;
        }
        .logs h2 {
            font-weight: 400;
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: #eee;
        }
        pre {
            background: #000;
            border: 1px solid #333;
            padding: 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            line-height: 1.4;
            color: #ccc;
            max-height: 300px;
            overflow-y: auto;
        }
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.8rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        

        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit">Upload</button>
        </form>

        <div class="logs">
            <h2>Upload Logs</h2>
            <pre><?= htmlspecialchars($logContents) ?></pre>
        </div>
    </div>

    <footer>© <?= date('Y') ?> Simple File Logger</footer>
</body>
</html>
