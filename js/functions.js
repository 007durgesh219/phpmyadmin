/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * general function, usally for data manipulation pages
 *
 */

/**
 * @var sql_box_locked lock for the sqlbox textarea in the querybox/querywindow
 */
var sql_box_locked = false;

/**
 * @var array holds elements which content should only selected once
 */
var only_once_elements = new Array();

/**
 * @var   int   ajax_message_count   Number of AJAX messages shown since page load
 */
var ajax_message_count = 0;

/**
 * @var codemirror_editor object containing CodeMirror editor
 */
var codemirror_editor = false;

/**
 * @var chart_activeTimeouts object active timeouts that refresh the charts. When disabling a realtime chart, this can be used to stop the continuous ajax requests
 */
var chart_activeTimeouts = new Object();

/**
 * Add a hidden field to the form to indicate that this will be an
 * Ajax request (only if this hidden field does not exist)
 *
 * @param   object   the form
 */
function PMA_prepareForAjaxRequest($form)
{
    if (! $form.find('input:hidden').is('#ajax_request_hidden')) {
        $form.append('<input type="hidden" id="ajax_request_hidden" name="ajax_request" value="true" />');
    }
}

/**
 * Generate a new password and copy it to the password input areas
 *
 * @param   object   the form that holds the password fields
 *
 * @return  boolean  always true
 */
function suggestPassword(passwd_form)
{
    // restrict the password to just letters and numbers to avoid problems:
    // "editors and viewers regard the password as multiple words and
    // things like double click no longer work"
    var pwchars = "abcdefhjmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWYXZ";
    var passwordlength = 16;    // do we want that to be dynamic?  no, keep it simple :)
    var passwd = passwd_form.generated_pw;
    passwd.value = '';

    for ( i = 0; i < passwordlength; i++ ) {
        passwd.value += pwchars.charAt( Math.floor( Math.random() * pwchars.length ) )
    }
    passwd_form.text_pma_pw.value = passwd.value;
    passwd_form.text_pma_pw2.value = passwd.value;
    return true;
}

/**
 * Version string to integer conversion.
 */
function parseVersionString (str)
{
    if (typeof(str) != 'string') { return false; }
    var add = 0;
    // Parse possible alpha/beta/rc/
    var state = str.split('-');
    if (state.length >= 2) {
        if (state[1].substr(0, 2) == 'rc') {
            add = - 20 - parseInt(state[1].substr(2));
        } else if (state[1].substr(0, 4) == 'beta') {
            add =  - 40 - parseInt(state[1].substr(4));
        } else if (state[1].substr(0, 5) == 'alpha') {
            add =  - 60 - parseInt(state[1].substr(5));
        } else if (state[1].substr(0, 3) == 'dev') {
            /* We don't handle dev, it's git snapshot */
            add = 0;
        }
    }
    // Parse version
    var x = str.split('.');
    // Use 0 for non existing parts
    var maj = parseInt(x[0]) || 0;
    var min = parseInt(x[1]) || 0;
    var pat = parseInt(x[2]) || 0;
    var hotfix = parseInt(x[3]) || 0;
    return  maj * 100000000 + min * 1000000 + pat * 10000 + hotfix * 100 + add;
}

/**
 * Indicates current available version on main page.
 */
function PMA_current_version()
{
    var current = parseVersionString(pmaversion);
    var latest = parseVersionString(PMA_latest_version);
    var version_information_message = PMA_messages['strLatestAvailable'] + ' ' + PMA_latest_version;
    if (latest > current) {
        var message = $.sprintf(PMA_messages['strNewerVersion'], PMA_latest_version, PMA_latest_date);
        if (Math.floor(latest / 10000) == Math.floor(current / 10000)) {
            /* Security update */
            klass = 'error';
        } else {
            klass = 'notice';
        }
        $('#maincontainer').after('<div class="' + klass + '">' + message + '</div>');
    }
    if (latest == current) {
        version_information_message = ' (' + PMA_messages['strUpToDate'] + ')';
    }
    $('#li_pma_version').append(version_information_message);
}

/**
 * for libraries/display_change_password.lib.php
 *     libraries/user_password.php
 *
 */

function displayPasswordGenerateButton()
{
    $('#tr_element_before_generate_password').parent().append('<tr><td>' + PMA_messages['strGeneratePassword'] + '</td><td><input type="button" id="button_generate_password" value="' + PMA_messages['strGenerate'] + '" onclick="suggestPassword(this.form)" /><input type="text" name="generated_pw" id="generated_pw" /></td></tr>');
    $('#div_element_before_generate_password').parent().append('<div class="item"><label for="button_generate_password">' + PMA_messages['strGeneratePassword'] + ':</label><span class="options"><input type="button" id="button_generate_password" value="' + PMA_messages['strGenerate'] + '" onclick="suggestPassword(this.form)" /></span><input type="text" name="generated_pw" id="generated_pw" /></div>');
}

/*
 * Adds a date/time picker to an element
 *
 * @param   object  $this_element   a jQuery object pointing to the element
 */
function PMA_addDatepicker($this_element, options)
{
    var showTimeOption = false;
    if ($this_element.is('.datetimefield')) {
        showTimeOption = true;
    }

    var defaultOptions = {
        showOn: 'button',
        buttonImage: themeCalendarImage, // defined in js/messages.php
        buttonImageOnly: true,
        duration: '',
        time24h: true,
        stepMinutes: 1,
        stepHours: 1,
        showTime: showTimeOption,
        dateFormat: 'yy-mm-dd', // yy means year with four digits
        altTimeField: '',
        beforeShow: function(input, inst) {
            // Remember that we came from the datepicker; this is used
            // in tbl_change.js by verificationsAfterFieldChange()
            $this_element.data('comes_from', 'datepicker');

            // Fix wrong timepicker z-index, doesn't work without timeout
            setTimeout(function() {
                $('#ui-timepicker-div').css('z-index',$('#ui-datepicker-div').css('z-index'))
            },0);
        },
        constrainInput: false
    };

    $this_element.datepicker($.extend(defaultOptions, options));
}

/**
 * selects the content of a given object, f.e. a textarea
 *
 * @param   object  element     element of which the content will be selected
 * @param   var     lock        variable which holds the lock for this element
 *                              or true, if no lock exists
 * @param   boolean only_once   if true this is only done once
 *                              f.e. only on first focus
 */
function selectContent( element, lock, only_once )
{
    if ( only_once && only_once_elements[element.name] ) {
        return;
    }

    only_once_elements[element.name] = true;

    if ( lock  ) {
        return;
    }

    element.select();
}

/**
 * Displays a confirmation box before to submit a "DROP/DELETE/ALTER" query.
 * This function is called while clicking links
 *
 * @param   object   the link
 * @param   object   the sql query to submit
 *
 * @return  boolean  whether to run the query or not
 */
function confirmLink(theLink, theSqlQuery)
{
    // Confirmation is not required in the configuration file
    // or browser is Opera (crappy js implementation)
    if (PMA_messages['strDoYouReally'] == '' || typeof(window.opera) != 'undefined') {
        return true;
    }

    var is_confirmed = confirm(PMA_messages['strDoYouReally'] + ' :\n' + theSqlQuery);
    if (is_confirmed) {
        if ( $(theLink).hasClass('formLinkSubmit') ) {
            var name = 'is_js_confirmed';
            if ($(theLink).attr('href').indexOf('usesubform') != -1) {
                name = 'subform[' + $(theLink).attr('href').substr('#').match(/usesubform\[(\d+)\]/i)[1] + '][is_js_confirmed]';
            }

            $(theLink).parents('form').append('<input type="hidden" name="' + name + '" value="1" />');
        } else if ( typeof(theLink.href) != 'undefined' ) {
            theLink.href += '&is_js_confirmed=1';
        } else if ( typeof(theLink.form) != 'undefined' ) {
            theLink.form.action += '?is_js_confirmed=1';
        }
    }

    return is_confirmed;
} // end of the 'confirmLink()' function


/**
 * Displays a confirmation box before doing some action
 *
 * @param   object   the message to display
 *
 * @return  boolean  whether to run the query or not
 *
 * @todo used only by libraries/display_tbl.lib.php. figure out how it is used
 *       and replace with a jQuery equivalent
 */
function confirmAction(theMessage)
{
    // TODO: Confirmation is not required in the configuration file
    // or browser is Opera (crappy js implementation)
    if (typeof(window.opera) != 'undefined') {
        return true;
    }

    var is_confirmed = confirm(theMessage);

    return is_confirmed;
} // end of the 'confirmAction()' function


/**
 * Displays an error message if a "DROP DATABASE" statement is submitted
 * while it isn't allowed, else confirms a "DROP/DELETE/ALTER" query before
 * sumitting it if required.
 * This function is called by the 'checkSqlQuery()' js function.
 *
 * @param   object   the form
 * @param   object   the sql query textarea
 *
 * @return  boolean  whether to run the query or not
 *
 * @see     checkSqlQuery()
 */
function confirmQuery(theForm1, sqlQuery1)
{
    // Confirmation is not required in the configuration file
    if (PMA_messages['strDoYouReally'] == '') {
        return true;
    }

    // "DROP DATABASE" statement isn't allowed
    if (PMA_messages['strNoDropDatabases'] != '') {
        var drop_re = new RegExp('(^|;)\\s*DROP\\s+(IF EXISTS\\s+)?DATABASE\\s', 'i');
        if (drop_re.test(sqlQuery1.value)) {
            alert(PMA_messages['strNoDropDatabases']);
            theForm1.reset();
            sqlQuery1.focus();
            return false;
        } // end if
    } // end if

    // Confirms a "DROP/DELETE/ALTER/TRUNCATE" statement
    //
    // TODO: find a way (if possible) to use the parser-analyser
    // for this kind of verification
    // For now, I just added a ^ to check for the statement at
    // beginning of expression

    var do_confirm_re_0 = new RegExp('^\\s*DROP\\s+(IF EXISTS\\s+)?(TABLE|DATABASE|PROCEDURE)\\s', 'i');
    var do_confirm_re_1 = new RegExp('^\\s*ALTER\\s+TABLE\\s+((`[^`]+`)|([A-Za-z0-9_$]+))\\s+DROP\\s', 'i');
    var do_confirm_re_2 = new RegExp('^\\s*DELETE\\s+FROM\\s', 'i');
    var do_confirm_re_3 = new RegExp('^\\s*TRUNCATE\\s', 'i');

    if (do_confirm_re_0.test(sqlQuery1.value)
        || do_confirm_re_1.test(sqlQuery1.value)
        || do_confirm_re_2.test(sqlQuery1.value)
        || do_confirm_re_3.test(sqlQuery1.value)) {
        var message      = (sqlQuery1.value.length > 100)
                         ? sqlQuery1.value.substr(0, 100) + '\n    ...'
                         : sqlQuery1.value;
        var is_confirmed = confirm(PMA_messages['strDoYouReally'] + ' :\n' + message);
        // statement is confirmed -> update the
        // "is_js_confirmed" form field so the confirm test won't be
        // run on the server side and allows to submit the form
        if (is_confirmed) {
            theForm1.elements['is_js_confirmed'].value = 1;
            return true;
        }
        // statement is rejected -> do not submit the form
        else {
            window.focus();
            sqlQuery1.focus();
            return false;
        } // end if (handle confirm box result)
    } // end if (display confirm box)

    return true;
} // end of the 'confirmQuery()' function


/**
 * Displays a confirmation box before disabling the BLOB repository for a given database.
 * This function is called while clicking links
 *
 * @param   object   the database
 *
 * @return  boolean  whether to disable the repository or not
 */
function confirmDisableRepository(theDB)
{
    // Confirmation is not required in the configuration file
    // or browser is Opera (crappy js implementation)
    if (PMA_messages['strDoYouReally'] == '' || typeof(window.opera) != 'undefined') {
        return true;
    }

    var is_confirmed = confirm(PMA_messages['strBLOBRepositoryDisableStrongWarning'] + '\n' + PMA_messages['strBLOBRepositoryDisableAreYouSure']);

    return is_confirmed;
} // end of the 'confirmDisableBLOBRepository()' function


/**
 * Displays an error message if the user submitted the sql query form with no
 * sql query, else checks for "DROP/DELETE/ALTER" statements
 *
 * @param   object   the form
 *
 * @return  boolean  always false
 *
 * @see     confirmQuery()
 */
