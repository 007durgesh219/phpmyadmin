<?php
/* $Id$ */

// Hindi translation
// 1st release   :   by Girish Nair <girishn@nagpur.dot.net.in>


$charset = 'utf-8';
$allow_recoding = TRUE;
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Tera, Peta, Exa
//$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
$byteUnits = array(' बैट्स', ' केबी', ' एमबी', ' जीबी','टीबी','पीबी','ईबी');

$day_of_week = array('रवी', 'सोम', 'मन्गल', 'बुध', 'गुरु', 'शुक्र', 'शनि');
$month = array('जनवरी', 'फरवरी', 'मार्च', 'अप्रैल', 'मई', 'जून', 'जुलाई', 'अगस्त', ' सितम्बर', 'अक्तूबर', 'नवम्बर', 'दिसमबर');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d %B, %Y को %I:%M %p';


$strAccessDenied = 'प्रवेश निषेध';
$strAction = ' कार्य';
$strAddNewField = 'नया फील्ड जोडो';
$strAddPriv = 'नया प्रिविलेज जोडो';
$strAddPrivMessage = 'आपने नया प्रिविलेज जोड लिया ।';
$strAddUser = 'नया यूसर बनाओ';
$strAddUserMessage = 'आपने नया यूसर बना लिया ।';
$strAfter = '%s के बाद में';
$strAfterInsertBack = 'पिछले पृष्ट पर वापस जाओ';
$strAfterInsertNewInsert = 'अगला नया रौ जोडे';
$strAll = 'सभी';
$strAnd = 'और';
$strAny = 'कोई';
$strAnyColumn = 'कोई भी कोलम';
$strAnyDatabase = 'कोई भी  डाटाबेस';
$strAnyHost = 'कोई भी  होस्ट';
$strAnyTable = 'कोई भी  टेबल';
$strAnyUser = 'कोई भी  यूसर';
$strAtBeginningOfTable = 'टेबल के शुरू  में';
$strAtEndOfTable = 'टेबल के आखिर में';
$strAttr = ' विशेषता';

$strBack = 'वापस';
$strBookmarkLabel = 'लेबल';

$strChange = 'बदलिये';
$strCheckAll = 'सभी को चेक करें';
$strCheckDbPriv = 'डाटाबेस   प्रिविलेजस  को चेक करें';
$strCheckTable = 'टेबल  को चेक करें';
$strColumn = 'कोलम';
$strColumnNames = 'कोलम के नाम';
$strComments = ' टिप्पणी';
$strCreate = 'बनाइये';
$strCreateNewDatabase = ' नया डाटाबेस बनाओ';
$strCreateNewTable = ' डाटाबेस मे नया टेबल बनाओ';

$strData = ' डाटा';
$strDatabase = ' डाटाबेस';
$strDatabaseHasBeenDropped = 'डाटाबेस %s को ड्रोप कर दिया ।';
$strDatabases = ' डाटाबेस';
$strDatabasesStats = ' डाटाबेसों के आँकडे';
$strDataOnly = 'केवल डाटा';
$strDelete = 'डिलीट';
$strDrop = ' ड्रोप';

$strEdit = 'एडिट';
$strEditPDFPages = 'PDF पेज एडिट करें';
$strEditPrivileges = ' प्रिविलेज एडिट करें';
$strEmpty = 'खाली';
$strExtra = ' अतिरिक्त';

$strGrants = 'ग्रान्टस';

$strHome = 'होम';
$strHomepageOfficial = 'phpMyAdmin का आधिकारिक होमपेज';
$strHost = 'होस्ट';

$strLogin = 'लोगिन';
$strLogout = 'लोग औट';
$strLogPassword = 'पासव्रड:';
$strLogUsername = 'यूसरनेम:';

$strMySQLShowProcess = 'प्रोसेस दिखाओ';
$strMySQLShowStatus = 'MySQL के runtime जानकारी  दिखाओ';
$strMySQLShowVars = 'MySQL के  system variables दिखाओ';

$strName = 'नाम';
$strNext = 'अगला';
$strNo = 'नहीं';

$strOr = 'अथवा';

$strShowPHPInfo = 'PHP कि जानकारी  दिखाओ';
$strSum = 'जोड';

