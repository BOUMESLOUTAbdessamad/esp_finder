<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="<?=base_url()?>bower_components/select2/dist/css/select2.min.css">
    <?=view_loader("headers/head.php",[],true)?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?=view_loader("headers/header.php",[],true)?>
            <?=view_loader("headers/nav.php",[],true)?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- modal -->
                <?=view_loader("projects/modal_edit.php",[],true)?>
                <!-- modal  -->
                <section class="content" id="project">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Projects Manage</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form onsubmit="app.feed(event)" style="float:left">
                                        <div  class="input-group input-group-sm col-md-12">
                                            <div style="float:right;margin-right:10px">
                                                <input id="searchquery"  value="<?=(isset($_GET['model']) ? $_GET['model'] : null)?>" name="model" class="form-control" type="text" placeholder="Search">
                                            </div>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat">Search</button>
                                            </span>
                                        </div>
                                    </form>
                                    <a class="btn btn-primary" style="margin-bottom:25px; font-weight:700; float:right" v-on:click="add()">Add</a>
                                    <table class="table table-bordered">
                                        <tr>
											<th scope="col">#ID</th>
                                            <!-- <th>Cover</th> -->
											<th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Updated</th>
                                            <th scope="col">Options</th>
                                        </tr>
                                        <tr v-for="project in projects" v-bind:class="(project.status ==  'closed' ? 'red' : '')">
										<td>{{project.id}}</td>
											<!-- <td>
												<img v-if="project.attachements[0]" style="width : 54px" v-bind:src='"<?=str_replace("admin.", "", base_url())?>uploads/" + project.attachements[0].path.replace("\\","/") + project.attachements[0].file_name' alt="project Cover">
											</td> -->
											<td>{{project.title}}</td>
                                            <td>{{project.content.substring(0, 25) + '...'}}</td>
                                            <td>{{project.author}}</td>
                                            <td>{{project.created}}</td>
                                            <td>{{project.updated}}</td>
                                            <td>
											<span class="dropdown">
											<a class="btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
												<i class="fa fa-ellipsis-v"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
												<a class="btn" v-on:click="set_status(project)">
													<span v-if='project.status == "open" '>Close project</span>
													<span v-else>Open project</span>
                                                </a><br>
                                                <a class="btn" v-on:click="edit(project)" id="edit">
                                                    <span>Edit</span>
                                                </a><br>
                                                <a class="btn" v-on:click="remove(project)" id="remove">
                                                    <!-- <i class="fa fa-remove"></i> -->
                                                    <span>Delete</span>
                                                </a>
												</div>
											</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <div class="row" style="margin-top : 20px">
                                        <div class="col-md-5">
                                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">{{"Display of "+pages.start+" to "+pages.end+" of total "+pages.total+" projects"}}</div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                                <ul class="pagination" style="margin : 0">
                                                    <li class="paginate_button previous" v-bind:class="(pages.current == 1 ? 'disabled' : '')" >
                                                        <a v-on:click="setPage(pages.prev)" href="#project" ref="prev">Previous</a>
                                                    </li>
                                                    <li v-for="page in pages.vector" v-if="page != 0" class="paginate_button" v-bind:class="page == pages.current ? 'active' : ''">
                                                        <a v-on:click="setPage(page)" href="#project">{{page}}</a>
                                                    </li>
                                                    <li class="paginate_button next" v-bind:class="(!pages.next ? 'disabled' : '')" >
                                                        <a v-on:click="setPage(pages.next)" href="#project" ref="next">Next</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?=view_loader("footers/footer.php",[],true)?>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?=view_loader("footers/foot.php",[],true)?>
        <script src="<?=base_url()?>bower_components/select2/dist/js/select2.full.min.js"></script>
		<script>
		const app = new Vue({
				el : "#project",
				data : {
					loading : false,
					pages : {
						"total":0,
						"pages":0,
						"start":1,
						"end":1,
						"current":1,
						"next":1,
						"prev":false,
						"separations":[null,5],
						"vector":[]
					},
                    projects : [],
				},

				methods : {
				setPage : function(page) {
							if(!page) {
									return;
							}
							app.pages.current = page;
							app.feed();
					},
					feed : function(event, callback) {

						var event = event || null;
						var callback = callback || null;
						this.loading = true;
						if(event) {
							event.preventDefault();
							app.pages.current = 1;
						}

						$.get(BASE_URL + "projects/feed/", {
							page : app.pages.current,
							// model : this.model

						},function(r) {
							app.loading = false;
							app.projects = r.data.projects;
                            console.log(app.projects);
							// editor.marks = r.data.marks;
							app.pages = r.data.pages;
							if(callback) {
								callback.apply(r.data.projects,[r.data.projects]);
							}

							$('#projectEdit').on('hidden.bs.modal', function (e) {
								editor.reset();
								editor.selected = {}
								editor.error = null;
                                editor.photos = [];
                                $('#keywords').tagsinput('removeAll');
								// $('#models').append(new Option('', '', true, true)).trigger('change');
							})


						})
					},
                    add : function() {
						$('#projectEdit').modal('show');

                    },
					remove : function(project) {
						if(confirm('Are you sure ?')) {
							$.post(BASE_URL + "projects/remove/",{project : project},function(r) {
								toastr.error('Reccord deleted.');
								app.feed();

							})
						}

					},
					edit : function(project) {
						$('#projectEdit').modal('show');

						$.get(BASE_URL + "projects/get/" + project.id,function(r) {

							$('#projectEdit').off("shown.bs.modal");
								editor.selected = r.data.project;
                                $('#keywords').tagsinput('add', editor.selected.keywords);
                                $('#content').summernote('code',editor.selected.content);

								// r.data.photos.forEach(photo => {
								// 	editor.photos.push(photo);
								// });
						})
                    },
                    set_status : function(project) {
						if(confirm('Are you sure ?')) {
							$.post(BASE_URL + "projects/set_status/",{project : project},function(r) {

								if(r.status == 'ok') {
									if(r.data == true) {
										toastr.success('Project marked as Open.');
									} else if(r.data == false) {
										toastr.success('Project Closed.');
                                    }

								} else {
									toastr.error('Error');
								}
								app.feed();
							})
						}
					}
				}
		})

		var editor = new Vue({
				el : "#editor",
				data : {
					selected : {},
					photos : [],
					error : null,
					uploading : false,

				},
				methods : {
					save : function() {
						this.error = null;
                        this.selected.keywords = $("#keywords").val();
                        this.selected.content = $('#content').summernote('code', project.content);

						$.post(BASE_URL + "projects/edit/",{
							project : JSON.parse(JSON.stringify(this.selected)),
							photos : this.photos,
						},function(r) {
							if(r.status == "ok") {
								app.loading = false;
								app.feed();
								$('#projectEdit').modal('hide');
								editor.reset();
								toastr.success('Reccord edited.');
							} else {
								editor.error = r.data[0];
							}
						})
					},
					reset : function() {
						this.selected = {}
						editor.error = null;
						editor.photos = [];
                        $('#keywords').tagsinput('removeAll');
					},

					// remove : function (photo) {
					// 	editor.photos.splice(editor.photos.indexOf(photo), editor.photos.indexOf(photo) + 1 )
					// }
				}
		});

		app.feed();
		$(document).ready(function() {

            $('#content').summernote({
                height: 120,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    // ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    // ['height', ['height']]
                ]
                });

			$("#searchquery" ).keyup(function() {
				setTimeout(function(){
					app.feed(event);
				}, 1500);
			})

            // Add attachements
			Files.Upload.bind($('#fileBrowse'),$('#fileInput'),$('#fileId'),["png","jpg","jpeg","gif"], null,function(file) {
				// editor.file = file;
				editor.photos.push(file);
				editor.uploading = false;

			}, null, 'projects_files', () => {
				editor.uploading = true;
			});

		});
		</script>
   </body>
</html>
