/**
 * Functions used in configuration forms and on user preferences pages
 */

// default values for fields
var defaultValues = {};

// language strings
var PMA_messages = {};

/**
 * Returns field type
 *
 * @param {Element} field
 */
function getFieldType(field) {
	field = $(field);
    var tagName = field.attr('tagName');
	if (tagName == 'INPUT') {
        return field.attr('type');
    } else if (tagName == 'SELECT') {
        return 'select';
    } else if (tagName == 'TEXTAREA') {
        return 'text';
    }
    return '';
}

/**
 * Sets field value
 *
 * value must be of type:
 * o undefined (omitted) - restore default value (form default, not PMA default)
 * o String - if field_type is 'text'
 * o boolean - if field_type is 'checkbox'
 * o Array of values - if field_type is 'select'
 *
 * @param {Element} field
 * @param {String}  field_type  see {@link #getFieldType}
 * @param {String|Boolean}  [value]
 */
function setFieldValue(field, field_type, value) {
	field = $(field);
    switch (field_type) {
        case 'text':
            field.attr('value', (value != undefined ? value : field.attr('defaultValue')));
            break;
        case 'checkbox':
            field.attr('checked', (value != undefined ? value : field.attr('defaultChecked')));
            break;
        case 'select':
            var options = field.attr('options');
        	var i, imax = options.length;
            if (value == undefined) {
                for (i = 0; i < imax; i++) {
                	options[i].selected = options[i].defaultSelected;
                }
            } else {
                for (i = 0; i < imax; i++) {
                	options[i].selected = (value.indexOf(options[i].value) != -1);
                }
            }
            break;
    }
    markField(field);
}

/**
 * Gets field value
 *
 * Will return one of:
 * o String - if type is 'text'
 * o boolean - if type is 'checkbox'
 * o Array of values - if type is 'select'
 *
 * @param {Element} field
 * @param {String}  field_type returned by {@link #getFieldType}
 * @type Boolean|String|String[]
 */
function getFieldValue(field, field_type) {
	field = $(field);
    switch (field_type) {
        case 'text':
            return field.attr('value');
        case 'checkbox':
            return field.attr('checked');
        case 'select':
        	var options = field.attr('options');
            var i, imax = options.length, items = [];
            for (i = 0; i < imax; i++) {
                if (options[i].selected) {
                    items.push(options[i].value);
                }
            }
            return items;
    }
}

/**
 * Returns values for all fields in fieldsets
 */
function getAllValues() {
    var elements = $('fieldset input, fieldset select, fieldset textarea');
    var values = {};
    var type, value;
    for (var i = 0; i < elements.length; i++) {
        type = getFieldType(elements[i]);
        value = getFieldValue(elements[i], type);
        if (typeof value != 'undefined') {
            // we only have single selects, fatten array
            if (type == 'select') {
                value = value[0];
            }
            values[elements[i].name] = value;
        }
    }
    return values;
}

/**
 * Checks whether field has its default value
 *
 * @param {Element} field
 * @param {String}  type
 * @return boolean
 */
function checkFieldDefault(field, type) {
    field = $(field);
    var field_id = field.attr('id');
    if (typeof defaultValues[field_id] == 'undefined') {
        return true;
    }
    var isDefault = true;
    var currentValue = getFieldValue(field, type);
    if (type != 'select') {
        isDefault = currentValue == defaultValues[field_id];
    } else {
        // compare arrays, will work for our representation of select values
        if (currentValue.length != defaultValues[field_id].length) {
            isDefault = false;
        }
        else {
            for (var i = 0; i < currentValue.length; i++) {
                if (currentValue[i] != defaultValues[field_id][i]) {
                    isDefault = false;
                    break;
                }
            }
        }
    }
    return isDefault;
}

/**
 * Returns element's id prefix
 * @param {Element} element
 */
function getIdPrefix(element) {
    return $(element).attr('id').replace(/[^-]+$/, '');
}

// ------------------------------------------------------------------
// Form validation and field operations
//

// form validator assignments
var validate = {};

