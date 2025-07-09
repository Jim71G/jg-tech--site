<?php
// === CONFIG ===
$receiptTxt = "../../uploads/starlight/intake_receipt.txt";
$receiptHtml = "../../archive/starlight/2025-07-08/confirmation.html";
$generatorScript = "../../scripts/receipt-generator.sh";

// === Get POST Data ===
$tier = $_POST['tier'] ?? 'Not selected';
$notes = trim($_POST['notes'] ?? 'None');

// === Append to intake_receipt.txt ===
$divider = "\n===== Tier Selection Summary =====\n";
$summary = "Tier Chosen: $tier\nClient Notes: $notes\n";

file_put_contents($receiptTxt, $divider . $summary, FILE_APPEND);

// === Trigger HTML Receipt Generation ===
exec("bash $generatorScript", $output, $status);

// === Confirmation Output ===
echo "<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <title>Tier Assigned – JG-Tech</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; padding: 2em; text-align: center; }
    .box { background: white; max-width: 600px; margin: auto; padding: 2em; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
    h1 { margin-bottom: 0.5em; }
    p { opacity: 0.85; }
  </style>
</head>
<body>
  <div class='box'>
    <h1>✅ Tier Assigned Successfully</h1>
    <p>Your intake receipt has been updated and saved to the client archive.</p>
    <p><strong>Tier Chosen:</strong> $tier</p>
    <p><strong>Your Notes:</strong> $notes</p>
    <p>Confirmation generated at: <code>$receiptHtml</code></p>
  </div>
</body>
</html>";
?>
