<?php
/* $Id$ */

/* Translated by: Yuval "Etus" Sarna */

$charset = 'iso-8859-8-i';
$text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('�����', '���', '�����', '�����', '�����', '����', '���');
$month = array('�����', '������', '���', '�����', '���', '����', '����', '������', '������', '�������', '������', '�����');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';

$strAccessDenied = '����� �����';
$strAction = '�����';
$strAddDeleteColumn = '����/��� ����� ���';
$strAddDeleteRow = '����/��� ���� ��������';
$strAddNewField = '���� ��� ���';
$strAddPriv = '���� ����� ����';
$strAddPrivMessage = '����� ����� ����.';
$strAddSearchConditions = '���� ���� ����� (���� �� "where"):';
$strAddToIndex = '���� ������� &nbsp;%s&nbsp;����/�����';
$strAddUser = '���� ����� ���';
$strAddUserMessage = '����� ����� ���.';
$strAffectedRows = '����� �������:';
$strAfter = '���� %s';
$strAfterInsertBack = '���� ����� �����';
$strAfterInsertNewInsert = '���� ���� ���� �����';
$strAll = '���';
$strAlterOrderBy = '��� �� ��� ����� ��-���';
$strAnalyzeTable = '��� ����';
$strAnd = '���';
$strAnIndex = '������ ������ �- %s';
$strAny = '��';
$strAnyColumn = '�� �����';
$strAnyDatabase = '�� ��� ������';
$strAnyHost = '�� ����';
$strAnyTable = '�� ����';
$strAnyUser = '�� �����';
$strAPrimaryKey = '���� ���� ������ �- %s';
$strAscending = '����';
$strAtBeginningOfTable = '������ ����';
$strAtEndOfTable = '���� ����';
$strAttr = '������';

$strBack = '����';
$strBinary = '������';
$strBinaryDoNotEdit = '������ - �� �����';
$strBookmarkDeleted = '�- Bookmark ����.';
$strBookmarkLabel = '�����';
$strBookmarkQuery = '����� �- SQL ������� �- Bookmark';
$strBookmarkThis = '���� �- Bookmark �� ����� �- SQL ���';
$strBookmarkView = '������ ����';
$strBrowse = '����';
$strBzip = '"BZipped"';

$strCantLoadMySQL = '�� ���� ����� �� ����� �- MySQL,<br />����� ���� �� ����������� �- PHP.';
$strCantRenameIdxToPrimary = '�� ���� ����� �� ������� ������ !';
$strCardinality = 'Cardinality';
$strCarriage = '�� ����� ����: \\r';
$strChange = '���';
$strChangeDisplay = '��� ��� �����';
$strChangePassword = '��� �����';
$strCheckAll = '��� ���';
$strCheckDbPriv = '���� �� ������ ��� �������';
$strCheckTable = '���� ����';
$strChoosePage = '��� ��� ���� ������';
$strColumn = '�����';
$strColumnNames = '���� ������';
$strComments = '�����';
$strCompleteInserts = '���� ������';
$strConfigFileError = 'phpMyAdmin �� ����� ����� �� ���� ������������ ���! ��� �� ���� �� PHP ���� ���� ���� ����� �� �� ��� �� ���� �� �����.<br> ��� ��� ����� ������������ ������ ����� ������ ���� ������ �� ���� �� ����� PHP ����� ����. ���� ������ ��� �� �����-���� ����� ����� �����.<br> �� ���� ���� �� ���, ��� ����.';
$strConfirm = '��� ���� ���� ����� �� ��?';
$strCookiesRequired = '������ ������ ����� ����� ������ ���� ����� ��.';
$strCopyTable = '���� ���� �- (��� ������<b>.</b>����):';
$strCopyTableOK = '����� %s ������ �- %s.';
$strCreate = '���';
$strCreateIndex = '��� ����� �-&nbsp;%s&nbsp;�����';
$strCreateIndexTopic = '��� ����� ���';
$strCreateNewDatabase = '��� ��� ������ ���';
$strCreateNewTable = '��� ���� ���� �� ��� ������� %s';
$strCreatePage = '��� ���� ���';
$strCriteria = '��������';

