jQuery(function($) {
    var FeatherEditor = new Aviary.Feather({
        apiKey: 'yourkey',
        apiVersion: 3,
        openType: 'lightbox',
        tools: 'all',
        onSaveButtonClicked: function(imgId) {
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action: 'wpixel_save', content: document.getElementById('avpw_canvas_element').toDataURL()},
                success: function(resp) {
                    console.log(resp.substring(0, 10))
                }
            });
            return false;
        }
    });

    var $body = $('#wpbody-content');
    setInterval(function() {
        var $lis = $body.find('ul.attachments li');
        $lis.each(function() {
            var $li = $(this);
            if(!$li.hasClass('wpixel')) {
                $li.addClass('wpixel');
                var imgId = $li.find('img').attr('id');
                if(!imgId) {
                    imgId = 'wpixel-' + $li.data('id');
                    $li.find('img').attr('id', imgId);
                }
                var $preview = $(this).find('.attachment-preview');
                $li.on('mouseenter.wpixel', function() {
                    var $wpixelIcon = $('<span class="wpixel-icon">WPixel</span>');
                    $preview.after($wpixelIcon.css({
                        position: 'absolute',
                        top: 0,
                        right: 0
                    }));
                    $wpixelIcon.click(function() {
                        $.get(ajaxurl, {
                            action: 'base_img_url',
                            attachmentId: $li.data('id')
                        }, function(url) {
                            FeatherEditor.launch({
                                image: imgId,
                                url: url
                            });
                        });
                    });
                });
                $li.on('mouseleave.wpixel', function() {
                    $preview.siblings('.wpixel-icon').remove();
                });
            }
        });
    }, 1000);
});