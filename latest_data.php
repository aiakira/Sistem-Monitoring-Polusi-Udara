<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Terbaru - Monitoring Polusi Udara UNM</title>
    <link rel="stylesheet" href="all_data.css">
</head>

<body>
<header>
    <h1>Data Terbaru - Monitoring Polusi Udara</h1>
    <a href="index.php">Kembali ke Dashboard</a>
</header>

<div class="data-box">
    <h2 style="text-align: center;">Polusi yang Terdeteksi</h2>
    <table>
        <thead>
            <tr>
            <th style="padding: 10px 100px;">MQ-2 (Gas Asap)</th>
            <th style="padding: 10px 100px;">MQ-7 (Karbon Monoksida)</th>
            <th style="padding: 10px 100px;">Waktu</th>
            </tr>
        </thead>
        <tbody id="dataTable"></tbody>
    </table>
</div>

<script>
let allData = [];

function fetchData() {
    fetch("data.php")
        .then(response => response.json())
        .then(data => {
            allData = data;
            showLatestData();
        })
        .catch(error => console.error("Error Fetch Data:", error));
}

function showLatestData() {
    const tableBody = document.getElementById("dataTable");
    tableBody.innerHTML = ""; // Kosongkan tabel sebelum update data baru

    if (allData.length > 0) {
        const latestData = allData[allData.length - 1];
        let tr = `<tr>
                    <td style="text-align: center;">${latestData.mq2}</td>
                    <td style="text-align: center;">${latestData.mq7}</td>
                    <td style="text-align: center;">${latestData.waktu}</td>
                </tr>`;
        tableBody.innerHTML += tr;
    }
}

document.addEventListener("DOMContentLoaded", fetchData);
</script>
</body>
</html>