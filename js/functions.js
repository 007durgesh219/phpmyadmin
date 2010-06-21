/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * general function, usally for data manipulation pages
 *
 * @version $Id$
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
 * @var ajax_message_init   boolean boolean that stores status of
 *      notification for PMA_ajaxShowNotification
 */
var ajax_message_init = false;

/**
 * selects the content of a given object, f.e. a textarea
 *
 * @param   object  element     element of which the content will be selected
 * @param   var     lock        variable which holds the lock for this element
 *                              or true, if no lock exists
 * @param   boolean only_once   if true this is only done once
 *                              f.e. only on first focus
 */
function selectContent( element, lock, only_once ) {
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
 * Displays an confirmation box before to submit a "DROP DATABASE" query.
 * This function is called while clicking links
 *
 * @param   object   the link
 * @param   object   the sql query to submit
 *
 * @return  boolean  whether to run the query or not
 */
function confirmLinkDropDB(theLink, theSqlQuery)
{
    // Confirmation is not required in the configuration file
    // or browser is Opera (crappy js implementation)
    if (PMA_messages['strDoYouReally'] == '' || typeof(window.opera) != 'undefined') {
        return true;
    }

    var is_confirmed = confirm(PMA_messages['strDropDatabaseStrongWarning'] + '\n' + PMA_messages['strDoYouReally'] + ' :\n' + theSqlQuery);
    if (is_confirmed) {
        theLink.href += '&is_js_confirmed=1';
    }

    return is_confirmed;
} // end of the 'confirmLinkDropDB()' function

/**
 * Displays an confirmation box before to submit a "DROP/DELETE/ALTER" query.
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
        if ( typeof(theLink.href) != 'undefined' ) {
            theLink.href += '&is_js_confirmed=1';
        } else if ( typeof(theLink.form) != 'undefined' ) {
            theLink.form.action += '?is_js_confirmed=1';
        }
    }

    return is_confirmed;
} // end of the 'confirmLink()' function


/**
 * Displays an confirmation box before doing some action
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

    // The replace function (js1.2) isn't supported
    else if (typeof(sqlQuery1.value.replace) == 'undefined') {
        return true;
    }

    // js1.2+ -> validation with regular expressions
    else {
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

        // Confirms a "DROP/DELETE/ALTER" statement
        //
        // TODO: find a way (if possible) to use the parser-analyser
        // for this kind of verification
        // For now, I just added a ^ to check for the statement at
        // beginning of expression

        var do_confirm_re_0 = new RegExp('^\\s*DROP\\s+(IF EXISTS\\s+)?(TABLE|DATABASE|PROCEDURE)\\s', 'i');
        var do_confirm_re_1 = new RegExp('^\\s*ALTER\\s+TABLE\\s+((`[^`]+`)|([A-Za-z0-9_$]+))\\s+DROP\\s', 'i');
        var do_confirm_re_2 = new RegExp('^\\s*DELETE\\s+FROM\\s', 'i');
        if (do_confirm_re_0.test(sqlQuery1.value)
            || do_confirm_re_1.test(sqlQuery1.value)
            || do_confirm_re_2.test(sqlQuery1.value)) {
            var message      = (sqlQuery1.value.length > 100)
                             ? sqlQuery1.value.substr(0, 100) + '\n    ...'
                             : sqlQuery1.value;
            var is_confirmed = confirm(PMA_messages['strDoYouReally'] + ' :\n' + message);
            // drop/delete/alter statement is confirmed -> update the
            // "is_js_confirmed" form field so the confirm test won't be
            // run on the server side and allows to submit the form
            if (is_confirmed) {
                theForm1.elements['is_js_confirmed'].value = 1;
                return true;
            }
            // "DROP/DELETE/ALTER" statement is rejected -> do not submit
            // the form
            else {
                window.focus();
                sqlQuery1.focus();
                return false;
            } // end if (handle confirm box result)
        } // end if (display confirm box)
    } // end confirmation stuff

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

    // The replace function (js1.2) isn't supported -> basic tests
    if (typeof(sqlQuery.value.replace) == 'undefined') {
        isEmpty      = (sqlQuery.value == '') ? 1 : 0;
        if (isEmpty && typeof(theForm.elements['sql_file']) != 'undefined') {
            isEmpty  = (theForm.elements['sql_file'].value == '') ? 1 : 0;
        }
        if (isEmpty && typeof(theForm.elements['sql_localfile']) != 'undefined') {
            isEmpty  = (theForm.elements['sql_localfile'].value == '') ? 1 : 0;
        }
        if (isEmpty && typeof(theForm.elements['id_bookmark']) != 'undefined') {
            isEmpty  = (theForm.elements['id_bookmark'].value == null || theForm.elements['id_bookmark'].value == '');
        }
    }
    // js1.2+ -> validation with regular expressions
    else {
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
    }

    if (isEmpty) {
        sqlQuery.select();
        alert(PMA_messages['strFormEmpty']);
        sqlQuery.focus();
        return false;
    }

    return true;
} // end of the 'checkSqlQuery()' function

// Global variable row_class is set to even
var row_class = 'even';

/** 
* Generates a row dynamically in the differences table displaying
* the complete statistics of difference in  table like number of 
* rows to be updated, number of rows to be inserted, number of 
* columns to be added, number of columns to be removed, etc.
*
* @param  index         index of matching table
* @param  update_size   number of rows/column to be updated
* @param  insert_size   number of rows/coulmns to be inserted
* @param  remove_size   number of columns to be removed
* @param  insert_index  number of indexes to be inserted
* @param  remove_index  number of indexes to be removed
* @param  img_obj       image object 
* @param  table_name    name of the table
*/

function showDetails(i, update_size, insert_size, remove_size, insert_index, remove_index, img_obj, table_name)
{   
    // The path of the image is split to facilitate comparison
    var relative_path = (img_obj.src).split("themes/"); 
    
    // The image source is changed when the showDetails function is called.
    if (relative_path[1] == 'original/img/new_data_hovered.jpg') {    
        img_obj.src = "./themes/original/img/new_data_selected_hovered.jpg";
        img_obj.alt = PMA_messages['strClickToUnselect'];  //only for IE browser
    } else if (relative_path[1] == 'original/img/new_struct_hovered.jpg') {
        img_obj.src = "./themes/original/img/new_struct_selected_hovered.jpg";
        img_obj.alt = PMA_messages['strClickToUnselect'];
    } else if (relative_path[1] == 'original/img/new_struct_selected_hovered.jpg') {
        img_obj.src = "./themes/original/img/new_struct_hovered.jpg";
        img_obj.alt = PMA_messages['strClickToSelect'];
    } else if (relative_path[1] == 'original/img/new_data_selected_hovered.jpg') {    
        img_obj.src = "./themes/original/img/new_data_hovered.jpg";
        img_obj.alt = PMA_messages['strClickToSelect'];
    } 
    
    var div = document.getElementById("list");    
    var table = div.getElementsByTagName("table")[0]; 
    var table_body = table.getElementsByTagName("tbody")[0];
    
    //Global variable row_class is being used
    if (row_class == 'even') {
        row_class = 'odd';
    } else {
        row_class = 'even'; 
    }
    // If the red or green button against a table name is pressed then append a new row to show the details of differences of this table. 
    if ((relative_path[1] != 'original/img/new_struct_selected_hovered.jpg') && (relative_path[1] != 'original/img/new_data_selected_hovered.jpg')) { 
        
        var newRow = document.createElement("tr");    
        newRow.setAttribute("class", row_class);
        newRow.className = row_class; 
        // Id assigned to this row element is same as the index of this table name in the  matching_tables/source_tables_uncommon array  
        newRow.setAttribute("id" , i);
            
        var table_name_cell = document.createElement("td");
        table_name_cell.align = "center";
        table_name_cell.innerHTML = table_name ;
        
        newRow.appendChild(table_name_cell);
       
        var create_table = document.createElement("td");
        create_table.align = "center";
           
        var add_cols = document.createElement("td");
        add_cols.align = "center";
        
        var remove_cols = document.createElement("td");
        remove_cols.align = "center";
        
        var alter_cols = document.createElement("td");
        alter_cols.align = "center";
        
        var add_index = document.createElement("td");
        add_index.align = "center";
        
        var delete_index = document.createElement("td");
        delete_index.align = "center";
        
        var update_rows = document.createElement("td");
        update_rows.align = "center";
        
        var insert_rows = document.createElement("td");
        insert_rows.align = "center";
        
        var tick_image = document.createElement("img");
        tick_image.src = "./themes/original/img/s_success.png"; 

        if (update_size == '' && insert_size == '' && remove_size == '') {
          /**
          This is the case when the table needs to be created in target database. 
          */
            create_table.appendChild(tick_image);
            add_cols.innerHTML = "--";
            remove_cols.innerHTML = "--";         
            alter_cols.innerHTML = "--";
            delete_index.innerHTML = "--";
            add_index.innerHTML = "--";
            update_rows.innerHTML = "--";
            insert_rows.innerHTML = "--";
 
            newRow.appendChild(create_table);
            newRow.appendChild(add_cols);
            newRow.appendChild(remove_cols);
            newRow.appendChild(alter_cols);
            newRow.appendChild(delete_index);
            newRow.appendChild(add_index);
            newRow.appendChild(update_rows);
            newRow.appendChild(insert_rows);
            
        } else if (update_size == '' && remove_size == '') {
           /**
           This is the case when data difference is displayed in the 
           table which is present in source but absent from target database 
          */
            create_table.innerHTML = "--";
            add_cols.innerHTML = "--";
            remove_cols.innerHTML = "--";         
            alter_cols.innerHTML = "--";
            add_index.innerHTML = "--";
            delete_index.innerHTML = "--";
            update_rows.innerHTML = "--";
            insert_rows.innerHTML = insert_size;
            
            newRow.appendChild(create_table);
            newRow.appendChild(add_cols);
            newRow.appendChild(remove_cols);
            newRow.appendChild(alter_cols);
            newRow.appendChild(delete_index); 
            newRow.appendChild(add_index);
            newRow.appendChild(update_rows);
            newRow.appendChild(insert_rows);
            
        } else if (remove_size == '') {
            /**
             This is the case when data difference between matching_tables is displayed. 
            */
            create_table.innerHTML = "--";
            add_cols.innerHTML = "--";
            remove_cols.innerHTML = "--";         
            alter_cols.innerHTML = "--";
            add_index.innerHTML = "--";
            delete_index.innerHTML = "--";
            update_rows.innerHTML = update_size;
            insert_rows.innerHTML = insert_size;
            
            newRow.appendChild(create_table);
            newRow.appendChild(add_cols);
            newRow.appendChild(remove_cols);
            newRow.appendChild(alter_cols);
            newRow.appendChild(delete_index);
            newRow.appendChild(add_index);
            newRow.appendChild(update_rows);
            newRow.appendChild(insert_rows);
            
        } else {
            /**
            This is the case when structure difference between matching_tables id displayed
            */
            create_table.innerHTML = "--";
            add_cols.innerHTML = insert_size;
            remove_cols.innerHTML = remove_size;         
            alter_cols.innerHTML = update_size;
            delete_index.innerHTML = remove_index;
            add_index.innerHTML = insert_index;
            update_rows.innerHTML = "--";
            insert_rows.innerHTML = "--";
           
            newRow.appendChild(create_table);
            newRow.appendChild(add_cols);
            newRow.appendChild(remove_cols);
            newRow.appendChild(alter_cols); 
            newRow.appendChild(delete_index);
            newRow.appendChild(add_index);
            newRow.appendChild(update_rows);
            newRow.appendChild(insert_rows);
        }
        table_body.appendChild(newRow);
      
    } else if ((relative_path[1] != 'original/img/new_struct_hovered.jpg') && (relative_path[1] != 'original/img/new_data_hovered.jpg')) {
      //The case when the row showing the details need to be removed from the table i.e. the difference button is deselected now.
        var table_rows = table_body.getElementsByTagName("tr");
        var j;
        var index = 0;
        for (j=0; j < table_rows.length; j++) 
        {   
            if (table_rows[j].id == i) { 
                index = j;
                table_rows[j].parentNode.removeChild(table_rows[j]);     
            }
        }
        //The table row css is being adjusted. Class "odd" for odd rows and "even" for even rows should be maintained.
        for(index; index < table_rows.length; index++)
        {
            row_class_element = table_rows[index].getAttribute('class');
            if (row_class_element == "even") {
                table_rows[index].setAttribute("class","odd");  // for Mozilla firefox
                table_rows[index].className = "odd";            // for IE browser
            } else {
                table_rows[index].setAttribute("class","even"); // for Mozilla firefox  
                table_rows[index].className = "even";           // for IE browser       
            }
        }    
    }     
}

/**
 * Changes the image on hover effects
 *
 * @param   img_obj   the image object whose source needs to be changed
 *
 */
 
function change_Image(img_obj)
{
     var relative_path = (img_obj.src).split("themes/"); 
    
    if (relative_path[1] == 'original/img/new_data.jpg') {    
        img_obj.src = "./themes/original/img/new_data_hovered.jpg";  
    } else if (relative_path[1] == 'original/img/new_struct.jpg') {
        img_obj.src = "./themes/original/img/new_struct_hovered.jpg";
    } else if (relative_path[1] == 'original/img/new_struct_hovered.jpg') {
        img_obj.src = "./themes/original/img/new_struct.jpg";
    } else if (relative_path[1] == 'original/img/new_data_hovered.jpg') {    
        img_obj.src = "./themes/original/img/new_data.jpg";  
    } else if (relative_path[1] == 'original/img/new_data_selected.jpg') {    
        img_obj.src = "./themes/original/img/new_data_selected_hovered.jpg";  
    } else if(relative_path[1] == 'original/img/new_struct_selected.jpg') {    
        img_obj.src = "./themes/original/img/new_struct_selected_hovered.jpg";  
    } else if (relative_path[1] == 'original/img/new_struct_selected_hovered.jpg') {    
        img_obj.src = "./themes/original/img/new_struct_selected.jpg";  
    } else if (relative_path[1] == 'original/img/new_data_selected_hovered.jpg') {    
        img_obj.src = "./themes/original/img/new_data_selected.jpg";  
    }
}

/**
 * Generates the URL containing the list of selected table ids for synchronization and 
 * a variable checked for confirmation of deleting previous rows from target tables 
 *
 * @param   token   the token generated for each PMA form 
 *
 */

function ApplySelectedChanges(token)
{
    var div =  document.getElementById("list");
    var table = div.getElementsByTagName('table')[0];
    var table_body = table.getElementsByTagName('tbody')[0];
    // Get all the rows from the details table
    var table_rows = table_body.getElementsByTagName('tr');
    var x = table_rows.length;
    var i;
    /**
     Append the token at the beginning of the query string followed by  
    Table_ids that shows that "Apply Selected Changes" button is pressed            
    */
    var append_string = "?token="+token+"&Table_ids="+1;
    for(i=0; i<x; i++){
           append_string += "&";    
           append_string += i+"="+table_rows[i].id; 
    }
    
    // Getting the value of checkbox delete_rows
    var checkbox = document.getElementById("delete_rows");
    if (checkbox.checked){
        append_string += "&checked=true";
    } else {
         append_string += "&checked=false";
    }
    //Appending the token and list of table ids in the URL 
    location.href += token;
    location.href += append_string;
}

/** 
* Displays error message if any text field 
* is left empty other than port field.
*
* @param  string   the form name
* @param  object   the form
*
* @return  boolean  whether the form field is empty or not
*/
function validateConnection(form_name, form_obj)
{   
    var check = true;
    var src_hostfilled = true;
    var trg_hostfilled = true;

    for (var i=1; i<form_name.elements.length; i++)
    {
        // All the text fields are checked excluding the port field because the default port can be used.
        if ((form_name.elements[i].type == 'text') && (form_name.elements[i].name != 'src_port') && (form_name.elements[i].name != 'trg_port')) {
            check = emptyFormElements(form_obj, form_name.elements[i].name);
            if (check==false) {
                element = form_name.elements[i].name;
                if (form_name.elements[i].name == 'src_host') {
                    src_hostfilled = false;
                    continue;
                }
                if (form_name.elements[i].name == 'trg_host') {
                    trg_hostfilled = false;
                    continue;
                }
                if ((form_name.elements[i].name == 'src_socket' && src_hostfilled==false) || (form_name.elements[i].name == 'trg_socket' && trg_hostfilled==false))
                    break;
                else
                    continue;
            }
        }
    }
    if (!check) {
        form_obj.reset();
        element.select();
        alert(PMA_messages['strFormEmpty']);
        element.focus();
    }
    return check;
}
    
/**
 * Check if a form's element is empty
 * should be
 *
 * @param   object   the form
 * @param   string   the name of the form field to put the focus on
 *
 * @return  boolean  whether the form field is empty or not
 */
function emptyCheckTheField(theForm, theFieldName)
{
    var isEmpty  = 1;
    var theField = theForm.elements[theFieldName];
    // Whether the replace function (js1.2) is supported or not
    var isRegExp = (typeof(theField.value.replace) != 'undefined');

    if (!isRegExp) {
        isEmpty      = (theField.value == '') ? 1 : 0;
    } else {
        var space_re = new RegExp('\\s+');
        isEmpty      = (theField.value.replace(space_re, '') == '') ? 1 : 0;
    }

    return isEmpty;
} // end of the 'emptyCheckTheField()' function


/**
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


/**
 * This array is used to remember mark status of rows in browse mode
 */
var marked_row = new Array;

/**
 * enables highlight and marking of rows in data tables
 *
 */
function PMA_markRowsInit() {
    // for every table row ...
    var rows = document.getElementsByTagName('tr');
    for ( var i = 0; i < rows.length; i++ ) {
        // ... with the class 'odd' or 'even' ...
        if ( 'odd' != rows[i].className.substr(0,3) && 'even' != rows[i].className.substr(0,4) ) {
            continue;
        }
        // ... add event listeners ...
        // ... to highlight the row on mouseover ...
        if ( navigator.appName == 'Microsoft Internet Explorer' ) {
            // but only for IE, other browsers are handled by :hover in css
            rows[i].onmouseover = function() {
                this.className += ' hover';
            }
            rows[i].onmouseout = function() {
                this.className = this.className.replace( ' hover', '' );
            }
        }
        // Do not set click events if not wanted
        if (rows[i].className.search(/noclick/) != -1) {
            continue;
        }
        // ... and to mark the row on click ...
        $(rows[i]).bind('mousedown', function(event) {
            var unique_id;
            var checkbox;
            var table;

            // Somehow IE8 has this not set
            if (!event) var event = window.event

            checkbox = this.getElementsByTagName( 'input' )[0];
            if ( checkbox && checkbox.type == 'checkbox' ) {
                unique_id = checkbox.name + checkbox.value;
            } else if ( this.id.length > 0 ) {
                unique_id = this.id;
            } else {
                return;
            }

            if ( typeof(marked_row[unique_id]) == 'undefined' || !marked_row[unique_id] ) {
                marked_row[unique_id] = true;
            } else {
                marked_row[unique_id] = false;
            }

            if ( marked_row[unique_id] ) {
                this.className += ' marked';
            } else {
                this.className = this.className.replace(' marked', '');
            }

            if ( checkbox && checkbox.disabled == false ) {
                checkbox.checked = marked_row[unique_id];
                if (typeof(event) == 'object') {
                    table = this.parentNode;
                    i = 0;
                    while (table.tagName.toLowerCase() != 'table' && i < 20) {
                        i++;
                        table = table.parentNode;
                    }

                    if (event.shiftKey == true && table.lastClicked != undefined) {
                        if (event.preventDefault) {event.preventDefault();} else {event.returnValue = false;}
                        i = table.lastClicked;

                        if (i < this.rowIndex) {
                            i++;
                        } else {
                            i--;
                        }

                        while (i != this.rowIndex) {
                            table.rows[i].onmousedown();
                            if (i < this.rowIndex) {
                                i++;
                            } else {
                                i--;
                            }
                        }
                    }

                    table.lastClicked = this.rowIndex;
                }
            }
        });

        // ... and disable label ...
        var labeltag = rows[i].getElementsByTagName('label')[0];
        if ( labeltag ) {
            labeltag.onclick = function() {
                return false;
            }
        }
        // .. and checkbox clicks
        var checkbox = rows[i].getElementsByTagName('input')[0];
        if ( checkbox ) {
            checkbox.onclick = function() {
                // opera does not recognize return false;
                this.checked = ! this.checked;
            }
        }
    }
}
$(document).ready(PMA_markRowsInit);

/**
 * marks all rows and selects its first checkbox inside the given element
 * the given element is usaly a table or a div containing the table or tables
 *
 * @param    container    DOM element
 */
function markAllRows( container_id ) {
    
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
function unMarkAllRows( container_id ) {
    
    $("#"+container_id).find("input:checkbox:enabled").removeAttr('checked')
    .parents("tr").removeClass("marked");
    return true;
}

/**
 * Sets/unsets the pointer and marker in browse mode
 *
 * @param   object    the table row
 * @param   integer  the row number
 * @param   string    the action calling this script (over, out or click)
 * @param   string    the default background color
 * @param   string    the color to use for mouseover
 * @param   string    the color to use for marking a row
 *
 * @return  boolean  whether pointer is set or not
 */
function setPointer(theRow, theRowNum, theAction, theDefaultColor, thePointerColor, theMarkColor)
{
    var theCells = null;

    // 1. Pointer and mark feature are disabled or the browser can't get the
    //    row -> exits
    if ((thePointerColor == '' && theMarkColor == '')
        || typeof(theRow.style) == 'undefined') {
        return false;
    }

    // 1.1 Sets the mouse pointer to pointer on mouseover and back to normal otherwise.
    if (theAction == "over" || theAction == "click") {
        theRow.style.cursor='pointer';
    } else {
        theRow.style.cursor='default';
    }

    // 2. Gets the current row and exits if the browser can't get it
    if (typeof(document.getElementsByTagName) != 'undefined') {
        theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        theCells = theRow.cells;
    }
    else {
        return false;
    }

    // 3. Gets the current color...
    var rowCellsCnt  = theCells.length;
    var domDetect    = null;
    var currentColor = null;
    var newColor     = null;
    // 3.1 ... with DOM compatible browsers except Opera that does not return
    //         valid values with "getAttribute"
    if (typeof(window.opera) == 'undefined'
        && typeof(theCells[0].getAttribute) != 'undefined') {
        currentColor = theCells[0].getAttribute('bgcolor');
        domDetect    = true;
    }
    // 3.2 ... with other browsers
    else {
        currentColor = theCells[0].style.backgroundColor;
        domDetect    = false;
    } // end 3

    // 3.3 ... Opera changes colors set via HTML to rgb(r,g,b) format so fix it
    if (currentColor.indexOf("rgb") >= 0)
    {
        var rgbStr = currentColor.slice(currentColor.indexOf('(') + 1,
                                     currentColor.indexOf(')'));
        var rgbValues = rgbStr.split(",");
        currentColor = "#";
        var hexChars = "0123456789ABCDEF";
        for (var i = 0; i < 3; i++)
        {
            var v = rgbValues[i].valueOf();
            currentColor += hexChars.charAt(v/16) + hexChars.charAt(v%16);
        }
    }

    // 4. Defines the new color
    // 4.1 Current color is the default one
    if (currentColor == ''
        || currentColor.toLowerCase() == theDefaultColor.toLowerCase()) {
        if (theAction == 'over' && thePointerColor != '') {
            newColor              = thePointerColor;
        }
        else if (theAction == 'click' && theMarkColor != '') {
            newColor              = theMarkColor;
            marked_row[theRowNum] = true;
            // Garvin: deactivated onclick marking of the checkbox because it's also executed
            // when an action (like edit/delete) on a single item is performed. Then the checkbox
            // would get deactived, even though we need it activated. Maybe there is a way
            // to detect if the row was clicked, and not an item therein...
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = true;
        }
    }
    // 4.1.2 Current color is the pointer one
    else if (currentColor.toLowerCase() == thePointerColor.toLowerCase()
             && (typeof(marked_row[theRowNum]) == 'undefined' || !marked_row[theRowNum])) {
        if (theAction == 'out') {
            newColor              = theDefaultColor;
        }
        else if (theAction == 'click' && theMarkColor != '') {
            newColor              = theMarkColor;
            marked_row[theRowNum] = true;
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = true;
        }
    }
    // 4.1.3 Current color is the marker one
    else if (currentColor.toLowerCase() == theMarkColor.toLowerCase()) {
        if (theAction == 'click') {
            newColor              = (thePointerColor != '')
                                  ? thePointerColor
                                  : theDefaultColor;
            marked_row[theRowNum] = (typeof(marked_row[theRowNum]) == 'undefined' || !marked_row[theRowNum])
                                  ? true
                                  : null;
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = false;
        }
    } // end 4

    // 5. Sets the new color...
    if (newColor) {
        var c = null;
        // 5.1 ... with DOM compatible browsers except Opera
        if (domDetect) {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].setAttribute('bgcolor', newColor, 0);
            } // end for
        }
        // 5.2 ... with other browsers
        else {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].style.backgroundColor = newColor;
            }
        }
    } // end 5

    return true;
} // end of the 'setPointer()' function

