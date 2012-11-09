/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Unbind all event handlers before tearing down a page
 */
AJAX.registerTeardown('server_variables.js', function() {
    $('table.data tbody tr td:nth-child(2).editable').unbind('hover');
    $('#filterText').unbind('keyup');
});

AJAX.registerOnload('server_variables.js', function() {
    var textFilter = null, odd_row = false;

    // Global vars
    $editLink = $('a.editLink');
    $saveLink = $('a.saveLink');
    $cancelLink = $('a.cancelLink');

    /* Variable editing */
    $('table.data tbody tr td:nth-child(2).editable').hover(
        function() {
            // Only add edit element if it is the global value, not session value and not when the element is being edited
            if ($(this).parent().children('th').length > 0 && ! $(this).hasClass('edit')) {
                $(this).prepend($editLink.clone().show());
            }
        },
        function() {
            $(this).find('a.editLink').remove();
        }
    );

    $('#filterText').keyup(function(e) {
        if ($(this).val().length == 0) {
            textFilter=null;
        } else {
            textFilter = new RegExp("(^| )"+$(this).val().replace(/_/g,' '),'i');
        }
        filterVariables();
    });

    /* FIXME: this seems broken as we now use the hash for the microhistory
    if (location.hash.substr(1).split('=')[0] == 'filter') {
        var name = location.hash.substr(1).split('=')[1];
        // Only allow variable names
        if (! name.match(/[^0-9a-zA-Z_]+/)) {
            $('#filterText').val(name).trigger('keyup');
        }
    }*/

    /* Filters the rows by the user given regexp */
    function filterVariables() {
        var mark_next = false, firstCell;
        odd_row = false;

        $('table.filteredData tbody tr').each(function() {
            firstCell = $(this).children(':first');

            if (mark_next || textFilter == null || textFilter.exec(firstCell.text())) {
                // If current global value is different from session value (=has class diffSession), then display that one too
                mark_next = $(this).hasClass('diffSession') && ! mark_next;

                odd_row = ! odd_row;
                $(this).css('display','');
                if (odd_row) {
                    $(this).addClass('odd');
                    $(this).removeClass('even');
                } else {
                    $(this).addClass('even');
                    $(this).removeClass('odd');
                }
            } else {
                $(this).css('display','none');
            }
        });
    }
});

/* Called by inline js. Allows the user to edit a server variable */
function editVariable(link)
{
    var varName = $(link).parent().parent().find('th:first').first().text().replace(/ /g,'_');
    var $mySaveLink = $saveLink.clone().show();
    var $myCancelLink = $cancelLink.clone().show();
    var $cell = $(link).parent();
    var $msgbox = PMA_ajaxShowMessage();

    $cell.addClass('edit');
    // remove edit link
    $cell.find('a.editLink').remove();

    $mySaveLink.click(function() {
        var $msgbox = PMA_ajaxShowMessage(PMA_messages.strProcessingRequest);
        $.get($(this).attr('href'), {
                ajax_request: true,
                type: 'setval',
                varName: varName,
                varValue: $cell.find('input').val()
            }, function(data) {
                if (data.success) {
                    $cell.html(data.variable);
                    PMA_ajaxRemoveMessage($msgbox);
                } else {
                    PMA_ajaxShowMessage(data.error, false);
                    $cell.html($cell.find('span.oldContent').html());
                }
                $cell.removeClass('edit');
            }, 'json');

        return false;
    });

    $myCancelLink.click(function() {
        $cell.html($cell.find('span.oldContent').html());
        $cell.removeClass('edit');
        return false;
    });

    $.get($mySaveLink.attr('href'), {
            ajax_request: true,
            type: 'getval',
            varName: varName
        }, function(data) {
            if (data.success == true) {
                // hide original content
                $cell.html('<span class="oldContent" style="display:none;">' + $cell.html() + '</span>');
                // put edit field and save/cancel link
                $cell.prepend('<table class="serverVariableEditTable" border="0"><tr><td></td><td style="width:100%;">' +
                              '<input type="text" id="variableEditArea" value="' + data.message + '" /></td></tr></table>');
                $cell.find('table td:first').append($mySaveLink);
                $cell.find('table td:first').append(' ');
                $cell.find('table td:first').append($myCancelLink);

                // Keyboard shortcuts to the rescue
                $('input#variableEditArea').focus();
                $('input#variableEditArea').keydown(function(event) {
                    // Enter key
                    if (event.keyCode == 13) {
                        $mySaveLink.trigger('click');
                    }
                    // Escape key
                    if (event.keyCode == 27) {
                        $myCancelLink.trigger('click');
                    }
                });
                PMA_ajaxRemoveMessage($msgbox);
            } else {
                $cell.removeClass('edit');
                PMA_ajaxShowMessage(data.error);
            }
        });

    return false;
}
