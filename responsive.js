function makeResponsive() {
    const viewportMeta = document.createElement('meta');
    viewportMeta.name = 'viewport';
    viewportMeta.content = 'width=device-width, initial-scale=1.0';
    document.head.appendChild(viewportMeta);

    const style = document.createElement('style');
    style.innerHTML = `
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            inline-size: 100%;
            max-inline-size: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col {
            flex: 1;
            padding: 10px;
        }
        @media (max-inline-size: 768px) {
            .col {
                flex: 100%;
            }
        }
    `;
    document.head.appendChild(style);
}

document.addEventListener('DOMContentLoaded', makeResponsive);

function makeTableResponsive() {
    const tableStyle = document.createElement('style');
    tableStyle.innerHTML = `
        table {
            inline-size: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: start;
            border-block-end: 1px solid #ddd;
        }
        @media (max-inline-size: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            th, td {
                inline-size: 100%;
                box-sizing: border-box;
            }
            thead tr {
                display: none;
            }
            tr {
                margin-block-end: 10px;
            }
            td {
                text-align: end;
                padding-inline-start: 50%;
                position: relative;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                inset-inline-start: 0;
                inline-size: 50%;
                padding-inline-start: 15px;
                font-weight: bold;
                text-align: start;
            }
        }
    `;
    document.head.appendChild(tableStyle);
}

document.addEventListener('DOMContentLoaded', makeTableResponsive);