/*
 * Sets/unsets the pointer and marker in vertical browse mode
 *
 * @param   object    the table row
 * @param   integer   the column number
 * @param   string    the action calling this script (over, out or click)
 * @param   string    the default background Class
 * @param   string    the Class to use for mouseover
 * @param   string    the Class to use for marking a row
 *
 * @return  boolean  whether pointer is set or not
 *
 */
function setVerticalPointer(theRow, theColNum, theAction, theDefaultClass1, theDefaultClass2, thePointerClass, theMarkClass) {
    // 1. Pointer and mark feature are disabled or the browser can't get the
    //    row -> exits
    if ((thePointerClass == '' && theMarkClass == '')
        || typeof(theRow.style) == 'undefined') {
        return false;
    }

    var tagSwitch = null;

    // 2. Gets the current row and exits if the browser can't get it
    if (typeof(document.getElementsByTagName) != 'undefined') {
        tagSwitch = 'tag';
    } else if (typeof(document.getElementById('table_results')) != 'undefined') {
        tagSwitch = 'cells';
    } else {
        return false;
    }

    var theCells = null;

    if (tagSwitch == 'tag') {
        theRows     = document.getElementById('table_results').getElementsByTagName('tr');
        theCells    = theRows[1].getElementsByTagName('td');
    } else if (tagSwitch == 'cells') {
        theRows     = document.getElementById('table_results').rows;
        theCells    = theRows[1].cells;
    }

    // 3. Gets the current Class...
    var currentClass   = null;
    var newClass       = null;

    // 3.1 ... with DOM compatible browsers except Opera that does not return
    //         valid values with "getAttribute"
    if (typeof(window.opera) == 'undefined'
        && typeof(theCells[theColNum].getAttribute) != 'undefined') {
        currentClass = theCells[theColNum].className;
    } // end 3

    // 4. Defines the new Class
    // 4.1 Current Class is the default one
    if (currentClass == ''
        || currentClass.toLowerCase() == theDefaultClass1.toLowerCase()
        || currentClass.toLowerCase() == theDefaultClass2.toLowerCase()) {
        if (theAction == 'over' && thePointerClass != '') {
            newClass              = thePointerClass;
        } else if (theAction == 'click' && theMarkClass != '') {
            newClass              = theMarkClass;
            marked_row[theColNum] = true;
        }
    }
    // 4.1.2 Current Class is the pointer one
    else if (currentClass.toLowerCase() == thePointerClass.toLowerCase() &&
             (typeof(marked_row[theColNum]) == 'undefined' || !marked_row[theColNum]) || marked_row[theColNum] == false) {
            if (theAction == 'out') {
                if (theColNum % 2) {
                    newClass              = theDefaultClass1;
                } else {
                    newClass              = theDefaultClass2;
                }
            }
            else if (theAction == 'click' && theMarkClass != '') {
                newClass              = theMarkClass;
                marked_row[theColNum] = true;
            }
    }
    // 4.1.3 Current Class is the marker one
    else if (currentClass.toLowerCase() == theMarkClass.toLowerCase()) {
        if (theAction == 'click') {
            newClass              = (thePointerClass != '')
                                  ? thePointerClass
                                  : ((theColNum % 2) ? theDefaultClass2 : theDefaultClass1);
            marked_row[theColNum] = false;
        }
    } // end 4

    // 5 ... with DOM compatible browsers except Opera

    if (newClass) {
        var c = null;
        var rowCnt = theRows.length;
        for (c = 0; c < rowCnt; c++) {
            if (tagSwitch == 'tag') {
                Cells = theRows[c].getElementsByTagName('td');
            } else if (tagSwitch == 'cells') {
                Cells = theRows[c].cells;
            }

            Cell  = Cells[theColNum];

            // 5.1 Sets the new Class...
            Cell.className = Cell.className.replace(currentClass, newClass);
        } // end for
    } // end 5

     return true;
 } // end of the 'setVerticalPointer()' function

