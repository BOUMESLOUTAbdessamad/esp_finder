<!-- Modal -->
<div  class="modal fade" id="projectEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div id="editor" class="modal-content">
            <div class="modal-header">
                <div class="box-header with-border">
                    <h5 class="box-title" v-if="selected.id">Edit Project</h5>
                    <h5 class="box-title" v-else>Add a Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div  class="modal-body">
                <div v-if="error"  class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{error}}
                </div>
                <form action="">
                    <input v-model="selected.id" type="text" style="display : none" name="id">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Title</label>
                            <input v-model="selected.title" name="title" type="text" class="form-control">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Description</label>
                            <textarea id="content" class="form-control" v-model="selected.content" name="content" cols="30" rows="8"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Keywords</label>
                            <input id="keywords" v-model="selected.keywords" name="keywords" type="text" value="" data-role="tagsinput" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Degree</label>
                            <select class="form-control" id="degree" v-model="selected.degree" name="degree">
                                <option value="master">Master's degree</option>
                                <option value="bachelor">Bachelor's degree</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Author</label>
                            <input v-model="selected.author" name="author" type="text" class="form-control">
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Attachements :</label> <br>
                            <div v-if="uploading" class="progress" style="height: 30px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    Uploading ...
                                </div>
                            </div>
                            <input v-model="selected.file" type="text" style="display : none" name="file" id="fileid" >
                            <input  type="file" style="display : none" id="fileInput">
                            <button type="button" class="btn btn-default" id="fileBrowse">Browse</button>
                        </div>
                    </div> -->
                    <div class='row'>
                        <div class='form-group col-md-12'>
                            <div class="flex-content"  >
                                <div style="margin-bottom: 12px" v-for="photo in photos">
                                    <button type="button" class="remove-image" v-on:click="remove(photo)"><i style="margin: -1px" class="fa fa-remove"></i></button>
                                    <div style="max-height: 84px; max-width: 128px;">
                                        <img  class="img-thumbnail rounded mx-auto d-block" style="height: auto; width: 128px; float:right" v-bind:src='"<?=str_replace("admin.", "", base_url())?>uploads/" + photo.path.replace("\\","/") + photo.name' alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" v-on:click="save()" class="btn btn-primary">Save</button>
                        <button type="button" v-on:click="reset()" class="btn btn-secondary">Reset</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right;">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
