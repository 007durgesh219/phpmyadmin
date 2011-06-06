/* vim: set expandtab sw=4 ts=4 sts=4: */

// Validate editor form fields
function validateRoutineEditor(syntaxHiglighter) {
    var inputname = '';
    var $elm      = null;
    var isError   = false;

    $elm = $('.rte_table').last().find('input[name=routine_name]');
    if ($elm.val() == '') {
        $elm.focus();
        isError = true;
    }
    if (! isError) {
        $elm = $('.rte_table').find('textarea[name=routine_definition]');
        if ($elm.val() == '') {
            syntaxHiglighter.focus();
            isError = true;
        }
    }
    if (! isError) {
        $('.routine_params_table').last().find('tr').each(function() {
            if (! isError) {
                $(this).find(':input').each(function() {
                    inputname = $(this).attr('name');
                    if (inputname.substr(0, 17) == 'routine_param_dir' ||
                        inputname.substr(0, 18) == 'routine_param_name' ||
                        inputname.substr(0, 18) == 'routine_param_type') {
                        if ($(this).val() == '') {
                            $(this).focus();
                            isError = true;
                            return false;
                        }
                    }
                });
            }
        });
    }
    if (! isError) {
        // SET and ENUM fields must have some values (a.k.a. length)
        $('.routine_params_table').last().find('tr').each(function() {
            var $inputtyp = $(this).find(':input[name^=routine_param_type]');
            var $inputlen = $(this).find(':input[name^=routine_param_length]');
            if ($inputtyp.length && $inputlen.length) {
                if (($inputtyp.val() == 'ENUM' || $inputtyp.val() == 'SET') && $inputlen.val() == '') {
                    $inputlen.focus();
                    isError = true;
                    return false;
                }
            }
        });
    }
    if (! isError) {
        return true;
    } else {
        alert(PMA_messages['strFormEmpty']);
        return false;
    }
} // end validateRoutineEditor()

/**
 * Attach Ajax event handlers for the Routines Editor.
 *
 * @uses    PMA_ajaxShowMessage()
 * @uses    PMA_ajaxRemoveMessage()
 *
 * @see $cfg['AjaxEnable']
 */
