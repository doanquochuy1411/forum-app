<section class="header-descriptin329">
    <div class="container">
        <h3>Post Details</h3>
        <ol class="breadcrumb breadcrumb839">
            <li><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
            <li><a href="<?php echo BASE_URL ?>">Bài viết</a></li>
            <li class="active"><?php echo $posts[0]["title"] ?></li>
        </ol>
    </div>
</section>
<section class="main-content920">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="post-details">
                    <div class="details-header923">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="post-title-left129">
                                    <h3><?php echo $posts[0]["title"] ?></h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="post-que-rep-rihght320"> <a href="#"><i class="fa fa-question-circle"
                                            aria-hidden="true"></i> Câu hỏi</a> <a href="#" class="r-clor10">Báo cáo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-details-info1982">
                        <p><?php echo $posts[0]["content"] ?></p>
                        <hr>
                        <div class="post-footer29032">
                            <div class="l-side2023">
                                <!-- <i class="fa fa-check check2" aria-hidden="true"> solved</i> <a href="#"><i
                                        class="fa fa-star star2" aria-hidden="true"> 5</i></a> <i -->
                                <!-- class="fa fa-folder folder2" aria-hidden="true"> wordpress</i> -->
                                <i class="fa fa-clock-o clock2" aria-hidden="true">
                                    <?php echo timeAgo($posts[0]["created_at"]) ?></i> <a href="#"><i
                                        class="fa fa-commenting commenting2" aria-hidden="true">
                                        <?php echo count($comments) ?> trả lời</i></a> <i class="fa fa-user user2"
                                    aria-hidden="true"> <?php echo $posts[0]["views"] ?> lượt xem</i>
                            </div>
                            <!-- <div class="l-rightside39">
                                <button type="button" class="tolltip-button thumbs-up2" data-toggle="tooltip"
                                    data-placement="bottom" title="Like"><i class="fa fa-thumbs-o-up "
                                        aria-hidden="true"></i></button>
                                <button type="button" class="tolltip-button  thumbs-down2" data-toggle="tooltip"
                                    data-placement="bottom" title="Dislike"><i class="fa fa-thumbs-o-down"
                                        aria-hidden="true"></i></button> <span
                                    class="single-question-vote-result">+22</span>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="share-tags-page-content12092">
                    <div class="l-share2093">
                        <i class="fa fa-share" aria-hidden="true"> Chia sẻ: </i>
                        <a style="margin: 0 2px"
                            href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL ?>/home/posts/<?php echo $posts[0]["id"] ?>"
                            target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"> </i>
                        </a>
                        <a style="margin: 0 2px"
                            href="https://t.me/share/url?url=<?php echo BASE_URL ?>/home/posts/<?php echo $posts[0]["id"] ?>"
                            target="_blank">
                            <i class="fa fa-instagram" aria-hidden="true"> </i>
                        </a>
                        <a style="margin: 0 2px"
                            href="https://t.me/share/url?url=<?php echo BASE_URL ?>/home/posts/<?php echo $posts[0]["id"] ?>"
                            target="_blank">
                            <i class="fa fa-telegram" aria-hidden="true"> </i>
                        </a>
                    </div>


                    <div class="R-tags309"> <i class="fa fa-tags" aria-hidden="true">
                            <?php if (count($tags_of_post) > 0) {
                                $tagNames = [];

                                foreach ($tags_of_post as $tag) {
                                    // Lặp qua từng tag và thêm tên vào mảng $tagNames
                                    foreach ($tags_of_post as $tag) {
                                        $tagNames[] = $tag['name'];
                                    }
                                }

                                // Nối các phần tử của mảng $tagNames thành một chuỗi và in ra
                                echo implode(', ', $tagNames);
                            }
                            ?>
                        </i>
                    </div>
                </div>
                <div class="comment-list12993">
                    <div class="container">
                        <div class="row">

                            <div class="comments-container">
                                <h3><?php echo count($comments) ?> Bình luận</h3>
                                <ul id="comments-list" class="comments-list">
                                    <?php
                                    if (count($comments) > 0) {
                                        // Tạo mảng để lưu trữ các comment theo cấu trúc cây
                                        $comments_tree = array();

                                        // Tạo mảng để lưu trữ các comment theo id để dễ dàng tra cứu
                                        $comments_by_id = array();

                                        // Phân loại các comment vào cấu trúc cây
                                        foreach ($comments as $comment) {
                                            // Đặt comment vào mảng theo id để dễ dàng tra cứu
                                            $comments_by_id[$comment['id']] = $comment;

                                            // Nếu comment không có parent_comment_id, đây là comment cha
                                            if ($comment['parent_comment_id'] === null) {
                                                $comments_tree[$comment['id']] = array(
                                                    'comment' => $comment,
                                                    'replies' => array() // Mảng để lưu các comment con
                                                );
                                            } else {
                                                // Nếu comment có parent_comment_id, thêm vào mảng replies của comment cha
                                                if (isset($comments_by_id[$comment['parent_comment_id']])) {
                                                    $parent_id = $comment['parent_comment_id'];
                                                    if (!isset($comments_tree[$parent_id])) {
                                                        $comments_tree[$parent_id] = array(
                                                            'comment' => $comments_by_id[$parent_id],
                                                            'replies' => array()
                                                        );
                                                    }
                                                    $comments_tree[$parent_id]['replies'][] = $comment;
                                                }
                                            }
                                        }

                                        // Hàm đệ quy để in comment và các comment con
                                        function print_comments($comments_tree)
                                        {
                                            $userID = $_SESSION["UserID"] ?? ""; // Toán tử gán null
                                            // $userID = isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : "";
                                            foreach ($comments_tree as $parent_id => $data) {
                                                echo '<li>';
                                                $comment = $data['comment'];
                                                // Nếu là chủ comment thì có thể sửa hoặc xóa
                                                if ($comment['user_id'] != $userID) {
                                                    echo '<div class="comment-main-level">
                                                        <div class="comment-avatar"><img src="' . BASE_URL . '/public/client/image/images.png" alt=""></div>
                                                        <div class="comment-box">   
                                                            <div class="comment-head">
                                                                <h6 class="comment-name"><a href="' . BASE_URL . '/users/' . $comment['user_id'] . '">' . $comment['comment_user_name'] . '</a></h6>
                                                                <span><i class="fa fa-clock-o" style="display: block;"> ' . timeAgo($comment['created_at']) . '</i></span>
                                                                <i class="fa fa-reply" style="display: block" onclick="toggleReplyForm(' . $comment['id'] . ')"></i>
                                                            </div>
                                                            <div class="comment-content"> ' . $comment['content'] . '
                                                        </div>
                                                    </div>';
                                                } else {
                                                    // chủ comment
                                                    echo '<div class="comment-main-level">
                                                        <div class="comment-avatar"><img src="' . BASE_URL . '/public/client/image/images.png" alt=""></div>
                                                        <div class="comment-box">   
                                                            <div class="comment-head">
                                                                <h6 class="comment-name"><a href="' . BASE_URL . '/users/' . $comment['user_id'] . '">' . $comment['comment_user_name'] . '</a></h6>
                                                                <span><i class="fa fa-clock-o" style="display: block;"> ' . timeAgo($comment['created_at']) . '</i></span>
                                                                <a href="' . BASE_URL . '/posts/replyComment/' . $comment['id'] . '"><i class="fa fa-reply" style="display: block" onclick="toggleReplyForm(' . $comment['id'] . ')"></i></a>
                                                                <a href="#"><i class="fa fa-trash" style="cursor: pointer; display: block;" onclick="confirmDelete(event, \'' . BASE_URL . '/posts/deleteComment/' . $comment['id'] . '\')"></i></a>
                                                                <a href="#"><i class="fa fa-pencil" style="cursor: pointer; display: block;" onclick="editComment(' . $comment['id'] . ')"></i></a>
                                                                </div>
                                                            <div class="comment-content"> ' . $comment['content'] . '
                                                        </div>
                                                    </div>';
                                                }

                                                // In các comment con nếu có
                                                if (isset($data['replies']) && count($data['replies']) > 0) {
                                                    echo '<ul class="comments-list reply-list">';
                                                    foreach ($data['replies'] as $reply) {
                                                        if ($reply['user_id'] != $userID) {
                                                            echo '<li>
                                                        <div class="comment-avatar"><img src="' . BASE_URL . '/public/client/image/images.png" alt=""></div>
                                                        <div class="comment-box">
                                                            <div class="comment-head">
                                                                <h6 class="comment-name"><a href="' . BASE_URL . '/users/' . $reply['user_id'] . '">' . $reply['comment_user_name'] . '</a></h6>
                                                                <span><i class="fa fa-clock-o" style="display: block;"> ' . timeAgo($reply['created_at']) . '</i></span>
                                                            </div>
                                                            <div class="comment-content"> ' . $reply['content'] . '
                                                            </div>
                                                        </div>
                                                    </li>';
                                                        } else {
                                                            // Chủ comment con
                                                            echo '<li>
                                                            <div class="comment-avatar"><img src="' . BASE_URL . '/public/client/image/images.png" alt=""></div>
                                                            <div class="comment-box">
                                                                <div class="comment-head">
                                                                    <h6 class="comment-name"><a href="' . BASE_URL . '/users/' . $reply['user_id'] . '">' . $reply['comment_user_name'] . '</a></h6>
                                                                    <span><i class="fa fa-clock-o" style="display: block;"> ' . timeAgo($reply['created_at']) . '</i></span>
                                                                    <a href="#" ><i class="fa fa-trash" style="cursor: pointer; display: block;" onclick="confirmDelete(event,\'' . BASE_URL . '/posts/deleteComment/' . $reply['id'] . '\')"></i></a>
                                                                    <a href="#"><i class="fa fa-pencil" style="cursor: pointer; display: block;" onclick="confirmDelete(event,\'' . BASE_URL . '/posts/deleteComment/' . $reply['id'] . '\')"></i></a>
                                                                    </div>
                                                                <div class="comment-content"> ' . $reply['content'] . '
                                                                </div>
                                                            </div>
                                                        </li>';
                                                        }
                                                    }
                                                    echo '</ul>';
                                                }
                                                echo '</li>';
                                            }
                                        }
                                        print_comments($comments_tree);

                                    }
                                    ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment289-box">
                    <hr>
                    <h3 style="margin-bottom: 15px;">Câu trả lời của bạn</h3>
                    <!-- <hr> -->
                    <div class="row">
                        <form id="postForm" action="<?php echo BASE_URL ?>/posts/createComment" method="post">
                            <div class=" col-md-12">
                                <div id="editorContainer" class="post9320-box">
                                    <div id="editor" style="border: solid 1px #000"></div>
                                    <input type="hidden" id="editorContent" name="content" />
                                    <input type="hidden" value="<?php echo $posts[0]["id"] ?>" name="post_id" />
                                    <input type="hidden" value="" name="parent_comment_id" />
                                </div>
                            </div>
                            <input type="hidden" name="token"
                                value="<?php echo isset($_SESSION['_token']) ? $_SESSION['_token'] : "" ?>" />
                            <div class="col-md-12">
                                <button type="submit" name="btnComment" class="pos393-submit">Bình luận</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="related3948-question-part">
                    <h3>Nội dung liên quan</h3>
                    <hr>
                    <?php
                    if (count($relate_posts) > 0) {
                        foreach ($relate_posts as $post) {
                            if ($post["id"] != $posts[0]["id"]) {
                                echo '<p><a href="' . BASE_URL . '/home/posts/' . $post["id"] . '"><i class="fa fa-angle-double-right" aria-hidden="true"></i> ' . $post['title'] . '</a></p>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <!--                end of col-md-9 -->
            <!--           strart col-md-3 (side bar)-->
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