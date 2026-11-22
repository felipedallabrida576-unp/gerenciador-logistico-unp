
fetch('load_trackm.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao buscar os pedidos.');
        }
        return response.json();
    })
    .then(data => {

        const ctx = document.getElementById('myAreaChart');

        new Chart(ctx, {
            type: 'bar',

            data: {
                labels: [
                    'Janeiro', 'Fevereiro', 'Março',
                    'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro',
                    'Outubro', 'Novembro', 'Dezembro'
                ],

                datasets: [{
                    label: 'Pedidos por mês',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }]
                },

                legend: {
                    display: true
                }
            }
        });

    })
    .catch(error => console.error(error));
