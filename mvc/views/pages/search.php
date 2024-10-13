<!--    breadcumb of category -->
<section class="header-descriptin329">
    <div class="container">
        <h3> Tất cả
        </h3>
        <ol class="breadcrumb breadcrumb839">
            <li><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
            <li><a href="<?php echo BASE_URL ?>">Tìm kiếm</a></li>
            <li class="active"><?php echo $search ?? "" ?></li>
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
                                        <p>' . stripImages($post["content"]) . '</p>
                                    </div>
                                    <hr>
                                    <div class="ques-icon-info3293">  <a href="#" style="color: #222629"><i class="fa fa-thumbs-up" aria-hidden="true"> ' . $post["like_count"] . ' Thích</i></a>
                                     <a href="#"><i
                                                class="fa fa-clock-o" aria-hidden="true"> ' . timeAgo($post["created_at"]) . '</i></a> <a
                                            href="#"><i class="fa fa-comment" aria-hidden="true"> ' . $post["comment_count"] . '
                                                Trả lời</i></a> <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true">
                                                ' . $post["views"] . ' lượt xem</i></a></div>
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
                            <p style="margin: 10px;"> <b>Chưa có bài viết</b></p>
                        </div>
                    </div>';
                    }
                    ?>

                </section>
            </div>
            <!-- end of col-md-9 -->
            <!--strart col-md-3 (side bar)-->
            <?php require_once 'sidebar.php' ?>

        </div>
    </div>
</section>