// form validator list
var validators = {
    // regexp: numeric value
    _regexp_numeric: new RegExp('^[0-9]+$'),
    /**
     * Validates positive number
     *
     * @param {boolean} isKeyUp
     */
    validate_positive_number: function (isKeyUp) {
        if (isKeyUp && this.value == '') {
            return true;
        }
        var result = this.value != '0' && validators._regexp_numeric.test(this.value);
        return result ? true : PMA_messages['error_nan_p'];
    },
    /**
     * Validates non-negative number
     *
     * @param {boolean} isKeyUp
     */
    validate_non_negative_number: function (isKeyUp) {
        if (isKeyUp && this.value == '') {
            return true;
        }
        var result = validators._regexp_numeric.test(this.value);
        return result ? true : PMA_messages['error_nan_nneg'];
    },
    /**
     * Validates port number
     *
     * @param {boolean} isKeyUp
     */
    validate_port_number: function(isKeyUp) {
        if (isKeyUp && this.value == '') {
            return true;
        }
        var result = validators._regexp_numeric.test(this.value) && this.value != '0';
        if (!result || this.value > 65536) {
            result = PMA_messages['error_incorrect_port'];
        }
        return result;
    },
    /**
     * DefaultPropDisplay validator
     *
     * @param {boolean} isKeyUp
     */
    validate_DefaultPropDisplay: function(isKeyUp) {
        if (isKeyUp && this.value == '') {
            return true;
        }
        var valid = this.value.match(/^(?:horizontal|vertical|[0-9]+)$/) != null;
        return valid ? true : PMA_messages['error_invalid_value']
    },
    /**
     * Validates string length - must be 1 character long
     *
     * @param {boolean} isKeyUp
     */
    validate_str1: function (isKeyUp) {
        if (isKeyUp && this.value == '') {
            return true;
        }
        var result = this.value.length == 1;
        return result ? true : PMA_messages['error_invalid_value'];
    },
    /**
     * Validates string length - must be 0 or 1 character long
     *
     * @param {boolean} isKeyUp
     */
    validate_str01: function (isKeyUp) {
        if (isKeyUp && this.value == '') {
            return true;
        }
        var result = this.value.length <= 1;
        return result ? true : PMA_messages['error_invalid_value'];
    },
    // field validators
    _field: {
    },
    // fieldset validators
    _fieldset: {
    }
};

/**
 * Registers validator for given field
 *
 * @param {String}  id       field id
 * @param {String}  type     validator (key in validators object)
 * @param {boolean} onKeyUp  whether fire on key up
 * @param {object}  params   validation function parameters
 */
function validateField(id, type, onKeyUp, params) {
    if (typeof validators[type] == 'undefined') {
        return;
    }
    if (typeof validate[id] == 'undefined') {
        validate[id] = [];
    }
    validate[id].push([type, params, onKeyUp]);
}

/**
 * Returns valdiation functions associated with form field
 *
 * @param  {String}  field_id     form field id
 * @param  {boolean} onKeyUpOnly  see validateField
 * @type Array
 * @return array of [function, paramseters to be passed to function]
 */
function getFieldValidators(field_id, onKeyUpOnly) {
    // look for field bound validator
    var name = field_id.match(/[^-]+$/)[0];
    if (typeof validators._field[name] != 'undefined') {
        return [[validators._field[name], null]];
    }

    // look for registered validators
    var functions = [];
    if (typeof validate[field_id] != 'undefined') {
        // validate[field_id]: array of [type, params, onKeyUp]
        for (var i = 0, imax = validate[field_id].length; i < imax; i++) {
            if (onKeyUpOnly && !validate[field_id][i][2]) {
                continue;
            }
            functions.push([validators[validate[field_id][i][0]], validate[field_id][i][1]]);
        }
    }

    return functions;
}

/**
 * Displays errors for given form fields
 *
 * WARNING: created DOM elements must be identical with the ones made by
 * display_input() in FormDisplay.tpl.php!
 *
 * @param {Object} error_list list of errors in the form {field id: error array}
 */