/**
 * Checks/unchecks all checkbox in given conainer (f.e. a form, fieldset or div)
 *
 * @param   string   container_id  the container id
 * @param   boolean  state         new value for checkbox (true or false)
 * @return  boolean  always true
 */
function setCheckboxes( container_id, state ) {

    if(state) {
        $("#"+container_id).find("input:checkbox").attr('checked', 'checked');
    }
    else {
        $("#"+container_id).find("input:checkbox").removeAttr('checked');
    }

    return true;
} // end of the 'setCheckboxes()' function


// added 2004-05-08 by Michael Keck <mail_at_michaelkeck_dot_de>
//   copy the checked from left to right or from right to left
//   so it's easier for users to see, if $cfg['ModifyAtRight']=true, what they've checked ;)
function copyCheckboxesRange(the_form, the_name, the_clicked)
{
    if (typeof(document.forms[the_form].elements[the_name]) != 'undefined' && typeof(document.forms[the_form].elements[the_name + 'r']) != 'undefined') {
        if (the_clicked !== 'r') {
            if (document.forms[the_form].elements[the_name].checked == true) {
                document.forms[the_form].elements[the_name + 'r'].checked = true;
            }else {
                document.forms[the_form].elements[the_name + 'r'].checked = false;
            }
        } else if (the_clicked == 'r') {
            if (document.forms[the_form].elements[the_name + 'r'].checked == true) {
                document.forms[the_form].elements[the_name].checked = true;
            }else {
                document.forms[the_form].elements[the_name].checked = false;
            }
       }
    }
}


