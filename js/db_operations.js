/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * function used in server privilege pages
 *
 * @version $Id$
 */

/**
 * Add Ajax event handlers here for db_operations.php
 *
 * no id for any form, will need to add for all
 * Create table - make ajax call, open dialog, submit form, show success/error, ask and refreshMain()
 * Rename Database - make ajax call, show success/error, ask and refresh()
 * Copy Database - make ajax call, show success/error, ask and refreshMain()
 * Change charset - make ajax call, show success/error
 */

$(document).ready(function() {

    //Create Table
    $("#create_table_form_minimal").live('submit', function(event) {
        event.preventDefault();

        /* @todo Validate this form! */

        PMA_ajaxShowMessage();
        $(this).append('<input type="hidden" name="ajax_request" value="true" />');

        $.get($(this).attr('action'), $(this).serialize(), function(data) {
            $('<div id="create_table_dialog"></div>')
            .append(data)
            .dialog({
                title: PMA_messages['strCreateTable'],
                width: 900,
                buttons : {
                            "Create Table" : function() {
                                $('#create_table_form').trigger("submit");
                            },
                            "Cancel" : function() {$(this).dialog('close').remove() ;}
                }
            });
        })
    })

    //Rename Database
    $("#rename_db_form").live('submit', function(event) {
        event.preventDefault();

        var question = 'CREATE DATABASE ... and then DROP DATABASE ' + window.parent.db;
        $(this).append('<input type="hidden" name="ajax_request" value="true" />');

        $(this).PMA_confirm(question, $(this).attr('action'), function(url) {
            PMA_ajaxShowMessage(PMA_messages['strRenamingDatabases']);

            $.get(url, $("#rename_db_form").serialize() + '&is_js_confirmed=1', function(data) {
                if(data.success == true) {
                    
                    PMA_ajaxShowMessage(data.message);
                    window.parent.db = data.newname;

                    $("<span>" + PMA_messages['strReloadDatabase'] + "?</span>").dialog({
                        buttons: {"Yes": function() {
                                            window.parent.refreshMain();
                                           },
                                   "No" : function() {
                                            $(this).dialog("close").remove();
                                          }
                                 }
                    }) //end dialog options
                }
                else {
                    PMA_ajaxShowMessage(data.error);
                }
            }) // end $.get()
        })
    }); // end Rename Database

    //Copy Database
    $("#copy_db_form").live('submit', function(event) {
        event.preventDefault();

        PMA_ajaxShowMessage(PMA_messages['strCopyingDatabase']);
        $(this).append('<input type="hidden" name="ajax_request" value="true" />');

        $.get($(this).attr('action'), $(this).serialize(), function(data) {
            if(data.success == true) {
                PMA_ajaxShowMessage(data.message);
                if( $("#checkbox_switch").is(":checked")) {
                    window.parent.db = data.newname;
                    window.parent.refreshMain();
                }
            }
            else {
                PMA_ajaxShowMessage(data.error);
            }
        })
    }) // end copy database

    //Change charset
    $("#change_db_charset_form").live('submit', function(event) {
        event.preventDefault();

        $(this).append('<input type="hidden" name="ajax_request" value="true" />');

        PMA_ajaxShowMessage(PMA_messages['strChangingCharset']);
        $.get($(this).attr('action'), $(this).serialize() + "&submitcollation=" + $(this).find("input[name=submitcollation]").attr('value'), function(data) {
            if(data.success == true) {
                PMA_ajaxShowMessage(data.message);
            }
            else {
                PMA_ajaxShowMessage(data.error);
            }
        })
    }) // end change charset
    
}, 'top.frame_content');