$strData = '����';
$strDatabase = '��� ������ ';
$strDatabaseHasBeenDropped = '��� ������� %s ����.';
$strDatabases = '���� �������';
$strDatabasesStats = '��������� ��� �������';
$strDatabaseWildcard = '��� ������ (����� ������ ������):';
$strDataOnly = '���� ����';
$strDefault = '����� ����';
$strDelete = '���';
$strDeleted = '����� �����';
$strDeletedRows = '����� ������:';
$strDeleteFailed = '����� ����� !';
$strDeleteUserMessage = '���� �� ������ %s.';
$strDescending = '����';
$strDisplay = '���';
$strDisplayOrder = '��� ����:';
$strDisplayPDF = '��� ���� ������ PDF';
$strDoAQuery = '��� "������ ������" (�� ����: "%")';
$strDocu = '�����';
$strDoYouReally = '��� ��� ���� ���� ���� ';
$strDrop = '���';
$strDropDB = '��� ��� ������ %s';
$strDropTable = '��� ����';
$strDumpingData = '���� ���� �����';
$strDynamic = '������';

$strEdit = '����';
$strEditPDFPages = '���� ��� PDF';
$strEditPrivileges = '���� ������';
$strEffective = '�������';
$strEmpty = '����';
$strEmptyResultSet = 'MySQL ����� 0 ������ �� ��� �������(�����, 0 �����).';
$strEnd = '���';
$strEnglishPrivileges = ' ����: ������ MySQL ������ ������� ';
$strError = '����';
$strExport = '����';
$strExportToXML = '���� ������ XML';
$strExtendedInserts = '������ �������';
$strExtra = '����';

$strField = '���';
$strFieldHasBeenDropped = '���� %s ����';
$strFields = '����';
$strFieldsEmpty = ' ����� ����� ���� ! ';
$strFieldsEnclosedBy = '��� ���� ��';
$strFieldsEscapedBy = '���� ���� ��';
$strFieldsTerminatedBy = '���� ���� ��';
$strFixed = '����';
$strFlushTable = '���� �� ��� ������� ("����")';
$strFormat = '�����';
$strFormEmpty = '��� ���� �� ����� !';
$strFullText = '���� ���';
$strFunction = '��������';

$strGenBy = '���� ��-���';
$strGenTime = '��� �����';
$strGo = '���';
$strGrants = '������';
$strGzip = '"GZipped"';

$strHasBeenAltered = '����.';
$strHasBeenCreated = '����.';
$strHome = '���� ����';
$strHomepageOfficial = '��� phpMyAdmin �����';
$strHomepageSourceforge = '���� ������� �� phpMyAdmin ���� Sourceforge';
$strHost = '����';
$strHostEmpty = '���� ����� ��� !';

$strIdxFulltext = '���� ���';
$strIfYouWish = '�� ������ ����� �� ��� �� ������ �����, ���� ���� ������ ��� ����� �����.';
$strIgnore = '�����';
$strIndex = '������';
$strIndexes = '��������';
$strIndexHasBeenDropped = '������ %s ����';
$strIndexName = '�� �������&nbsp;:';
$strIndexType = '��� �������&nbsp;:';
$strInsert = '����';
$strInsertAsNewRow = '����� ����� ����';
$strInsertedRows = '����� �������:';
$strInsertNewRow = '���� ���� ����';
$strInsertTextfiles = '���� ���� ���� ���� ���� �����';
$strInstructions = '������';
$strInUse = '������';
$strInvalidName = '"%s" ��� ���� �����, ���� ���� ������ �� ���� ������/����/���.';

$strKeepPass = '�� ���� �� ������';
$strKeyname = '�� ����';
$strKill = '���';

$strLength = '����';
$strLengthSet = '����/�����*';
$strLimitNumRows = '���� ������ ��� ��';
$strLineFeed = '���� ����: \\n';
$strLines = '�����';
$strLinesTerminatedBy = '����� ������ ��-���';
$strLinkNotFound = '����� �� ����';
$strLinksTo = '������� �-';
$strLocationTextfile = '����� ���� �����';
$strLogin = '����';
$strLogout = '�����';
$strLogPassword = '�����:';
$strLogUsername = '�� �����:';

$strMissingBracket = '������ �����';
$strModifications = '�������� �����';
$strModify = '���';
$strModifyIndexTopic = '��� ������';
$strMoveTable = '���� ���� �- (��� ������<b>.</b>����):';
$strMoveTableOK = '����� %s ������ �- %s.';
$strMySQLReloaded = 'MySQL ���� ����.';
$strMySQLSaid = 'MySQL ���: ';
$strMySQLServerProcess = 'MySQL %pma_s1% �� �� %pma_s2% �- %pma_s3%';
$strMySQLShowProcess = '���� �������';
$strMySQLShowStatus = '���� �� ���� ����� �� MySQL';
$strMySQLShowVars = '���� �� ����� ������ �� MySQL';