function displayErrors(error_list) {
    for (var field_id in error_list) {
        var errors = error_list[field_id];
        var field = $('#'+field_id);
        var isFieldset = field.attr('tagName') == 'FIELDSET';
        var errorCnt = isFieldset
            ? field.find('dl.errors')
            : field.siblings('.inline_errors');

        // remove empty errors (used to clear error list)
        errors = $.grep(errors, function(item) {
            return item != '';
        });

        // CSS error class
        if (!isFieldset) {
            // checkboxes uses parent <span> for marking
            var fieldMarker = (field.attr('type') == 'checkbox') ? field.parent() : field;
            fieldMarker[errors.length ? 'addClass' : 'removeClass']('field-error');
        }

        if (errors.length) {
            // if error container doesn't exist, create it
            if (errorCnt.length == 0) {
                if (isFieldset) {
                    errorCnt = $('<dl class="errors" />');
                    field.find('table').before(errorCnt);
                } else {
                    errorCnt = $('<dl class="inline_errors" />');
                    field.closest('td').append(errorCnt);
                }
            }

            var html = '';
            for (var i = 0, imax = errors.length; i < imax; i++) {
                html += '<dd>' + errors[i] + '</dd>';
            }
            errorCnt.html(html);
        } else if (errorCnt !== null) {
            // remove useless error container
            errorCnt.remove();
        }
    }
}

/**
 * Validates fieldset and puts errors in 'errors' object
 *
 * @param {Element} fieldset
 * @param {boolean} isKeyUp
 * @param {Object}  errors
 */
function validate_fieldset(fieldset, isKeyUp, errors) {
	fieldset = $(fieldset);
    if (fieldset.length && typeof validators._fieldset[fieldset.attr('id')] != 'undefined') {
        var fieldset_errors = validators._fieldset[fieldset.attr('id')].apply(fieldset[0], [isKeyUp]);
        for (var field_id in fieldset_errors) {
            if (typeof errors[field_id] == 'undefined') {
                errors[field_id] = [];
            }
            if (typeof fieldset_errors[field_id] == 'string') {
                fieldset_errors[field_id] = [fieldset_errors[field_id]];
            }
            $.merge(errors[field_id], fieldset_errors[field_id]);
        }
    }
}

/**
 * Validates form field and puts errors in 'errors' object
 *
 * @param {Element} field
 * @param {boolean} isKeyUp
 * @param {Object}  errors
 */
function validate_field(field, isKeyUp, errors) {
	field = $(field);
	var field_id = field.attr('id');
    errors[field_id] = [];
    var functions = getFieldValidators(field_id, isKeyUp);
    for (var i = 0; i < functions.length; i++) {
        var result = functions[i][0].apply(field[0], [isKeyUp, functions[i][1]]);
        if (result !== true) {
            if (typeof result == 'string') {
            	result = [result];
            }
            $.merge(errors[field_id], result);
        }
    }
}

/**
 * Validates form field and parent fieldset
 *
 * @param {Element} field
 * @param {boolean} isKeyUp
 */
function validate_field_and_fieldset(field, isKeyUp) {
	field = $(field);
    var errors = {};
    validate_field(field, isKeyUp, errors);
    validate_fieldset(field.closest('fieldset'), isKeyUp, errors);
    displayErrors(errors);
}

/**
 * Marks field depending on its value (system default or custom)
 *
 * @param {Element} field
 */
function markField(field) {
	field = $(field);
    var type = getFieldType(field);
    var isDefault = checkFieldDefault(field, type);

    // checkboxes uses parent <span> for marking
    var fieldMarker = (type == 'checkbox') ? field.parent() : field;
    setRestoreDefaultBtn(field, !isDefault);
    fieldMarker[isDefault ? 'removeClass' : 'addClass']('custom');
}

/**
 * Enables or disables the "restore default value" button
 *
 * @param {Element} field
 * @param {boolean} display
 */
function setRestoreDefaultBtn(field, display) {
    var el = $(field).closest('td').find('.restore-default');
    el.css('display', (el.css('display') ? '' : 'none'));
}