$strTable = ' टेबल ';

$strUser = 'यूसर';
$strUserName = 'यूसर नेम';
$strUsers = 'यूसरस';
$strUseTables = 'टेबल का उपयोग करो';

$strValue = 'मूल्य';

$strWelcome = ' %s मे स्वागत है';

$strYes = 'हाँ';


// To translate
$strAddDeleteColumn = 'Add/Delete Field Columns';
$strAddDeleteRow = 'Add/Delete Criteria Row';
$strAddSearchConditions = 'Add search conditions (body of the "where" clause):';
$strAddToIndex = 'Add to index &nbsp;%s&nbsp;column(s)';
$strAffectedRows = 'Affected rows:';
$strAllTableSameWidth = 'display all Tables with same width?';
$strAlterOrderBy = 'Alter table order by';
$strAnalyzeTable = 'Analyze table';
$strAnIndex = 'An index has been added on %s';
$strAPrimaryKey = 'A primary key has been added on %s';
$strAscending = 'Ascending';

$strBeginCut = 'BEGIN CUT';
$strBeginRaw = 'BEGIN RAW';
$strBinary = 'Binary';
$strBinaryDoNotEdit = 'Binary - do not edit';
$strBookmarkDeleted = 'The bookmark has been deleted.';
$strBookmarkQuery = 'Bookmarked SQL-query';
$strBookmarkThis = 'Bookmark this SQL-query';
$strBookmarkView = 'View only';
$strBrowse = 'Browse';
$strBzip = '"bzipped"';

$strCantLoadMySQL = 'cannot load MySQL extension,<br />please check PHP Configuration.';
$strCantLoadRecodeIconv = 'Can not load iconv or recode extension needed for charset conversion, configure php to allow using these extensions or disable charset conversion in phpMyAdmin.';
$strCantRenameIdxToPrimary = 'Can\'t rename index to PRIMARY!';
$strCantUseRecodeIconv = 'Can not use iconv nor libiconv nor recode_string function while extension reports to be loaded. Check your php configuration.';
$strCardinality = 'Cardinality';
$strCarriage = 'Carriage return: \\r';
$strChangeDisplay = 'Choose Field to display';
$strChangePassword = 'Change password';
$strCharsetOfFile = 'Character set of the file:';
$strChoosePage = 'Please choose a Page to edit';
$strColComFeat = 'Displaying Column Comments';
$strCompleteInserts = 'Complete inserts';
$strConfigFileError = 'phpMyAdmin was unable to read your configuration file!<br />This might happen if php finds a parse error in it or php cannot find the file.<br />Please call the configuration file directly using the link below and read the php error message(s) that you recieve. In most cases a quote or a semicolon is missing somewhere.<br />If you recieve a blank page, everything is fine.';
$strConfigureTableCoord = 'Please configure the coordinates for table %s';
$strConfirm = 'Do you really want to do it?';
$strCookiesRequired = 'Cookies must be enabled past this point.';
$strCopyTable = 'Copy table to (database<b>.</b>table):';
$strCopyTableOK = 'Table %s has been copied to %s.';
$strCreateIndex = 'Create an index on&nbsp;%s&nbsp;columns';
$strCreateIndexTopic = 'Create a new index';
$strCreatePage = 'Create a new Page';
$strCreatePdfFeat = 'Creation of PDFs';
$strCriteria = 'Criteria';

$strDatabaseWildcard = 'Database (wildcards allowed):';
$strDefault = 'Default';
$strDeleted = 'The row has been deleted';
$strDeletedRows = 'Deleted rows:';
$strDeleteFailed = 'Deleted Failed!';
$strDeleteUserMessage = 'You have deleted the user %s.';
$strDescending = 'Descending';
$strDisabled = 'Disabled';
$strDisplay = 'Display';
$strDisplayFeat = 'Display Features';
$strDisplayOrder = 'Display order:';
$strDisplayPDF = 'Display PDF schema';
$strDoAQuery = 'Do a "query by example" (wildcard: "%")';
$strDocu = 'Documentation';
$strDoYouReally = 'Do you really want to ';
$strDropDB = 'Drop database %s';
$strDropTable = 'Drop table';
$strDumpingData = 'Dumping data for table';
$strDumpXRows = 'Dump %s row(s) starting at record # %s.';
$strDynamic = 'dynamic';