// added 2004-05-08 by Michael Keck <mail_at_michaelkeck_dot_de>
//  - this was directly written to each td, so why not a function ;)
//  setCheckboxColumn(\'id_rows_to_delete' . $row_no . ''\');
function setCheckboxColumn(theCheckbox){
    if (document.getElementById(theCheckbox)) {
        document.getElementById(theCheckbox).checked = (document.getElementById(theCheckbox).checked ? false : true);
        if (document.getElementById(theCheckbox + 'r')) {
            document.getElementById(theCheckbox + 'r').checked = document.getElementById(theCheckbox).checked;
        }
    } else {
        if (document.getElementById(theCheckbox + 'r')) {
            document.getElementById(theCheckbox + 'r').checked = (document.getElementById(theCheckbox +'r').checked ? false : true);
            if (document.getElementById(theCheckbox)) {
                document.getElementById(theCheckbox).checked = document.getElementById(theCheckbox + 'r').checked;
            }
        }
    }
}


/**
  * Checks/unchecks all options of a <select> element
  *
  * @param   string   the form name
  * @param   string   the element name
  * @param   boolean  whether to check or to uncheck the element
  *
  * @return  boolean  always true
  */
function setSelectOptions(the_form, the_select, do_check)
{

    if( do_check ) {
        $("form[name='"+ the_form +"']").find("select[name='"+the_select+"']").find("option").attr('selected', 'selected');
    }
    else {
        $("form[name='"+ the_form +"']").find("select[name="+the_select+"]").find("option").removeAttr('selected');
    }
    return true;
} // end of the 'setSelectOptions()' function