$(function() {
    // register validators and mark custom values
	var elements = $('input[id], select[id], textarea[id]');
    $('input[id], select[id], textarea[id]').each(function(){
        markField(this);
        var el = $(this);
        el.bind('change', function() {
            validate_field_and_fieldset(this, false);
            markField(this);
        });
        var tagName = el.attr('tagName');
        // text fields can be validated after each change
        if (tagName == 'INPUT' && el.attr('type') == 'text') {
        	el.keyup(function() {
                validate_field_and_fieldset(el, true);
                markField(el);
            });
        }
        // disable textarea spellcheck
        if (tagName == 'TEXTAREA') {
        	el.attr('spellcheck', false);
        }
    });

	// check whether we've refreshed a page and browser remembered modified
	// form values
	var check_page_refresh = $('#check_page_refresh');
	if (check_page_refresh.length == 0 || check_page_refresh.val() == '1') {
		// run all field validators
		var errors = {};
		for (var i = 0; i < elements.length; i++) {
			validate_field(elements[i], false, errors);
		}
		// run all fieldset validators
		$('fieldset').each(function(){
			validate_fieldset(this, false, errors);
		});

		displayErrors(errors);
	} else if (check_page_refresh) {
		check_page_refresh.val('1');
	}
});

//
// END: Form validation and field operations
// ------------------------------------------------------------------

// ------------------------------------------------------------------
// Tabbed forms
//

/**
 * Sets active tab
 *
 * @param {Element} tab_link
 */
function setTab(tab_link) {
    var tabs_menu = $(tab_link).closest('.tabs');

    var links = tabs_menu.find('a');
    var contents, link;
    for (var i = 0, imax = links.length; i < imax; i++) {
    	link = $(links[i]);
        contents = $(link.attr('href'));
        if (links[i] == tab_link) {
        	link.addClass('active');
            contents.css('display', 'block');
        } else {
            link.removeClass('active');
            contents.css('display', 'none');
        }
    }
    location.hash = 'tab_' + $(tab_link).attr('href').substr(1);
}

