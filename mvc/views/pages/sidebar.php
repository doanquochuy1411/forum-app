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
                                <a href="' . BASE_URL . '/home/info/' . encryptData($user["account_name"]) . '"><img src="' . BASE_URL . '/public/src/uploads/' . $post['avatar'] . '" alt="Image"></a>
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