$strName = '��';
$strNext = '���';
$strNo = '��';
$strNoDatabases = '��� ���� ������';
$strNoDescription = '��� �����';
$strNoDropDatabases = '������ "DROP DATABASE" ������.';
$strNoFrames = 'phpMyAdmin ��� ���� ������� �� ����� <b>����� ��������</b>.';
$strNoIndex = '������ �� ����� !';
$strNoIndexPartsDefined = '��� ���� ������ ������� !';
$strNoModification = '��� �����';
$strNone = 'NULL';
$strNoPassword = '��� �����';
$strNoPhp = '��� ��� PHP';
$strNoPrivileges = '��� ������';
$strNoQuery = '��� ������ SQL !';
$strNoRights = '��� �� ����� ������ ��� ����� ��� ����� !';
$strNoTablesFound = '������ �� ����� ���� �������.';
$strNotNumber = '��� �� ���� !';
$strNotSet = '����� <b>%s</b> �� ����� �- %s';
$strNotValidNumber = ' ��� �� ���� ���� �� ���� !';
$strNoUsersFound = '�� �����/������� �����.';
$strNull = 'NULL';
$strNumSearchResultsInTable = '%s �����/������ ���� ����� <i>%s</i>';

$strOftenQuotation = '������ ������. ���� ������ ������ ��� ���� char �- varchar ������ �� ��� ������.';
$strOperations = '������';
$strOptimizeTable = '���� ����';
$strOptionalControls = '������. ���� �� ����� ������ �� ������ �������.';
$strOptionally = '���� ������';
$strOptions = '��������';
$strOr = '��';
$strOverhead = '�����';

$strPageNumber = '���� ����:';
$strPartialText = '������ ������';
$strPassword = '�����';
$strPasswordEmpty = '������ ���� !';
$strPasswordNotSame = '�������� ���� ���� !';
$strPdfDbSchema = '���� ��� ������� "%s" - ���� %s';
$strPdfInvalidPageNum = '���� ���� �� PDF �� �����!';
$strPdfInvalidTblName = '����� "%s" �� �����!';
$strPhp = '��� ��� PHP';
$strPHPVersion = '���� PHP';
$strPmaDocumentation = '���������� phpMyAdmin';
$strPmaUriError = '������ �- <tt>$cfg[\'PmaAbsoluteUri\']</tt> ����� ����� ������ ����� ������������ ���!';
$strPos1 = '����';
$strPrevious = '�����';
$strPrimary = '����';
$strPrimaryKey = '���� ����';
$strPrimaryKeyHasBeenDropped = '����� ����� ����';
$strPrimaryKeyName = '��� �� ����� ����� ���� �����... ���� !';
$strPrimaryKeyWarning = '("���� ����" <b>����</b> ������� ��� �� ���� ���� !)';
$strPrintView = '���� �����';
$strPrivileges = '������';
$strProperties = '��������';

$strQBE = '������ ������';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = '������ SQL �� ��� ������� <b>%s</b>:';

$strRecords = '������';
$strReferentialIntegrity = '���� �� �- Referential Integrity:';
$strRelationView = '����� ���';
$strReloadFailed = '����� ���� �� MySQL �����.';
$strReloadMySQL = '��� ���� �� MySQL';
$strRememberReload = '���� ����� ���� �� ����.';
$strRenameTable = '��� �� �� ����� �-';
$strRenameTableOK = '�� ����� %s ����� �- %s';
$strRepairTable = '��� ����';
$strReplace = '����';
$strReplaceTable = '���� �� �� ����� �� ����';
$strReset = '���';
$strReType = '���� ����';
$strRevoke = '����';
$strRevokeGrant = '����� �����';
$strRevokeGrantMessage = '���� �� ����� �- Grant �- %s';
$strRevokeMessage = ' ���� �� ������ �- %s';
$strRevokePriv = '���� ������';
$strRowLength = '���� ����';
$strRows = '�����';
$strRowsFrom = '����� �������� �-';
$strRowSize = ' ���� ����� ';
$strRowsModeHorizontal = '�����';
$strRowsModeOptions = '���� %s ���� �� ������ ������� ���� %s ����';
$strRowsModeVertical = '�����';
$strRowsStatistic = '��������� �����';
$strRunning = '�� �� %s';
$strRunQuery = '��� ������';
$strRunSQLQuery = '��� �� ������/������� �� ��� ������� %s';

