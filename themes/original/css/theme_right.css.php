/* Always enabled stylesheets (right frame) */
body {
    margin: 0.5em;
    padding: 0;
    font-family: <?php echo $right_font_family; ?>;
    color: #000000;
    <?php
    if ($GLOBALS['cfg']['RightBgImage'] == '') {
        // calls from a css file are relative to itself, so use ../images
        echo '    background-image: url(../themes/original/img/vertical_line.png);' . "\n"
           . '    background-repeat: repeat-y;' . "\n";
    } else {
        echo '    background-image: url(' . $GLOBALS['cfg']['RightBgImage'] . ');' . "\n";
    } // end if... else...
    ?>
    background-color: <?php echo $GLOBALS['cfg']['RightBgColor'] . "\n"; ?>
}


/* querywindow */
body#bodyquerywindow {
    margin: 0;
    padding: 0;
    background-image: none;
    background-color: <?php echo $GLOBALS['cfg']['RightBgColor'] . "\n"; ?>
}

div#querywindowcontainer {
    margin: 0;
    padding: 0;
    width: 100%;
}

div#querywindowcontainer fieldset {
    margin-top: 0;
}
/* END querywindow */


/* querybox */

div#sqlquerycontainer {
    float: left;
    width: 69%;
    /* height: 15em; */
}

div#tablefieldscontainer  {
    float: right;
    width: 29%;
    /* height: 15em; */
}

div#tablefieldscontainer select  {
    width: 100%;
    /* height: 12em; */
}

textarea#sqlquery {
    width: 100%;
    /* height: 100%; */
}

div#queryboxcontainer div#bookmarkoptions {
    margin-top: 0.5em;
}
/* end querybox */


