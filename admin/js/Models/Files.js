Files = {
    Upload: {
        bind: function (trigger, input, value,types,size,success,error,folder,preupload) {
            var preupload = preupload || null;
			var folder = folder || null;
            var success = success || null;
            var error = error || null;
            var types = types || ["zip", "rar", "tar", "gzip","bin","php" ,"png", "jpg", "jpeg", "gif"];
            var size = size || 5145728;
            trigger.click(function () {
                input.click();
            })
            input.on('change', function (e) {
                if (this.files && this.files[0]) {
                    //validate file ext/name/size
                    var errors = [];
                    ext = this.files[0].name.split(".")[this.files[0].name.split(".").length - 1];
                    filename = this.files[0].name.replace("." + ext, "");
                    var file = {
                        name: filename,
                        ext: ext,
                        size: this.files[0].size
                    };
                    var allowed = types;
                    var allowedSize = size;
                    if (allowed.indexOf(file.ext.toLowerCase()) < 0) {
                        errors.push("Not Allowed File Type");
                    }

                    if (file.size >= allowedSize) {
                        errors.push("File Is Too Big");
                    }

                    if (errors.length > 0) {
                        console.log(errors);
                    } else {
                        //proceed to upload
                        var formData = new FormData();
                        formData.append('file', this.files[0],file.name +"."+file.ext);
                        if(preupload) {
                            preupload.apply(formData,[formData]);
                        }
                        $.ajax(BASE_URL + "files/upload/"+folder, {
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (r) {
                                console.log('Upload success');
                                if(success) {
                                    success.apply(r.data,[r.data]);
                                }
                            },
                            error: function (e) {
                                console.log('Upload error');
                                if(error) {
                                    error.apply(e,[e]);
                                }
                            }
                        });
                    }
                }
            })
        }
    }
}
