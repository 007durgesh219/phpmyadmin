<?php
/* $Id$ */

/**
 * Translated on 2002/04/29 by: Arthit Suriyawongkul
 *                              Warit Wanasathian
 */


// note: Thai has 2 standard encodings (tis-620, iso-8859-11)
$charset = 'tis-620';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('亵�', '����亵�', '�����亵�', '�ԡ�亵�');

$day_of_week = array('��.', '�.', '�.', '�.', '��.', '�.', '�.');
$month = array('�.�.', '�.�.', '��.�.', '��.�.', '�.�.', '��.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%e %B %Y  %R�.';


$strAccessDenied = '���͹حҵ�����ҹ';
$strAction = '��зӡ��';
$strAddDeleteColumn = '����/ź ������� (��Ŵ�)';
$strAddDeleteRow = '����/ź ��';
$strAddNewField = '������Ŵ�����';
$strAddPriv = '�����Է��';
$strAddPrivMessage = '�����Է�����º��������';
$strAddSearchConditions = '�������͹�㹡�ä��� :';
$strAddToIndex = '�����Ѫ�դ������ %s';
$strAddUser = '�������������';
$strAddUserMessage = '����������������º��������';
$strAffectedRows = '�Ƿ��١��з�:';
$strAfter = '��ѧ %s';
$strAfterInsertBack = '�觡�Ѻ';
$strAfterInsertNewInsert = '�á����¹����';
$strAll = '������';
$strAlterOrderBy = '���§���㹵��ҧ���';
$strAnalyzeTable = '����������ҧ';
$strAnd = '���';
$strAnIndex = '�������Ѫ������� %s';
$strAny = '��';
$strAnyColumn = '���������';
$strAnyDatabase = '�ҹ��������';
$strAnyHost = '��ʵ���';
$strAnyTable = '���ҧ��';
$strAnyUser = '�������';
$strAPrimaryKey = '������ primary key ����� %s';
$strAscending = '������ҡ';
$strAtBeginningOfTable = '���ش������鹢ͧ���ҧ';
$strAtEndOfTable = '���ش�ش���¢ͧ���ҧ';
$strAttr = '�͵��Ժ�ǵ�';

$strBack = '��͹��Ѻ';
$strBinary = ' ������亹��� ';
$strBinaryDoNotEdit = ' ������亹��� - ������� ';
$strBookmarkDeleted = 'ź��������º��������';
$strBookmarkLabel = '���ª���';
$strBookmarkQuery = 'SQL-query �١������';
$strBookmarkThis = '��� SQL-query ������';
$strBookmarkView = '�����ҧ����';
$strBrowse = '�Դ��';

$strCantLoadMySQL = '�������ö���¡�� MySQL extension,<br />��سҵ�Ǩ�ͺ��õ�駤�Ңͧ PHP';
$strCantRenameIdxToPrimary = '����¹���ʹѪ���� PRIMARY �����!';
$strCarriage = '�Ѵ���: \\r';
$strChange = '����¹';
$strChangePassword = '����¹���ʼ�ҹ';
$strCheckAll = '���͡������';
$strCheckDbPriv = '��Ǩ�ͺ�Է��㹰ҹ������';
$strCheckTable = '��Ǩ�ͺ���ҧ';
$strColumn = '�������';
$strColumnNames = '���ͤ������';
$strCompleteInserts = '����� INSERT ����ٻẺ';
$strConfirm = '�س�׹�ѹ���з���觹��?';
$strCookiesRequired = '��ͧ͹حҵ���� \'��ꡡ��\' ���¡�͹ �֧�� ��ҹ�ش������';
$strCopyTable = '�Ѵ�͡���ҧ��ѧ (database<b>.</b>table):';
$strCopyTableOK =  '�Ѵ�͡���ҧ %s ���㹪��� %s ���º ��������.';
$strCreate = '���ҧ';
$strCreateIndex = '���ҧ�Ѫ���¤������ %s';
$strCreateIndexTopic = '���ҧ�Ѫ������';
$strCreateNewDatabase = '���ҧ�ҹ����������';
$strCreateNewTable = '���ҧ���ҧ㹰ҹ�����Ź�� %s';
$strCriteria = '���͹�';

$strData = '������';
$strDatabase = '�ҹ������ ';
$strDatabaseHasBeenDropped = '�¹�ҹ������ %s �������º ��������';
$strDatabases = '�ҹ������';
$strDatabasesStats = 'ʶԵ԰ҹ������';
$strDatabaseWildcard = '�ҹ������ (�� wildcards ��):';
$strDataOnly = '੾�Т�����';
$strDefault = '��һ�����';
$strDelete = 'ź';
$strDeleted = 'ź���º��������';
$strDeletedRows = '�Ƿ��١ź:';
$strDeleteFailed = 'ź��������!';
$strDeleteUserMessage = '�س��ź����� %s �����';
$strDescending = '�ҡ仹���';
$strDisplay = '�ʴ���';
$strDisplayOrder = '�ӴѺ����ʴ�:';
$strDoAQuery = '�� "query by example" (wildcard: "%")';
$strDocu = '�͡�����ҧ�ԧ';
$strDoYouReally = '��ͧ��è� ';
$strDrop = '�¹���';
$strDropDB = '�¹�ҹ������ %s ���';
$strDropTable = '�¹���ҧ���';
$strDumpingData = 'dump ���ҧ';
$strDynamic = '��褧���';

$strEdit = '���';
$strEditPrivileges = '����Է��';
$strEffective = '�ռ�';
$strEmpty = 'ź������';
$strEmptyResultSet = 'MySQL �׹���Ѿ����ҧ���� (null) ��Ѻ�� (0 ��).';
$strEnd = '�����ش';
$strEnglishPrivileges = ' �ô��Һ: ���ͧ͢�Է��� MySQL �� �ʴ��������ѧ��� ';
$strError = '�Դ��Ҵ';
$strExtendedInserts = 'INSERT Ẻ��������¹㹤�������';
$strExtra = '�������';

$strField = '��Ŵ�';
$strFieldHasBeenDropped = '�¹��Ŵ�� %s �������º��������';
$strFields = '�ӹǹ��Ŵ�';
$strFieldsEmpty = ' �ӹǹ��Ŵ��� ��ҧ����! ';
$strFieldsEnclosedBy = '�������Ŵ����';
$strFieldsEscapedBy = '����ͧ��������Ѻ escape char';
$strFieldsTerminatedBy = '����Ŵ����';
$strFixed = '�����';
$strFlushTable = '��ҧ���ҧ ("FLUSH")';
$strFormat = '�ٻẺ';
$strFormEmpty = '����Ẻ��������� !';
$strFunction = '�ѧ����';

$strGenTime = '���һ����ż� ("Generation Time")';
$strGo = 'ŧ���';
$strGrants = '͹حҵ';

$strHasBeenAltered = '����¹��������';
$strHasBeenCreated = '���ҧ��������';
$strHome = '˹�Һ�ҹ';
$strHomepageOfficial = '���ྨ���ҧ�繷ҧ��âͧ phpMyAdmin';
$strHomepageSourceforge = '˹�Ҵ�ǹ���Ŵ phpMyAdmin ��� Sourceforge';
$strHost = '��ʵ�';
$strHostEmpty = '������ʵ��ѧ��ҧ����!';

$strIfYouWish = '��ҵ�ͧ������¡��੾�кҧ������� ����к���ª��� ��Ŵ��Ҵ��� (������Ъ��ʹ�������ͧ�����١���)';
$strIgnore = '���ʹ�';
$strIndex = '�Ѫ��';
$strIndexes = '�Ѫ��';
$strIndexHasBeenDropped = '�¹�Ѫ�� %s �������º��������';
$strIndexName = '���ʹѪ�� :';
$strIndexType = '��Դ�ͧ�Ѫ�� :';
$strInsert = '�á';
$strInsertAsNewRow = '�á��������';
$strInsertedRows = '�Ƿ��١�á:';
$strInsertNewRow = '�á������';
$strInsertTextfiles = '�á�����Ũҡ����ͤ�������� ���ҧ';
$strInstructions = '�Ը���';
$strInUse = '������';
$strInvalidName = '"%s" �繤�ʧǹ �������駪��� �ҹ������/ ���ҧ/��Ŵ� �����';

$strKeepPass = '��س���������¹���ʼ�ҹ';
$strKeyname = '���ͤ���';
$strKill = '��ҷ��';

$strLength = '�������';
$strLengthSet = '�������/૵*';
$strLimitNumRows = '����¹���˹��';
$strLineFeed = '��鹺�÷Ѵ����: \\n';
$strLines = '��÷Ѵ';
$strLinesTerminatedBy = '���Ǵ���';
$strLocationTextfile = '���͡����ͤ����ҡ';
$strLogin = '�������к�';
$strLogout = '�͡�ҡ�к�';
$strLogPassword = '���ʼ�ҹ:';
$strLogUsername = '���ͼ����:';

$strModifications = '�ѹ�֡���������º��������';
$strModify = '���';
$strModifyIndexTopic = '��䢴Ѫ��';
$strMoveTable = '���µ��ҧ� (database<b>.</b>table):';
$strMoveTableOK = '���ҧ %s �١����� %s ����';
$strMySQLReloaded = '���¡ MySQL �������������';
$strMySQLSaid = 'MySQL �ʴ�: ';
$strMySQLServerProcess = 'MySQL %pma_s1% �ӧҹ���躹 %pma_s2% 㹪��� %pma_s3%';
$strMySQLShowProcess = '�ʴ��ҹ��������ͧ MySQL';
$strMySQLShowStatus = '�ʴ�ʶҹТͧ MySQL';
$strMySQLShowVars = '�ʴ�������к��ͧ MySQL';

$strName = '����';
$strNext = '����';
$strNo = '���';
$strNoDatabases = '����հҹ������';
$strNoDropDatabases = '����� "DROP DATABASE" �١�Դ���';
$strNoFrames = '���������<b>�������</b> �Ъ�������� phpMyAdmin ����¢��';
$strNoIndex = '�ѧ������˹��Ѫ����!';
$strNoIndexPartsDefined = '������˹���ǹ�� �ͧ�Ѫ��!';
$strNoModification = '����ա������¹�ŧ';
$strNone = '�����';
$strNoPassword = '��������ʼ�ҹ';
$strNoPrivileges = '������Է��';
$strNoQuery = '����� SQL query!';
$strNoRights = '�س������Է�Է�������ҵç���!';
$strNoTablesFound = '��辺���ҧ� � 㹰ҹ������';
$strNotNumber = '��ҹ����������Ţ!';
$strNotValidNumber = ' ����������Ţ�Ƿ��١��ͧ!';
$strNoUsersFound = '��辺�������.';
$strNull = '��ҧ���� (null)';

$strOftenQuotation = '�»��Ԩ�������ͧ�����ѭ��С�� (����ͧ���¤Ӿٴ)<br />"��ҷ�����" ���¶֧����������ͧ���� �����੾�СѺ��Ŵ쪹Դ char ��� varchar ��ҹ��';
$strOptimizeTable = '��Ѻ�觵��ҧ';
$strOptionalControls = '��˹���Ҩ���¹������ҹ����ѡ��о���� ���ҧ��';
$strOptionally = '��ҷ�����';
$strOr = '����';
$strOverhead = '�Թ��������';

$strPartialText = '��ͤ����ҧ��ǹ';
$strPassword = '���ʼ�ҹ';
$strPasswordEmpty = '���ʼ�ҹ�ѧ��ҧ����!';
$strPasswordNotSame = '���ʼ�ҹ���ç�ѹ!';
$strPHPVersion = '��蹢ͧ PHP';
$strPmaDocumentation = '�͡��á���� phpMyAdmin';
$strPmaUriError = '<b>��ͧ</b>��˹���� <tt>$cfg[\'PmaAbsoluteUri\']</tt> ����͹�ԡ��ê�����¡�͹';
$strPos1 = '�ش�������';
$strPrevious = '��͹˹��';
$strPrimaryKeyHasBeenDropped = '�¹ primary key �������º ��������';
$strPrimaryKeyName = '���ͧ͢ primary key �е�ͧ��... PRIMARY!';
$strPrimaryKeyWarning = '(���ͧ͢ primary key <b>�е�ͧ�� </b>"PRIMARY" ��ҹ��!)';
$strPrintView = '�ʴ�';
$strPrivileges = '�Է��';
$strProperties = '�س���ѵ�';

$strQBEDel = 'ź';
$strQBEIns = '����';
$strQueryOnDb = 'SQL-query ���ҹ������ <b>%s</b>:';

$strRecords = '����¹';
$strReferentialIntegrity = '��Ǩ�ͺ��������ó�ͧ�����ҧ �֧:';
$strReloadFailed = '���¡ MySQL ������������';
$strReloadMySQL = '���¡ MySQL ����';
$strRememberReload = '����������¡��������������ա����'; // can be better translated
$strRenameTable = '����¹���͵��ҧ��';
$strRenameTableOK = '���ҧ %s ��١����¹������ %s';
$strRepairTable = '���������ҧ';
$strReplace = '��¹�Ѻ';
$strReplaceTable = '��¹�Ѻ���¢����Ũҡ���';
$strReset = '���������';
$strReType = '���������';
$strRevoke = '�ԡ�͹';
$strRevokeGrant = '�ԡ�͹���͹حҵ';
$strRevokeGrantMessage = '�س���ԡ�͹���͹حҵ�ͧ %s';
$strRevokeMessage = '�س���ԡ�͹�Է�Ԣͧ %s';
$strRevokePriv = '�ԡ�͹�Է��';
$strRowLength = '���������';
$strRows = '��';
$strRowsFrom = '�� ������ҡ�Ƿ��';
$strRowSize = ' ��Ҵ�� ';
$strRowsModeHorizontal = '�ǹ͹';
$strRowsModeOptions = '�����%s ��Ы������Ƿء� %s ����';
$strRowsModeVertical = '�ǵ��';
$strRowsStatistic = 'ʶԵԢͧ��';
$strRunning = '�ӧҹ����� %s';
$strRunQuery = '�� query';
$strRunSQLQuery = '�� SQL query ���ҹ������ %s';

$strSave = '�ѹ�֡';
$strSelect = '���͡';
$strSelectADb = '�ô���͡�ҹ������';
$strSelectAll = '���͡������';
$strSelectFields = '���͡��Ŵ� (���ҧ����˹�觿�Ŵ�):';
$strSelectNumRows = '� query';
$strSend = '���������';
$strServerChoice = '������͡���������'; // can be better translated
$strServerVersion = '��蹢ͧ���������';
$strSetEnumVal = '��Ҫ�Դ�ͧ��Ŵ��� "enum" ���� "set" �ô ����ҵ���ٻẺ: \'a\',\'b\',\'c\'...<br />��ҵ�ͧ����������ͧ ���� backslash ("\") ���� �ѭ��С������� ("\'") ����㹤������� ��� ����������ͧ���� backslashe ��˹�� (������ҧ�� \'\\\\xyz\' or \'a\\\'b\')';
$strShow = '�ʴ�';
$strShowAll = '�ʴ�������';
$strShowCols = '�ʴ��������';
$strShowingRecords = '�ʴ�����¹��� ';
$strShowPHPInfo = '�ʴ������Ţͧ PHP';
$strShowTables = '�ʴ����ҧ';
$strShowThisQuery = ' �ʴ� query ����ա�� ';
$strSingly = '(�����)';
$strSize = '��Ҵ';
$strSort = '���§';
$strSpaceUsage = '���ͷ������';
$strStatement = '�����';
$strStrucExcelCSV = '������ CSV ����Ѻ���ëͿ�������';
$strStrucCSV = '������ CSV';
$strStrucData = '����ç���ҧ��Т�����';
$strStrucDrop = '��������� \'drop table\'';
$strStrucOnly = '੾���ç���ҧ';
$strSubmit = '��';
$strSuccess = '�� SQL-query �������º��������';
$strSum = '�����';

$strTable = '���ҧ ';
$strTableComments = '�����˵آͧ���ҧ';
$strTableEmpty = '���͵��ҧ�ѧ��ҧ����!';
$strTableHasBeenDropped = '�¹���ҧ %s �������º���� ����';
$strTableHasBeenEmptied = 'ź������㹵��ҧ %s ���º���� ����';
$strTableHasBeenFlushed = '��ҧ���ҧ %s ���º��������';
$strTableMaintenance = '��ô����ѡ�ҵ��ҧ';
$strTables = '%s ���ҧ';
$strTableStructure = '�ç���ҧ���ҧ';
$strTableType = '��Դ���ҧ';
$strTextAreaLength = ' ���ͧ�ҡ������Ǣͧ�ѹ <br />��Ŵ��� ����Ҩ����� ';
$strTheContent = '���á�����Ũҡ���ͧ�س���º��������';
$strTheContents = '����Ѻ�Ƿ���� primary key ���� unique key ����͹�ѹ �����Ҩҡ����᷹������������㹵��ҧ';
$strTheTerminator = '�ش����ش�ͧ��Ŵ�';
$strTotal = '������';
$strType = '��Դ';

$strUncheckAll = '������͡���';
$strUnselectAll = '������͡���';
$strUpdatePrivMessage = '�س���Ѻ��ا�Է������Ѻ %s ����';
$strUpdateProfile = '��Ѻ��ا profile:'; // to translate
$strUpdateProfileMessage = '��Ѻ��ا profile ���º��������'; // to translate
$strUpdateQuery = '��Ѻ��ا query';
$strUsage = '��ҹ';
$strUseBackquotes = '��� \'backqoute\' ���Ѻ���͵��ҧ��п�Ŵ�';
$strUser = '�����';
$strUserEmpty = '���ͼ�����ѧ��ҧ����!';
$strUserName = '���ͼ����';
$strUsers = '�����';
$strUseTables = '�����ҧ';

$strValue = '���';
$strViewDump = '���ç���ҧ�ͧ���ҧ';
$strViewDumpDB = '���ç���ҧ�ͧ�ҹ������';

$strWelcome = '%s �Թ�յ�͹�Ѻ';
$strWithChecked = '�ӡѺ������͡:';
$strWrongUser = '͹حҵ������������� ���ͼ�����������ʼ�ҹ�Դ';

$strYes = '��';


// To translate
$strBzip = '"bzipped"';
$strCardinality = 'Cardinality';
$strDumpXRows = 'Dump %s rows starting at row %s.';
$strExport = 'Export';
$strExportToXML = 'Export to XML format';
$strFullText = 'Full Texts';
$strGzip = '"gzipped"';
$strIdxFulltext = 'Fulltext';
$strLinksTo = 'Links to';
$strOperations = 'Operations';
$strOptions = 'Options';
$strPrimary = 'Primary';
$strPrimaryKey = 'Primary key';
$strQBE = 'Query by Example';
$strRelationView = 'Relation view';
$strSQL = 'SQL';
$strSQLQuery = 'SQL-query';
$strStructure = 'Structure';
$strUnique = 'Unique';
$strZip = '"zipped"';
$strLinkNotFound = 'Link not found';  //to translate
$strConfigureTableCoord = 'Please configure the coordinates for table %s';  //to translate
$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';  //to translate
$strDisplayPDF = 'Display PDF schema';  //to translate
?>