function checkSqlQuery(theForm)
{
    var sqlQuery = theForm.elements['sql_query'];
    var isEmpty  = 1;

    var space_re = new RegExp('\\s+');
    if (typeof(theForm.elements['sql_file']) != 'undefined' &&
            theForm.elements['sql_file'].value.replace(space_re, '') != '') {
        return true;
    }
    if (typeof(theForm.elements['sql_localfile']) != 'undefined' &&
            theForm.elements['sql_localfile'].value.replace(space_re, '') != '') {
        return true;
    }
    if (isEmpty && typeof(theForm.elements['id_bookmark']) != 'undefined' &&
            (theForm.elements['id_bookmark'].value != null || theForm.elements['id_bookmark'].value != '') &&
            theForm.elements['id_bookmark'].selectedIndex != 0
            ) {
        return true;
    }
    // Checks for "DROP/DELETE/ALTER" statements
    if (sqlQuery.value.replace(space_re, '') != '') {
        if (confirmQuery(theForm, sqlQuery)) {
            return true;
        } else {
            return false;
        }
    }
    theForm.reset();
    isEmpty = 1;

    if (isEmpty) {
        sqlQuery.select();
        alert(PMA_messages['strFormEmpty']);
        sqlQuery.focus();
        return false;
    }

    return true;
} // end of the 'checkSqlQuery()' function

/**
 * Check if a form's element is empty.
 * An element containing only spaces is also considered empty
 *
 * @param   object   the form
 * @param   string   the name of the form field to put the focus on
 *
 * @return  boolean  whether the form field is empty or not
 */
function emptyCheckTheField(theForm, theFieldName)
{
    var theField = theForm.elements[theFieldName];
    var space_re = new RegExp('\\s+');
    return (theField.value.replace(space_re, '') == '') ? 1 : 0;
} // end of the 'emptyCheckTheField()' function


/**
 * Check whether a form field is empty or not
 *
 * @param   object   the form
 * @param   string   the name of the form field to put the focus on
 *
 * @return  boolean  whether the form field is empty or not
 */
function emptyFormElements(theForm, theFieldName)
{
    var theField = theForm.elements[theFieldName];
    var isEmpty = emptyCheckTheField(theForm, theFieldName);


    return isEmpty;
} // end of the 'emptyFormElements()' function


/**
 * Ensures a value submitted in a form is numeric and is in a range
 *
 * @param   object   the form
 * @param   string   the name of the form field to check
 * @param   integer  the minimum authorized value
 * @param   integer  the maximum authorized value
 *
 * @return  boolean  whether a valid number has been submitted or not
 */
function checkFormElementInRange(theForm, theFieldName, message, min, max)
{
    var theField         = theForm.elements[theFieldName];
    var val              = parseInt(theField.value);

    if (typeof(min) == 'undefined') {
        min = 0;
    }
    if (typeof(max) == 'undefined') {
        max = Number.MAX_VALUE;
    }

    // It's not a number
    if (isNaN(val)) {
        theField.select();
        alert(PMA_messages['strNotNumber']);
        theField.focus();
        return false;
    }
    // It's a number but it is not between min and max
    else if (val < min || val > max) {
        theField.select();
        alert(message.replace('%d', val));
        theField.focus();
        return false;
    }
    // It's a valid number
    else {
        theField.value = val;
    }
    return true;

} // end of the 'checkFormElementInRange()' function


function checkTableEditForm(theForm, fieldsCnt)
{
    // TODO: avoid sending a message if user just wants to add a line
    // on the form but has not completed at least one field name

    var atLeastOneField = 0;
    var i, elm, elm2, elm3, val, id;

    for (i=0; i<fieldsCnt; i++)
    {
        id = "#field_" + i + "_2";
        elm = $(id);
        val = elm.val()
        if (val == 'VARCHAR' || val == 'CHAR' || val == 'BIT' || val == 'VARBINARY' || val == 'BINARY') {
            elm2 = $("#field_" + i + "_3");
            val = parseInt(elm2.val());
            elm3 = $("#field_" + i + "_1");
            if (isNaN(val) && elm3.val() != "") {
                elm2.select();
                alert(PMA_messages['strNotNumber']);
                elm2.focus();
                return false;
            }
        }

        if (atLeastOneField == 0) {
            id = "field_" + i + "_1";
            if (!emptyCheckTheField(theForm, id)) {
                atLeastOneField = 1;
            }
        }
    }
    if (atLeastOneField == 0) {
        var theField = theForm.elements["field_0_1"];
        alert(PMA_messages['strFormEmpty']);
        theField.focus();
        return false;
    }

    // at least this section is under jQuery
    if ($("input.textfield[name='table']").val() == "") {
        alert(PMA_messages['strFormEmpty']);
        $("input.textfield[name='table']").focus();
        return false;
    }


    return true;
} // enf of the 'checkTableEditForm()' function


/**
 * Ensures the choice between 'transmit', 'zipped', 'gzipped' and 'bzipped'
 * checkboxes is consistant
 *
 * @param   object   the form
 * @param   string   a code for the action that causes this function to be run
 *
 * @return  boolean  always true
 */
function checkTransmitDump(theForm, theAction)
{
    var formElts = theForm.elements;

    // 'zipped' option has been checked
    if (theAction == 'zip' && formElts['zip'].checked) {
        if (!formElts['asfile'].checked) {
            theForm.elements['asfile'].checked = true;
        }
        if (typeof(formElts['gzip']) != 'undefined' && formElts['gzip'].checked) {
            theForm.elements['gzip'].checked = false;
        }
        if (typeof(formElts['bzip']) != 'undefined' && formElts['bzip'].checked) {
            theForm.elements['bzip'].checked = false;
        }
    }
    // 'gzipped' option has been checked
    else if (theAction == 'gzip' && formElts['gzip'].checked) {
        if (!formElts['asfile'].checked) {
            theForm.elements['asfile'].checked = true;
        }
        if (typeof(formElts['zip']) != 'undefined' && formElts['zip'].checked) {
            theForm.elements['zip'].checked = false;
        }
        if (typeof(formElts['bzip']) != 'undefined' && formElts['bzip'].checked) {
            theForm.elements['bzip'].checked = false;
        }
    }
    // 'bzipped' option has been checked
    else if (theAction == 'bzip' && formElts['bzip'].checked) {
        if (!formElts['asfile'].checked) {
            theForm.elements['asfile'].checked = true;
        }
        if (typeof(formElts['zip']) != 'undefined' && formElts['zip'].checked) {
            theForm.elements['zip'].checked = false;
        }
        if (typeof(formElts['gzip']) != 'undefined' && formElts['gzip'].checked) {
            theForm.elements['gzip'].checked = false;
        }
    }
    // 'transmit' option has been unchecked
    else if (theAction == 'transmit' && !formElts['asfile'].checked) {
        if (typeof(formElts['zip']) != 'undefined' && formElts['zip'].checked) {
            theForm.elements['zip'].checked = false;
        }
        if ((typeof(formElts['gzip']) != 'undefined' && formElts['gzip'].checked)) {
            theForm.elements['gzip'].checked = false;
        }
        if ((typeof(formElts['bzip']) != 'undefined' && formElts['bzip'].checked)) {
            theForm.elements['bzip'].checked = false;
        }
    }

    return true;
} // end of the 'checkTransmitDump()' function

$(document).ready(function() {
    /**
     * Row marking in horizontal mode (use "live" so that it works also for
     * next pages reached via AJAX); a tr may have the class noclick to remove
     * this behavior.
     */
    $('table:not(.noclick) tr.odd:not(.noclick), table:not(.noclick) tr.even:not(.noclick)').live('click',function(e) {
        // do not trigger when clicked on anchor
        if ($(e.target).is('a, img, a *')) {
            return;
        }
        var $tr = $(this);

        // make the table unselectable (to prevent default highlighting when shift+click)
        $tr.parents('table').noSelect();

        if (!e.shiftKey || last_clicked_row == -1) {
            // usual click

            // XXX: FF fires two click events for <label> (label and checkbox), so we need to handle this differently
            var $checkbox = $tr.find(':checkbox');
            if ($checkbox.length) {
                // checkbox in a row, add or remove class depending on checkbox state
                var checked = $checkbox.attr('checked');
                if (!$(e.target).is(':checkbox, label')) {
                    checked = !checked;
                    $checkbox.attr('checked', checked);
                }
                if (checked) {
                    $tr.addClass('marked');
                } else {
                    $tr.removeClass('marked');
                }
                last_click_checked = checked;
            } else {
                // normaln data table, just toggle class
                $tr.toggleClass('marked');
                last_click_checked = false;
            }

            // remember the last clicked row
            last_clicked_row = last_click_checked ? $('tr.odd:not(.noclick), tr.even:not(.noclick)').index(this) : -1;
            last_shift_clicked_row = -1;
        } else {
            // handle the shift click
            var start, end;

            // clear last shift click result
            if (last_shift_clicked_row >= 0) {
                if (last_shift_clicked_row >= last_clicked_row) {
                    start = last_clicked_row;
                    end = last_shift_clicked_row;
                } else {
                    start = last_shift_clicked_row;
                    end = last_clicked_row;
                }
                $tr.parent().find('tr.odd:not(.noclick), tr.even:not(.noclick)')
                    .slice(start, end + 1)
                    .removeClass('marked')
                    .find(':checkbox')
                    .attr('checked', false);
            }

            // handle new shift click
            var curr_row = $('tr.odd:not(.noclick), tr.even:not(.noclick)').index(this);
            if (curr_row >= last_clicked_row) {
                start = last_clicked_row;
                end = curr_row;
            } else {
                start = curr_row;
                end = last_clicked_row;
            }
            $tr.parent().find('tr.odd:not(.noclick), tr.even:not(.noclick)')
                .slice(start, end + 1)
                .addClass('marked')
                .find(':checkbox')
                .attr('checked', true);

            // remember the last shift clicked row
            last_shift_clicked_row = curr_row;
        }
    });

    /**
     * Add a date/time picker to each element that needs it
     */
    $('.datefield, .datetimefield').each(function() {
        PMA_addDatepicker($(this));
        });
})

/**
 * True if last click is to check a row.
 */
var last_click_checked = false;

/**
 * Zero-based index of last clicked row.
 * Used to handle the shift + click event in the code above.
 */
var last_clicked_row = -1;

/**
 * Zero-based index of last shift clicked row.
 */
var last_shift_clicked_row = -1;

/**
 * Row highlighting in horizontal mode (use "live"
 * so that it works also for pages reached via AJAX)
 */
/*$(document).ready(function() {
    $('tr.odd, tr.even').live('hover',function(event) {
        var $tr = $(this);
        $tr.toggleClass('hover',event.type=='mouseover');
        $tr.children().toggleClass('hover',event.type=='mouseover');
    });
})*/

/**
 * This array is used to remember mark status of rows in browse mode
 */
var marked_row = new Array;

/**
 * marks all rows and selects its first checkbox inside the given element
 * the given element is usaly a table or a div containing the table or tables
 *
 * @param    container    DOM element
 */
function markAllRows( container_id )
{

    $("#"+container_id).find("input:checkbox:enabled").attr('checked', 'checked')
    .parents("tr").addClass("marked");
    return true;
}

/**
 * marks all rows and selects its first checkbox inside the given element
 * the given element is usaly a table or a div containing the table or tables
 *
 * @param    container    DOM element
 */
function unMarkAllRows( container_id )
{

    $("#"+container_id).find("input:checkbox:enabled").removeAttr('checked')
    .parents("tr").removeClass("marked");
    return true;
}

/**
 * Checks/unchecks all checkbox in given conainer (f.e. a form, fieldset or div)
 *
 * @param   string   container_id  the container id
 * @param   boolean  state         new value for checkbox (true or false)
 * @return  boolean  always true
 */
function setCheckboxes( container_id, state )
{

    if(state) {
        $("#"+container_id).find("input:checkbox").attr('checked', 'checked');
    }
    else {
        $("#"+container_id).find("input:checkbox").removeAttr('checked');
    }

    return true;
} // end of the 'setCheckboxes()' function

/**
  * Checks/unchecks all options of a <select> element
  *
  * @param   string   the form name
  * @param   string   the element name
  * @param   boolean  whether to check or to uncheck options
  *
  * @return  boolean  always true
  */
function setSelectOptions(the_form, the_select, do_check)
{
    $("form[name='"+ the_form +"'] select[name='"+the_select+"']").find("option").attr('selected', do_check);
    return true;
} // end of the 'setSelectOptions()' function

