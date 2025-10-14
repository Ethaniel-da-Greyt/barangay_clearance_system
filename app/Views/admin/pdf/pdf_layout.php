<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monthly Report - <?= esc(date('F Y', strtotime($month))) ?></title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #000;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            position: relative;
        }

        .header img.logo {
            position: absolute;
            top: 0;
            left: 0;
            width: 80px;
            height: 80px;
        }

        .header h1,
        .header h2,
        .header h3,
        .header h4,
        .header p {
            margin: 0;
            padding: 2px;
        }

        .report-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 30px 0 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            background-color: #f2f2f2;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #eee;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>

<body>
    <?php
    $path = FCPATH . 'logo/logo.png'; // FCPATH is root of /public
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>

    <!-- Header with Logo and Government Titles -->
    <div class="header">
        <img src="<?= $base64 ?>" alt="Barangay Logo" class="logo">
        <h4>Republic of the Philippines</h4>
        <h4>Province of Zamboanga del Norte</h4>
        <h4>City of Dipolog</h4>
        <h3><strong>Barangay Dicayas</strong></h3>
        <h4><em>Office of the Punong Barangay</em></h4>
    </div>

    <!-- Report Title -->
    <div class="report-title">
        Monthly Report – <?= esc(date('F Y', strtotime($month))) ?>
    </div>

    <!-- Report Table -->
    <table>
        <thead>
            <tr>
                <th>Date Requested</th>
                <th>Request ID</th>
                <th>Document</th>
                <th>Requestor</th>
                <th>Sex</th>
                <th>Purok</th>
                <th>Contact</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $r): ?>
                <tr>
                    <td><?= esc(date('F d, Y - h:i A', strtotime($r['created_at']))) ?></td>
                    <td><?= esc($r['request_id']) ?></td>
                    <td><?= esc($r['request_type']) ?></td>
                    <td><?= esc($r['firstname'] . ' ' . $r['middle_initial'] . ' ' . $r['lastname'] . ' ' . $r['suffix']) ?>
                    </td>
                    <td><?= esc($r['sex']) ?></td>
                    <td><?= esc($r['purok']) ?></td>
                    <td><?= esc($r['contact_no']) ?></td>
                    <td><?= esc(ucfirst($r['status'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Generated on <?= date('F d, Y h:i A') ?>
    </div>

</body>

</html>