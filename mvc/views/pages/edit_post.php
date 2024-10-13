<section class="header-descriptin329">
    <div class="container">
        <h3>Chi tiết bài viết</h3>
        <ol class="breadcrumb breadcrumb839">
            <li><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
            <li><a href="<?php echo BASE_URL ?>">Bài viết</a></li>
            <li class="active"><?php echo $post_to_edit[0]["title"] ?></li>
        </ol>
    </div>
</section>
<section class="main-content920">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="ask-question-input-part032">
                    <h4>
                        <a href="<?php echo BASE_URL ?>/home/posts/<?php echo $post_to_edit[0]["id"] ?>"
                            style="text-decoration: none">
                            <b>Bài Viết: <?php echo $post_to_edit[0]["title"] ?></b>
                        </a>
                    </h4>
                    <hr>
                    <form id="postForm"
                        action="<?php echo BASE_URL ?>/posts/HandleEdit/<?php echo $post_to_edit[0]["id"] ?>"
                        method="post" onsubmit="return validateFormCreatePost()">
                        <div class="username-part940">
                            <span class="form-description43">Loại bài đăng*</span>
                            <select id="contentType" name="contentType" class="username029">
                                <option value="post"
                                    <?php echo $post_to_edit[0]["type"] == 'post' ? 'selected' : ''; ?>>
                                    Bài
                                    viết</option>
                                <option value="question"
                                    <?php echo $post_to_edit[0]["type"] == 'question' ? 'selected' : ''; ?>>
                                    Đặt câu hỏi</option>
                            </select>
                        </div>

                        <div class="email-part320">
                            <span class="form-description442">Danh mục* </span>
                            <select id="contentCategory" name="contentCategory" class="email30">
                                <?php
                                foreach ($categories as $category) {
                                    $selected = $post_to_edit[0]["category_id"] == decryptData($category["id"]) ? 'selected' : '';
                                    echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="question-title39">
                            <span class="form-description43305">Tiêu đề* </span>
                            <input type="text" id="title" name="title" value="<?php echo $post_to_edit[0]["title"] ?>"
                                class="username029" placeholder="Nhập tiêu đề">
                            <small id="title_err"></small>
                        </div>

                        <div class="categori49">
                            <span class="form-description43305" style="margin-bottom: 5px">Tags </span>
                            <div id="tagsInputContainer" class="browsers" style="display: contents">
                                <?php if (count($tags_of_post) > 0) {
                                    foreach ($tags_of_post as $t) {
                                        // print_r($t["name"]);
                                        echo '<span class="badge badge-primary mx-1 tags">' . $t["name"] . ' <button type="button" class="close" aria-label="Close" onclick="removeTag(\'' . $t["name"] . '\')">
                                        <span aria-hidden="true">×</span>
                                      </button></span>';
                                    }
                                } ?>
                                <input type="text" id="tagsInput" placeholder="Nhập các tags, Enter để thêm"
                                    style="border: none; outline: none; width: 100%; margin-top: 5px; margin-left: 20%;">
                            </div>
                            <div id="hiddenTagsContainer"></div>
                        </div>
                        <div id="editorContainer">
                            <span class="form-description43305" style="margin-bottom: 5px">Nội dung </span>
                            <div id="editor"></div>
                            <input type="hidden" id="editorContent" name="content" />
                            <small id="editorContent_err"></small>
                        </div>
                        <input type="hidden" name="token"
                            value="<?php echo isset($_SESSION['_token']) ? $_SESSION['_token'] : "" ?>" />
                        <div class="publish-button2389">
                            <button type="submit" name="btnEditPost" class="publis1291">Cập nhật</button>
                        </div>
                    </form>

                </div>


            </div>
            <!--                end of col-md-9 -->
            <!--           strart col-md-3 (side bar)-->
            <?php require_once 'sidebar.php' ?>

        </div>
    </div>
</section>