$strSave = '����';
$strSearch = '���';
$strSearchFormTitle = '��� ���� �������';
$strSearchInTables = '���� �����/�������:';
$strSearchOption1 = '����� ��� �� ������';
$strSearchOption2 = '�� ������';
$strSearchOption3 = '������ �������';
$strSearchOption4 = '������ ����';
$strSearchResultsFor = '������ ����� �- "<i>%s</i>" %s:';
$strSearchType = '���:';
$strSelect = '���';
$strSelectADb = '��� ����� ��� ������';
$strSelectAll = '��� ���';
$strSelectFields = '��� ���� (����� ���):';
$strSelectNumRows = '���� ������';
$strSelectTables = '��� ������';
$strSend = '���� �����';
$strServerChoice = '����� ���';
$strServerVersion = '���� ���';
$strSetEnumVal = '�� ��� ���� ��� enum �� set, ���� ����� ����� �������� ������ ���: \'a\',\'b\',\'c\'...<br />�� ���� �� ��� ���� \ �� ����� ��� ��� �� ������ ����, ���� \ �����.';
$strShow = '����';
$strShowAll = '���� ���';
$strShowColor = '��� ���';
$strShowCols = '���� �����';
$strShowingRecords = '���� �����';
$strShowPHPInfo = '���� ���� PHP';
$strShowTables = '���� ������';
$strShowThisQuery = ' ���� �� ������� ��� ���� ';
$strSingly = '(�����)';
$strSize = '����';
$strSort = '�����';
$strSpaceUsage = '��� ����';
$strSplitWordsWithSpace = '������ ������� �� ��� �� ���� (" ").';
$strSQL = 'SQL';
$strSQLQuery = '������ SQL';
$strSQLResult = '������ SQL';
$strStatement = '������';
$strStrucCSV = '���� CSV';
$strStrucData = '����� �����';
$strStrucDrop = '���� \'��� ����\'';
$strStrucExcelCSV = 'CVS ����� Ms Excel';
$strStrucOnly = '���� ����';
$strStructPropose = '��� ���� ����';
$strStructure = '�����';
$strSubmit = '���';
$strSuccess = '������ �- SQL ��� ����� ������';
$strSum = '�����';

$strTable = '����';
$strTableComments = '����� ����';
$strTableEmpty = '�� ����� ��� !';
$strTableHasBeenDropped = '����� %s �����';
$strTableHasBeenEmptied = 'Table %s �����';
$strTableHasBeenFlushed = 'Table %s ����� ������ �����';
$strTableMaintenance = '����� ����';
$strTables = '%s ����/������';
$strTableStructure = '���� ���� �����';
$strTableType = '��� ����';
$strTextAreaLength = ' ���� �����,<br /> ���� ���� �� �� ���� ������ ';
$strTheContent = '����� �� ���� �����.';
$strTheContents = '����� �� ����� ��� ����� �� ����� �� ����� ������ ������ �� ���� ���� �� ���� ����� ���.';
$strTheTerminator = '���� �� �����.';
$strTotal = '��-���';
$strType = '���';

$strUncheckAll = '��� ����� �� ���';
$strUnique = '�����';
$strUnselectAll = '��� ����� �� ���';
$strUpdatePrivMessage = '������ �� ������� �- %s.';
$strUpdateProfile = '���� ������:';
$strUpdateProfileMessage = '������� �����.';
$strUpdateQuery = '���� ������';
$strUsage = '�����';
$strUseBackquotes = '����� ������� ������� �� ������ ����� ����';
$strUser = '�����';
$strUserEmpty = '�� ������ ��� !';
$strUserName = '�� �����';
$strUsers = '�������';
$strUseTables = '����� �������';

$strValue = '���';
$strViewDump = '���� �� ���� �����';
$strViewDumpDB = '���� �� ���� ��� �������';

$strWelcome = '���� ��� �- %s';
$strWithChecked = '���� ��:';
$strWrongUser = '�� �����/����� ������. ����� �����.';

$strYes = '��';

$strZip = '"Zipped"';
//To translate:

$strAllTableSameWidth = 'display all Tables with same width?';  //to translate

$strBeginCut = 'BEGIN CUT';  //to translate
$strBeginRaw = 'BEGIN RAW';  //to translate

