<!--======= welcome section on top background=====-->
<section class="welcome-part-one">
    <div class="container">
        <div class="welcome-demop102 text-center">
            <h2>Chào mừng đến với Ask me, Mẫu Câu Hỏi & Trả Lời Tuyệt Vời</h2>
            <p>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis.
                Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi
                tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vitae velit in neque dictum
                blandit.</p>
            <div class="button0239-item">
                <a href="#">
                    <button type="button" class="aboutus022">Về Chúng Tôi</button>
                </a>
                <a href="#">
                    <button type="button" class="join92">Tham Gia Ngay</button>
                </a>
            </div>
            <div class="form-style8292">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil-square" aria-hidden="true"></i></span>
                    <input type="text" id="txtSearch_body" class="form-control form-control8392"
                        placeholder="Đặt câu hỏi bất kỳ và bạn sẽ chắc chắn tìm thấy câu trả lời của mình?">
                    <span class="input-group-addon">
                        <a href="#" onclick="handleSearchLink(event)">Đặt Câu Hỏi Ngay</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

</section>


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


                    <!--  End of content-1------>

                    <!-- Posts -->
                    <section id="content1">
                        <!--Recently answered Content Section -->
                        <div class="question-type2033">
                            <?php
                            foreach ($posts as $post) {
                                // echo 'hihi';
                                $content = stripImages($post["content"]);
                                echo '<div class="row">
                                    <div class="col-md-1">
                                        <div class="left-user12923 left-user12923-repeat">
                                            <a href="' . BASE_URL . '/home/info/' . encryptData($post["account_name"]) . '"><img src="' . BASE_URL . '/public/client/image/images.png" alt="image"> </a> <a href="#"><i
                                                    class="fa fa-check" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="right-description893">
                                            <div id="que-hedder2983">
                                                <h3><a href="' . BASE_URL . '/home/posts/' . $post["id"] . '" target="_blank">' . $post['title'] . '</a></h3>
                                            </div>
                                            <div class="ques-details10018">
                                                <p>' . $content . '</p>
                                            </div>
                                            <hr>
                                            <div class="ques-icon-info3293"> <a href="#"><i class="fa fa-check"
                                                        aria-hidden="true">
                                                        solved</i></a> <a href="#"><i class="fa fa-star" aria-hidden="true">
                                                        5</i> </a> <a href="#"><i class="fa fa-folder" aria-hidden="true">
                                                        wordpress</i></a> <a href="#"><i class="fa fa-clock-o"
                                                        aria-hidden="true"> 4 min
                                                        ago</i></a> <a href="#"><i class="fa fa-comment" aria-hidden="true">
                                                        5 answer</i></a> <a href="#"><i class="fa fa-user-circle-o"
                                                        aria-hidden="true"> 70
                                                        view</i> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="ques-type302">
                                            <a href="#">
                                                <button type="button" class="q-type238"><i class="fa fa-comment"
                                                        aria-hidden="true"> ' . $post["comment_count"] . '</i> Bình luận</button>
                                            </a>
                                            <a href="#">
                                                <button type="button" class="q-type23 button-ques2973"> <i
                                                        class="fa fa-user-circle-o" aria-hidden="true"> ' . $post["views"] . ' lượt xem</i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
                            }
                            ?>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </section>

                    <!--my posts -->
                    <section id="content5">
                        <!--Recently answered Content Section -->
                        <div class="question-type2033">
                            <?php
                            if (count($my_posts) > 0) {
                                foreach ($my_posts as $post) {
                                    $content = stripImages($post["content"]);
                                    echo '<div class="row">
                                        <div class="col-md-1">
                                            <div class="left-user12923 left-user12923-repeat">
                                                <a href="' . BASE_URL . '/home/info/' . encryptData($post["account_name"]) . '"><img src="' . BASE_URL . '/public/client/image/images.png" alt="image"> </a> <a href="#"><i
                                                        class="fa fa-check" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="right-description893">
                                                <div id="que-hedder2983">
                                                    <h3>
                                                    <a href="' . BASE_URL . '/posts/edit/' . $post["id"] . '" target="_blank">' . $post['title'] . '</a>
                                                    <a href="#" style="color: red" title="Xóa bài viết"><i class="fa fa-close" onclick="confirmDelete(event,\'' . BASE_URL . '/posts/delete/' . $post['id'] . '\')"></i></a>
                                                    </h3>
                                                </div>
                                                <div class="ques-details10018">
                                                    <p>' . $content . '</p>
                                                </div>
                                                <hr>
                                                <div class="ques-icon-info3293"> <a href="#"><i class="fa fa-check"
                                                            aria-hidden="true">
                                                            solved</i></a> <a href="#"><i class="fa fa-star" aria-hidden="true">
                                                            5</i> </a> <a href="#"><i class="fa fa-folder" aria-hidden="true">
                                                            wordpress</i></a> <a href="#"><i class="fa fa-clock-o"
                                                            aria-hidden="true"> 4 min
                                                            ago</i></a> <a href="#"><i class="fa fa-comment" aria-hidden="true">
                                                            5 answer</i></a> <a href="#"><i class="fa fa-user-circle-o"
                                                            aria-hidden="true"> 70
                                                            view</i> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ques-type302">
                                                <a href="#">
                                                    <button type="button" class="q-type238"><i class="fa fa-comment"
                                                            aria-hidden="true"> ' . $post["comment_count"] . '</i> Bình luận</button>
                                                </a>
                                                <a href="#">
                                                    <button type="button" class="q-type23 button-ques2973"> <i
                                                            class="fa fa-user-circle-o" aria-hidden="true"> ' . $post["views"] . ' lượt xem</i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '
                        <div class="row">
                            <p style="margin: 10px;"> <b>Chưa có bài viết</b></p>
                    </div>';
                            }
                            ?>
                        </div>
                        <?php
                        if (count($my_posts) > 0) {
                            echo '<nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>';
                        }
                        ?>

                    </section>
                    <!--End content-4 -->

                    <!-- Questions -->
                    <section id="content2">
                        <!--Recent Question Content Section -->
                        <div class="question-type2033">
                            <?php
                            foreach ($questions as $question) {
                                $content = stripImages($question["content"]);

                                echo '<div class="row">
                                <div class="col-md-1">
                                    <div class="left-user12923 left-user12923-repeat">
                                        <a href="' . BASE_URL . '/home/info/' . encryptData($question["account_name"]) . '"><img src="' . BASE_URL . '/public/client/image/images.png"
                            alt="image"> </a> <a href="#"><i class="fa fa-check" aria-hidden="true"></i></a>
                        </div>
                </div>
                <div class="col-md-9">
                    <div class="right-description893">
                        <div id="que-hedder2983">
                            <h3><a href="' . BASE_URL . '/home/posts/' . $question["id"] . '" target="_blank">' . $question['title'] . '</a></h3>
                        </div>
                        <div class="ques-details10018">
                            <p>' . $content . '</p>
                        </div>
                        <hr>
                        <div class="ques-icon-info3293"> <a href="#"><i class="fa fa-star" aria-hidden="true"> 5 </i>
                            </a> <a href="#"><i class="fa fa-folder" aria-hidden="true"> wordpress</i></a> <a
                                href="#"><i class="fa fa-clock-o" aria-hidden="true"> 4 min
                                    ago</i></a> <a href="#"><i class="fa fa-question-circle-o" aria-hidden="true">
                                    Question</i></a> <a href="#"><i class="fa fa-bug" aria-hidden="true"> Report</i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ques-type302">
                        <a href="#">
                            <button type="button" class="q-type238"><i class="fa fa-comment" aria-hidden="true"> ' . $question["comment_count"] . ' câu trả lời</i></button>
                        </a>
                        <a href="#">
                            <button type="button" class="q-type23 button-ques2973"> <i class="fa fa-user-circle-o"
                                    aria-hidden="true"> ' . $question['views'] . ' lượt xem</i>
                            </button>
                        </a>
                    </div>  
                </div>
            </div>';
                            }
                            ?>
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
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
            <aside class="col-md-3 sidebar97239">
                <div class="scrollable-sidebar">
                    <div class="categori-part329">
                        <h4>Danh mục</h4>
                        <ul>
                            <?php
                            if (count($categories) > 0) {
                                foreach ($categories as $category) {
                                    echo '<li><a href="' . BASE_URL . '/home/categories/' . $category['id'] . '/post">' . $category['name'] . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="recent-post3290">
                        <h4>Bài viết gần đây</h4>
                        <?php
                        $count = 0;
                        foreach ($recent_posts as $post) {
                            if ($count >= 8) {
                                break;
                            }
                            echo '<div class="post-details021"> <a href="' . BASE_URL . '/home/posts/' . $post['id'] . '">
                                <h5>' . $post['title'] . '</h5>
                            </a>
                            <small
                                style="color: red">', $post['created_at'], '</small>    
                        </div>
                        <hr>';
                            $count++;
                        }
                        ?>
                    </div>
                    <div class="highest-part302">
                        <h4>Đóng góp nhiều nhất</h4>
                        <?php
                        $count = 0;
                        foreach ($users as $user) {
                            if ($count >= 5) {
                                break;
                            }
                            echo '<div class="pints-wrapper">
                            <div class="left-user3898">
                                <a href="' . BASE_URL . '/home/info/' . encryptData($user["account_name"]) . '"><img src="' . BASE_URL . '/public/client/image/images.png" alt="Image"></a>
                                <div class="imag-overlay39"> <a href="#"><i class="fa fa-plus"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div> <span class="points-details938">
                                <a href="' . BASE_URL . '/home/info/' . encryptData($user["account_name"]) . '">
                                    <h5>' . $user["user_name"] . '</h5>
                                </a>
                                <a href="#" class="designetion439">Người dùng</a>
                                <p>' . $user["point"] . ' điểm</p>
                            </span>
                        </div>
                        <hr>';
                            $count++;
                        }
                        ?>
                    </div>
                    <!--               end of Highest points -->
                    <!--          start tags part-->
                    <div class="tags-part2398">
                        <h4>Tags</h4>
                        <ul>
                            <?php
                            if (count($tags)) {
                                $count = 0;
                                foreach ($tags as $tag) {
                                    if ($count >= 5) {
                                        break;
                                    }
                                    echo '<li><a href="' . BASE_URL . '/home/tags/' . $tag['name'] . '">' . $tag['name'] . '</a></li>';
                                    $count++;
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <!--          End tags part-->

                </div>
            </aside>
        </div>
    </div>
</section>