/**
 * Sets current value for query box.
 */
function setQuery(query)
{
    if (codemirror_editor) {
        codemirror_editor.setValue(query);
    } else {
        document.sqlform.sql_query.value = query;
    }
}


/**
  * Create quick sql statements.
  *
  */
function insertQuery(queryType)
{
    if (queryType == "clear") {
        setQuery('');
        return;
    }

    var myQuery = document.sqlform.sql_query;
    var query = "";
    var myListBox = document.sqlform.dummy;
    var table = document.sqlform.table.value;

    if (myListBox.options.length > 0) {
        sql_box_locked = true;
        var chaineAj = "";
        var valDis = "";
        var editDis = "";
        var NbSelect = 0;
        for (var i=0; i < myListBox.options.length; i++) {
            NbSelect++;
            if (NbSelect > 1) {
                chaineAj += ", ";
                valDis += ",";
                editDis += ",";
            }
            chaineAj += myListBox.options[i].value;
            valDis += "[value-" + NbSelect + "]";
            editDis += myListBox.options[i].value + "=[value-" + NbSelect + "]";
        }
        if (queryType == "selectall") {
            query = "SELECT * FROM `" + table + "` WHERE 1";
        } else if (queryType == "select") {
            query = "SELECT " + chaineAj + " FROM `" + table + "` WHERE 1";
        } else if (queryType == "insert") {
               query = "INSERT INTO `" + table + "`(" + chaineAj + ") VALUES (" + valDis + ")";
        } else if (queryType == "update") {
            query = "UPDATE `" + table + "` SET " + editDis + " WHERE 1";
        } else if(queryType == "delete") {
            query = "DELETE FROM `" + table + "` WHERE 1";
        }
        setQuery(query);
        sql_box_locked = false;
    }
}


/**
  * Inserts multiple fields.
  *
  */
function insertValueQuery()
{
    var myQuery = document.sqlform.sql_query;
    var myListBox = document.sqlform.dummy;

    if(myListBox.options.length > 0) {
        sql_box_locked = true;
        var chaineAj = "";
        var NbSelect = 0;
        for(var i=0; i<myListBox.options.length; i++) {
            if (myListBox.options[i].selected) {
                NbSelect++;
                if (NbSelect > 1) {
                    chaineAj += ", ";
                }
                chaineAj += myListBox.options[i].value;
            }
        }

        /* CodeMirror support */
        if (codemirror_editor) {
            codemirror_editor.replaceSelection(chaineAj);
        //IE support
        } else if (document.selection) {
            myQuery.focus();
            sel = document.selection.createRange();
            sel.text = chaineAj;
            document.sqlform.insert.focus();
        }
        //MOZILLA/NETSCAPE support
        else if (document.sqlform.sql_query.selectionStart || document.sqlform.sql_query.selectionStart == "0") {
            var startPos = document.sqlform.sql_query.selectionStart;
            var endPos = document.sqlform.sql_query.selectionEnd;
            var chaineSql = document.sqlform.sql_query.value;

            myQuery.value = chaineSql.substring(0, startPos) + chaineAj + chaineSql.substring(endPos, chaineSql.length);
        } else {
            myQuery.value += chaineAj;
        }
        sql_box_locked = false;
    }
}

/**
  * listbox redirection
  */
function goToUrl(selObj, goToLocation)
{
    eval("document.location.href = '" + goToLocation + "pos=" + selObj.options[selObj.selectedIndex].value + "'");
}

/**
 * getElement
 */
function getElement(e,f)
{
    if(document.layers){
        f=(f)?f:self;
        if(f.document.layers[e]) {
            return f.document.layers[e];
        }
        for(W=0;W<f.document.layers.length;W++) {
            return(getElement(e,f.document.layers[W]));
        }
    }
    if(document.all) {
        return document.all[e];
    }
    return document.getElementById(e);
}

/**
  * Refresh the WYSIWYG scratchboard after changes have been made
  */
function refreshDragOption(e)
{
    var elm = $('#' + e);
    if (elm.css('visibility') == 'visible') {
        refreshLayout();
        TableDragInit();
    }
}

/**
  * Refresh/resize the WYSIWYG scratchboard
  */
function refreshLayout()
{
    var elm = $('#pdflayout')
    var orientation = $('#orientation_opt').val();
    if($('#paper_opt').length==1){
        var paper = $('#paper_opt').val();
    }else{
        var paper = 'A4';
    }
    if (orientation == 'P') {
        posa = 'x';
        posb = 'y';
    } else {
        posa = 'y';
        posb = 'x';
    }
    elm.css('width', pdfPaperSize(paper, posa) + 'px');
    elm.css('height', pdfPaperSize(paper, posb) + 'px');
}

/**
  * Show/hide the WYSIWYG scratchboard
  */
function ToggleDragDrop(e)
{
    var elm = $('#' + e);
    if (elm.css('visibility') == 'hidden') {
        PDFinit(); /* Defined in pdf_pages.php */
        elm.css('visibility', 'visible');
        elm.css('display', 'block');
        $('#showwysiwyg').val('1')
    } else {
        elm.css('visibility', 'hidden');
        elm.css('display', 'none');
        $('#showwysiwyg').val('0')
    }
}

/**
  * PDF scratchboard: When a position is entered manually, update
  * the fields inside the scratchboard.
  */
function dragPlace(no, axis, value)
{
    var elm = $('#table_' + no);
    if (axis == 'x') {
        elm.css('left', value + 'px');
    } else {
        elm.css('top', value + 'px');
    }
}

/**
 * Returns paper sizes for a given format
 */
function pdfPaperSize(format, axis)
{
    switch (format.toUpperCase()) {
        case '4A0':
            if (axis == 'x') return 4767.87; else return 6740.79;
            break;
        case '2A0':
            if (axis == 'x') return 3370.39; else return 4767.87;
            break;
        case 'A0':
            if (axis == 'x') return 2383.94; else return 3370.39;
            break;
        case 'A1':
            if (axis == 'x') return 1683.78; else return 2383.94;
            break;
        case 'A2':
            if (axis == 'x') return 1190.55; else return 1683.78;
            break;
        case 'A3':
            if (axis == 'x') return 841.89; else return 1190.55;
            break;
        case 'A4':
            if (axis == 'x') return 595.28; else return 841.89;
            break;
        case 'A5':
            if (axis == 'x') return 419.53; else return 595.28;
            break;
        case 'A6':
            if (axis == 'x') return 297.64; else return 419.53;
            break;
        case 'A7':
            if (axis == 'x') return 209.76; else return 297.64;
            break;
        case 'A8':
            if (axis == 'x') return 147.40; else return 209.76;
            break;
        case 'A9':
            if (axis == 'x') return 104.88; else return 147.40;
            break;
        case 'A10':
            if (axis == 'x') return 73.70; else return 104.88;
            break;
        case 'B0':
            if (axis == 'x') return 2834.65; else return 4008.19;
            break;
        case 'B1':
            if (axis == 'x') return 2004.09; else return 2834.65;
            break;
        case 'B2':
            if (axis == 'x') return 1417.32; else return 2004.09;
            break;
        case 'B3':
            if (axis == 'x') return 1000.63; else return 1417.32;
            break;
        case 'B4':
            if (axis == 'x') return 708.66; else return 1000.63;
            break;
        case 'B5':
            if (axis == 'x') return 498.90; else return 708.66;
            break;
        case 'B6':
            if (axis == 'x') return 354.33; else return 498.90;
            break;
        case 'B7':
            if (axis == 'x') return 249.45; else return 354.33;
            break;
        case 'B8':
            if (axis == 'x') return 175.75; else return 249.45;
            break;
        case 'B9':
            if (axis == 'x') return 124.72; else return 175.75;
            break;
        case 'B10':
            if (axis == 'x') return 87.87; else return 124.72;
            break;
        case 'C0':
            if (axis == 'x') return 2599.37; else return 3676.54;
            break;
        case 'C1':
            if (axis == 'x') return 1836.85; else return 2599.37;
            break;
        case 'C2':
            if (axis == 'x') return 1298.27; else return 1836.85;
            break;
        case 'C3':
            if (axis == 'x') return 918.43; else return 1298.27;
            break;
        case 'C4':
            if (axis == 'x') return 649.13; else return 918.43;
            break;
        case 'C5':
            if (axis == 'x') return 459.21; else return 649.13;
            break;
        case 'C6':
            if (axis == 'x') return 323.15; else return 459.21;
            break;
        case 'C7':
            if (axis == 'x') return 229.61; else return 323.15;
            break;
        case 'C8':
            if (axis == 'x') return 161.57; else return 229.61;
            break;
        case 'C9':
            if (axis == 'x') return 113.39; else return 161.57;
            break;
        case 'C10':
            if (axis == 'x') return 79.37; else return 113.39;
            break;
        case 'RA0':
            if (axis == 'x') return 2437.80; else return 3458.27;
            break;
        case 'RA1':
            if (axis == 'x') return 1729.13; else return 2437.80;
            break;
        case 'RA2':
            if (axis == 'x') return 1218.90; else return 1729.13;
            break;
        case 'RA3':
            if (axis == 'x') return 864.57; else return 1218.90;
            break;
        case 'RA4':
            if (axis == 'x') return 609.45; else return 864.57;
            break;
        case 'SRA0':
            if (axis == 'x') return 2551.18; else return 3628.35;
            break;
        case 'SRA1':
            if (axis == 'x') return 1814.17; else return 2551.18;
            break;
        case 'SRA2':
            if (axis == 'x') return 1275.59; else return 1814.17;
            break;
        case 'SRA3':
            if (axis == 'x') return 907.09; else return 1275.59;
            break;
        case 'SRA4':
            if (axis == 'x') return 637.80; else return 907.09;
            break;
        case 'LETTER':
            if (axis == 'x') return 612.00; else return 792.00;
            break;
        case 'LEGAL':
            if (axis == 'x') return 612.00; else return 1008.00;
            break;
        case 'EXECUTIVE':
            if (axis == 'x') return 521.86; else return 756.00;
            break;
        case 'FOLIO':
            if (axis == 'x') return 612.00; else return 936.00;
            break;
    } // end switch

    return 0;
}

/**
 * for playing media from the BLOB repository
 *
 * @param   var
 * @param   var     url_params  main purpose is to pass the token
 * @param   var     bs_ref      BLOB repository reference
 * @param   var     m_type      type of BLOB repository media
 * @param   var     w_width     width of popup window
 * @param   var     w_height    height of popup window
 */
function popupBSMedia(url_params, bs_ref, m_type, is_cust_type, w_width, w_height)
{
    // if width not specified, use default
    if (w_width == undefined) {
        w_width = 640;
    }

    // if height not specified, use default
    if (w_height == undefined) {
        w_height = 480;
    }

    // open popup window (for displaying video/playing audio)
    var mediaWin = window.open('bs_play_media.php?' + url_params + '&bs_reference=' + bs_ref + '&media_type=' + m_type + '&custom_type=' + is_cust_type, 'viewBSMedia', 'width=' + w_width + ', height=' + w_height + ', resizable=1, scrollbars=1, status=0');
}

/**
 * popups a request for changing MIME types for files in the BLOB repository
 *
 * @param   var     db                      database name
 * @param   var     table                   table name
 * @param   var     reference               BLOB repository reference
 * @param   var     current_mime_type       current MIME type associated with BLOB repository reference
 */
function requestMIMETypeChange(db, table, reference, current_mime_type)
{
    // no mime type specified, set to default (nothing)
    if (undefined == current_mime_type) {
        current_mime_type = "";
    }

    // prompt user for new mime type
    var new_mime_type = prompt("Enter custom MIME type", current_mime_type);

    // if new mime_type is specified and is not the same as the previous type, request for mime type change
    if (new_mime_type && new_mime_type != current_mime_type) {
        changeMIMEType(db, table, reference, new_mime_type);
    }
}

/**
 * changes MIME types for files in the BLOB repository
 *
 * @param   var     db              database name
 * @param   var     table           table name
 * @param   var     reference       BLOB repository reference
 * @param   var     mime_type       new MIME type to be associated with BLOB repository reference
 */
function changeMIMEType(db, table, reference, mime_type)
{
    // specify url and parameters for jQuery POST
    var mime_chg_url = 'bs_change_mime_type.php';
    var params = {bs_db: db, bs_table: table, bs_reference: reference, bs_new_mime_type: mime_type};

    // jQuery POST
    jQuery.post(mime_chg_url, params);
}