th              {font-family: <?php echo $right_font_family; ?>;  font-weight: bold; color: #000000; background-color: <?php echo $GLOBALS['cfg']['ThBgcolor']; ?>}
td              {font-family: <?php echo $right_font_family; ?>; }
form {
    font-family: <?php echo $right_font_family; ?>;
    padding: 0;
    margin: 0;
    display: inline;
}
input           {font-family: <?php echo $right_font_family; ?>; }
input.textfield {font-family: <?php echo $right_font_family; ?>;  color: #000000; background-color: #FFFFFF}
select          {font-family: <?php echo $right_font_family; ?>;  color: #000000; background-color: #FFFFFF}
textarea        {font-family: <?php echo $right_font_family; ?>;  color: #000000; background-color: #FFFFFF}
h1              {font-family: <?php echo $right_font_family; ?>; font-size: 140%; font-weight: bold}
h2              {font-family: <?php echo $right_font_family; ?>; font-size: 120%; font-weight: bold}
h3              {font-family: <?php echo $right_font_family; ?>;  font-weight: bold}
a:link          {font-family: <?php echo $right_font_family; ?>;  text-decoration: none; color: #0000FF}
a:visited       {font-family: <?php echo $right_font_family; ?>;  text-decoration: none; color: #0000FF}
a:hover         {font-family: <?php echo $right_font_family; ?>;  text-decoration: underline; color: #FF0000}
dfn             {font-style: normal}
dfn:hover       {font-style: normal; cursor: help}

a img {
    border: 0;
}

hr {
    color: #666666;
    background-color: #666666;
    border: 0;
    height: 1px;
}


fieldset        {
    margin-top: 1em;
    border:     #686868 solid 1px;
    padding:    0.5em;
    background-color: <?php echo $GLOBALS['cfg']['BgcolorOne']; ?>;
}
fieldset fieldset {
    margin:     0.8em;
}
fieldset.tblFooters {
    margin-top: 0;
    margin-bottom: 0.5em;
    text-align: right;
    float: none;
    clear: both;
}
fieldset .formelement {
    line-height: 2.4em;
    float: left;
    margin-right: 0.5em;
    /* IE */
    white-space: nowrap;
}
/* revert for Gecko */
fieldset div[class=formelement] {
    white-space: normal;
}
fieldset legend {
    background-color: transparent;
}

/* buttons in some browsers (eg. Konqueror) are block elements, this breaks design */
button { display: inline; }

/* Textarea */
textarea { overflow: auto; }


/* IE */
fieldset .formelement input,
fieldset .formelement select {
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}
/* revert for Gecko */
fieldset div[class=formelement] input,
fieldset div[class=formelement] select {
    margin-top: auto;
    margin-bottom: auto;
    height: auto;
}

button.mult_submit {
    border: none;
    background-color: transparent;
}


/* data tables */
table caption,
table th,
table td {
    padding: 0.1em 0.5em 0.1em 0.5em;
    margin: 0;
    margin: 0.1em;
    vertical-align: top;
}

/* odd table rows 1,3,5,7,... */
table tr.odd th,
table tr.odd {
    background-color: <?php echo $GLOBALS['cfg']['BgcolorOne']; ?>;
    text-align: left;
}

/* even table rows 2,4,6,8,... */
table tr.even th,
table tr.even {
    background-color: <?php echo $GLOBALS['cfg']['BgcolorTwo']; ?>;
    text-align: left;
}

/* marked tbale rows */
table tr.marked th,
table tr.marked {
    background-color: <?php echo $GLOBALS['cfg']['BrowseMarkerColor']; ?>;
}

/* hovered table rows */
table tr.odd:hover,
table tr.even:hover,
table tr.odd:hover th,
table tr.even:hover th,
table tr.hover th,
table tr.hover {
    background-color: <?php echo $GLOBALS['cfg']['BrowsePointerColor']; ?>;
}

table .value {
    text-align: right;
    white-space: nowrap;
}
/* IE doesnt handles 'pre' right */
table [class=value] {
    white-space: pre;
}

.value {
    font-family: "Courier New", Courier, monospace;
}
.value .attention {
    color: red;
    font-weight: bold;
}
.value .allfine {
    color: green;
}


img.lightbulb {
    cursor: pointer;
}


.pdflayout {
    overflow:         hidden;
    clip:             inherit;
    background-color: #FFFFFF;
    display:          none;
    border:           1px solid #000000;
    position:         relative;
}

.pdflayout_table {
    background:       <?php echo $GLOBALS['cfg']['ThBgcolor']; ?>;
    color:            #000000;
    overflow:         hidden;
    clip:             inherit;
    z-index:          2;
    display:          inline;
    visibility:       inherit;
    cursor:           move;
    position:         absolute;
    font-size:        80%;
    border:           1px dashed #000000;
}

.print{font-family:arial;font-size:8pt;}

/* MySQL Parser */
.syntax {font-family: sans-serif; font-size: 80%;}
.syntax_comment            { padding-left: 4pt; padding-right: 4pt;}
.syntax_digit              {}
.syntax_digit_hex          {}
.syntax_digit_integer      {}
.syntax_digit_float        {}
.syntax_punct              {}
.syntax_alpha              {}
.syntax_alpha_columnType   {text-transform: uppercase;}
.syntax_alpha_columnAttrib {text-transform: uppercase;}
.syntax_alpha_reservedWord {text-transform: uppercase; font-weight: bold;}
.syntax_alpha_functionName {text-transform: uppercase;}
.syntax_alpha_identifier   {}
.syntax_alpha_charset      {}
.syntax_alpha_variable     {}
.syntax_quote              {white-space: pre;}
.syntax_quote_backtick     {}


/* leave some space between icons and text */
.icon {
    vertical-align: middle;
    margin-right: 0.3em;
    margin-left: 0.3em;
}
/* no extra space in table cells */
td .icon {
    margin: 0;
}

.selectallarrow {
    margin-<?php echo $right; ?>: 0.3em;
    margin-<?php echo $left; ?>: 0.6em;
}


/* topmenu */
ul#topmenu {
    font-weight: bold;
    list-style-type: none;
    margin: 0;
    padding: 0;
}

ul#topmenu li {
    float: left;
    margin: 0;
    padding: 0;
    vertical-align: middle;
}

#topmenu img {
    vertical-align: middle;
    margin-right: 0.1em;
}

/* default tab styles */
.tab, .tabcaution, .tabactive {
    display: block;
    margin: 0.2em 0.2em 0 0.2em;
    padding: 0.2em 0.2em 0 0.2em;
    white-space: nowrap;
}

/* disabled tabs */
span.tab {
    color: #666666;
}

/* disabled drop/empty tabs */
span.tabcaution {
    color: #ff6666;
}

/* enabled drop/empty tabs */
a.tabcaution {
    color: #FF0000;
}
a.tabcaution:hover {
    color: #FFFFFF;
    background-color: #FF0000;
}

<?php if ( $GLOBALS['cfg']['LightTabs'] ) { ?>
/* active tab */
a.tabactive {
    color: black;
}
<?php } else { ?>
#topmenu {
    margin-top: 0.5em;
    padding: 0.1em 0.3em 0.1em 0.3em;
}

ul#topmenu li {
    border-bottom: 1pt solid black;
}

/* default tab styles */
.tab, .tabcaution, .tabactive {
    background-color: <?php echo $GLOBALS['cfg']['BgcolorOne']; ?>;
    border: 1pt solid <?php echo $GLOBALS['cfg']['BgcolorTwo']; ?>;
    border-bottom: 0;
    border-radius-topleft: 0.4em;
    border-radius-topright: 0.4em;
    -moz-border-radius-topleft: 0.4em;
    -moz-border-radius-topright: 0.4em;
}

/* enabled hover/active tabs */
a.tab:hover, a.tabcaution:hover, .tabactive, .tabactive:hover {
    margin: 0;
    padding: 0.2em 0.4em 0.2em 0.4em;
    text-decoration: none;
}

a.tab:hover, .tabactive {
    background-color: <?php echo $GLOBALS['cfg']['BgcolorTwo']; ?>;
}

/* disabled drop/empty tabs */
span.tab, span.tabcaution {
    cursor: url(themes/original/img/error.ico), url(../themes/original/img/error.ico), default;
}
<?php } ?>
/* end topmenu */


#fieldsetexport #exportoptions {
    float: left;
}


/* Calendar */
table.calendar      { width: 100%; }
table.calendar td   { text-align: center; }
table.calendar td a { display: block; }

table.calendar td a:hover {
    background-color: <?php echo $GLOBALS['cfg']['BrowsePointerColor']; ?>;
}

table.calendar th {
    background-color: <?php echo $GLOBALS['cfg']['ThBgcolor']; ?>;
}

table.calendar td.selected {
    background-color: <?php echo $GLOBALS['cfg']['BrowseMarkerColor']; ?>;
}

img.calendar { border: none; }
form.clock   { text-align: center; }
/* end Calendar */


/* table stats */
div#tablestatistics {
    border-bottom: 0.1em solid #669999;
    margin-bottom: 0.5em;
    padding-bottom: 0.5em;
}

