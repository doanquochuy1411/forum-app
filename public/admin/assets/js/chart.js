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

    // Top 10 bài viết có lượt xem cao nhất
    // var ctx3 = document.getElementById('viewsChart').getContext('2d');
    // var viewsChart = new Chart(ctx3, {
    //     type: 'bar',
    //     data: {
    //         labels: [],
    //         datasets: [{
    //             label: 'Số lượt xem',
    //             data: [],
    //             backgroundColor: 'rgba(255, 159, 64, 0.2)',
    //             borderColor: 'rgba(255, 159, 64, 1)',
    //             borderWidth: 1
    //         }]
            
    //     },
    //     options: {
    //         scales: { y: { beginAtZero: true } }
    //     }
    // });

    // // Top 10 bài viết có lượt like cao nhất
    // var ctx4 = document.getElementById('likesChart').getContext('2d');
    // var likesChart = new Chart(ctx4, {
    //     type: 'bar',
    //     data: {
    //         labels: [],
    //         datasets: [{
    //             label: 'Số lượt thích',
    //             data: [],
    //             backgroundColor: 'rgba(153, 102, 255, 0.2)',
    //             borderColor: 'rgba(153, 102, 255, 1)',
    //             borderWidth: 1
    //         }]
            
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });
   // Top 10 bài viết có lượt xem cao nhất
var ctx3 = document.getElementById('viewsChart').getContext('2d');
var viewsChart = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: [], // Nhãn sẽ được cập nhật sau
        datasets: [{
            label: 'Số lượt xem',
            data: [],
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Số lượt xem'
                }
            },
            x: {
                display: false // Ẩn nhãn trục x
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    title: function(tooltipItems) {
                        // Hiển thị tiêu đề bài viết khi hover
                        return tooltipItems[0].label;
                    },
                    label: function(tooltipItem) {
                        // Hiển thị số lượt xem bên cạnh tiêu đề
                        return `Số lượt xem: ${tooltipItem.raw}`;
                    }
                }
            }
        }
    }
});

// Top 10 bài viết có lượt thích cao nhất
var ctx4 = document.getElementById('likesChart').getContext('2d');
var likesChart = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: [], // Nhãn sẽ được cập nhật sau
        datasets: [{
            label: 'Số lượt thích',
            data: [],
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Số lượt thích'
                }
            },
            x: {
                display: false // Ẩn nhãn trục x
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    title: function(tooltipItems) {
                        // Hiển thị tiêu đề bài viết khi hover
                        return tooltipItems[0].label;
                    },
                    label: function(tooltipItem) {
                        // Hiển thị số lượt thích bên cạnh tiêu đề
                        return `Số lượt thích: ${tooltipItem.raw}`;
                    }
                }
            }
        }
    }
});



  function getCurrentYear() {
        const currentDate = new Date();
        return currentDate.getFullYear();
    }

    function updateChartData(year) {
        // Tạo hai promise từ fetch
        const postStatsPromise = fetch(BASE_URL+'/api/getPostToStatistics/' + year)
            .then(response => response.json());
            
        const userStatsPromise = fetch(BASE_URL+'/api/getUserToStatistics/' + year)
            .then(response => response.json());
        
        const postByViewsStatsPromise = fetch(BASE_URL+'/api/GetTopPostsByViews/' + 10)
            .then(response => response.json());
            
        const postByLikesStatsPromise = fetch(BASE_URL+'/api/GetTopPostsByLikes/' + 10)
            .then(response => response.json());
    
        // Sử dụng Promise.all để đợi cả fetch hoàn thành
        Promise.all([postStatsPromise, userStatsPromise, postByViewsStatsPromise, postByLikesStatsPromise])
            .then(([postData, userData, postByViewsData, postByLikesData]) => {
                console.log('Post Data:', postData);
                console.log('User Data:', userData);
                console.log('Top Posts by Views:', postByViewsData);
                console.log('Top Posts by Likes:', postByLikesData);

                // Cập nhật biểu đồ bài viết
                postsChart.data.datasets[0].data = postData.posts;
                postsChart.update(); 
    
                // Cập nhật biểu đồ người dùng
                usersChart.data.datasets[0].data = userData.users;
                usersChart.update(); 

                // Cập nhật biểu đồ Top 10 bài viết có lượt xem cao nhất
                const viewPostTitles = postByViewsData.top_posts_by_views.map(post => post.title);
                const viewCounts = postByViewsData.top_posts_by_views.map(post => post.views);

                viewsChart.data.labels = viewPostTitles; // Cập nhật tiêu đề các bài viết
                viewsChart.data.datasets[0].data = viewCounts; // Cập nhật số lượt xem
                viewsChart.update();

                // Cập nhật biểu đồ Top 10 bài viết có lượt thích cao nhất
                const likePostTitles = postByLikesData.top_posts_by_likes.map(post => post.title);
                const likeCounts = postByLikesData.top_posts_by_likes.map(post => post.likes);

                likesChart.data.labels = likePostTitles; // Cập nhật tiêu đề các bài viết
                likesChart.data.datasets[0].data = likeCounts; // Cập nhật số lượt thích
                likesChart.update();
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