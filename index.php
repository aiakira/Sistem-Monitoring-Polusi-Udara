<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Polusi Udara UNM</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.0.2"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body>
<header>
    <h1>Monitoring Polusi Udara</h1>
    <p>Lokasi: Kota Makassar, Jl. Andi Pangeran Pettarani, Gedung Pinisi UNM</p>
    <a href="https://www.bing.com/maps?osid=56b7649c-4f24-4b84-b4b4-860209f2d855&cp=-5.168459~119.429626&lvl=16&pi=0&v=2&sV=2&form=S00027" target="_blank">Lihat Peta</a>
</header>

<div class="container">
    <nav class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="all_data.php">Semua Data</a></li>
            <li><a href="latest_data.php">Data Terbaru</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="data-box" style="inline-size: 90%; padding: 10px;">
            <h2 style="text-align: center;">Polusi yang Terdeteksi</h2>
            <table>
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

        <div id="warning" class="warning" style="display: none;">
            <p style="text-align: center; font-weight: bold; color: red;">Kadar polusi berbahaya!</p>
        </div>

        <div class="chart-container">
            <canvas id="pmChart"></canvas>
        </div>

        <div class="peta">
            <h2>Peta Lokasi</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.387896924211!2d119.44001531477372!3d-5.139011253100313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbf1d7999999999%3A0x9999999999999999!2sJl.%20Andi%20Pangeran%20Pettarani!5e0!3m2!1sen!2sid!4v1618300000000" 
                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </main>
</div>

<script>
let allData = [];

function fetchData() {
    fetch("data.php")
        .then(response => response.json())
        .then(data => {
            console.log("Data dari server:", data);
            allData = data;
            showLatestData();
            checkPollution();
            updateChartWithData();
        })
        .catch(error => console.error("Error Fetch Data:", error));
}

function showLatestData() {
    const tableBody = document.getElementById("dataTable");
    tableBody.innerHTML = ""; 

    if (allData.length > 0) {
        const latestData = allData[allData.length - 1];
        let tr = `<tr>
                    <td style="text-align: center;">${latestData.mq2}</td>
                    <td style="text-align: center">${latestData.mq7}</td>
                    <td style="padding: 10px 10px;">${latestData.waktu}</td>
                </tr>`;
        tableBody.innerHTML += tr;
    }
}

function checkPollution() {
    if (allData.length > 0) {
        const latestData = allData[allData.length - 1];
        if (latestData.mq2 > 300 || latestData.mq7 > 50) {
            document.getElementById("warning").style.display = "block";
        } else {
            document.getElementById("warning").style.display = "none";
        }
    }
}

function updateChartWithData() {
    if (allData.length < 7) {
        console.warn("Data kurang dari 7, menggunakan data dummy.");
        updateChart(["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"], [50, 25, 15, 65, 75, 87, 98,], [40, 50, 30, 67, 60, 89, 54,]);
        return;
    }

    const labels = allData.map(item => item.waktu);
    const pm25Data = allData.map(item => item.mq2);
    const pm10Data = allData.map(item => item.mq7);

    updateChart(labels, pm25Data, pm10Data);
}

function updateChart(labels, pm25Data, pm10Data) {
    const ctx = document.getElementById('pmChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'MQ-2 (Gas Asap)',
                    data: pm25Data,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'MQ-7 (Karbon Monoksida)',
                    data: pm10Data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: { display: true, text: 'Waktu' }
                },
                y: {
                    title: { display: true, text: 'Konsentrasi' },
                    beginAtZero: true
                }
            },
            plugins: {
                legend: { position: 'top' },
                annotation: {
                    annotations: {
                        line1: {
                            type: 'line',
                            yMin: 300,
                            yMax: 300,
                            borderColor: 'red',
                            borderWidth: 2,
                            label: { content: 'Batas MQ-2', enabled: true }
                        },
                        line2: {
                            type: 'line',
                            yMin: 50,
                            yMax: 50,
                            borderColor: 'red',
                            borderWidth: 2,
                            label: { content: 'Batas MQ-7', enabled: true }
                        }
                    }
                }
            }
        }
    });
}
document.addEventListener("DOMContentLoaded", fetchData);
</script>
</body>
</html>