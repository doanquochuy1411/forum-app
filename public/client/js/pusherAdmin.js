Pusher.logToConsole = true;

    var pusher = new Pusher('c3b55afe49178f9e72ea', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('post-reported');
    channel.bind('PostReported', function(data) {
        updateNotifications();
    });

    function updateNotifications() {
        $.ajax({
            url: 'http://localhost/forum-app/api/getNotifications', // Đường dẫn tới hàm xử lý lấy thông báo trên server
            type: 'GET',
            success: function(response) {
                // Chuyển đổi chuỗi JSON thành đối tượng JavaScript
                var data = JSON.parse(response);
                // console.log(data)
                if (data.code === 200) {
                    // Update số lượng thông báo
                    $('.badge').text(data.count);

                    // Xóa các thông báo cũ trong dropdown
                    $('#notification-dropdown').find('li:not(.dropdown-header, .divider)').remove();

                    // Thêm các thông báo mới vào dropdown
                    data.notifications.forEach(function(notification) {
                        // console.log(notification)
                        var image = 'http://localhost/forum-app/public/client/image/images.png';
                        if (notification.comment_id != null) {
                            // Gọi API để lấy thông tin người dùng từ comment_id
                            getAuthOfComment(notification.comment_id, function(userDetail) {
                            // console.log("user details: " + userDetail.user_details[0]);
                            image = 'http://localhost/forum-app/public/src/uploads/' + userDetail.user_details[0].avatar; // Sử dụng avatar của người dùng
                            // notification.message += userDetail.user_details[0].comment_user_name
                            notification.message = userDetail.user_details[0].comment_user_name.concat(" ", notification.message) 
                            // Thêm thông báo vào dropdown
                            addNotificationToDropdown(notification, image);
                        });
                        } else {
                            // Thêm thông báo vào dropdown
                            addNotificationToDropdown(notification, image);
                        }
                    });
                } else {
                    console.log("Lỗi rồi"); // Log trạng thái khi không có thông báo mới
                    console.log(data)
                }
            },
            error: function() {
                console.log("Error fetching notifications.");
            }
        });
    }

    function addNotificationToDropdown(notification, image) {
        $('#notification-dropdown').append(
            `<li class="notification-message">
                                        <a href="http://localhost/forum-app/home/notifications/${notification.id}">
                                            <div class="media">
                                                <span class="avatar">U</span>
                                                <div class="media-body">
                                                    <p class="noti-details">${notification.message}</p>
                                                    <p class="noti-time"><span class="notification-time">${timeAgo(notification.created_at)}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>`
        );
    }

    function getAuthOfComment(cmt_id, callback) {
        $.ajax({
            url: `http://localhost/forum-app/api/getUserDetailsViaCmtID/${cmt_id}`, // Đường dẫn tới hàm xử lý lấy thông báo trên server
            type: 'GET',
            success: function(response) {
                // Chuyển đổi chuỗi JSON thành đối tượng JavaScript
                var userDetail = JSON.parse(response);
                console.log(userDetail)
                callback(userDetail);
            },
            error: function() {
                console.log("Error fetching notifications.");
                callback({ avatar: 'http://localhost/forum-app/public/client/image/images.png' });
            }
        });
    }

    $(document).ready(function() {
        updateNotifications(); // Lấy và hiển thị thông báo khi tải trang
    });

    function timeAgo(datetime) {
        const now = new Date();
        const ago = new Date(datetime);
        const diffInSeconds = Math.floor((now - ago) / 1000);
    
        const timeUnits = {
            year: 'năm',
            month: 'tháng',
            week: 'tuần',
            day: 'ngày',
            hour: 'giờ',
            minute: 'phút',
            second: 'giây'
        };
    
        const secondsInUnits = {
            year: 31536000,
            month: 2592000,
            week: 604800,
            day: 86400,
            hour: 3600,
            minute: 60,
            second: 1
        };
    
        let result = '';
        for (const [unit, label] of Object.entries(timeUnits)) {
            const interval = Math.floor(diffInSeconds / secondsInUnits[unit]);
            if (interval > 0) {
                result = interval + ' ' + label + ' trước';
                break;  // Chỉ lấy khoảng thời gian lớn nhất
            }
        }
    
        return result || 'vừa mới';  // Nếu không có khoảng thời gian lớn hơn 0, hiển thị 'vừa mới'
    }
    
    