/**
 * Jquery Coding for inline editing SQL_QUERY
 */
$(document).ready(function(){
    $(".inline_edit_sql").live('click', function(){
        var server     = $(this).prev().find("input[name='server']").val();
        var db         = $(this).prev().find("input[name='db']").val();
        var table      = $(this).prev().find("input[name='table']").val();
        var token      = $(this).prev().find("input[name='token']").val();
        var sql_query  = $(this).prev().find("input[name='sql_query']").val();
        var $inner_sql = $(this).parent().prev().find('.inner_sql');
        var old_text   = $inner_sql.html();

        var new_content = "<textarea name=\"sql_query_edit\" id=\"sql_query_edit\">" + sql_query + "</textarea>\n";
        new_content    += "<input type=\"button\" class=\"btnSave\" value=\"" + PMA_messages['strGo'] + "\">\n";
        new_content    += "<input type=\"button\" class=\"btnDiscard\" value=\"" + PMA_messages['strCancel'] + "\">\n";
        $inner_sql.replaceWith(new_content);
        $(".btnSave").each(function(){
            $(this).click(function(){
                sql_query = $(this).prev().val();
                window.location.replace("import.php"
                                      + "?server=" + encodeURIComponent(server)
                                      + "&db=" + encodeURIComponent(db)
                                      + "&table=" + encodeURIComponent(table)
                                      + "&sql_query=" + encodeURIComponent(sql_query)
                                      + "&show_query=1"
                                      + "&token=" + token);
            });
        });
        $(".btnDiscard").each(function(){
            $(this).click(function(){
                $(this).closest(".sql").html("<span class=\"syntax\"><span class=\"inner_sql\">" + old_text + "</span></span>");
            });
        });
        return false;
    });

    $('.sqlbutton').click(function(evt){
        insertQuery(evt.target.id);
        return false;
    });

    $("#export_type").change(function(){
        if($("#export_type").val()=='svg'){
            $("#show_grid_opt").attr("disabled","disabled");
            $("#orientation_opt").attr("disabled","disabled");
            $("#with_doc").attr("disabled","disabled");
            $("#show_table_dim_opt").removeAttr("disabled");
            $("#all_table_same_wide").removeAttr("disabled");
            $("#paper_opt").removeAttr("disabled","disabled");
            $("#show_color_opt").removeAttr("disabled","disabled");
            //$(this).css("background-color","yellow");
        }else if($("#export_type").val()=='dia'){
            $("#show_grid_opt").attr("disabled","disabled");
            $("#with_doc").attr("disabled","disabled");
            $("#show_table_dim_opt").attr("disabled","disabled");
            $("#all_table_same_wide").attr("disabled","disabled");
            $("#paper_opt").removeAttr("disabled","disabled");
            $("#show_color_opt").removeAttr("disabled","disabled");
            $("#orientation_opt").removeAttr("disabled","disabled");
        }else if($("#export_type").val()=='eps'){
            $("#show_grid_opt").attr("disabled","disabled");
            $("#orientation_opt").removeAttr("disabled");
            $("#with_doc").attr("disabled","disabled");
            $("#show_table_dim_opt").attr("disabled","disabled");
            $("#all_table_same_wide").attr("disabled","disabled");
            $("#paper_opt").attr("disabled","disabled");
            $("#show_color_opt").attr("disabled","disabled");

        }else if($("#export_type").val()=='pdf'){
            $("#show_grid_opt").removeAttr("disabled");
            $("#orientation_opt").removeAttr("disabled");
            $("#with_doc").removeAttr("disabled","disabled");
            $("#show_table_dim_opt").removeAttr("disabled","disabled");
            $("#all_table_same_wide").removeAttr("disabled","disabled");
            $("#paper_opt").removeAttr("disabled","disabled");
            $("#show_color_opt").removeAttr("disabled","disabled");
        }else{
            // nothing
        }
    });

    $('#sqlquery').focus().keydown(function (e) {
        if (e.ctrlKey && e.keyCode == 13) {
            $("#sqlqueryform").submit();
        }
    });

    if ($('#input_username')) {
        if ($('#input_username').val() == '') {
            $('#input_username').focus();
        } else {
            $('#input_password').focus();
        }
    }
});

/**
 * Show a message on the top of the page for an Ajax request
 *
 * @param   var     message     string containing the message to be shown.
 *                              optional, defaults to 'Loading...'
 * @param   var     timeout     number of milliseconds for the message to be visible
 *                              optional, defaults to 5000
 * @return  jQuery object       jQuery Element that holds the message div
 */
function PMA_ajaxShowMessage(message, timeout)
{

    //Handle the case when a empty data.message is passed. We don't want the empty message
    if (message == '') {
        return true;
    } else if (! message) {
        // If the message is undefined, show the default
        message = PMA_messages['strLoading'];
    }

    /**
     * @var timeout Number of milliseconds for which the message will be visible
     * @default 5000 ms
     */
    if (! timeout) {
        timeout = 5000;
    }

    // Create a parent element for the AJAX messages, if necessary
    if ($('#loading_parent').length == 0) {
        $('<div id="loading_parent"></div>')
        .insertBefore("#serverinfo");
    }

    // Update message count to create distinct message elements every time
    ajax_message_count++;

    // Remove all old messages, if any
    $(".ajax_notification[id^=ajax_message_num]").remove();

    /**
     * @var    $retval    a jQuery object containing the reference
     *                    to the created AJAX message
     */
    var $retval = $('<span class="ajax_notification" id="ajax_message_num_' + ajax_message_count + '"></span>')
        .hide()
        .appendTo("#loading_parent")
        .html(message)
        .fadeIn('medium')
        .delay(timeout)
        .fadeOut('medium', function() {
            $(this).remove();
        });

    return $retval;
}

/**
 * Removes the message shown for an Ajax operation when it's completed
 */
function PMA_ajaxRemoveMessage($this_msgbox)
{
    if ($this_msgbox != undefined && $this_msgbox instanceof jQuery) {
        $this_msgbox
        .stop(true, true)
        .fadeOut('medium');
    }
}

/**
 * Hides/shows the "Open in ENUM/SET editor" message, depending on the data type of the column currently selected
 */
function PMA_showNoticeForEnum(selectElement)
{
    var enum_notice_id = selectElement.attr("id").split("_")[1];
    enum_notice_id += "_" + (parseInt(selectElement.attr("id").split("_")[2]) + 1);
    var selectedType = selectElement.attr("value");
    if (selectedType == "ENUM" || selectedType == "SET") {
        $("p[id='enum_notice_" + enum_notice_id + "']").show();
    } else {
        $("p[id='enum_notice_" + enum_notice_id + "']").hide();
    }
}

/**
 * Generates a dialog box to pop up the create_table form
 */
function PMA_createTableDialog( div, url , target)
{
     /**
     *  @var    button_options  Object that stores the options passed to jQueryUI
     *                          dialog
     */
     var button_options = {};
     // in the following function we need to use $(this)
     button_options[PMA_messages['strCancel']] = function() {$(this).parent().dialog('close').remove();}

     var button_options_error = {};
     button_options_error[PMA_messages['strOK']] = function() {$(this).parent().dialog('close').remove();}

     var $msgbox = PMA_ajaxShowMessage();

     $.get( target , url ,  function(data) {
         //in the case of an error, show the error message returned.
         if (data.success != undefined && data.success == false) {
             div
             .append(data.error)
             .dialog({
                 title: PMA_messages['strCreateTable'],
                 height: 230,
                 width: 900,
                 open: PMA_verifyTypeOfAllColumns,
                 buttons : button_options_error
             })// end dialog options
             //remove the redundant [Back] link in the error message.
             .find('fieldset').remove();
         } else {
             div
             .append(data)
             .dialog({
                 title: PMA_messages['strCreateTable'],
                 height: 600,
                 width: 900,
                 open: PMA_verifyTypeOfAllColumns,
                 buttons : button_options
             }); // end dialog options
         }
         PMA_ajaxRemoveMessage($msgbox);
     }) // end $.get()

}

/**
 * Creates a highcharts chart in the given container
 *
 * @param   var     settings    object with highcharts properties that should be applied. (See also http://www.highcharts.com/ref/)
 *                              requires at least settings.chart.renderTo and settings.series to be set.
 *                              In addition there may be an additional property object 'realtime' that allows for realtime charting:
 *                              realtime: {
 *                                  url: adress to get the data from (will always add token, ajax_request=1 and chart_data=1 to the GET request)
 *                                  type: the GET request will also add type=[value of the type property] to the request
 *                                  callback: Callback function that should draw the point, it's called with 4 parameters in this order:
 *                                      - the chart object
 *                                      - the current response value of the GET request, JSON parsed
 *                                      - the previous response value of the GET request, JSON parsed
 *                                      - the number of added points
 *                                  error: Callback function when the get request fails. TODO: Apply callback on timeouts aswell
 *                              }
 *
 * @return  object   The created highcharts instance
 */
function PMA_createChart(passedSettings)
{
    var container = passedSettings.chart.renderTo;

    var settings = {
        chart: {
            type: 'spline',
            marginRight: 10,
            backgroundColor: 'none',
            events: {
                /* Live charting support */
                load: function() {
                    var thisChart = this;
                    var lastValue = null, curValue = null;
                    var numLoadedPoints = 0, otherSum = 0;
                    var diff;

                    // No realtime updates for graphs that are being exported, and disabled when realtime is not set
                    // Also don't do live charting if we don't have the server time
                    if(thisChart.options.chart.forExport == true ||
                        ! thisChart.options.realtime ||
                        ! thisChart.options.realtime.callback ||
                        ! server_time_diff) return;

                    thisChart.options.realtime.timeoutCallBack = function() {
                        thisChart.options.realtime.postRequest = $.post(
                            thisChart.options.realtime.url,
                            thisChart.options.realtime.postData,
                            function(data) {
                                try {
                                    curValue = jQuery.parseJSON(data);
                                } catch (err) {
                                    if(thisChart.options.realtime.error)
                                        thisChart.options.realtime.error(err);
                                    return;
                                }

                                if (lastValue==null) {
                                    diff = curValue.x - thisChart.xAxis[0].getExtremes().max;
                                } else {
                                    diff = parseInt(curValue.x - lastValue.x);
                                }

                                thisChart.xAxis[0].setExtremes(
                                    thisChart.xAxis[0].getExtremes().min+diff,
                                    thisChart.xAxis[0].getExtremes().max+diff,
                                    false
                                );

                                thisChart.options.realtime.callback(thisChart,curValue,lastValue,numLoadedPoints);

                                lastValue = curValue;
                                numLoadedPoints++;

                                // Timeout has been cleared => don't start a new timeout
                                if (chart_activeTimeouts[container] == null) {
                                    return;
                                }

                                chart_activeTimeouts[container] = setTimeout(
                                    thisChart.options.realtime.timeoutCallBack,
                                    thisChart.options.realtime.refreshRate
                                );
                        });
                    }

                    chart_activeTimeouts[container] = setTimeout(thisChart.options.realtime.timeoutCallBack, 5);
                }
            }
        },
        plotOptions: {
            series: {
                marker: {
                    radius: 3
                }
            }
        },
        credits: {
            enabled:false
        },
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            min: 0,
            title: {
                text: PMA_messages['strTotalCount']
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            formatter: function() {
                    return '<b>' + this.series.name +'</b><br/>' +
                    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                    Highcharts.numberFormat(this.y, 2);
            }
        },
        exporting: {
            enabled: true
        },
        series: []
    }

    /* Set/Get realtime chart default values */
    if(passedSettings.realtime) {
        if(!passedSettings.realtime.refreshRate) {
            passedSettings.realtime.refreshRate = 5000;
        }

        if(!passedSettings.realtime.numMaxPoints) {
            passedSettings.realtime.numMaxPoints = 30;
        }

        // Allow custom POST vars to be added
        passedSettings.realtime.postData = $.extend(false,{ ajax_request: true, chart_data: 1, type: passedSettings.realtime.type },passedSettings.realtime.postData);

        if(server_time_diff) {
            settings.xAxis.min = new Date().getTime() - server_time_diff - passedSettings.realtime.numMaxPoints * passedSettings.realtime.refreshRate;
            settings.xAxis.max = new Date().getTime() - server_time_diff + passedSettings.realtime.refreshRate;
        }
    }

    // Overwrite/Merge default settings with passedsettings
    $.extend(true,settings,passedSettings);

    return new Highcharts.Chart(settings);
}


