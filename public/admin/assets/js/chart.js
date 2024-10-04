document.addEventListener('DOMContentLoaded', function() {
    // Tạo biểu đồ số lượng bài viết theo tháng
    var ctx = document.getElementById('postsChart').getContext('2d');
    var postsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Số lượng bài viết',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Tạo biểu đồ số lượng người dùng theo tháng
    var ctx2 = document.getElementById('usersChart').getContext('2d');
    var usersChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            datasets: [{
                label: 'Số lượng người dùng',
                data: [],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
            
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

  function getCurrentYear() {
        const currentDate = new Date();
        return currentDate.getFullYear();
    }

    // Hàm cập nhật dữ liệu biểu đồ từ server
    // function updateChartData(year) {
    //     // Sử dụng fetch để lấy dữ liệu từ server
    //     fetch('http://localhost/forum-app/api/getPostToStatistics/' + year)
    //         .then(response => response.json())
    //         .then(data => {
    //             postsChart.data.datasets[0].data = data.posts;
    //             postsChart.update(); 
    //         })
    //         .catch(error => console.error('Error:', error));

    //     fetch('http://localhost/forum-app/api/getUserToStatistics/' + year)
    //         .then(response => response.json())
    //         .then(data => {
    //             usersChart.data.datasets[0].data = data.users;
    //             usersChart.update(); 
    //         })
    //         .catch(function(error) {
    //                         console.error('Error:', error);
    //                     });
    // }
    function updateChartData(year) {
        // Tạo hai promise từ fetch
        const postStatsPromise = fetch('http://localhost/forum-app/api/getPostToStatistics/' + year)
            .then(response => response.json());
            
        const userStatsPromise = fetch('http://localhost/forum-app/api/getUserToStatistics/' + year)
            .then(response => response.json());
    
        // Sử dụng Promise.all để đợi cả hai fetch hoàn thành
        Promise.all([postStatsPromise, userStatsPromise])
            .then(([postData, userData]) => {
                // Cập nhật biểu đồ bài viết
                postsChart.data.datasets[0].data = postData.posts;
                postsChart.update(); 
    
                // Cập nhật biểu đồ người dùng
                usersChart.data.datasets[0].data = userData.users;
                usersChart.update(); 
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    }
    

    document.getElementById('yearSelect').addEventListener('change', function() {
        var selectedYear = this.value;
        updateChartData(selectedYear);  
    });

    updateChartData(getCurrentYear());
});