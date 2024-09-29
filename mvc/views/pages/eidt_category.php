<!--content-->
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Danh mục</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="#" id="openAddCategoryModal" class="btn btn btn-primary btn-rounded float-right"><i
                        class="fa fa-plus"></i> Thêm danh
                    mục</a>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable m-b-0">
                                <form id="edit-category-form" action="<?php echo BASE_URL ?>/admin/editCategory"
                                    method="post" onsubmit="return validateFormEditCategory()">
                                    <div class="form-group">
                                        <label for="category_name_update">Tên danh mục*</label>
                                        <input type="text" class="form-control" name="category_name_update">
                                        <small id="category_name_update_err"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_description_update">Mô tả</label>
                                        <input type="text" class="form-control" name="category_description_update">
                                        <small id="category_description_update_err"></small>
                                    </div>
                                    <input type="hidden" name="token" value="<?php echo $_SESSION['_token'] ?>" />
                                    <button type="submit" name="btnEditCategory" class="btn btn-primary">Cập
                                        nhật</button>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--/ content-->