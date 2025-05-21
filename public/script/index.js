
function initCheckDisplayControll($check_prefix, $target_prefix) {
    $("[name^='"+$check_prefix+"']").each(function() {
        $name = $(this).attr('name');
        $target = $name.substr($check_prefix.length);
        $val = localStorage.getItem($target);
        if ($val=='0') {
            $(this).prop('checked', false);
            $("."+$target_prefix+$target).each(function() {
                $(this).hide();
            });
        } else {
            $(this).prop('checked', true);
            $("."+$target_prefix+$target).each(function() {
                $(this).show();
            });
        }
    });
      
    $("[name^='"+$check_prefix+"']").click(function() {
        $name = $(this).attr('name');
        if ($name.indexOf($check_prefix)===0) {
            $target = $name.substr($check_prefix.length);
            if ($(this).prop('checked')) {
                localStorage.setItem($target, 1);
                $("."+$target_prefix+$target).each(function() {
                    $(this).show();
                });
            } else {
                localStorage.setItem($target, 0);
                $("."+$target_prefix+$target).each(function() {
                    $(this).hide();
                });
            }
        }
    });
}

function initCheckDelete($check_path, $button_path) {
    $($check_path).change(function() {
        $checked = false;
        $($check_path).each(function() {
            if ($(this).prop('checked')) {
                $checked = true;
            }
        });
        if ($checked) {
            $($button_path).prop('disabled', false);
        } else {
            $($button_path).prop('disabled', true);
        }
    });
}

function initAllCheck($check_path, $target_path) {
    $($check_path).click(function() {
        $flag = $(this).prop('checked');
        $($target_path).each(function() {
            $(this).prop('checked', $flag).change();
        });
    });
}