$strCantLoadRecodeIconv = 'Can not load iconv or recode extension needed for charset conversion, configure php to allow using these extensions or disable charset conversion in phpMyAdmin.';  //to translate
$strCantUseRecodeIconv = 'Can not use iconv nor libiconv nor recode_string function while extension reports to be loaded. Check your php configuration.';  //to translate
$strCharsetOfFile = 'Character set of the file:'; //to translate
$strColComFeat = 'Displaying Column Comments';  //to translate
$strConfigureTableCoord = 'Please configure the coordinates for table %s';  //to translate
$strCreatePdfFeat = 'Creation of PDFs';  //to translate

$strDisabled = 'Disabled';  //to translate
$strDisplayFeat = 'Display Features';  //to translate
$strDumpXRows = 'Dump %s rows starting at row %s.'; //to translate

$strEnabled = 'Enabled';  //to translate
$strEndCut = 'END CUT';  //to translate
$strEndRaw = 'END RAW';  //to translate
$strExplain = 'Explain SQL';  //to translate

$strGeneralRelationFeat = 'General relation features';  //to translate

$strHaveToShow = 'You have to choose at least one Column to display';  //to translate

$strMySQLCharset = 'MySQL Charset';  //to translate

$strNoExplain = 'Skip Explain SQL';  //to translate
$strNotOK = 'not OK';  //to translate
$strNoValidateSQL = 'Skip Validate SQL';  //to translate
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> match(es)';//to translate

$strOK = 'OK';  //to translate

$strPdfNoTables = 'No tables';  //to translate

$strRelationNotWorking = 'The additional Features for working with linked Tables have been deactivated. To find out why click %shere%s.';  //to translate

$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';  //to translate
$strSearchNeedle = 'Word(s) or value(s) to search for (wildcard: "%"):';//to translate
$strShowGrid = 'Show grid'; //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate
$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';  //to translate
$strSQPBugInvalidIdentifer = 'Invalid Identifer';  //to translate
$strSQPBugUnclosedQuote = 'Unclosed quote';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate

$strValidateSQL = 'Validate SQL';  //to translate

$strInsecureMySQL = 'Your configuration file contains settings (root with no password) that correspond to the default MySQL privileged account. Your MySQL server is running with this default, is open to intrusion, and you really should fix this security hole.';  //to translate
$strWebServerUploadDirectory = 'web-server upload directory';  //to translate
$strWebServerUploadDirectoryError = 'The directory you set for upload work cannot be reached';  //to translate
$strValidatorError = 'The SQL validator could not be initialized. Please check if you have installed the necessary php extensions as described in the %sdocumentation%s.'; //to translate
$strServer = 'Server %s';  //to translate
$strPutColNames = 'Put fields names at first row';  //to translate
$strImportDocSQL = 'Import docSQL Files';  //to translate
$strDataDict = 'Data Dictionary';  //to translate
$strPrint = 'Print';  //to translate
$strPHP40203 = 'You are using PHP 4.2.3, which has a serious bug with multi-byte strings (mbstring). See PHP bug report 19404. This version of PHP is not recommended for use with phpMyAdmin.';  //to translate
$strCompression = 'Compression'; //to translate
$strNumTables = 'Tables'; //to translate
$strTotalUC = 'Total'; //to translate
$strRelationalSchema = 'Relational schema';  //to translate
$strTableOfContents = 'Table of contents';  //to translate
$strCannotLogin = 'Cannot login to MySQL server';  //to translate
$strShowDatadictAs = 'Data Dictionary Format';  //to translate
$strLandscape = 'Landscape';  //to translate
$strPortrait = 'Portrait';  //to translate

$timespanfmt = '%s days, %s hours, %s minutes and %s seconds'; //to translate

$strAbortedClients = 'Aborted'; //to translate
$strConnections = 'Connections'; //to translate
$strFailedAttempts = 'Failed attempts'; //to translate
$strGlobalValue = 'Global value'; //to translate
$strMoreStatusVars = 'More status variables'; //to translate
$strPerHour = 'per hour'; //to translate
$strQueryStatistics = '<b>Query statistics</b>: Since its startup, %s queries have been sent to the server.';
$strQueryType = 'Query type'; //to translate
$strReceived = 'Received'; //to translate
$strSent = 'Sent'; //to translate
$strServerStatus = 'Runtime Information'; //to translate
$strServerStatusUptime = 'This MySQL server has been running for %s. It started up on %s.'; //to translate
$strServerTabVariables = 'Variables'; //to translate
$strServerTabProcesslist = 'Processes'; //to translate
$strServerTrafficNotes = '<b>Server traffic</b>: These tables show the network traffic statistics of this MySQL server since its startup.';
$strServerVars = 'Server variables and settings'; //to translate
$strSessionValue = 'Session value'; //to translate
$strTraffic = 'Traffic'; //to translate
$strVar = 'Variable'; //to translate