$(function() {
    var tabs = $('.tabs');
    var url_tab = location.hash.match(/^#tab_.+/)
        ? $('a[href$="' + location.hash.substr(5) + '"]') : null;
    if (url_tab) {
        url_tab = url_tab[0];
    }
    // add tabs events and activate one tab (the first one or indicated by location hash)
    for (var i = 0, imax = tabs.length; i < imax; i++) {
        var links = $(tabs[i]).find('a');
        var selected_tab = links[0];
        for (var j = 0, jmax = links.length; j < jmax; j++) {
            $(links[j]).click(function(e) {
                e.preventDefault();
                setTab(this);
            });
            if (links[j] == url_tab) {
                selected_tab = links[j];
            }
        }
        setTab(selected_tab);
    }
    // tab links handling, check each 200ms
    // (works with history in FF, further browser support here would be an overkill)
    var prev_hash = location.hash;
    setInterval(function() {
        if (location.hash != prev_hash) {
            prev_hash = location.hash;
            var url_tab = location.hash.match(/^#tab_.+/)
                ? $('a[href$="' + location.hash.substr(5) + '"]') : null;
            if (url_tab) {
                setTab(url_tab[0]);
            }
        }
    }, 200);
});

//
// END: Tabbed forms
// ------------------------------------------------------------------

// ------------------------------------------------------------------
// Form reset buttons
//

$(function() {
    $('input[type=button]').click(function() {
        var fields = $(this).closest('fieldset').find('input, select, textarea');
        for (var i = 0, imax = fields.length; i < imax; i++) {
            setFieldValue(fields[i], getFieldType(fields[i]));
        }
    });
});

//
// END: Form reset buttons
// ------------------------------------------------------------------

// ------------------------------------------------------------------
// "Restore default" and "set value" buttons
//

/**
 * Restores field's default value
 *
 * @param {String} field_id
 */
function restoreField(field_id) {
    var field = $('#'+field_id);
    if (field.length == 0 || defaultValues[field_id] == undefined) {
        return;
    }
    setFieldValue(field, getFieldType(field), defaultValues[field_id]);
}

$(function() {
    $('.restore-default, .set-value').each(function() {
        var link = $(this);
        // inline-block for IE so opacity inheritance works
        link.css('display', 'inline-block').css('opacity', 0.25);
        if (!link.hasClass('restore-default')) {
            // restore-default is handled by markField
        	link.css('display', '');
        }
        link.bind({
            mouseenter: function() {$(this).css('opacity', 1);},
            mouseleave: function() {$(this).css('opacity', 0.25);},
            click: function(e) {
                e.preventDefault();
                var href = $(this).attr('href').substr(1);
                var field_id;
                if ($(this).hasClass('restore-default')) {
                    field_id = href;
                    restoreField(field_id);
                } else {
                    field_id = href.match(/^[^=]+/)[0];
                    var value = href.match(/=(.+)$/)[1];
                    setFieldValue($('#'+field_id), 'text', value);
                }
                $('#'+field_id).trigger('change');
            }
        });
    });
});

//
// END: "Restore default" and "set value" buttons
// ------------------------------------------------------------------

// ------------------------------------------------------------------
// User preferences import/export
//

$(function() {
    var radios = $('#import_local_storage, #export_local_storage');
    if (!radios.length) {
        return;
    }

    // enable JavaScript dependent fields
    radios
        .attr('disabled', false)
        .add('#export_text_file, #import_text_file')
        .click(function(){
            var show_id = $(this).attr('id');
            var hide_id = show_id.match(/local_storage$/)
                ? show_id.replace(/local_storage$/, 'text_file')
                : show_id.replace(/text_file$/, 'local_storage');
        $('#opts_'+hide_id).hide('fast');
        $('#opts_'+show_id).show('fast');
    });

    // detect localStorage state
    var ls_supported = window.localStorage || false;
    var ls_exists = ls_supported ? (window.localStorage['config'] || false) : false;
    $('.localStorage-'+(ls_supported ? 'un' : '')+'supported').hide();
    $('.localStorage-'+(ls_exists ? 'empty' : 'exists')).hide();
    if (ls_exists) {
        updatePrefsDate();
    }
    $('form.prefs-form').change(function(){
        var form = $(this);
        var disabled = false;
        if (!ls_supported) {
            disabled = form.find('input[type=radio][value$=local_storage]').attr('checked');
        } else if (!ls_exists && form.attr('name') == 'prefs_import'
                && $('#import_local_storage')[0].checked) {
            disabled = true;
        }
        form.find('input[type=submit]').attr('disabled', disabled);
    }).submit(function(e) {
        var form = $(this);
        if (form.attr('name') == 'prefs_export' && $('#export_local_storage')[0].checked) {
            e.preventDefault();
            // use AJAX to read JSON settings and save them
            savePrefsToLocalStorage(form);
        } else if (form.attr('name') == 'prefs_import' && $('#import_local_storage')[0].checked) {
            // set 'json' input and submit form
            form.find('input[name=json]').val(window.localStorage['config']);
        }
    });
});

/**
 * Saves user preferences to localStorage
 *
 * @param {Element} form
 */
function savePrefsToLocalStorage(form)
{
    form = $(form);
    var submit = form.find('input[type=submit]');
    //PMA_messages['strPrefsSaved']
    submit.attr('disabled', true);
    $.ajax({
        url: 'prefs_manage.php',
        cache: false,
        type: 'POST',
        data: {
            token: form.find('input[name=token]').val(),
            submit_get_json: true
        },
        success: function(response) {
            window.localStorage['config'] = response.prefs;
            window.localStorage['config_mtime'] = response.mtime;
            window.localStorage['config_mtime_local'] = (new Date()).toUTCString();
            updatePrefsDate();
            $('.localStorage-empty').hide();
            $('.localStorage-exists').show();
        },
        complete: function() {
            submit.attr('disabled', false);
        }
    });
}

/**
 * Updates preferences timestamp in Import form
 */
function updatePrefsDate()
{
    var d = new Date(window.localStorage['config_mtime_local']);
    var msg = PMA_messages['strSavedOn'].replace('__DATE__', formatDate(d));
    $('#opts_import_local_storage .localStorage-exists').html(msg);
}

/**
 * Returns date formatted as YYYY-MM-DD HH:II
 *
 * @param {Date} d
 */
function formatDate(d)
{
    return d.getFullYear() + '-'
        + (d.getMonth() < 10 ? '0'+d.getMonth() : d.getMonth())
        + '-' + (d.getDay() < 10 ? '0'+d.getDay() : d.getDay())
        + ' ' + (d.getHours() < 10 ? '0'+d.getHours() : d.getHours())
        + ':' + (d.getMinutes() < 10 ? '0'+d.getMinutes() : d.getMinutes());
}

//
// END: User preferences import/export
// ------------------------------------------------------------------