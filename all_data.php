<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Data - Monitoring Polusi Udara UNM</title>
    <link rel="stylesheet" href="all_data.css">
</head>

<body>
<header>
    <h1>Semua Data - Monitoring Polusi Udara</h1>
    <a href="index.php" class="back-link">Kembali ke Dashboard</a>
</header>

<div class="data-box">
    <h2 style="text-align: center;">Polusi yang Terdeteksi</h2>
    <table class="container">
        <thead>
            <tr>
                <th style="padding: 10px 60px;">MQ-2 (Gas Asap)</th>
                <th style="padding: 10px 60px;">MQ-7 (Karbon Monoksida)</th>
                <th style="padding: 10px 60px;">Waktu</th>
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
            showAllData();
        })
        .catch(error => console.error("Error Fetch Data:", error));
}

function showAllData() {
    const tableBody = document.getElementById("dataTable");
    tableBody.innerHTML = ""; 

    let currentDate = "";

    allData.forEach(row => {
        let rowDate = new Date(row.waktu).toLocaleDateString('id-ID');
        if (rowDate !== currentDate) {
            currentDate = rowDate;
            let dateRow = `<tr>
                            <td colspan="3" style="text-align: center; font-weight: bold;">${currentDate}</td>
                        </tr>`;
            tableBody.innerHTML += dateRow;
        }

        let tr = `<tr>
            <td style="padding: 10px 60px;">${row.mq2}</td>
            <td style="padding: 10px 60px;">${row.mq7}</td>
            <td style="padding: 10px 60px;">${new Date(row.waktu).toLocaleTimeString('id-ID')}</td>
            </tr>`;
        tableBody.innerHTML += tr;
    });
}

document.addEventListener("DOMContentLoaded", fetchData);
</script>

</body>
</html>