div#tablestatistics table {
    float: left;
    margin-bottom: 0.5em;
    margin-right: 0.5em;
}

div#tablestatistics table caption {
    margin-right: 0.5em;
}
/* END tabel stats */


/* server privileges */
#tableuserrights td,
#tablespecificuserrights td,
#tabledatabases td {
    vertical-align: middle;
}
/* END server privileges */


/* message boxes: warning, error, confirmation */
.notice {
    color: #000000;
    background-color: #FFFFDD;
}
h1.notice,
div.notice {
    margin: 0.5em 0 0.5em 0;
    border: 0.1em solid #FFD700;
    <?php if ( $GLOBALS['cfg']['ErrorIconic'] ) { ?>
    background-image: url(../themes/original/img/s_notice.png);
    background-repeat: no-repeat;
        <?php if ( $GLOBALS['text_dir'] === 'ltr' ) {?>
    background-position: 10px 50%;
    padding: 10px 10px 10px 36px;
        <?php } else {?>
    background-position: 99% 50%;
    padding: 10px 5% 10px 10px;
        <?php }?>
    <?php } else {?>
    padding: 0.5em;
    <?php }?>
}
.notice h1 {
    border-bottom: 0.1em solid #FFD700;
    font-weight: bold;
    text-align: <?php echo $left; ?>;
    margin: 0 0 0.2em 0;
}