/*
 * Creates a Profiling Chart. Used in sql.php and server_status.js
 */
function PMA_createProfilingChart(data, options)
{
    return PMA_createChart($.extend(true, {
        chart: {
            renderTo: 'profilingchart',
            type: 'pie'
        },
        title: { text:'', margin:0 },
        series: [{
            type: 'pie',
            name: PMA_messages['strQueryExecutionTime'],
            data: data
        }],
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    distance: 35,
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b><br/>'+ Highcharts.numberFormat(this.percentage, 2) +' %';
                   }
                }
            }
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.point.name +'</b><br/>'+PMA_prettyProfilingNum(this.y)+'<br/>('+Highcharts.numberFormat(this.percentage, 2) +' %)';
            }
        }
    },options));
}

// Formats a profiling duration nicely. Used in PMA_createProfilingChart() and server_status.js
function PMA_prettyProfilingNum(num, acc)
{
    if (!acc) {
        acc = 2;
    }
    acc = Math.pow(10,acc);
    if (num * 1000 < 0.1) {
        num = Math.round(acc * (num * 1000 * 1000)) / acc + 'µ';
    } else if (num < 0.1) {
        num = Math.round(acc * (num * 1000)) / acc + 'm';
    } else {
        num = Math.round(acc * num) / acc;
    }

    return num + 's';
}

/**
 * jQuery function that uses jQueryUI's dialogs to confirm with user. Does not
 *  return a jQuery object yet and hence cannot be chained
 *
 * @param   string      question
 * @param   string      url         URL to be passed to the callbackFn to make
 *                                  an Ajax call to
 * @param   function    callbackFn  callback to execute after user clicks on OK
 */

jQuery.fn.PMA_confirm = function(question, url, callbackFn) {
    if (PMA_messages['strDoYouReally'] == '') {
        return true;
    }

    /**
     *  @var    button_options  Object that stores the options passed to jQueryUI
     *                          dialog
     */
    var button_options = {};
    button_options[PMA_messages['strOK']] = function(){
                                                $(this).dialog("close").remove();

                                                if($.isFunction(callbackFn)) {
                                                    callbackFn.call(this, url);
                                                }
                                            };
    button_options[PMA_messages['strCancel']] = function() {$(this).dialog("close").remove();}

    $('<div id="confirm_dialog"></div>')
    .prepend(question)
    .dialog({buttons: button_options});
};

/**
 * jQuery function to sort a table's body after a new row has been appended to it.
 * Also fixes the even/odd classes of the table rows at the end.
 *
 * @param   string      text_selector   string to select the sortKey's text
 *
 * @return  jQuery Object for chaining purposes
 */
jQuery.fn.PMA_sort_table = function(text_selector) {
    return this.each(function() {

        /**
         * @var table_body  Object referring to the table's <tbody> element
         */
        var table_body = $(this);
        /**
         * @var rows    Object referring to the collection of rows in {@link table_body}
         */
        var rows = $(this).find('tr').get();

        //get the text of the field that we will sort by
        $.each(rows, function(index, row) {
            row.sortKey = $.trim($(row).find(text_selector).text().toLowerCase());
        })

        //get the sorted order
        rows.sort(function(a,b) {
            if(a.sortKey < b.sortKey) {
                return -1;
            }
            if(a.sortKey > b.sortKey) {
                return 1;
            }
            return 0;
        })

        //pull out each row from the table and then append it according to it's order
        $.each(rows, function(index, row) {
            $(table_body).append(row);
            row.sortKey = null;
        })

        //Re-check the classes of each row
        $(this).find('tr:odd')
        .removeClass('even').addClass('odd')
        .end()
        .find('tr:even')
        .removeClass('odd').addClass('even');
    })
}

/**
 * jQuery coding for 'Create Table'.  Used on db_operations.php,
 * db_structure.php and db_tracking.php (i.e., wherever
 * libraries/display_create_table.lib.php is used)
 *
 * Attach Ajax Event handlers for Create Table
 */
$(document).ready(function() {

     /**
     * Attach event handler to the submit action of the create table minimal form
     * and retrieve the full table form and display it in a dialog
     *
     * @uses    PMA_ajaxShowMessage()
     */
    $("#create_table_form_minimal.ajax").live('submit', function(event) {
        event.preventDefault();
        $form = $(this);
        PMA_prepareForAjaxRequest($form);

        /*variables which stores the common attributes*/
        var url = $form.serialize();
        var action = $form.attr('action');
        var div =  $('<div id="create_table_dialog"></div>');

        /*Calling to the createTableDialog function*/
        PMA_createTableDialog(div, url, action);

        // empty table name and number of columns from the minimal form
        $form.find('input[name=table],input[name=num_fields]').val('');
    });

    /**
     * Attach event handler for submission of create table form (save)
     *
     * @uses    PMA_ajaxShowMessage()
     * @uses    $.PMA_sort_table()
     *
     */
    // .live() must be called after a selector, see http://api.jquery.com/live
    $("#create_table_form input[name=do_save_data]").live('click', function(event) {
        event.preventDefault();

        /**
         *  @var    the_form    object referring to the create table form
         */
        var $form = $("#create_table_form");

        /*
         * First validate the form; if there is a problem, avoid submitting it
         *
         * checkTableEditForm() needs a pure element and not a jQuery object,
         * this is why we pass $form[0] as a parameter (the jQuery object
         * is actually an array of DOM elements)
         */

        if (checkTableEditForm($form[0], $form.find('input[name=orig_num_fields]').val())) {
            // OK, form passed validation step
            if ($form.hasClass('ajax')) {
                PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);
                PMA_prepareForAjaxRequest($form);
                //User wants to submit the form
                $.post($form.attr('action'), $form.serialize() + "&do_save_data=" + $(this).val(), function(data) {
                    if(data.success == true) {
                        $('#properties_message')
                         .removeClass('error')
                         .html('');
                        PMA_ajaxShowMessage(data.message);
                        // Only if the create table dialog (distinct panel) exists
                        if ($("#create_table_dialog").length > 0) {
                            $("#create_table_dialog").dialog("close").remove();
                        }

                        /**
                         * @var tables_table    Object referring to the <tbody> element that holds the list of tables
                         */
                        var tables_table = $("#tablesForm").find("tbody").not("#tbl_summary_row");
                        // this is the first table created in this db
                        if (tables_table.length == 0) {
                            if (window.parent && window.parent.frame_content) {
                                window.parent.frame_content.location.reload();
                            }
                        } else {
                            /**
                             * @var curr_last_row   Object referring to the last <tr> element in {@link tables_table}
                             */
                            var curr_last_row = $(tables_table).find('tr:last');
                            /**
                             * @var curr_last_row_index_string   String containing the index of {@link curr_last_row}
                             */
                            var curr_last_row_index_string = $(curr_last_row).find('input:checkbox').attr('id').match(/\d+/)[0];
                            /**
                             * @var curr_last_row_index Index of {@link curr_last_row}
                             */
                            var curr_last_row_index = parseFloat(curr_last_row_index_string);
                            /**
                             * @var new_last_row_index   Index of the new row to be appended to {@link tables_table}
                             */
                            var new_last_row_index = curr_last_row_index + 1;
                            /**
                             * @var new_last_row_id String containing the id of the row to be appended to {@link tables_table}
                             */
                            var new_last_row_id = 'checkbox_tbl_' + new_last_row_index;

                            data.new_table_string = data.new_table_string.replace(/checkbox_tbl_/, new_last_row_id);
                            //append to table
                            $(data.new_table_string)
                             .appendTo(tables_table);

                            //Sort the table
                            $(tables_table).PMA_sort_table('th');
                        }

                        //Refresh navigation frame as a new table has been added
                        if (window.parent && window.parent.frame_navigation) {
                            window.parent.frame_navigation.location.reload();
                        }
                    } else {
                        $('#properties_message')
                         .addClass('error')
                         .html(data.error);
                        // scroll to the div containing the error message
                        $('#properties_message')[0].scrollIntoView();
                    }
                }) // end $.post()
            } // end if ($form.hasClass('ajax')
            else {
                // non-Ajax submit
                $form.append('<input type="hidden" name="do_save_data" value="save" />');
                $form.submit();
            }
        } // end if (checkTableEditForm() )
    }) // end create table form (save)

    /**
     * Attach event handler for create table form (add fields)
     *
     * @uses    PMA_ajaxShowMessage()
     * @uses    $.PMA_sort_table()
     * @uses    window.parent.refreshNavigation()
     *
     */
    // .live() must be called after a selector, see http://api.jquery.com/live
    $("#create_table_form.ajax input[name=submit_num_fields]").live('click', function(event) {
        event.preventDefault();

        /**
         *  @var    the_form    object referring to the create table form
         */
        var $form = $("#create_table_form");

        var $msgbox = PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);
        PMA_prepareForAjaxRequest($form);

        //User wants to add more fields to the table
        $.post($form.attr('action'), $form.serialize() + "&submit_num_fields=" + $(this).val(), function(data) {
            // if 'create_table_dialog' exists
            if ($("#create_table_dialog").length > 0) {
                $("#create_table_dialog").html(data);
            }
            // if 'create_table_div' exists
            if ($("#create_table_div").length > 0) {
                $("#create_table_div").html(data);
            }
            PMA_verifyTypeOfAllColumns();
            PMA_ajaxRemoveMessage($msgbox);
        }) //end $.post()

    }) // end create table form (add fields)

}, 'top.frame_content'); //end $(document).ready for 'Create Table'

/**
 * jQuery coding for 'Change Table' and 'Add Column'.  Used on tbl_structure.php *
 * Attach Ajax Event handlers for Change Table
 */
$(document).ready(function() {
    /**
     *Ajax action for submitting the "Column Change" and "Add Column" form
    **/
    $("#append_fields_form input[name=do_save_data]").live('click', function(event) {
        event.preventDefault();
        /**
         *  @var    the_form    object referring to the export form
         */
        var $form = $("#append_fields_form");

        /*
         * First validate the form; if there is a problem, avoid submitting it
         *
         * checkTableEditForm() needs a pure element and not a jQuery object,
         * this is why we pass $form[0] as a parameter (the jQuery object
         * is actually an array of DOM elements)
         */
        if (checkTableEditForm($form[0], $form.find('input[name=orig_num_fields]').val())) {
            // OK, form passed validation step
            if ($form.hasClass('ajax')) {
                PMA_prepareForAjaxRequest($form);
                //User wants to submit the form
                $.post($form.attr('action'), $form.serialize()+"&do_save_data=Save", function(data) {
                    if ($("#sqlqueryresults").length != 0) {
                        $("#sqlqueryresults").remove();
                    } else if ($(".error").length != 0) {
                        $(".error").remove();
                    }
                    if (data.success == true) {
                        PMA_ajaxShowMessage(data.message);
                        $("<div id='sqlqueryresults'></div>").insertAfter("#topmenucontainer");
                        $("#sqlqueryresults").html(data.sql_query);
                        $("#result_query .notice").remove();
                        $("#result_query").prepend((data.message));
                        if ($("#change_column_dialog").length > 0) {
                            $("#change_column_dialog").dialog("close").remove();
                        } else if ($("#add_columns").length > 0) {
                            $("#add_columns").dialog("close").remove();
                        }
                        /*Reload the field form*/
                        $.post($("#fieldsForm").attr('action'), $("#fieldsForm").serialize()+"&ajax_request=true", function(form_data) {
                            $("#fieldsForm").remove();
                            $("#addColumns").remove();
                            var $temp_div = $("<div id='temp_div'><div>").append(form_data);
                            if ($("#sqlqueryresults").length != 0) {
                                $temp_div.find("#fieldsForm").insertAfter("#sqlqueryresults");
                            } else {
                                $temp_div.find("#fieldsForm").insertAfter(".error");
                            }
                            $temp_div.find("#addColumns").insertBefore("iframe.IE_hack");
                            /*Call the function to display the more options in table*/
                            displayMoreTableOpts();
                        });
                    } else {
                        var $temp_div = $("<div id='temp_div'><div>").append(data);
                        var $error = $temp_div.find(".error code").addClass("error");
                        PMA_ajaxShowMessage($error);
                    }
                }) // end $.post()
            } else {
                // non-Ajax submit
                $form.append('<input type="hidden" name="do_save_data" value="Save" />');
                $form.submit();
            }
        }
    }) // end change table button "do_save_data"

}, 'top.frame_content'); //end $(document).ready for 'Change Table'

