<!--    breadcumb of category -->
<section class="header-descriptin329">
    <div class="container">
        <h3> Tất cả
            <?php echo $title ?>
        </h3>
        <ol class="breadcrumb breadcrumb839">
            <li><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
            <li><a href="<?php echo BASE_URL ?>">Danh mục</a></li>
            <li class="active"><?php echo $category_details[0]["name"] ?? "Tất cả danh mục" ?></li>
        </ol>
    </div>
</section>
<!--    body content-->
<section class="main-content920">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <section class="category2781">
                    <?php
                    if (count($posts) > 0) {
                        foreach ($posts as $post) {
                            echo '<div class="question-type2033">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="left-user12923 left-user12923-repeat">
                                    <a href="#"><img src="' . BASE_URL . '/public/src/uploads/' . $post['avatar'] . '" alt="image"> </a> <a href="#"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="right-description893">
                                    <div id="que-hedder2983">
                                        <h3><a href="' . BASE_URL . '/home/posts/' . $post["id"] . '" target="_blank">' . $post['title'] . '</a></h3>
                                    </div>
                                    <div class="ques-details10018">
                                        <p>' . stripImages($post["content"]) . '</p>
                                    </div>
                                    <hr>
                                    <div class="ques-icon-info3293"> <a href="#"><i
                                                class="fa fa-clock-o" aria-hidden="true"> ' . timeAgo($post["created_at"]) . '</i></a> <a
                                            href="' . BASE_URL . '/home/post/' . $post["id"] . '"><i class="fa fa-question-circle-o" aria-hidden="true">
                                                Câu hỏi</i></a> <a href="' . BASE_URL . '/home/posts/' . $post["id"] . '"><i class="fa fa-bug" aria-hidden="true">
                                                Báo cáo</i></a> </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="ques-type302">
                                    <a href="' . BASE_URL . '/home/posts/' . $post["id"] . '">
                                                <button type="button" class="q-type238"><i class="fa fa-comment"
                                                        aria-hidden="true"> ' . $post["comment_count"] . '</i> Bình luận</button>
                                            </a>
                                            <a href="' . BASE_URL . '/home/posts/' . $post["id"] . '">
                                                <button type="button" class="q-type23 button-ques2973"> <i
                                                        class="fa fa-user-circle-o" aria-hidden="true"> ' . $post["views"] . ' lượt xem</i>
                                                </button>
                                            </a>
                                </div>
                            </div>
                        </div>
                    </div>';
                        }
                    } else {
                        echo '<div class="question-type2033">
                        <div class="row">
                            <p style="margin: 10px;"> <b>Chưa có ' . $title . '</b></p>
                        </div>
                    </div>';
                    }
                    ?>

                </section>
            </div>
            <!-- end of col-md-9 -->
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
                            echo '<div class="post-details021"> <a href="' . BASE_URL . '/home/posts/' . $post["id"] . '">
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
                                <a href="#"><img src="' . BASE_URL . '/public/src/uploads/' . $user['image'] . '" alt="Image"></a>
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