$strEffective = 'Effective';
$strEmptyResultSet = 'MySQL returned an empty result set (i.e. zero rows).';
$strEnabled = 'Enabled';
$strEnd = 'End';
$strEndCut = 'END CUT';
$strEndRaw = 'END RAW';
$strEnglishPrivileges = ' Note: MySQL privilege names are expressed in English ';
$strExplain = 'Explain SQL';
$strError = 'Error';
$strExport = 'Export';
$strExportToXML = 'Export to XML format';
$strExtendedInserts = 'Extended inserts';

$strField = 'Field';
$strFieldHasBeenDropped = 'Field %s has been dropped';
$strFields = 'Fields';
$strFieldsEmpty = ' The field count is empty! ';
$strFieldsEnclosedBy = 'Fields enclosed by';
$strFieldsEscapedBy = 'Fields escaped by';
$strFieldsTerminatedBy = 'Fields terminated by';
$strFixed = 'fixed';
$strFlushTable = 'Flush the table ("FLUSH")';
$strFormat = 'Format';
$strFormEmpty = 'Missing value in the form !';
$strFullText = 'Full Texts';
$strFunction = 'Function';

$strGeneralRelationFeat = 'General relation features';
$strGenTime = 'Generation Time';
$strGenBy = 'Generated by';
$strGo = 'Go';
$strGzip = '"gzipped"';

$strHasBeenAltered = 'has been altered.';
$strHasBeenCreated = 'has been created.';
$strHaveToShow = 'You have to choose at least one Column to display';

$strHomepageSourceforge = 'Sourceforge phpMyAdmin Download Page';
$strHostEmpty = 'The host name is empty!';

$strIdxFulltext = 'Fulltext';
$strIfYouWish = 'If you wish to load only some of a table\'s columns, specify a comma separated field list.';
$strIgnore = 'Ignore';
$strIndex = 'Index';
$strIndexes = 'Indexes';
$strIndexHasBeenDropped = 'Index %s has been dropped';
$strIndexName = 'Index name&nbsp;:';
$strIndexType = 'Index type&nbsp;:';
$strInsert = 'Insert';
$strInsertAsNewRow = 'Insert as a new row';
$strInsertedRows = 'Inserted rows:';
$strInsertNewRow = 'Insert new row';
$strInsertTextfiles = 'Insert data from a textfile into table';
$strInstructions = 'Instructions';
$strInUse = 'in use';
$strInvalidName = '"%s" is a reserved word, you can\'t use it as a database/table/field name.';

$strKeepPass = 'Do not change the password';
$strKeyname = 'Keyname';
$strKill = 'Kill';

$strLength = 'Length';
$strLengthSet = 'Length/Values*';
$strLimitNumRows = 'Number of rows per page';
$strLineFeed = 'Linefeed: \\n';
$strLines = 'Lines';
$strLinesTerminatedBy = 'Lines terminated by';
$strLinkNotFound = 'Link not found';
$strLinksTo = 'Links to';
$strLocationTextfile = 'Location of the textfile';

$strMissingBracket = 'Missing Bracket';
$strModifications = 'Modifications have been saved';
$strModify = 'Modify';
$strModifyIndexTopic = 'Modify an index';
$strMoveTable = 'Move table to (database<b>.</b>table):';
$strMoveTableOK = 'Table %s has been moved to %s.';
$strMySQLCharset = 'MySQL charset';
$strMySQLReloaded = 'MySQL reloaded.';
$strMySQLSaid = 'MySQL said: ';
$strMySQLServerProcess = 'MySQL %pma_s1% running on %pma_s2% as %pma_s3%';