/**
 * jQuery coding for 'Table operations'.  Used on tbl_operations.php
 * Attach Ajax Event handlers for Table operations
 */
$(document).ready(function() {
    /**
     *Ajax action for submitting the "Alter table order by"
    **/
    $("#alterTableOrderby.ajax").live('submit', function(event) {
        event.preventDefault();
        $form = $(this);

        PMA_prepareForAjaxRequest($form);
        /*variables which stores the common attributes*/
        $.post($form.attr('action'), $form.serialize()+"&submitorderby=Go", function(data) {
            if ($("#sqlqueryresults").length != 0) {
                $("#sqlqueryresults").remove();
            }
            if ($("#result_query").length != 0) {
                $("#result_query").remove();
            }
            if (data.success == true) {
                PMA_ajaxShowMessage(data.message);
                $("<div id='sqlqueryresults'></div>").insertAfter("#topmenucontainer");
                $("#sqlqueryresults").html(data.sql_query);
                $("#result_query .notice").remove();
                $("#result_query").prepend((data.message));
            } else {
                $temp_div = $("<div id='temp_div'></div>")
                $temp_div.html(data.error);
                $error = $temp_div.find("code").addClass("error");
                PMA_ajaxShowMessage($error);
            }
        }) // end $.post()
    });//end of alterTableOrderby ajax submit

    /**
     *Ajax action for submitting the "Copy table"
    **/
    $("#copyTable.ajax input[name='submit_copy']").live('click', function(event) {
        event.preventDefault();
        $form = $("#copyTable");
        if($form.find("input[name='switch_to_new']").attr('checked')) {
            $form.append('<input type="hidden" name="submit_copy" value="Go" />');
            $form.removeClass('ajax');
            $form.find("#ajax_request_hidden").remove();
            $form.submit();
        } else {
            PMA_prepareForAjaxRequest($form);
            /*variables which stores the common attributes*/
            $.post($form.attr('action'), $form.serialize()+"&submit_copy=Go", function(data) {
                if ($("#sqlqueryresults").length != 0) {
                    $("#sqlqueryresults").remove();
                }
                if ($("#result_query").length != 0) {
                    $("#result_query").remove();
                }
                if (data.success == true) {
                    PMA_ajaxShowMessage(data.message);
                    $("<div id='sqlqueryresults'></div>").insertAfter("#topmenucontainer");
                    $("#sqlqueryresults").html(data.sql_query);
                    $("#result_query .notice").remove();
                    $("#result_query").prepend((data.message));
                    $("#copyTable").find("select[name='target_db'] option[value="+data.db+"]").attr('selected', 'selected');

                    //Refresh navigation frame when the table is coppied
                    if (window.parent && window.parent.frame_navigation) {
                        window.parent.frame_navigation.location.reload();
                    }
                } else {
                    $temp_div = $("<div id='temp_div'></div>")
                    $temp_div.html(data.error);
                    $error = $temp_div.find("code").addClass("error");
                    PMA_ajaxShowMessage($error);
                }
            }) // end $.post()
        }
    });//end of copyTable ajax submit

}, 'top.frame_content'); //end $(document).ready for 'Table operations'


/**
 * Attach Ajax event handlers for Drop Database. Moved here from db_structure.js
 * as it was also required on db_create.php
 *
 * @uses    $.PMA_confirm()
 * @uses    PMA_ajaxShowMessage()
 * @uses    window.parent.refreshNavigation()
 * @uses    window.parent.refreshMain()
 * @see $cfg['AjaxEnable']
 */
$(document).ready(function() {
    $("#drop_db_anchor").live('click', function(event) {
        event.preventDefault();

        //context is top.frame_content, so we need to use window.parent.db to access the db var
        /**
         * @var question    String containing the question to be asked for confirmation
         */
        var question = PMA_messages['strDropDatabaseStrongWarning'] + '\n' + PMA_messages['strDoYouReally'] + ' :\n' + 'DROP DATABASE ' + window.parent.db;

        $(this).PMA_confirm(question, $(this).attr('href') ,function(url) {

            PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);
            $.get(url, {'is_js_confirmed': '1', 'ajax_request': true}, function(data) {
                //Database deleted successfully, refresh both the frames
                window.parent.refreshNavigation();
                window.parent.refreshMain();
            }) // end $.get()
        }); // end $.PMA_confirm()
    }); //end of Drop Database Ajax action
}) // end of $(document).ready() for Drop Database

/**
 * Attach Ajax event handlers for 'Create Database'.  Used wherever libraries/
 * display_create_database.lib.php is used, ie main.php and server_databases.php
 *
 * @uses    PMA_ajaxShowMessage()
 * @see $cfg['AjaxEnable']
 */
$(document).ready(function() {

    $('#create_database_form.ajax').live('submit', function(event) {
        event.preventDefault();

        $form = $(this);

        PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);
        PMA_prepareForAjaxRequest($form);

        $.post($form.attr('action'), $form.serialize(), function(data) {
            if(data.success == true) {
                PMA_ajaxShowMessage(data.message);

                //Append database's row to table
                $("#tabledatabases")
                .find('tbody')
                .append(data.new_db_string)
                .PMA_sort_table('.name')
                .find('#db_summary_row')
                .appendTo('#tabledatabases tbody')
                .removeClass('odd even');

                var $databases_count_object = $('#databases_count');
                var databases_count = parseInt($databases_count_object.text());
                $databases_count_object.text(++databases_count);
                //Refresh navigation frame as a new database has been added
                if (window.parent && window.parent.frame_navigation) {
                    window.parent.frame_navigation.location.reload();
                }
            }
            else {
                PMA_ajaxShowMessage(data.error);
            }
        }) // end $.post()
    }) // end $().live()
})  // end $(document).ready() for Create Database

/**
 * Attach Ajax event handlers for 'Change Password' on main.php
 */
$(document).ready(function() {

    /**
     * Attach Ajax event handler on the change password anchor
     * @see $cfg['AjaxEnable']
     */
    $('#change_password_anchor.dialog_active').live('click',function(event) {
        event.preventDefault();
        return false;
        });
    $('#change_password_anchor.ajax').live('click', function(event) {
        event.preventDefault();
        $(this).removeClass('ajax').addClass('dialog_active');
        /**
         * @var button_options  Object containing options to be passed to jQueryUI's dialog
         */
        var button_options = {};
        button_options[PMA_messages['strCancel']] = function() {$(this).dialog('close').remove();}
        $.get($(this).attr('href'), {'ajax_request': true}, function(data) {
            $('<div id="change_password_dialog"></div>')
            .dialog({
                title: PMA_messages['strChangePassword'],
                width: 600,
                close: function(ev,ui) {$(this).remove();},
                buttons : button_options,
                beforeClose: function(ev,ui){ $('#change_password_anchor.dialog_active').removeClass('dialog_active').addClass('ajax')}
            })
            .append(data);
            displayPasswordGenerateButton();
        }) // end $.get()
    }) // end handler for change password anchor

    /**
     * Attach Ajax event handler for Change Password form submission
     *
     * @uses    PMA_ajaxShowMessage()
     * @see $cfg['AjaxEnable']
     */
    $("#change_password_form.ajax").find('input[name=change_pw]').live('click', function(event) {
        event.preventDefault();

        /**
         * @var the_form    Object referring to the change password form
         */
        var the_form = $("#change_password_form");

        /**
         * @var this_value  String containing the value of the submit button.
         * Need to append this for the change password form on Server Privileges
         * page to work
         */
        var this_value = $(this).val();

        var $msgbox = PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);
        $(the_form).append('<input type="hidden" name="ajax_request" value="true" />');

        $.post($(the_form).attr('action'), $(the_form).serialize() + '&change_pw='+ this_value, function(data) {
            if(data.success == true) {
                $("#topmenucontainer").after(data.sql_query);
                $("#change_password_dialog").hide().remove();
                $("#edit_user_dialog").dialog("close").remove();
                $('#change_password_anchor.dialog_active').removeClass('dialog_active').addClass('ajax');
                PMA_ajaxRemoveMessage($msgbox);
            }
            else {
                PMA_ajaxShowMessage(data.error);
            }
        }) // end $.post()
    }) // end handler for Change Password form submission
}) // end $(document).ready() for Change Password

/**
 * Toggle the hiding/showing of the "Open in ENUM/SET editor" message when
 * the page loads and when the selected data type changes
 */
$(document).ready(function() {
    // is called here for normal page loads and also when opening
    // the Create table dialog
    PMA_verifyTypeOfAllColumns();
    //
    // needs live() to work also in the Create Table dialog
    $("select[class='column_type']").live('change', function() {
        PMA_showNoticeForEnum($(this));
    });
});

function PMA_verifyTypeOfAllColumns()
{
    $("select[class='column_type']").each(function() {
        PMA_showNoticeForEnum($(this));
    });
}

/**
 * Closes the ENUM/SET editor and removes the data in it
 */
function disable_popup()
{
    $("#popup_background").fadeOut("fast");
    $("#enum_editor").fadeOut("fast");
    // clear the data from the text boxes
    $("#enum_editor #values input").remove();
    $("#enum_editor input[type='hidden']").remove();
}

/**
 * Opens the ENUM/SET editor and controls its functions
 */
