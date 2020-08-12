<!DOCTYPE html>
<html>
    <?=view_loader("headers/head.php",[],true)?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?=view_loader("headers/header.php",[],true)?>
            <?=view_loader("headers/nav.php",[],true)?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Profile Image -->
                                <div class="box box-primary" style="height : 750px;overflow-y : auto">
                                    <div class="box-body box-profile">
                                        <img class="profile-user-img img-responsive img-circle" src="<?=base_url()?>img/type_<?=$request['type']?>.png" alt="User profile picture">
                                        <h3 class="profile-username text-center"><?=strtoupper($request['mark']." ".$request['model'])?></h3>
                                        <p class="text-muted text-center"><?=ucfirst($request['status'])?> <i class="fa <?=($request['status'] == "delivered" ? "fa-check" : null)?>"></i> </p>
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Year</b> <a class="pull-right"><?=$request['year']?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Engine</b> <a class="pull-right"><?=($request['horsepower'] ? $request['horsepower'] : null)?> <?=$request['engine']?></a>
                                            </li>

                                            <li class="list-group-item">
                                                <b>Vehicule Engine</b> <a class="pull-right"><?=($request['vengine'] ? $request['vengine'] : null)?></a>
                                            </li>

                                            <li class="list-group-item">
                                                <b>HP</b> <a class="pull-right"><?=$request['hp']?></a>
                                            </li>

                                            <li class="list-group-item">
                                                <b>VIN</b> <a class="pull-right"><?=strtoupper($request['vin'])?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>ECU</b> <a class="pull-right"><?=ucwords($request['ecu'])?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Read Method</b> <a class="pull-right"><?=ucwords($request['method'])?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Gearbox</b> <a class="pull-right"><?=ucwords($request['gearbox'])?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>SW</b> <a class="pull-right"><?=strtoupper($request['sw'])?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>HW</b> <a class="pull-right"><?=strtoupper($request['hw'])?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>File</b> <a class="pull-right"><?=($request['original'] ? "Original" : "Modified")?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Checksum</b> <a class="pull-right"><?=($request['checksum'] ? "Requested" : "Not Requested")?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Description</b>
                                                <p>
                                                    <?=$request['description']?>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Profile Image -->
                                        <div class="box box-primary" style="height : 380px;overflow-y : auto">
                                            <div class="box-body box-profile">
                                                <h3 class="profile-username text-center">Tuning Types</h3>
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                        <b>Uploaded : </b> 
                                                        <a class="pull-right">
                                                        <?=$request['created']?>
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Delivered : </b> 
                                                        <a class="pull-right">
                                                        <?=($request['processed'] ? $request['processed'] : "--")?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                        foreach($request['options'] as $option) {
                                                            ?>
                                                    <li class="list-group-item">
                                                        <b><?=$option['description']?></b> 
                                                        <a class="pull-right">
                                                        <i class="fa fa-check"></i>
                                                        </a>
                                                    </li>
                                                    <?php
                                                        }
                                                        ?>
                                                </ul>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Profile Image -->
                                        <div class="box box-primary" style="height : 380px">
                                            <div class="box-body box-profile">
                                                <h3 class="profile-username text-center">Files</h3>
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                        <b>Original : </b> 
                                                        <a href="<?=str_replace('admin.',"",base_url())?>uploads/<?=$request['original_path'].$request['original_name']?>" class="pull-right">
                                                        <?=$request['file_name']?> <i class="fa fa-download"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Repaired : </b> 
                                                        <a href="<?=str_replace('admin.',"",base_url())?>uploads/<?=$request['repaired_path'].$request['repaired_name']?>" class="pull-right">
                                                        <?=$request['repaired_file_name']?>
                                                        <i class="fa <?=($request['repaired_file_name'] && $request['repaired_file_name'] !== "" ? "fa-download" : "fa-times")?>"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <form action="">
                                                    <label id="fileName" for="">(No File Selected)</label><br>
                                                    <input type="text" class="hidden" id="fileIdHolder">
                                                    <input type="file" style="display : none" id="fileInput">
                                                    <button type="button" class="btn btn-default" id="fileBrowse" >Browse</button>
                                                </form>
                                                <br>
                                                <div class="btn-group btn-block">
                                                    <button onclick="cancel()" style="width : 33.33%" type="button" class="btn btn-danger btn-flat"><i class="fa fa-times"></i> Cancel</b></button>
                                                    <button onclick="save()" style="width : 33.33%" type="button" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                                                    <button <?=($request['status'] == "canceled" ? 'disabled="1"' : '')?> onclick="deliver()" style="width : 33.33%" type="button" class="btn btn-primary btn-flat"><i class="fa fa-share-square"></i> Deliver</b></button>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-primary direct-chat direct-chat-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Direct Chat</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <!-- Conversations are loaded here -->
                                                
                                                <div class="direct-chat-messages" >
                                                <a href="#" onclick="Conversations.Messages.more(<?=$conversation["id"]?>)">Load More ...</a>
                                                <div id="messagesHolder"></div>
                                                        
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer" id="msgForm">
                                                    <a href="#" class="link-black" id="msgFileDisplay"></a>
                                                    <div class="input-group">
                                                       <input type="text" class="hidden" value="<?=$conversation["id"]?>" name="conversation">
                     
                                                        <input name="message[details]" onkeydown="javascript: if(event.keyCode == 13){$('#btnSend').click();$(this).val('')};" id="btn-input" type="text" placeholder="Type Message ..." class="form-control">
                                                        <span class="input-group-btn">
                                                            <input type="text" class="hidden" name="attachement" id="msgFileHolder">
                                                            <input type="file" class="hidden" id="msgFileBrowser" >
                                                            <button type="submit" class="btn btn-default btn-flat" id="msgFileTrigger"> <i class="fa fa-paperclip"></i> File</button>
                                                            <button id="btnSend" onclick="Conversations.Messages.send(event)" type="submit" class="btn btn-primary btn-flat"> <i class="fa fa-send-o"></i> Send</button>
                                                        </span>
                                                    </div>
                                             
                                            </div>
                                            <!-- /.box-footer-->
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <script src="<?=base_url()?>js/Models/Files.js"></script>
        <script src="https://www.gstatic.com/firebasejs/5.11.0/firebase.js"></script>
      <script>
         // Initialize Firebase
         var config = {
           apiKey: "AIzaSyAxp-R8yO5SVs74aHR8fY0_4OhE88cWC1I",
           authDomain: "chiptuning-file.firebaseapp.com",
           databaseURL: "https://chiptuning-file.firebaseio.com",
           projectId: "chiptuning-file",
           storageBucket: "chiptuning-file.appspot.com",
           messagingSenderId: "805469327038"
         };
         firebase.initializeApp(config);
      </script>
        <script src="<?=base_url()?>js/Models/Conversations.js"></script>

        <script src="<?=base_url()?>js/jquery.form.js"></script>
        <script src="<?=base_url()?>js/template7.js"></script>
        <script>
            $(document).ready(function() {
                Files.Upload.bind($('#fileBrowse'),$('#fileInput'),$('#fileIdHolder'),function(r) {
                    $('#fileName').html(r.file_name);
                });

                Conversations.Messages.resume(<?=$conversation['id']?>);

                Files.Upload.bind($('#msgFileTrigger'),$('#msgFileBrowser'),$('#msgFileHolder'),function(data) {
                        $('#msgFileHolder').val(data.id);
                        $('#msgFileDisplay').html(data.file_name + " <i class='fa fa-trash'></i>");
                        $('#msgFileDisplay').click(function() {
                            $(this).html('');
                            $('#msgFileHolder').val('');
                        });
                })
            });
        </script>
        <script>
            function save() {
                if($("#fileIdHolder").val() && $("#fileIdHolder").val() != "") {
                    $.get(BASE_URL + "files/save/<?=$request['id']?>/" + $("#fileIdHolder").val(),function(data) {
                        console.log(data);
                        alert('Saved');
                        window.location.reload();
                    });
                }
            }
            
            function deliver() {
                $.get(BASE_URL + "files/deliver/<?=$request['id']?>",function(data) {
                    console.log(data);
                    alert('Delivered');
                    window.location.reload();
                });
            }

            function cancel() {
                $.get(BASE_URL + "files/cancel/<?=$request['id']?>",function(data) {
                    location.href = BASE_URL + "files/search";
                });
            }
        </script>
    </body>
</html>