$strNoDatabases = 'No databases';
$strNoDescription = 'no Description';
$strNoDropDatabases = '"DROP DATABASE" statements are disabled.';
$strNoExplain = 'Skip Explain SQL';
$strNoFrames = 'phpMyAdmin is more friendly with a <b>frames-capable</b> browser.';
$strNoIndex = 'No index defined!';
$strNoIndexPartsDefined = 'No index parts defined!';
$strNoModification = 'No change';
$strNone = 'None';
$strNoPassword = 'No Password';
$strNoPhp = 'Without PHP Code';
$strNoPrivileges = 'No Privileges';
$strNoQuery = 'No SQL query!';
$strNoRights = 'You don\'t have enough rights to be here right now!';
$strNoTablesFound = 'No tables found in database.';
$strNotNumber = 'This is not a number!';
$strNotOK = 'not OK';
$strNotSet = '<b>%s</b> table not found or not set in %s';
$strNotValidNumber = ' is not a valid row number!';
$strNoUsersFound = 'No user(s) found.';
$strNoValidateSQL = 'Skip Validate SQL';
$strNull = 'Null';
$strNumSearchResultsInTable = '%s match(es) inside table <i>%s</i>';
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> match(es)';

$strOftenQuotation = 'Often quotation marks. OPTIONALLY means that only char and varchar fields are enclosed by the "enclosed by"-character.';
$strOK = 'OK';
$strOperations = 'Operations';
$strOptimizeTable = 'Optimize table';
$strOptionalControls = 'Optional. Controls how to write or read special characters.';
$strOptionally = 'OPTIONALLY';
$strOptions = 'Options';
$strOverhead = 'Overhead';

$strPageNumber = 'Page number:';
$strPartialText = 'Partial Texts';
$strPassword = 'Password';
$strPasswordEmpty = 'The password is empty!';
$strPasswordNotSame = 'The passwords aren\'t the same!';
$strPdfDbSchema = 'Schema of the the "%s" database - Page %s';
$strPdfInvalidPageNum = 'Undefined PDF page number!';
$strPdfInvalidTblName = 'The "%s" table doesn\'t exist!';
$strPdfNoTables = 'No tables';
$strPhp = 'Create PHP Code';
$strPHPVersion = 'PHP Version';
$strPmaDocumentation = 'phpMyAdmin documentation';
$strPmaUriError = 'The <tt>$cfg[\'PmaAbsoluteUri\']</tt> directive MUST be set in your configuration file!';
$strPos1 = 'Begin';
$strPrevious = 'Previous';
$strPrimary = 'Primary';
$strPrimaryKey = 'Primary key';
$strPrimaryKeyHasBeenDropped = 'The primary key has been dropped';
$strPrimaryKeyName = 'The name of the primary key must be... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>must</b> be the name of and <b>only of</b> a primary key!)';
$strPrintView = 'Print view';
$strPrivileges = 'Privileges';
$strProperties = 'Properties';

$strQBE = 'Query';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = 'SQL-query on database <b>%s</b>:';

$strRecords = 'Records';
$strReferentialIntegrity = 'Check referential integrity:';
$strRelationNotWorking = 'The additional Features for working with linked Tables have been deactivated. To find out why click %shere%s.';
$strRelationView = 'Relation view';
$strReloadFailed = 'MySQL reload failed.';
$strReloadMySQL = 'Reload MySQL';
$strRememberReload = 'Remember reload the server.';
$strRenameTable = 'Rename table to';
$strRenameTableOK = 'Table %s has been renamed to %s';
$strRepairTable = 'Repair table';
$strReplace = 'Replace';
$strReplaceTable = 'Replace table data with file';
$strReset = 'Reset';
$strReType = 'Re-type';
$strRevoke = 'Revoke';
$strRevokeGrant = 'Revoke Grant';
$strRevokeGrantMessage = 'You have revoked the Grant privilege for %s';
$strRevokeMessage = 'You have revoked the privileges for %s';
$strRevokePriv = 'Revoke Privileges';
$strRowLength = 'Row length';
$strRows = 'Rows';
$strRowsFrom = 'row(s) starting from record #';
$strRowSize = ' Row size ';
$strRowsModeHorizontal = 'horizontal';
$strRowsModeOptions = 'in %s mode and repeat headers after %s cells';
$strRowsModeVertical = 'vertical';
$strRowsStatistic = 'Row Statistic';
$strRunning = 'running on %s';
$strRunQuery = 'Submit Query';
$strRunSQLQuery = 'Run SQL query/queries on database %s';

