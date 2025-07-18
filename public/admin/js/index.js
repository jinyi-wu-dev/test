
var storage_label = '';
var hide_list;
function loadHideList($label) {
    $storage_label = $label;
    $load = localStorage.getItem($label);
    if ($load) {
        $hide_list = JSON.parse($load);
    } else {
        $hide_list = [1];
    }
}
function saveHideList() {
    localStorage.setItem($storage_label, JSON.stringify($hide_list));
}
function addHideList($key) {
    if ($hide_list.indexOf($key)==-1) {
        $hide_list.push($key);
    }
    saveHideList();
}
function delHideList($key) {
    $pos = $hide_list.indexOf($key);
    if ($pos>-1) {
        $hide_list.splice($pos, 1);
    }
    saveHideList();
}

function initCheckDisplayControll($label, $check_prefix, $target_prefix) {
    loadHideList($label);

    $("[name^='"+$check_prefix+"']").each(function() {
        $name = $(this).attr('name');
        $target = $name.substr($check_prefix.length);
        if ($hide_list.indexOf($target)>-1) {
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
                delHideList($target);
                $("."+$target_prefix+$target).each(function() {
                    $(this).show();
                });
            } else {
                addHideList($target);
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

function initImageRange($range_path, $image_path) {
    $($image_path).width('200px');
    $($range_path).change(function() {
        w = $(this).val()*10 + 'px';
        $($image_path).each(function() {
            $(this).width(w);
        });
    });
}

