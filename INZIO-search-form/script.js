document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const keyword = document.getElementById('keyword').value;
    fetch(`fetch_results.php?keyword=${encodeURIComponent(keyword)}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('results').textContent = JSON.stringify(data, null, 2);
            document.getElementById('saveJson').addEventListener('click', () => saveFile(data, 'results.json', 'application/json'));
            document.getElementById('saveCsv').addEventListener('click', () => saveFile(convertToCSV(data), 'results.csv', 'text/csv'));
        })
        .catch(error => console.error('Error:', error));
});

function saveFile(content, fileName, contentType) {
    const a = document.createElement('a');
    const file = new Blob([content], {type: contentType});
    a.href = URL.createObjectURL(file);
    a.download = fileName;
    a.click();
}

function convertToCSV(data) {
    const csvRows = [];
    const headers = Object.keys(data[0]);
    csvRows.push(headers.join(','));

    for (const row of data) {
        const values = headers.map(header => row[header]);
        csvRows.push(values.join(','));
    }

    return csvRows.join('\n');
}
