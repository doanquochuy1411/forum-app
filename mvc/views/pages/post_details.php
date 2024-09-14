<section class="header-descriptin329">
    <div class="container">
        <h3>Chi tiết bài viết</h3>
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
                            <div class="col-md-8 post">
                                <div class="post-title-left129">
                                    <i>
                                        Được tạo bởi
                                        <a href="<?php echo BASE_URL ?>/home/info/<?php echo encryptData($posts[0]["account_name"]) ?>"
                                            style="text-decoration: none;">
                                            <img style="width: 22px"
                                                src="<?php echo BASE_URL ?>/public/src/uploads/<?php echo $posts[0]["avatar"] ?>"
                                                alt="">
                                            <span><?php echo $posts[0]["user_name"] ?></span></i>
                                    </a>
                                    <h3><?php echo $posts[0]["title"] ?></h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="post-que-rep-rihght320"> <a href="#"><i class="fa fa-question-circle"
                                            aria-hidden="true"></i> Câu hỏi</a> <a href="#" id="openReportModal"
                                        class="r-clor10">Báo xấu</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-details-info1982">
                        <p><?php echo $posts[0]["content"] ?></p>
                        <hr>
                        <div class="post-footer29032">
                            <div class="l-side2023">
                                <i class="fa fa-clock-o clock2" aria-hidden="true">
                                    <?php echo timeAgo($posts[0]["created_at"]) ?></i> <a href="#"><i
                                        class="fa fa-commenting commenting2" aria-hidden="true">
                                        <?php echo count($comments) ?> trả lời</i></a> <i class="fa fa-user user2"
                                    aria-hidden="true"> <?php echo $posts[0]["views"] ?> lượt xem</i>
                            </div>
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
                                    $tagNames[] = $tag['name'];
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
                                                        <div class="comment-avatar"><img src="' . BASE_URL . '/public/src/uploads/' . $comment['avatar'] . '" alt=""></div>
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
                                                        <div class="comment-avatar"><img src="' . BASE_URL . '/public/src/uploads/' . $comment['avatar'] . '" alt=""></div>
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
                                                        <div class="comment-avatar"><img src="' . BASE_URL . '/public/src/uploads/' . $reply['avatar'] . '" alt=""></div>
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
                                                            <div class="comment-avatar"><img src="' . BASE_URL . '/public/src/uploads/' . $reply['avatar'] . '" alt=""></div>
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
            <!-- Pop up -->
            <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="edit-user-modal-label"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <h3 style="text-align: center" class="modal-title" id="edit-user-modal-label"><b>Lý do báo
                                    xấu</b></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="report-post-form"
                                action="<?php echo BASE_URL ?>/reports/send/<?php echo $posts[0]["id"] ?>" method="post"
                                onsubmit="return validateFormReport()">
                                <div class="form-group">
                                    <label for="report_reasons">Chọn lý do báo xấu:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="report_reasons[]"
                                            value="Spam" id="reason1">
                                        <label class="form-check-label" for="reason1">
                                            Spam
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="report_reasons[]"
                                            value="Ngôn từ thô tục" id="reason2">
                                        <label class="form-check-label" for="reason2">
                                            Ngôn từ thô tục
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="report_reasons[]"
                                            value="Nội dung không phù hợp" id="reason3">
                                        <label class="form-check-label" for="reason3">
                                            Nội dung không phù hợp
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="report_reasons[]"
                                            value="Quảng cáo không liên quan" id="reason4">
                                        <label class="form-check-label" for="reason4">
                                            Quảng cáo không liên quan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="report_reasons[]"
                                            value="Khác" id="reason5">
                                        <label class="form-check-label" for="reason5">
                                            Khác
                                        </label>
                                    </div>
                                    <small id="report_reasons_err"></small>
                                </div>

                                <div class="form-group">
                                    <label for="additional_info">Thông tin bổ sung (tùy chọn):</label>
                                    <textarea class="form-control" id="additional_info" name="additional_info"
                                        rows="3"></textarea>
                                    <small id="additional_info_err"></small>
                                </div>

                                <!-- Hidden field to store post or question ID -->
                                <input type="hidden" name="token" value="<?php echo $_SESSION['_token'] ?>" />
                                <button type="submit" name="btnReport" class="btn btn-danger">Báo xấu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--                end of col-md-9 -->
            <!--           strart col-md-3 (side bar)-->
            <?php require_once 'sidebar.php' ?>


        </div>
    </div>
</section>