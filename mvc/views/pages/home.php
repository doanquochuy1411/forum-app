<style>
/* CSS cho hiệu ứng fade in/out */
.question-type2033 {
    opacity: 1;
    transition: opacity 0.5s ease-in-out;
}

.question-type2033.fade-out {
    opacity: 0;
}
</style>
<!-- ======content section/body=====-->
<section class="main-content920">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div id="main">
                    <input id="tab1" type="radio" name="tabs" checked>
                    <label for="tab1">Bài viết gần đây</label>

                    <input id="tab2" type="radio" name="tabs">
                    <label for="tab2">Câu hỏi</label>

                    <input id="tab3" type="radio" name="tabs">
                    <label for="tab3">Mua bán</label>

                    <?php
                    if (isset($_SESSION["UserID"])) {
                        echo '<input id="tab5" type="radio" name="tabs">
                        <label for="tab5">Bài viết của tôi</label>';
                    }
                    ?>

                    <input id="tab4" type="radio" name="tabs">
                    <label for="tab4">Tạo mới</label>

                    <!-- Posts -->
                    <section id="content1">
                        <!-- Recently answered Content Section -->
                        <div class="question-type2033">
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous" id="prevBtn">
                                        <span aria-hidden="true">&laquo; Trước</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" aria-label="Next" id="nextBtn">
                                        <span aria-hidden="true">Sau &raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </section>



                    <!--my posts -->
                    <section id="content5">
                        <div class="question-type2033">

                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous" id="prevBtn">
                                        <span aria-hidden="true">&laquo; Trước</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" aria-label="Next" id="nextBtn">
                                        <span aria-hidden="true">Sau &raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </section>

                    <!-- Questions -->
                    <section id="content2">
                        <div class="question-type2033">

                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous" id="prevBtn">
                                        <span aria-hidden="true">&laquo; Trước</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" aria-label="Next" id="nextBtn">
                                        <span aria-hidden="true">Sau &raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </section>


                    <!-- Create post -->
                    <section id="content4">
                        <!--Recent Question Content Section -->
                        <form id="postForm" action="<?php echo BASE_URL ?>/home/createPost" method="post"
                            onsubmit="return validateFormCreatePost()">
                            <div class=" form-group row">
                                <div class="col-md-6">
                                    <label for="contentType">Loại bài đăng</label>
                                    <select id="contentType" name="contentType" class="form-control">
                                        <option value="post" selected>Bài viết</option>
                                        <option value="question">Đặt câu hỏi</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="contentCategory">Danh mục</label>
                                    <select id="contentCategory" name="contentCategory" class="form-control">
                                        <?php
                                        $first = true;
                                        foreach ($categories as $category) {
                                            $selected = $first ? 'selected' : '';
                                            echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
                                            $first = false;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Input for title -->
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Nhập tiêu đề">
                                <small id="title_err"></small>
                            </div>

                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <div id="tagsInputContainer" class="form-control">
                                    <input type="text" id="tagsInput" placeholder="Nhập các tags, Enter để thêm"
                                        style="border: none; outline: none; width: 100%;">
                                </div>
                            </div>
                            <div id="hiddenTagsContainer"></div>

                            <div id="editorContainer">
                                <label for="editor">Nội dung</label>
                                <div id="editor"></div>
                                <input type="hidden" id="editorContent" name="content" />
                                <small id="editorContent_err"></small>
                            </div>

                            <input type="hidden" name="token"
                                value="<?php echo isset($_SESSION['_token']) ? $_SESSION['_token'] : "" ?>" />
                            <div class="text-right">
                                <button type="submit" name="btnCreatePost" class="btn btn-primary"
                                    style="margin-top: 5px;">Đăng</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
            <!--end of col-md-9 -->
            <!--strart col-md-3 (side bar)-->
            <?php require_once 'sidebar.php' ?>
        </div>
    </div>
</section>
<script>
var postsData = <?php echo json_encode($posts); ?>;
var questionsData = <?php echo json_encode($questions); ?>;
var myPostsData = <?php echo json_encode($my_posts); ?>;

function paginate(data, page, limit, containerId) {
    var start = (page - 1) * limit;
    var end = start + limit;
    var paginatedData = data.slice(start, end);

    var container = document.querySelector(containerId + ' .question-type2033');
    container.classList.add('fade-out');

    setTimeout(function() {
        container.innerHTML = '';

        paginatedData.forEach(function(post) {
            var content = stripImages(post.content);
            var html = '<div class="row">';
            html += '<div class="col-md-1">';
            html += '<div class="left-user12923 left-user12923-repeat">';
            html += '<a href="<?php echo BASE_URL ?>/home/info/' + post.account_name +
                '"><img src="<?php echo BASE_URL ?>/public/src/uploads/' + post.avatar +
                '" alt="image"> </a> <a href="#"><i class="fa fa-check" aria-hidden="true"></i></a>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-9">';
            html += '<div class="right-description893">';
            html += '<div id="que-hedder2983">';
            html += '<h3><a href="<?php echo BASE_URL ?>/home/posts/' + post.id + '" target="_blank">' +
                post.title + '</a></h3>';
            html += '</div>';
            html += '<div class="ques-details10018">';
            html += '<p>' + content + '</p>';
            html += '</div>';
            html += '<hr>';
            html +=
                '<div class="ques-icon-info3293"> <a href="#"><i class="fa fa-check" aria-hidden="true"> solved</i></a> <a href="#"><i class="fa fa-star" aria-hidden="true"> 5</i> </a> <a href="#"><i class="fa fa-folder" aria-hidden="true"> wordpress</i></a> <a href="#"><i class="fa fa-clock-o" aria-hidden="true"> 4 min ago</i></a> <a href="#"><i class="fa fa-comment" aria-hidden="true"> 5 answer</i></a> <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"> 70 view</i> </a>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-2">';
            html += '<div class="ques-type302">';
            html +=
                '<a href="#"><button type="button" class="q-type238"><i class="fa fa-comment" aria-hidden="true"> ' +
                post.comment_count + '</i> Bình luận</button></a>';
            html +=
                '<a href="#"><button type="button" class="q-type23 button-ques2973"> <i class="fa fa-user-circle-o" aria-hidden="true"> ' +
                post.views + ' lượt xem</i></button></a>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            container.innerHTML += html;
        });

        container.classList.remove('fade-out');
    }, 300); // Thời gian chờ để hiệu ứng fade out hoàn thành
}

function stripImages(content) {
    return content.replace(/<img[^>]*>/g, '');
}

function updatePagination(totalItems, limit, containerId, currentPage) {
    var totalPages = Math.ceil(totalItems / limit);
    var paginationContainer = document.querySelector(containerId + ' .pagination');
    paginationContainer.innerHTML = '';

    var prevBtn = document.createElement('li');
    var prevA = document.createElement('a');
    prevA.href = '#';
    prevA.innerHTML = '<span aria-hidden="true">&laquo; Trước</span>';
    prevA.addEventListener('click', function(event) {
        event.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            paginate(postsData, currentPage, limit, containerId);
            updatePagination(totalItems, limit, containerId, currentPage);
        }
    });
    prevBtn.appendChild(prevA);
    paginationContainer.appendChild(prevBtn);

    for (var i = 1; i <= totalPages; i++) {
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.href = '#';
        a.textContent = i;
        a.addEventListener('click', function(event) {
            event.preventDefault();
            currentPage = parseInt(this.textContent);
            paginate(postsData, currentPage, limit, containerId);
            updatePagination(totalItems, limit, containerId, currentPage);
        });
        if (i === currentPage) {
            li.classList.add('active');
        }
        li.appendChild(a);
        paginationContainer.appendChild(li);
    }

    var nextBtn = document.createElement('li');
    var nextA = document.createElement('a');
    nextA.href = '#';
    nextA.innerHTML = '<span aria-hidden="true">Sau &raquo;</span>';
    nextA.addEventListener('click', function(event) {
        event.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            paginate(postsData, currentPage, limit, containerId);
            updatePagination(totalItems, limit, containerId, currentPage);
        }
    });
    nextBtn.appendChild(nextA);
    paginationContainer.appendChild(nextBtn);
}

// Khởi tạo phân trang cho content1
var currentPageContent1 = 1;
paginate(postsData, currentPageContent1, 5, '#content1');
updatePagination(postsData.length, 5, '#content1', currentPageContent1);

// Khởi tạo phân trang cho content2
var currentPageContent2 = 1;
paginate(questionsData, currentPageContent2, 5, '#content2');
updatePagination(questionsData.length, 5, '#content2', currentPageContent2);

// Khởi tạo phân trang cho content5
var currentPageContent5 = 1;
paginate(myPostsData, currentPageContent5, 5, '#content5');
updatePagination(myPostsData.length, 5, '#content5', currentPageContent5);
</script>