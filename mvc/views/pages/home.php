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
                    <input type="text" class="form-control form-control8392"
                        placeholder="Đặt câu hỏi bất kỳ và bạn sẽ chắc chắn tìm thấy câu trả lời của mình?">
                    <span class="input-group-addon"><a href="#">Đặt Câu Hỏi Ngay</a></span>
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
                    <label for="tab1">Câu hỏi</label>

                    <input id="tab2" type="radio" name="tabs">
                    <label for="tab2">Phản hồi</label>

                    <!-- <input id="tab3" type="radio" name="tabs">
                    <label for="tab3">Câu hỏi gần đây đã được trả lời</label> -->

                    <input id="tab4" type="radio" name="tabs">
                    <label for="tab4">Chưa có câu trả lời</label>

                    <input id="tab5" type="radio" name="tabs">
                    <label for="tab5">Bài viết gần đây</label>

                    <a href="<?php echo BASE_URL ?>/home/logout">logout</a>



                    <section id="content1">
                        <!--Recent Question Content Section -->
                        <div class="question-type2033">
                            <?php
                            foreach ($questions as $question) {
                                echo '<div class="row">
                                <div class="col-md-1">
                                    <div class="left-user12923 left-user12923-repeat">
                                        <a href="#"><img src="' . BASE_URL . '/public/client/image/images.png"
                            alt="image"> </a> <a href="#"><i class="fa fa-check" aria-hidden="true"></i></a>
                        </div>
                </div>
                <div class="col-md-9">
                    <div class="right-description893">
                        <div id="que-hedder2983">
                            <h3><a href="' . BASE_URL . '/home/questions/' . $question["id"] . '" target="_blank">' . $question['title'] . '</a></h3>
                        </div>
                        <div class="ques-details10018">
                            <p>' . $question["content"] . '</p>
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
                    <!--  End of content-1------>

                    <section id="content2">
                        <!--Most Response Content Section -->
                        <div class="scrollable-sidebar">
                            <div class="question-type2033">
                                <?php
                                function timeAgo($datetime, $full = false)
                                {
                                    $now = new DateTime();
                                    $ago = new DateTime($datetime);
                                    $diff = $now->diff($ago);

                                    $diff->w = floor($diff->d / 7);
                                    $diff->d -= $diff->w * 7;

                                    $string = array(
                                        'y' => 'năm',
                                        'm' => 'tháng',
                                        'w' => 'tuần',
                                        'd' => 'ngày',
                                        'h' => 'giờ',
                                        'i' => 'phút',
                                        's' => 'giây',
                                    );
                                    foreach ($string as $k => &$v) {
                                        if ($diff->$k) {
                                            $output[] = $diff->$k . ' ' . $v;
                                        }
                                    }
                                    if (!$full)
                                        $output = array_slice($output, 0, 1);
                                    return $output ? implode(', ', $output) . ' trước' : 'vừa mới';
                                }


                                foreach ($comments as $comment) {
                                    echo '                            <div class="row">
                                        <div class="col-md-1">
                                            <div class="left-user12923 left-user12923-repeat">
                                                <a href="#"><img src="' . BASE_URL . '/public/client/image/images.png" alt="image"> </a> <a href="#"><i
                                                        class="fa fa-check" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="right-description893">
                                                <div id="que-hedder2983">
                                                    <p><a href="#">' . $comment["comment_user_name"] . '</a> đã bình luận cho bài viết</p><h3> <a href="' . BASE_URL . '/home/posts/' . $comment["post_id"] . '" target="_blank">' . $comment['post_title'] . '</a></h3>
                                                    <p><i>Của <a href="#">' . $comment["owner_name"] . '</a> </i></p>
                                                    </div>
                                                <div class="ques-details10018">
                                                    <p><a href="#" style="text-decoration: none; color: #000">' . $comment["content"] . '</a></p>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ques-type302">
                                                <a href="#"><i class="fa fa-clock-o"
                                                                aria-hidden="true"> ' . timeAgo($comment['created_at']) . '</i></a>
                                                <a href="#">
                                                    <button type="button" class="q-type238"><i class="fa fa-comment"
                                                            aria-hidden="true"> ' . $comment["comment_count"] . '
                                                            câu trả lời</i></button>
                                                </a>
                                                <a href="#">
                                                    <button type="button" class="q-type23 button-ques2973"> <i
                                                            class="fa fa-user-circle-o" aria-hidden="true"> ' . $comment["views"] . ' lượt xem</i>
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
                        </div>
                    </section>

                    <!----end of content-2----->

                    <section id="content4">
                        <!--Recently answered Content Section -->
                        <div class="question-type2033">
                            <?php
                            foreach ($posts as $post) {
                                if ($post['comment_count'] == 0) {

                                    echo '<div class="row">
                                    <div class="col-md-1">
                                        <div class="left-user12923 left-user12923-repeat">
                                            <a href="#"><img src="' . BASE_URL . '/public/client/image/images.png" alt="image"> </a> <a href="#"><i
                                                    class="fa fa-check" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="right-description893">
                                            <div id="que-hedder2983">
                                                <h3><a href="' . BASE_URL . '/home/posts/' . $post["id"] . '" target="_blank">' . $post['title'] . '</a></h3>
                                            </div>
                                            <div class="ques-details10018">
                                                <p>' . $post["content"] . '</p>
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
                    <!--End content-4 -->


                    <section id="content5">
                        <!--Recent Question Content Section -->
                        <div class="question-type2033">
                            <?php
                            foreach ($posts as $post) {
                                echo '<div class="row">
                                    <div class="col-md-1">
                                        <div class="left-user12923 left-user12923-repeat">
                                            <a href="#"><img src="' . BASE_URL . '/public/client/image/images.png" alt="image"> </a> <a href="#"><i
                                                    class="fa fa-check" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="right-description893">
                                            <div id="que-hedder2983">
                                                <h3><a href="' . BASE_URL . '/home/posts/' . $post["id"] . '" target="_blank">' . $post['title'] . '</a></h3>
                                            </div>
                                            <div class="ques-details10018">
                                                <p>' . $post["content"] . '</p>
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
                        <!--End of content-5-->
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

                </div>
            </div>
            <!--end of col-md-9 -->
            <!--strart col-md-3 (side bar)-->
            <aside class="col-md-3 sidebar97239">
                <div class="scrollable-sidebar">
                    <!--        start recent post  -->
                    <div class="recent-post3290">
                        <h4>Bài viết gần đây</h4>
                        <?php
                        $count = 0;
                        foreach ($posts as $post) {
                            if ($count >= 3) {
                                break;
                            }
                            echo '<div class="post-details021"> <a href="#">
                                <h5>' . $post['title'] . '</h5>
                            </a>
                            <p>' . $post['content'] . '</p> <small
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
                                <a href="#"><img src="' . BASE_URL . '/public/client/image/images.png" alt="Image"></a>
                                <div class="imag-overlay39"> <a href="#"><i class="fa fa-plus"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div> <span class="points-details938">
                                <a href="#">
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
                </div>
                <!--       end recent post    -->
            </aside>
        </div>
    </div>
</section>