$(document).ready(function() {
    // Needs live() to work also in the Create table dialog
    $("a[class='open_enum_editor']").live('click', function() {
        // Center the popup
        var windowWidth = document.documentElement.clientWidth;
        var windowHeight = document.documentElement.clientHeight;
        var popupWidth = windowWidth/2;
        var popupHeight = windowHeight*0.8;
        var popupOffsetTop = windowHeight/2 - popupHeight/2;
        var popupOffsetLeft = windowWidth/2 - popupWidth/2;
        $("#enum_editor").css({"position":"absolute", "top": popupOffsetTop, "left": popupOffsetLeft, "width": popupWidth, "height": popupHeight});

        // Make it appear
        $("#popup_background").css({"opacity":"0.7"});
        $("#popup_background").fadeIn("fast");
        $("#enum_editor").fadeIn("fast");
        /**Replacing the column name in the enum editor header*/
        var column_name = $("#append_fields_form").find("input[id=field_0_1]").attr("value");
        var h3_text = $("#enum_editor h3").html();
        $("#enum_editor h3").html(h3_text.split('"')[0]+'"'+column_name+'"');

        // Get the values
        var values = $(this).parent().prev("input").attr("value").split(",");
        $.each(values, function(index, val) {
            if(jQuery.trim(val) != "") {
                 // enclose the string in single quotes if it's not already
                 if(val.substr(0, 1) != "'") {
                      val = "'" + val;
                 }
                 if(val.substr(val.length-1, val.length) != "'") {
                      val = val + "'";
                 }
                // escape the single quotes, except the mandatory ones enclosing the entire string
                val = val.substr(1, val.length-2).replace(/''/g, "'").replace(/\\\\/g, '\\').replace(/\\'/g, "'").replace(/'/g, "&#039;");
                // escape the greater-than symbol
                val = val.replace(/>/g, "&gt;");
                $("#enum_editor #values").append("<input type='text' value=" + val + " />");
            }
        });
        // So we know which column's data is being edited
        $("#enum_editor").append("<input type='hidden' value='" + $(this).parent().prev("input").attr("id") + "' />");
        return false;
    });

    // If the "close" link is clicked, close the enum editor
    // Needs live() to work also in the Create table dialog
    $("a[class='close_enum_editor']").live('click', function() {
        disable_popup();
    });

    // If the "cancel" link is clicked, close the enum editor
    // Needs live() to work also in the Create table dialog
    $("a[class='cancel_enum_editor']").live('click', function() {
        disable_popup();
    });

    // When "add a new value" is clicked, append an empty text field
    // Needs live() to work also in the Create table dialog
    $("a[class='add_value']").live('click', function() {
        $("#enum_editor #values").append("<input type='text' />");
    });

    // When the submit button is clicked, put the data back into the original form
    // Needs live() to work also in the Create table dialog
    $("#enum_editor input[type='submit']").live('click', function() {
        var value_array = new Array();
        $.each($("#enum_editor #values input"), function(index, input_element) {
            val = jQuery.trim(input_element.value);
            if(val != "") {
                value_array.push("'" + val.replace(/\\/g, '\\\\').replace(/'/g, "''") + "'");
            }
        });
        // get the Length/Values text field where this value belongs
        var values_id = $("#enum_editor input[type='hidden']").attr("value");
        $("input[id='" + values_id + "']").attr("value", value_array.join(","));
        disable_popup();
     });

    /**
     * Hides certain table structure actions, replacing them with the word "More". They are displayed
     * in a dropdown menu when the user hovers over the word "More."
     */
    displayMoreTableOpts();
});

function displayMoreTableOpts()
{
    // Remove the actions from the table cells (they are available by default for JavaScript-disabled browsers)
    // if the table is not a view or information_schema (otherwise there is only one action to hide and there's no point)
    if($("input[type='hidden'][name='table_type']").val() == "table") {
        var $table = $("table[id='tablestructure']");
        $table.find("td[class='browse']").remove();
        $table.find("td[class='primary']").remove();
        $table.find("td[class='unique']").remove();
        $table.find("td[class='index']").remove();
        $table.find("td[class='fulltext']").remove();
        $table.find("td[class='spatial']").remove();
        $table.find("th[class='action']").attr("colspan", 3);

        // Display the "more" text
        $table.find("td[class='more_opts']").show();

        // Position the dropdown
        $(".structure_actions_dropdown").each(function() {
            // Optimize DOM querying
            var $this_dropdown = $(this);
             // The top offset must be set for IE even if it didn't change
            var cell_right_edge_offset = $this_dropdown.parent().position().left + $this_dropdown.parent().innerWidth();
            var left_offset = cell_right_edge_offset - $this_dropdown.innerWidth();
            var top_offset = $this_dropdown.parent().position().top + $this_dropdown.parent().innerHeight();
            $this_dropdown.offset({ top: top_offset, left: left_offset });
        });

        // A hack for IE6 to prevent the after_field select element from being displayed on top of the dropdown by
        // positioning an iframe directly on top of it
        var $after_field = $("select[name='after_field']");
        $("iframe[class='IE_hack']")
            .width($after_field.width())
            .height($after_field.height())
            .offset({
                top: $after_field.offset().top,
                left: $after_field.offset().left
            });

        // When "more" is hovered over, show the hidden actions
        $table.find("td[class='more_opts']")
            .mouseenter(function() {
                if($.browser.msie && $.browser.version == "6.0") {
                    $("iframe[class='IE_hack']")
                        .show()
                        .width($after_field.width()+4)
                        .height($after_field.height()+4)
                        .offset({
                            top: $after_field.offset().top,
                            left: $after_field.offset().left
                        });
                }
                $(".structure_actions_dropdown").hide(); // Hide all the other ones that may be open
                $(this).children(".structure_actions_dropdown").show();
                // Need to do this again for IE otherwise the offset is wrong
                if($.browser.msie) {
                    var left_offset_IE = $(this).offset().left + $(this).innerWidth() - $(this).children(".structure_actions_dropdown").innerWidth();
                    var top_offset_IE = $(this).offset().top + $(this).innerHeight();
                    $(this).children(".structure_actions_dropdown").offset({
                        top: top_offset_IE,
                        left: left_offset_IE });
                }
            })
            .mouseleave(function() {
                $(this).children(".structure_actions_dropdown").hide();
                if($.browser.msie && $.browser.version == "6.0") {
                    $("iframe[class='IE_hack']").hide();
                }
            });
    }

}
$(document).ready(function(){
    PMA_convertFootnotesToTooltips();
});

/**
 * Ensures indexes names are valid according to their type and, for a primary
 * key, lock index name to 'PRIMARY'
 * @param   string   form_id  Variable which parses the form name as
 *                            the input
 * @return  boolean  false    if there is no index form, true else
 */
function checkIndexName(form_id)
{
    if ($("#"+form_id).length == 0) {
        return false;
    }

    // Gets the elements pointers
    var $the_idx_name = $("#input_index_name");
    var $the_idx_type = $("#select_index_type");

    // Index is a primary key
    if ($the_idx_type.find("option:selected").attr("value") == 'PRIMARY') {
        $the_idx_name.attr("value", 'PRIMARY');
        $the_idx_name.attr("disabled", true);
    }

    // Other cases
    else {
        if ($the_idx_name.attr("value") == 'PRIMARY') {
            $the_idx_name.attr("value",  '');
        }
        $the_idx_name.attr("disabled", false);
    }

    return true;
} // end of the 'checkIndexName()' function

/**
 * function to convert the footnotes to tooltips
 *
 * @param   jquery-Object   $div    a div jquery object which specifies the
 *                                  domain for searching footnootes. If we
 *                                  ommit this parameter the function searches
 *                                  the footnotes in the whole body
 **/
function PMA_convertFootnotesToTooltips($div)
{
    // Hide the footnotes from the footer (which are displayed for
    // JavaScript-disabled browsers) since the tooltip is sufficient

    if ($div == undefined || ! $div instanceof jQuery || $div.length == 0) {
        $div = $("#serverinfo").parent();
    }

    $footnotes = $div.find(".footnotes");

    $footnotes.hide();
    $footnotes.find('span').each(function() {
        $(this).children("sup").remove();
    });
    // The border and padding must be removed otherwise a thin yellow box remains visible
    $footnotes.css("border", "none");
    $footnotes.css("padding", "0px");

    // Replace the superscripts with the help icon
    $div.find("sup.footnotemarker").hide();
    $div.find("img.footnotemarker").show();

    $div.find("img.footnotemarker").each(function() {
        var img_class = $(this).attr("class");
        /** img contains two classes, as example "footnotemarker footnote_1".
         *  We split it by second class and take it for the id of span
        */
        img_class = img_class.split(" ");
        for (i = 0; i < img_class.length; i++) {
            if (img_class[i].split("_")[0] == "footnote") {
                var span_id = img_class[i].split("_")[1];
            }
        }
        /**
         * Now we get the #id of the span with span_id variable. As an example if we
         * initially get the img class as "footnotemarker footnote_2", now we get
         * #2 as the span_id. Using that we can find footnote_2 in footnotes.
         * */
        var tooltip_text = $footnotes.find("span[id='footnote_" + span_id + "']").html();
        $(this).qtip({
            content: tooltip_text,
            show: { delay: 0 },
            hide: { delay: 1000 },
            style: { background: '#ffffcc' }
        });
    });
}

function menuResize()
{
    var cnt = $('#topmenu');
    var wmax = cnt.innerWidth() - 5; // 5 px margin for jumping menu in Chrome
    var submenu = cnt.find('.submenu');
    var submenu_w = submenu.outerWidth(true);
    var submenu_ul = submenu.find('ul');
    var li = cnt.find('> li');
    var li2 = submenu_ul.find('li');
    var more_shown = li2.length > 0;
    var w = more_shown ? submenu_w : 0;

    // hide menu items
    var hide_start = 0;
    for (var i = 0; i < li.length-1; i++) { // li.length-1: skip .submenu element
        var el = $(li[i]);
        var el_width = el.outerWidth(true);
        el.data('width', el_width);
        w += el_width;
        if (w > wmax) {
            w -= el_width;
            if (w + submenu_w < wmax) {
                hide_start = i;
            } else {
                hide_start = i-1;
                w -= $(li[i-1]).data('width');
            }
            break;
        }
    }

    if (hide_start > 0) {
        for (var i = hide_start; i < li.length-1; i++) {
            $(li[i])[more_shown ? 'prependTo' : 'appendTo'](submenu_ul);
        }
        submenu.addClass('shown');
    } else if (more_shown) {
        w -= submenu_w;
        // nothing hidden, maybe something can be restored
        for (var i = 0; i < li2.length; i++) {
            //console.log(li2[i], submenu_w);
            w += $(li2[i]).data('width');
            // item fits or (it is the last item and it would fit if More got removed)
            if (w+submenu_w < wmax || (i == li2.length-1 && w < wmax)) {
                $(li2[i]).insertBefore(submenu);
                if (i == li2.length-1) {
                    submenu.removeClass('shown');
                }
                continue;
            }
            break;
        }
    }
    if (submenu.find('.tabactive').length) {
        submenu.addClass('active').find('> a').removeClass('tab').addClass('tabactive');
    } else {
        submenu.removeClass('active').find('> a').addClass('tab').removeClass('tabactive');
    }
}

$(function() {
    var topmenu = $('#topmenu');
    if (topmenu.length == 0) {
        return;
    }
    // create submenu container
    var link = $('<a />', {href: '#', 'class': 'tab'})
        .text(PMA_messages['strMore'])
        .click(function(e) {
            e.preventDefault();
        });
    var img = topmenu.find('li:first-child img');
    if (img.length) {
        img.clone().attr('class', 'icon ic_b_more').prependTo(link);
    }
    var submenu = $('<li />', {'class': 'submenu'})
        .append(link)
        .append($('<ul />'))
        .mouseenter(function() {
            if ($(this).find('ul .tabactive').length == 0) {
                $(this).addClass('submenuhover').find('> a').addClass('tabactive');
            }
        })
        .mouseleave(function() {
            if ($(this).find('ul .tabactive').length == 0) {
                $(this).removeClass('submenuhover').find('> a').removeClass('tabactive');
            }
        });
    topmenu.append(submenu);

    // populate submenu and register resize event
    $(window).resize(menuResize);
    menuResize();
});

/**
 * Get the row number from the classlist (for example, row_1)
 */
function PMA_getRowNumber(classlist)
{
    return parseInt(classlist.split(/\s+row_/)[1]);
}

/**
 * Changes status of slider
 */
function PMA_set_status_label(id)
{
    if ($('#' + id).css('display') == 'none') {
        $('#anchor_status_' + id).text('+ ');
    } else {
        $('#anchor_status_' + id).text('- ');
    }
}

/**
 * Initializes slider effect.
 */
function PMA_init_slider()
{
    $('.pma_auto_slider').each(function(idx, e) {
        if ($(e).hasClass('slider_init_done')) return;
        $(e).addClass('slider_init_done');
        $('<span id="anchor_status_' + e.id + '"></span>')
            .insertBefore(e);
        PMA_set_status_label(e.id);

        $('<a href="#' + e.id + '" id="anchor_' + e.id + '">' + e.title + '</a>')
            .insertBefore(e)
            .click(function() {
                $('#' + e.id).toggle('clip', function() {
                    PMA_set_status_label(e.id);
                });
                return false;
            });
    });
}

/**
 * var  toggleButton  This is a function that creates a toggle
 *                    sliding button given a jQuery reference
 *                    to the correct DOM element
 */
var toggleButton = function ($obj) {
    // In rtl mode the toggle switch is flipped horizontally
    // so we need to take that into account
    if ($('.text_direction', $obj).text() == 'ltr') {
        var right = 'right';
    } else {
        var right = 'left';
    }
    /**
     *  var  h  Height of the button, used to scale the
     *          background image and position the layers
     */
    var h = $obj.height();
    $('img', $obj).height(h);
    $('table', $obj).css('bottom', h-1);
    /**
     *  var  on   Width of the "ON" part of the toggle switch
     *  var  off  Width of the "OFF" part of the toggle switch
     */
    var on  = $('.toggleOn', $obj).width();
    var off = $('.toggleOff', $obj).width();
    // Make the "ON" and "OFF" parts of the switch the same size
    $('.toggleOn > div', $obj).width(Math.max(on, off));
    $('.toggleOff > div', $obj).width(Math.max(on, off));
    /**
     *  var  w  Width of the central part of the switch
     */
    var w = parseInt(($('img', $obj).height() / 16) * 22, 10);
    // Resize the central part of the switch on the top
    // layer to match the background
    $('table td:nth-child(2) > div', $obj).width(w);
    /**
     *  var  imgw    Width of the background image
     *  var  tblw    Width of the foreground layer
     *  var  offset  By how many pixels to move the background
     *               image, so that it matches the top layer
     */
    var imgw = $('img', $obj).width();
    var tblw = $('table', $obj).width();
    var offset = parseInt(((imgw - tblw) / 2), 10);
    // Move the background to match the layout of the top layer
    $obj.find('img').css(right, offset);
    /**
     *  var  offw    Outer width of the "ON" part of the toggle switch
     *  var  btnw    Outer width of the central part of the switch
     */
    var offw = $('.toggleOff', $obj).outerWidth();
    var btnw = $('table td:nth-child(2)', $obj).outerWidth();
    // Resize the main div so that exactly one side of
    // the switch plus the central part fit into it.
    $obj.width(offw + btnw + 2);
    /**
     *  var  move  How many pixels to move the
     *             switch by when toggling
     */
    var move = $('.toggleOff', $obj).outerWidth();
    // If the switch is initialized to the
    // OFF state we need to move it now.
    if ($('.container', $obj).hasClass('off')) {
        if (right == 'right') {
            $('table, img', $obj).animate({'left': '-=' + move + 'px'}, 0);
        } else {
            $('table, img', $obj).animate({'left': '+=' + move + 'px'}, 0);
        }
    }
    // Attach an 'onclick' event to the switch
    $('.container', $obj).click(function () {
        if ($(this).hasClass('isActive')) {
            return false;
        } else {
            $(this).addClass('isActive');
        }
        var $msg = PMA_ajaxShowMessage(PMA_messages['strLoading']);
        var $container = $(this);
        var callback = $('.callback', this).text();
        // Perform the actual toggle
        if ($(this).hasClass('on')) {
            if (right == 'right') {
                var operator = '-=';
            } else {
                var operator = '+=';
            }
            var url = $(this).find('.toggleOff > span').text();
            var removeClass = 'on';
            var addClass = 'off';
        } else {
            if (right == 'right') {
                var operator = '+=';
            } else {
                var operator = '-=';
            }
            var url = $(this).find('.toggleOn > span').text();
            var removeClass = 'off';
            var addClass = 'on';
        }
        $.post(url, {'ajax_request': true}, function(data) {
            if(data.success == true) {
                PMA_ajaxRemoveMessage($msg);
                $container
                .removeClass(removeClass)
                .addClass(addClass)
                .animate({'left': operator + move + 'px'}, function () {
                    $container.removeClass('isActive');
                });
                eval(callback);
            } else {
                PMA_ajaxShowMessage(data.error);
                $container.removeClass('isActive');
            }
        });
    });
};

/**
 * Initialise all toggle buttons
 */
$(window).load(function () {
    $('.toggleAjax').each(function () {
        $(this)
        .show()
        .find('.toggleButton')
        toggleButton($(this));
    });
});

/**
 * Vertical pointer
 */
$(document).ready(function() {
    $('.vpointer').live('hover',
        //handlerInOut
        function(e) {
            var $this_td = $(this);
            var row_num = PMA_getRowNumber($this_td.attr('class'));
            // for all td of the same vertical row, toggle hover
            $('.vpointer').filter('.row_' + row_num).toggleClass('hover');
        }
        );
}) // end of $(document).ready() for vertical pointer

$(document).ready(function() {
    /**
     * Vertical marker
     */
    $('.vmarker').live('click', function(e) {
        // do not trigger when clicked on anchor
        if ($(e.target).is('a, img, a *')) {
            return;
        }

        var $this_td = $(this);
        var row_num = PMA_getRowNumber($this_td.attr('class'));

        // XXX: FF fires two click events for <label> (label and checkbox), so we need to handle this differently
        var $tr = $(this);
        var $checkbox = $('.vmarker').filter('.row_' + row_num + ':first').find(':checkbox');
        if ($checkbox.length) {
            // checkbox in a row, add or remove class depending on checkbox state
            var checked = $checkbox.attr('checked');
            if (!$(e.target).is(':checkbox, label')) {
                checked = !checked;
                $checkbox.attr('checked', checked);
            }
            // for all td of the same vertical row, toggle the marked class
            if (checked) {
                $('.vmarker').filter('.row_' + row_num).addClass('marked');
            } else {
                $('.vmarker').filter('.row_' + row_num).removeClass('marked');
            }
        } else {
            // normaln data table, just toggle class
            $('.vmarker').filter('.row_' + row_num).toggleClass('marked');
        }
    });

    /**
     * Reveal visual builder anchor
     */

    $('#visual_builder_anchor').show();

    /**
     * Page selector in db Structure (non-AJAX)
     */
    $('#tableslistcontainer').find('#pageselector').live('change', function() {
        $(this).parent("form").submit();
    });

    /**
     * Page selector in navi panel (non-AJAX)
     */
    $('#navidbpageselector').find('#pageselector').live('change', function() {
        $(this).parent("form").submit();
    });

    /**
     * Page selector in browse_foreigners windows (non-AJAX)
     */
    $('#body_browse_foreigners').find('#pageselector').live('change', function() {
        $(this).closest("form").submit();
    });

    /**
     * Load version information asynchronously.
     */
    if ($('.jsversioncheck').length > 0) {
        (function() {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = 'http://www.phpmyadmin.net/home_page/version.js';
            s.onload = PMA_current_version;
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    }

    /**
     * Slider effect.
     */
    PMA_init_slider();

    /**
     * Enables the text generated by PMA_linkOrButton() to be clickable
     */
    $('a[class~="formLinkSubmit"]').live('click',function(e) {

        if($(this).attr('href').indexOf('=') != -1) {
            var data = $(this).attr('href').substr($(this).attr('href').indexOf('#')+1).split('=',2);
            $(this).parents('form').append('<input type="hidden" name="' + data[0] + '" value="' + data[1] + '"/>');
        }
        $(this).parents('form').submit();
        return false;
    });

    $('#update_recent_tables').ready(function() {
        if (window.parent.frame_navigation != undefined
            && window.parent.frame_navigation.PMA_reloadRecentTable != undefined)
        {
            window.parent.frame_navigation.PMA_reloadRecentTable();
        }
    });

}) // end of $(document).ready()

/**
 * Creates a message inside an object with a sliding effect
 *
 * @param   msg    A string containing the text to display
 * @param   $obj   a jQuery object containing the reference
 *                 to the element where to put the message
 *                 This is optional, if no element is
 *                 provided, one will be created below the
 *                 navigation links at the top of the page
 *
 * @return  bool   True on success, false on failure
 */
function PMA_slidingMessage(msg, $obj)
{
    if (msg == undefined || msg.length == 0) {
        // Don't show an empty message
        return false;
    }
    if ($obj == undefined || ! $obj instanceof jQuery || $obj.length == 0) {
        // If the second argument was not supplied,
        // we might have to create a new DOM node.
        if ($('#PMA_slidingMessage').length == 0) {
            $('#topmenucontainer')
            .after('<span id="PMA_slidingMessage" '
                 + 'style="display: inline-block;"></span>');
        }
        $obj = $('#PMA_slidingMessage');
    }
    if ($obj.has('div').length > 0) {
        // If there already is a message inside the
        // target object, we must get rid of it
        $obj
        .find('div')
        .first()
        .fadeOut(function () {
            $obj
            .children()
            .remove();
            $obj
            .append('<div style="display: none;">' + msg + '</div>')
            .animate({
                height: $obj.find('div').first().height()
            })
            .find('div')
            .first()
            .fadeIn();
        });
    } else {
        // Object does not already have a message
        // inside it, so we simply slide it down
        var h = $obj
                .width('100%')
                .html('<div style="display: none;">' + msg + '</div>')
                .find('div')
                .first()
                .height();
        $obj
        .find('div')
        .first()
        .css('height', 0)
        .show()
        .animate({
                height: h
            }, function() {
            // Set the height of the parent
            // to the height of the child
            $obj
            .height(
                $obj
                .find('div')
                .first()
                .height()
            );
        });
    }
    return true;
} // end PMA_slidingMessage()

/**
 * Attach Ajax event handlers for Drop Table.
 *
 * @uses    $.PMA_confirm()
 * @uses    PMA_ajaxShowMessage()
 * @uses    window.parent.refreshNavigation()
 * @uses    window.parent.refreshMain()
 * @see $cfg['AjaxEnable']
 */
$(document).ready(function() {
    $("#drop_tbl_anchor").live('click', function(event) {
        event.preventDefault();

        //context is top.frame_content, so we need to use window.parent.db to access the db var
        /**
         * @var question    String containing the question to be asked for confirmation
         */
        var question = PMA_messages['strDropTableStrongWarning'] + '\n' + PMA_messages['strDoYouReally'] + ' :\n' + 'DROP TABLE ' + window.parent.table;

        $(this).PMA_confirm(question, $(this).attr('href') ,function(url) {

            PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);
            $.get(url, {'is_js_confirmed': '1', 'ajax_request': true}, function(data) {
                //Database deleted successfully, refresh both the frames
                window.parent.refreshNavigation();
                window.parent.refreshMain();
            }) // end $.get()
        }); // end $.PMA_confirm()
    }); //end of Drop Table Ajax action
}) // end of $(document).ready() for Drop Table

/**
 * Attach Ajax event handlers for Truncate Table.
 *
 * @uses    $.PMA_confirm()
 * @uses    PMA_ajaxShowMessage()
 * @uses    window.parent.refreshNavigation()
 * @uses    window.parent.refreshMain()
 * @see $cfg['AjaxEnable']
 */
$(document).ready(function() {
    $("#truncate_tbl_anchor").live('click', function(event) {
        event.preventDefault();

        //context is top.frame_content, so we need to use window.parent.db to access the db var
        /**
         * @var question    String containing the question to be asked for confirmation
         */
        var question = PMA_messages['strTruncateTableStrongWarning'] + '\n' + PMA_messages['strDoYouReally'] + ' :\n' + 'TRUNCATE TABLE ' + window.parent.table;

        $(this).PMA_confirm(question, $(this).attr('href') ,function(url) {

            PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);
            $.get(url, {'is_js_confirmed': '1', 'ajax_request': true}, function(data) {
                //Database deleted successfully, refresh both the frames
                window.parent.refreshNavigation();
                window.parent.refreshMain();
            }) // end $.get()
        }); // end $.PMA_confirm()
    }); //end of Drop Table Ajax action
}) // end of $(document).ready() for Drop Table

/**
 * Attach CodeMirror2 editor to SQL edit area.
 */
$(document).ready(function() {
    var elm = $('#sqlquery');
    if (elm.length > 0) {
        codemirror_editor = CodeMirror.fromTextArea(elm[0], {lineNumbers: true, matchBrackets: true, indentUnit: 4, mode: "text/x-mysql"});
    }
});

/**
 * jQuery plugin to cancel selection in HTML code.
 */
(function ($) {
    $.fn.noSelect = function (p) { //no select plugin by Paulo P.Marinas
        var prevent = (p == null) ? true : p;
        if (prevent) {
            return this.each(function () {
                if ($.browser.msie || $.browser.safari) $(this).bind('selectstart', function () {
                    return false;
                });
                else if ($.browser.mozilla) {
                    $(this).css('MozUserSelect', 'none');
                    $('body').trigger('focus');
                } else if ($.browser.opera) $(this).bind('mousedown', function () {
                    return false;
                });
                else $(this).attr('unselectable', 'on');
            });
        } else {
            return this.each(function () {
                if ($.browser.msie || $.browser.safari) $(this).unbind('selectstart');
                else if ($.browser.mozilla) $(this).css('MozUserSelect', 'inherit');
                else if ($.browser.opera) $(this).unbind('mousedown');
                else $(this).removeAttr('unselectable', 'on');
            });
        }
    }; //end noSelect
})(jQuery);

/**
 * Create default PMA tooltip for the element specified. The default appearance
 * can be overriden by specifying optional "options" parameter (see qTip options).
 */
function PMA_createqTip($elements, content, options)
{
    var o = {
        content: content,
        style: {
            background: '#333',
            border: {
                radius: 5
            },
            fontSize: '0.8em',
            padding: '0 0.5em',
            name: 'dark'
        },
        position: {
            target: 'mouse',
            corner: { target: 'rightMiddle', tooltip: 'leftMiddle' },
            adjust: { x: 20 }
        },
        show: {
            delay: 0,
            effect: {
                type: 'grow',
                length: 100
            }
        },
        hide: {
            effect: {
                type: 'grow',
                length: 150
            }
        }
    }

    $elements.qtip($.extend(true, o, options));
}

$(document).ready(function() {
    /**
     * Theme selector.
     */
    $('a.themeselect').live('click', function(e) {
        window.open(
            e.target,
            'themes',
            'left=10,top=20,width=510,height=350,scrollbars=yes,status=yes,resizable=yes'
            );
        return false;
    });

    /**
     * Automatic form submission on change.
     */
    $('.autosubmit').change(function(e) {
        e.target.form.submit();
    });

    /**
     * Theme changer.
     */
    $('.take_theme').live('click', function(e) {
        alert(e.target.nodeName);
        var evt = $(e);
        var what = evt.target.id;
        if (window.opener && window.opener.document.forms['setTheme'].elements['set_theme']) {
            window.opener.document.forms['setTheme'].elements['set_theme'].value = what;
            window.opener.document.forms['setTheme'].submit();
            window.close();
            return false;
        }
        return true;
    });
});