$(document).ready(function() {
    var $ajaxDialog      = null;
    var param_template   = '';
    var $edit_row        = null;
    var syntaxHiglighter = null;
    $('.add_routine_anchor, .edit_routine_anchor').live('click', function(event) {
        event.preventDefault();
        if ($(this).hasClass('edit_routine_anchor')) {
            // Remeber the row of the routine being edited for later, so that if the edit
            // is successful, we can replace the row with info about the modified routine.
            $edit_row = $(this).parents('tr');
        }

        var $msg = PMA_ajaxShowMessage(PMA_messages['strLoading']);
        $.get($(this).attr('href'), {'ajax_request': true}, function(data) {
            if(data.success == true) {
                PMA_ajaxRemoveMessage($msg);
                /**
                 * @var button_options  Object containing options for jQueryUI dialog buttons
                 */
                var button_options = {};
                button_options[PMA_messages['strGo']] = function() {
                    syntaxHiglighter.save();
                    // Validate editor and submit request, if passed.
                    if (validateRoutineEditor(syntaxHiglighter)) {
                        var data = $('.rte_form').last().serialize() + "&routine_process_"+mode+"routine=1&ajax_request=true";
                        var $msg = PMA_ajaxShowMessage(PMA_messages['strLoading']);
                        $.post('db_routines.php', data, function (data) {
                            if(data.success == true) {
                                // Routine created successfully
                                PMA_ajaxShowMessage(data.message);
                                $('#js_query_display').html('<div style="margin-top: 1em;">' + data.sql_query + '</div>');
                                $ajaxDialog.dialog('close');
                                // If we are in 'edit' mode, we must remove the reference to the old row.
                                if (mode == 'edit') {
                                    $edit_row.remove();
                                }
                                // Insert the new row at the correct location in the list of routines
                                var text = '';
                                var inserted = false;
                                $('table.data').find('tr').each(function() {
                                    text = $(this).children('td').eq(0).find('strong').text().toUpperCase();
                                    if (text != '' && text > data.name) {
                                        $(this).before(data.new_row);
                                        inserted = true;
                                        return false;
                                    }
                                });
                                if (! inserted) {
                                    $('table.data').append(data.new_row);
                                }
                                // Now we have inserted the row at the correct position, but surely
                                // at least some row classes are wrong now. So we will itirate
                                // throught all rows and assign correct classes to them.
                                var ct = 0;
                                $('table.data').find('tr').each(function() {
                                    if ($(this).has('th').length) {
                                        return true;
                                    }
                                    rowclass = (ct % 2 == 0) ? 'even' : 'odd';
                                    $(this).removeClass().addClass(rowclass);
                                    ct++;
                                });
                            } else {
                                PMA_ajaxShowMessage(data.error);
                            }
                        });
                    }
                }
                button_options[PMA_messages['strClose']] = function() {
                    $(this).dialog("close");
                }
                /**
                 * Display the dialog to the user
                 */
                $ajaxDialog = $('<div style="font-size: 0.9em;">'+data.message+'</div>').dialog({
                                width: 650,  // TODO: make a better decision about the size
                                height: 550, // of the dialog based on the size of the viewport
                                buttons: button_options,
                                title: data.title,
                                modal: true,
                                close: function () {
                                    $(this).remove();
                                }
                        });
               // Is this edit mode or add mode?
                var mode = 'add';
                if ($('input[name=routine_process_editroutine]').length > 0) {
                    mode = 'edit';
                }
                // No need for 2 submit buttons
                $('fieldset.routineEditorSubmit').remove();
                // Cache the template for a parameter table row
                param_template = data.param_template;
                // Make adjustments in the dialog to make it AJAX compatible
                var is_procedure = '';
                var is_function = '';
                if (data.type == 'PROCEDURE') {
                    is_procedure = ' selected="selected"';
                } else if (data.type == 'FUNCTION') {
                    is_function = ' selected="selected"';
                }
                var new_type_cell = '<select name="routine_type">'
                                  + '<option value="PROCEDURE"' + is_procedure + '>PROCEDURE</option>'
                                  + '<option value="FUNCTION"' + is_function + '>FUNCTION</option>'
                                  + '</select>';
                $('.routine_changetype_cell').html(new_type_cell);
                $('.routine_param_remove').show();
                $('input[name=routine_removeparameter]').remove();
                $('input[name=routine_addparameter]').css('width', '100%');
                // Attach syntax highlited editor to routine definition
                var elm  = $('textarea[name=routine_definition]').last();
                var opts = {lineNumbers: true, matchBrackets: true, indentUnit: 4, mode: "text/x-mysql"};
                syntaxHiglighter = CodeMirror.fromTextArea(elm[0], opts);
                // Hack to prevent the syntax highlighter from expanding beyond dialog boundries
                $('.CodeMirror-scroll').find('div').first().css('width', '1px');
            } else {
                PMA_ajaxShowMessage(data.error);
            }
        }) // end $.get()
    }); // end $.live()

    $('input[name=routine_addparameter]').live('click', function(event) {
        event.preventDefault();
        var $routine_params_table = $('.routine_params_table').last();
        var new_param_row = param_template.replace(/%s/g, $routine_params_table.find('tr').length-1);
        $routine_params_table.append(new_param_row);
        if ($('.rte_table').find('select[name=routine_type]').val() == 'FUNCTION') {
            $('.routine_return_row').show();
            $('.routine_direction_cell').hide();
        }
    }); // end $.live()

    $('.routine_param_remove_anchor').live('click', function (event) {
        event.preventDefault();
        $(this).parent().parent().remove();
        // After removing a parameter, the indices of the name attributes in
        // the input fields lose the correct order and need to be reordered.
        var index = -1; // Init at -1 because the first row is the table header.
        $('.routine_params_table').last().find('tr').each(function() {
            $(this).find(':input').each(function() {
                var inputname = $(this).attr('name');
                if (inputname.substr(0, 17) == 'routine_param_dir') {
                    $(this).attr('name', inputname.substr(0, 17) + '[' + index + ']');
                } else if (inputname.substr(0, 18) == 'routine_param_name') {
                    $(this).attr('name', inputname.substr(0, 18) + '[' + index + ']');
                } else if (inputname.substr(0, 18) == 'routine_param_type') {
                    $(this).attr('name', inputname.substr(0, 18) + '[' + index + ']');
                } else if (inputname.substr(0, 20) == 'routine_param_length') {
                    $(this).attr('name', inputname.substr(0, 20) + '[' + index + ']');
                }
            });
            index++;
        });
    }); // end $.live()

    $('select[name=routine_type]').live('change', function(event) {
        event.preventDefault();
        $('.routine_return_row, .routine_direction_cell').toggle();
    }); // end $.live()
}); // end of $(document).ready() for Routine Editor