.warning {
    color: #CC0000;
    background-color: #FFFFCC;
}
h1.warning,
div.warning {
    margin: 0.5em 0 0.5em 0;
    border: 0.1em solid #CC0000;
    <?php if ( $GLOBALS['cfg']['ErrorIconic'] ) { ?>
    background-image: url(../themes/original/img/s_warn.png);
    background-repeat: no-repeat;
        <?php if ( $GLOBALS['text_dir'] === 'ltr' ) {?>
    background-position: 10px 50%;
    padding: 10px 10px 10px 36px;
        <?php } else {?>
    background-position: 99% 50%;
    padding: 10px 5% 10px 10px;
        <?php }?>
    <?php } else {?>
    padding: 0.5em;
    <?php }?>
}
.warning h1 {
    border-bottom: 0.1em solid #cc0000;
    font-weight: bold;
    text-align: <?php echo $left; ?>;
    margin: 0 0 0.2em 0;
}

.error {
    background-color: #FFFFCC;
    color: #ff0000;
}
h1.error,
div.error {
    margin: 0.5em 0 0.5em 0;
    border: 0.1em solid #ff0000;
    <?php if ( $GLOBALS['cfg']['ErrorIconic'] ) { ?>
    background-image: url(../themes/original/img/s_error.png);
    background-repeat: no-repeat;
        <?php if ( $GLOBALS['text_dir'] === 'ltr' ) {?>
    background-position: 10px 50%;
    padding: 10px 10px 10px 36px;
        <?php } else {?>
    background-position: 99% 50%;
    padding: 10px 5% 10px 10px;
        <?php }?>
    <?php } else {?>
    padding: 0.5em;
    <?php }?>
}
div.error h1 {
    border-bottom: 0.1em solid #ff0000;
    font-weight: bold;
    text-align: <?php echo $left; ?>;
    margin: 0 0 0.2em 0;
}


.confirmation {
    background-color: #FFFFCC;
}
fieldset.confirmation {
    border: 0.1em solid #FF0000;
}
fieldset.confirmation legend {
    border-left: 0.1em solid #FF0000;
    border-right: 0.1em solid #FF0000;
    font-weight: bold;
    <?php if ( $GLOBALS['cfg']['ErrorIconic'] ) { ?>
    background-image: url(../themes/original/img/s_really.png);
    background-repeat: no-repeat;
        <?php if ( $GLOBALS['text_dir'] === 'ltr' ) {?>
    background-position: 5px 50%;
    padding: 0.2em 0.2em 0.2em 25px;
        <?php } else {?>
    background-position: 97% 50%;
    padding: 0.2em 25px 0.2em 0.2em;
        <?php }?>
    <?php }?>
}
/* end messageboxes */


.tblcomment     {font-size: 70%; font-weight: normal; color: #000099; }

.tblHeaders {
    background-color: <?php echo $cfg['LeftBgColor']; ?>;
    font-weight: bold;
    color: #000000;
}
.tblFooters {
    background-color: <?php echo $cfg['LeftBgColor']; ?>;
    font-weight: normal;
    color: #000000;
}
.tblHeaders a:link,
.tblHeaders a:active,
.tblHeaders a:visited,
.tblFooters a:link,
.tblFooters a:active,
.tblFooters a:visited {
    color: #0000FF;
}
.tblHeaders a:hover,
.tblFooters a:hover {
    color: #FF0000;
}

/* forbidden, no privilegs */
.noPrivileges{
    color: #FF0000;
    font-weight: bold;
}

/* Heading */

img, input, select, button {
    vertical-align: middle;
}

#serverinfo {
    font-weight: bold;
    margin-bottom: 0.5em;
}