$strCommand = 'Command'; //to translate
$strCouldNotKill = 'phpMyAdmin was unable to kill thread %s. It probably has already been closed.'; //to translate
$strId = 'ID'; //to translate
$strProcesslist = 'Process list'; //to translate
$strStatus = 'Status'; //to translate
$strTime = 'Time'; //to translate
$strThreadSuccessfullyKilled = 'Thread %s was successfully killed.'; //to translate

$strBzError = 'phpMyAdmin was unable to compress the dump because of a broken Bz2 extension in this php version. It is strongly recommended to set the <code>$cfg[\'BZipDump\']</code> directive in your phpMyAdmin configuration file to <code>FALSE</code>. If you want to use the Bz2 compression features, you should upgrade to a later php version. See php bug report %s for details.'; //to translate
$strLaTeX = 'LaTeX';  //to translate

$strAdministration = 'Administration'; //to translate
$strFlushPrivilegesNote = 'Note: phpMyAdmin gets the users\' privileges directly from MySQL\'s privilege tables. The content of this tables may differ from the privileges the server uses if manual changes have made to it. In this case, you should %sreload the privileges%s before you continue.'; //to translate
$strGlobalPrivileges = 'Global privileges'; //to translate
$strGrantOption = 'Grant'; //to translate
$strPrivDescAllPrivileges = 'Includes all privileges except GRANT.'; //to translate
$strPrivDescAlter = 'Allows altering the structure of existing tables.'; //to translate
$strPrivDescCreateDb = 'Allows creating new databases and tables.'; //to translate
$strPrivDescCreateTbl = 'Allows creating new tables.'; //to translate
$strPrivDescCreateTmpTable = 'Allows creating temporary tables.'; //to translate
$strPrivDescDelete = 'Allows deleting data.'; //to translate
$strPrivDescDropDb = 'Allows dropping databases and tables.'; //to translate
$strPrivDescDropTbl = 'Allows dropping tables.'; //to translate
$strPrivDescExecute = 'Allows running stored procedures; Has no effect in this MySQL version.'; //to translate
$strPrivDescFile = 'Allows importing data from and exporting data into files.'; //to translate
$strPrivDescGrant = 'Allows adding users and privileges without reloading the privilege tables.'; //to translate
$strPrivDescIndex = 'Allows creating and dropping indexes.'; //to translate
$strPrivDescInsert = 'Allows inserting and replacing data.'; //to translate
$strPrivDescLockTables = 'Allows locking tables for the current thread.'; //to translate
$strPrivDescMaxConnections = 'Limits the number of new connections the user may open per hour.';
$strPrivDescMaxQuestions = 'Limits the number of queries the user may send to the server per hour.';
$strPrivDescMaxUpdates = 'Limits the number of commands that that change any table or database the user may execute per hour.';
$strPrivDescProcess3 = 'Allows killing processes of other users.'; //to translate
$strPrivDescProcess4 = 'Allows viewing the complete queries in the process list.'; //to translate
$strPrivDescReferences = 'Has no effect in this MySQL version.'; //to translate
$strPrivDescReplClient = 'Gives the right to the user to ask where the slaves / masters are.'; //to translate
$strPrivDescReplSlave = 'Needed for the replication slaves.'; //to translate
$strPrivDescReload = 'Allows reloading server settings and flushing the server\'s caches.'; //to translate
$strPrivDescSelect = 'Allows reading data.'; //to translate
$strPrivDescShowDb = 'Gives access to the complete list of databases.'; //to translate
$strPrivDescShutdown = 'Allows shutting down the server.'; //to translate
$strPrivDescSuper = 'Allows connectiong, even if maximum number of connections is reached; Required for most administrative operations like setting global variables or killing threads of other users.'; //to translate
$strPrivDescUpdate = 'Allows changing data.'; //to translate
$strPrivDescUsage = 'No privileges.'; //to translate
$strPrivilegesReloaded = 'The privileges were reloaded successfully.'; //to translate
$strResourceLimits = 'Resource limits'; //to translate
$strUserOverview = 'User overview'; //to translate
$strZeroRemovesTheLimit = 'Note: Setting these options to 0 (zero) removes the limit.'; //to translate
?>