/**
  * Create quick sql statements.
  *
  */
function insertQuery(queryType) {
    var myQuery = document.sqlform.sql_query;
    var myListBox = document.sqlform.dummy;
    var query = "";
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
    document.sqlform.sql_query.value = query;
    sql_box_locked = false;
    }
}


/**
  * Inserts multiple fields.
  *
  */
function insertValueQuery() {
    var myQuery = document.sqlform.sql_query;
    var myListBox = document.sqlform.dummy;

    if(myListBox.options.length > 0) {
        sql_box_locked = true;
        var chaineAj = "";
        var NbSelect = 0;
        for(var i=0; i<myListBox.options.length; i++) {
            if (myListBox.options[i].selected){
                NbSelect++;
                if (NbSelect > 1)
                    chaineAj += ", ";
                chaineAj += myListBox.options[i].value;
            }
        }

        //IE support
        if (document.selection) {
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
function goToUrl(selObj, goToLocation) {
    eval("document.location.href = '" + goToLocation + "pos=" + selObj.options[selObj.selectedIndex].value + "'");
}

/**
 * getElement
 */
function getElement(e,f){
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
  * Refresh the WYSIWYG-PDF scratchboard after changes have been made
  */
function refreshDragOption(e) {
    var elm = $('#' + e);
    if (elm.css('visibility') == 'visible') {
        refreshLayout();
    }
}

/**
  * Refresh/resize the WYSIWYG-PDF scratchboard
  */
function refreshLayout() {
    var elm = $('#pdflayout')
    var orientation = $('#orientation_opt').val();
    var paper = $('#paper_opt').val();

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
  * Show/hide the WYSIWYG-PDF scratchboard
  */
function ToggleDragDrop(e) {
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
function dragPlace(no, axis, value) {
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
function pdfPaperSize(format, axis) {
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
    if (w_width == undefined)
        w_width = 640;

    // if height not specified, use default
    if (w_height == undefined)
        w_height = 480;

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
    if (undefined == current_mime_type)
        current_mime_type = "";

    // prompt user for new mime type
    var new_mime_type = prompt("Enter custom MIME type", current_mime_type);

    // if new mime_type is specified and is not the same as the previous type, request for mime type change
    if (new_mime_type && new_mime_type != current_mime_type)
        changeMIMEType(db, table, reference, new_mime_type);
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
    var $oldText,$db,$table,$token,$sql_query;
    $oldText=$(".inner_sql").html();
    $("#inline_edit").click(function(){
        $db=$("input[name='db']").val();
        $table=$("input[name='table']").val();
        $token=$("input[name='token']").val();
        $sql_query=$("input[name='sql_query']").val();
        $(".inner_sql").replaceWith("<textarea name=\"sql_query_edit\" id=\"sql_query_edit\">"+ $sql_query +"</textarea><input type=\"button\" id=\"btnSave\" value=\"" + PMA_messages['strGo'] + "\"><input type=\"button\" id=\"btnDiscard\" value=\"" + PMA_messages['strCancel'] + "\">");
        return false;
    });

    $("#btnSave").live("click",function(){
        window.location.replace("import.php?db="+$db+"&table="+$table+"&sql_query="+$("#sql_query_edit").val()+"&show_query=1&token="+$token+"");
    });

    $("#btnDiscard").live("click",function(){
        $(".sql").html("<span class=\"syntax\"><span class=\"inner_sql\">"+$oldText+"</span></span>");
    });

    $('.sqlbutton').click(function(evt){
        insertQuery(evt.target.id);
        return false;
    });
});

/**
 * Function to process the plain HTML response from an Ajax request.  Inserts
 * the various HTML divisions from the response at the proper locations.  The 
 * array relates the divisions to be inserted to their placeholders.
 *
 * @param   var divisions_map   an associative array of id names
 *
 * <code>
 * PMA_ajaxInsertResponse({'resultsTable':'resultsTable_response',
 *                         'profilingData':'profilingData_response'});
 * </code>
 *
 */

function PMA_ajaxInsertResponse(divisions_map) {
    $.each(divisions_map, function(key, value) {
        var content_div = '#'+value;
        var target_div = '#'+key;
        var content = $(content_div).html();

        //replace content of target_div with that from the response
        $(target_div).html(content);
    });
};

/**
 * Show a message on the top of the page for an Ajax request
 *
 * @param   var     message     string containing the message to be shown.
 *                              optional, defaults to 'Loading...'
 * @param   var     timeout     number of milliseconds for the message to be visible
 *                              optional, defaults to 5000
 */

function PMA_ajaxShowMessage(message, timeout) {
    
    if(!message) {
        var msg = PMA_messages['strLoading'];
    }
    else {
        var msg = message;
    }

    if(!timeout) {
        var to = 5000;
    }
    else {
        var to = timeout;
    }

    if( !ajax_message_init) {
        $(function(){
            $('<span id="loading" class="ajax_notification"></span>')
            .insertBefore("#serverinfo")
            .html(msg)
            .slideDown('medium')
            .delay(to)
            .slideUp('medium', function(){
                $(this).html(""); //Clear the message
            });
        }, 'top.frame_content');
        ajax_message_init = true;
    }
    else {
        $("#loading")
        .html(msg)
        .slideDown('medium')
        .delay(to)
        .slideUp('medium', function() {
            $(this).html("");
        })
    }
}

/**
 * jQuery function that uses jQueryUI's dialogs to confirm with user
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

    $('<div id="confirm_dialog"></div>')
    .prepend(question)
    .dialog({
        buttons: {"OK": function(){
                            $(this).dialog("close");

                            if($.isFunction(callbackFn)) {
                                callbackFn.call(this, url);
                            }
                        },
                 "Cancel": function(){
                            $(this).dialog("close");
                        }
                 }
    });
};

/**
 * jQuery code for 'Drop Database', 'Truncate Table', 'Drop Table' action on
 * db_structure.php
 *
 * @todo    move to a different file as it is not required on every page
 */
$(document).ready(function() {

    //Drop Database
    $("#drop_db_anchor").live('click', function(event) {
        event.preventDefault();

        //context is top.frame_content, so we need to use window.parent.db to access the db var
        var question = PMA_messages['strDropDatabaseStrongWarning'] + '\n' + PMA_messages['strDoYouReally'] + ' :\n' + 'DROP DATABASE ' + window.parent.db;

        $(this).PMA_confirm(question, $(this).attr('href') ,function(url) {

            PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);
            $.get(url, {'is_js_confirmed': '1', 'ajax_request': true}, function(data) {
                //Database deleted successfully, refresh both the frames
                window.parent.refreshNavigation();
                window.parent.refreshMain();
            })
        });
    }); //end of Drop Database Ajax action

    //Truncate Table
    $(".truncate_table_anchor").live('click', function(event) {
        event.preventDefault();

        //extract current table name and build the question string
        var curr_table_name = $(this).parents('tr').children('th').children('a').text();
        var question = 'TRUNCATE ' + curr_table_name;

        $(this).PMA_confirm(question, $(this).attr('href'), function(url) {

            PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);

            $.get(url, {'is_js_confirmed' : 1, 'ajax_request' : true}, function(data) {
                if(data.success == true) {
                    PMA_ajaxShowMessage(data.message);
                    //need to find a better solution here.  The icon should be replaced
                    $(this).remove();
                }
                else {
                    PMA_ajaxShowMessage(PMA_messages['strErrorProcessingRequest'] + " : " + data.error);
                }
            })
        })
    }); //end of Truncate Table Ajax action

    //Drop Table
    $(".drop_table_anchor").live('click', function(event) {
        event.preventDefault();

        //extract current table name and build the question string
        var curr_table_name = $(this).parents('tr').children('th').children('a').text();
        var question = 'DROP TABLE ' + curr_table_name;

        $(this).PMA_confirm(question, $(this).attr('href'), function(url) {

            PMA_ajaxShowMessage(PMA_messages['strProcessingRequest']);

            $.get(url, {'is_js_confirmed' : 1, 'ajax_request' : true}, function(data) {
                if(data.success == true) {
                    PMA_ajaxShowMessage(data.message);
                    //need to find a better solution here.  The icon should be replaced
                    $(this).remove();
                }
                else {
                    PMA_ajaxShowMessage(PMA_messages['strErrorProcessingRequest'] + " : " + data.error);
                }
            });
        });
    }); //end of Drop Table Ajax action

    //Drop Column
    $(".drop_column_anchor").live('click', function(event) {
        event.preventDefault();

        var curr_table_name = window.parent.table;
        var curr_column_name = $(this).parents('tr').children('th').children('label').text();
        var question = PMA_message['strDoYouReally'] + ' :\n ALTER TABLE `' + curr_table_name + '` DROP `' + curr_column_name + '`';

        $(this).PMA_confirm(question, $(this).attr('href'), function(url) {

            PMA_ajaxShowMessage(PMA_messages['strDroppingColumn']);

            $.get(url, {'is_js_confirmed' : 1, 'ajax_request' : true}, function(data) {
                if(data.success == true) {
                    PMA_ajaxShowMessage(data.message);
                    $(this).remove();
                }
                else {
                    PMA_ajaxShowMessage(PMA_messages['strErrorProcessingRequest'] + " : " + data.error);
                }
            })
        }); //end of Drop Column Anchor action
    })
    
    //Add Primary Key
    $(".add_primary_key_anchor").live('click', function(event) {
        event.preventDefault();

        var curr_table_name = window.parent.table;
        var curr_column_name = $(this).parents('tr').children('th').children('label').text();
        var question = PMA_messages['strDoYouReally'] + ' :\n ALTER TABLE `' + curr_table_name + '` ADD PRIMARY KEY(`' + curr_column_name + '`)';

        $(this).PMA_confirm(question, $(this).attr('href'), function(url) {

            PMA_ajaxShowMessage(PMA_messages['strAddingPrimaryKey']);

            $.get(url, {'is_js_confirmed' : 1, 'ajax_request' : true}, function(data) {
                if(data.success == true) {
                    PMA_ajaxShowMessage(data.message);
                    $(this).remove();
                }
                else {
                    PMA_ajaxShowMessage(PMA_messages['strErrorProcessingRequest'] + " : " + data.error);
                }
            })
        })
    })

}, 'top.frame_content'); //end $(document).ready()