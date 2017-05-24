var swfu;
var file_queue_limit = 100;//队列1，每次只能上传1个,若是1个以上，上传后的样式是叠加图片
window.onload = function() {
    swfu = new SWFUpload({
        upload_url: "{:U('Admin/System/upload')}",
        post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
        file_size_limit: "2 MB", //最大2M
        file_types: "*.jpg;*.png;*.gif;*.bmp", //设置选择文件的类型
        file_types_description: "JPG Images", //描述文件类型
        file_upload_limit: "0", //0代表不受上传个数的限制
        file_queue_limit:file_queue_limit,
        file_queue_error_handler: fileQueueError,
        file_dialog_complete_handler: fileDialogComplete, //当关闭选择框后,做触发的事件
        upload_progress_handler: uploadProgress, //处理上传进度
        upload_error_handler: uploadError, //错误处理事件
        upload_success_handler: uploadSuccess, //上传成功够,所处理的时间
        upload_complete_handler: uploadComplete, //上传结束后,处理的事件
        button_image_url: "/Public/upload/images/upload.png",
        button_placeholder_id: "spanButtonPlaceholder",
        button_width: 113,
        button_height: 33,
        button_text: '',
        button_text_style: '.spanButtonPlaceholder { font-family: Helvetica, Arial, sans-serif; font-size: 14pt;} ',
        button_text_top_padding: 0,
        button_text_left_padding: 0,
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_cursor: SWFUpload.CURSOR.HAND,
        flash_url: "/Public/upload/js/swfupload.swf",
        custom_settings: {
            upload_target: "divFileProgressContainer"
        },
        debug: 1 //是否开启日志
    });
};
