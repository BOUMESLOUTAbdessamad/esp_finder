<!-- Modal -->
<div  class="modal fade" id="requestsFiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div id="editor" class="modal-content">
            <div class="modal-header">
                <div class="box-header with-border">
                    <h5 class="box-title" >File request details </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div  class="modal-body" id="view">
                <dl>
                    <dt>Description</dt>
                    <dd>{{request.description}}</dd>
                    <dt>Hardware No.</dt>
                    <dd>{{request.hwid}}</dd>
                    <dt>Software No.</dt>
                    <dd>{{request.swid}}</dd>
                    <dt>User Email</dt>
                    <dd>{{request.email}}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