#serverinfo .item {
    white-space: nowrap;
}

#span_table_comment {
    font-weight: normal;
    font-style: italic;
    white-space: nowrap;
}

#serverinfo img {
    margin: 0 0.1em 0 0.2em;
}


/* disabled text */
.disabled, .disabled a:link, disabled a:active, .disabled a:visited {
    font-family: <?php echo $right_font_family; ?>;
    color:       #666666;
}
.disabled a:hover {
    text-decoration: none;
}
tr.disabled td, td.disabled {
    background-color: #cccccc;
}

#textSQLDUMP {
    width: 95%;
    height: 95%;
    font-family: "Courier New", Courier, mono;
    font-size:   12px;
}

#TooltipContainer {
    position:   absolute;
    z-index:    99;
    width:      20em;
    height:     auto;
    overflow:   visible;
    visibility: hidden;
    background-color: #ffffcc;
    color:            #006600;
    border:           0.1em solid #000000;
    padding:          0.5em;
    font-family:      <?php echo $right_font_family; ?>;
}


/* user privileges */
#fieldset_add_user_login div.item {
    border-bottom: 1px solid silver;
    padding-bottom: 0.3em;
    margin-bottom: 0.3em;
}

#fieldset_add_user_login label {
    float: left;
    display: block;
    width: 10em;
    max-width: 100%;
    text-align: right;
    padding-right: 0.5em;
}

#fieldset_add_user_login span.options #select_pred_username,
#fieldset_add_user_login span.options #select_pred_hostname,
#fieldset_add_user_login span.options #select_pred_password {
    width: 100%;
    max-width: 100%;
}

#fieldset_add_user_login span.options {
    float: left;
    display: block;
    width: 12em;
    max-width: 100%;
    padding-right: 0.5em;
}

#fieldset_add_user_login input {
    width: 12em;
    clear: right;
    max-width: 100%;
}

#fieldset_add_user_login span.options input {
    width: auto;
}

#fieldset_user_priv div.item {
    float: left;
    width: 9em;
    max-width: 100%;
}

#fieldset_user_priv div.item div.item {
    float: none;
}

#fieldset_user_priv div.item label{
    white-space: nowrap;
}

#fieldset_user_priv div.item select {
    width: 100%;
}

#fieldset_user_global_rights fieldset {
    float: left;
}
/* END user privileges */


/* serverstatus */
div#serverstatus table caption a.top {
    float: right;
}

div#serverstatus div#serverstatusqueriesdetails table,
div#serverstatus table#serverstatustraffic,
div#serverstatus table#serverstatusconnections {
    float: left;
}

#serverstatussection,
.clearfloat {
    clear: both;
}
div#serverstatussection table {
    width: 100%;
    margin-bottom: 1em;
}
div#serverstatussection table .name {
    width: 18em;
}
div#serverstatussection table .value {
    width: 6em;
}

div#serverstatus table tbody td.descr a,
div#serverstatus table .tblFooters a {
    white-space: nowrap;
}
div#serverstatus div#statuslinks a:before,
div#serverstatus div#sectionlinks a:before,
div#serverstatus table tbody td.descr a:before,
div#serverstatus table .tblFooters a:before {
    content: '[';
}
div#serverstatus div#statuslinks a:after,
div#serverstatus div#sectionlinks a:after,
div#serverstatus table tbody td.descr a:after,
div#serverstatus table .tblFooters a:after {
    content: ']';
}
/* end serverstatus */