$strSave = 'Save';
$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';
$strSearch = 'Search';
$strSearchFormTitle = 'Search in database';
$strSearchInTables = 'Inside table(s):';
$strSearchNeedle = 'Word(s) or value(s) to search for (wildcard: "%"):';
$strSearchOption1 = 'at least one of the words';
$strSearchOption2 = 'all words';
$strSearchOption3 = 'the exact phrase';
$strSearchOption4 = 'as regular expression';
$strSearchResultsFor = 'Search results for "<i>%s</i>" %s:';
$strSearchType = 'Find:';
$strSelect = 'Select';
$strSelectADb = 'Please select a database';
$strSelectAll = 'Select All';
$strSelectFields = 'Select fields (at least one):';
$strSelectNumRows = 'in query';
$strSelectTables = 'Select Tables';
$strSend = 'Save as file';
$strServerChoice = 'Server Choice';
$strServerVersion = 'Server version';
$strSetEnumVal = 'If field type is "enum" or "set", please enter the values using this format: \'a\',\'b\',\'c\'...<br />If you ever need to put a backslash ("\") or a single quote ("\'") amongst those values, backslashes it (for example \'\\\\xyz\' or \'a\\\'b\').';
$strShow = 'Show';
$strShowAll = 'Show all';
$strShowColor = 'Show color';
$strShowCols = 'Show columns';
$strShowGrid = 'Show grid';
$strShowingRecords = 'Showing rows';
$strShowTableDimension = 'Show dimension of tables';
$strShowTables = 'Show tables';
$strShowThisQuery = ' Show this query here again ';
$strSingly = '(singly)';
$strSize = 'Size';
$strSort = 'Sort';
$strSpaceUsage = 'Space usage';
$strSplitWordsWithSpace = 'Words are separated by a space character (" ").';
$strSQL = 'SQL';
$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';
$strSQLQuery = 'SQL-query';
$strSQLResult = 'SQL result';
$strSQPBugInvalidIdentifer = 'Invalid Identifer';
$strSQPBugUnclosedQuote = 'Unclosed quote';
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';
$strStatement = 'Statements';
$strStrucCSV = 'CSV data';
$strStrucData = 'Structure and data';
$strStrucDrop = 'Add \'drop table\'';
$strStrucExcelCSV = 'CSV for Ms Excel data';
$strStrucOnly = 'Structure only';
$strStructPropose = 'Propose table structure';
$strStructure = 'Structure';
$strSubmit = 'Submit';
$strSuccess = 'Your SQL-query has been executed successfully';

$strTableComments = 'Table comments';
$strTableEmpty = 'The table name is empty!';
$strTableHasBeenDropped = 'Table %s has been dropped';
$strTableHasBeenEmptied = 'Table %s has been emptied';
$strTableHasBeenFlushed = 'Table %s has been flushed';
$strTableMaintenance = 'Table maintenance';
$strTables = '%s table(s)';
$strTableStructure = 'Table structure for table';
$strTableType = 'Table type';
$strTextAreaLength = ' Because of its length,<br /> this field might not be editable ';
$strTheContent = 'The content of your file has been inserted.';
$strTheContents = 'The contents of the file replaces the contents of the selected table for rows with identical primary or unique key.';
$strTheTerminator = 'The terminator of the fields.';
$strTotal = 'total';
$strType = 'Type';

$strUncheckAll = 'Uncheck All';
$strUnique = 'Unique';
$strUnselectAll = 'Unselect All';
$strUpdatePrivMessage = 'You have updated the privileges for %s.';
$strUpdateProfile = 'Update profile:';
$strUpdateProfileMessage = 'The profile has been updated.';
$strUpdateQuery = 'Update Query';
$strUsage = 'Usage';
$strUseBackquotes = 'Enclose table and field names with backquotes';
$strUserEmpty = 'The user name is empty!';

$strValidateSQL = 'Validate SQL';
$strViewDump = 'View dump (schema) of table';
$strViewDumpDB = 'View dump (schema) of database';

$strWithChecked = 'With selected:';
$strWrongUser = 'Wrong username/password. Access denied.';

$strZip = '"zipped"';
?>
