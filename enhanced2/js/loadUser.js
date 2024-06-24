fetch('displayUser.php')
                        .then(response => response.text())
                        .then(html => document.getElementById('data-container').innerHTML = html)
                        .catch(error => console.error('Error loading the data:', error));