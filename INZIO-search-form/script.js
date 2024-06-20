document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const keyword = document.getElementById('keyword').value;
    fetch(`fetch_results.php?keyword=${encodeURIComponent(keyword)}`)
        .then(response => response.json())
        .then(data => {
            displayResults(data);
            document.getElementById('saveJson').addEventListener('click', () => saveFile(JSON.stringify(data, null, 2), 'results.json', 'application/json'));
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

function displayResults(data) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = ''; // Clear previous results

    data.forEach(item => {
        const resultItem = document.createElement('div');
        const titleLink = document.createElement('a');
        titleLink.href = item.link;
        titleLink.textContent = item.title;
        titleLink.target = '_blank'; // Open in new tab
        resultItem.appendChild(titleLink);
        resultsContainer.appendChild(resultItem);
    });

    // Also display the raw JSON for saving
    const pre = document.createElement('pre');
    pre.textContent = JSON.stringify(data, null, 2);
    resultsContainer.appendChild(pre);
}
