<?php
/* $Id$ */

/**
 * Latvian language file by Sandis Jērics <sandisj at parks.lv>
 */

$charset = 'utf-8';
$allow_recoding = TRUE;
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('baiti', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('Sv', 'Pr', 'Ot', 'Tr', 'Ce', 'Pt', 'Se');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jūn', 'Jūl', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d%m.%Y %H:%M';

$strAccessDenied = 'Pieeja aizliegta';
$strAction = 'Darbība';
$strAddDeleteColumn = 'Pievienot/Dzēst laukus (kolonnas)';
$strAddDeleteRow = 'Pievienot/Dzēst ierakstu';
$strAddNewField = 'Pievienot jaunu lauku';
$strAddPriv = 'Pievienot jaunu privilēģiju';
$strAddPrivMessage = 'Jūs pievienojāt jaunu privilēģiju.';
$strAddSearchConditions = 'Pievienot meklēšanas nosacījumus ("where" izteiksmes ķermenis):';
$strAddToIndex = 'Pievienot indeksam &nbsp;%s&nbsp;kolonn(u/as)';
$strAddUser = 'Pievienot jaunu lietotāju';
$strAddUserMessage = 'Jūs pievienojāt jaunu lietotāju.';
$strAffectedRows = 'Ietekmēto rindu skaits:';
$strAfter = 'Pēc %s';
$strAfterInsertBack = 'Atgriezties iepriekšējā lapā atpakaļ';
$strAfterInsertNewInsert = 'Ievietot vēl vienu rindu';
$strAll = 'Visi';
$strAlterOrderBy = 'Mainīt datu kārtošanas laukus';
$strAnalyzeTable = 'Analizēt tabulu';
$strAnd = 'Un';
$strAnIndex = 'Indekss tieka pievienots uz %s';
$strAny = 'Jebkurš';
$strAnyColumn = 'Jebkura kolonna';
$strAnyDatabase = 'Jebkura datubāze';
$strAnyHost = 'Jebkurš hosts';
$strAnyTable = 'Jebkura tabula';
$strAnyUser = 'Jebkurš lietotājs';
$strAPrimaryKey = 'Primārā atslēga pievienota uz lauka %s';
$strAscending = 'Augošā secībā';
$strAtBeginningOfTable = 'Tabulas sākumā';
$strAtEndOfTable = 'Tabulas beigās';
$strAttr = 'Atribūti';

$strBack = 'Atpakaļ';
$strBinary = 'Binārais';
$strBinaryDoNotEdit = 'Binārais - netiek labots';
$strBookmarkDeleted = 'Ieraksts tika dzēsts.';
$strBookmarkLabel = 'Nosaukums';
$strBookmarkQuery = 'Saglabātie SQL-vaicājumi';
$strBookmarkThis = 'Saglabāt šo SQL-vaicājumu';
$strBookmarkView = 'Tikai apskatīt';
$strBrowse = 'Apskatīt';
$strBzip = 'saarhivēts ar bzip';

$strCantLoadMySQL = 'nevar ielādēt MySQL paplašinājumu,<br />lūdzu pārbaudiet PHP konfigurāciju.';
$strCantRenameIdxToPrimary = 'Nevar pārsaukt indeksu par PRIMARY!';
$strCardinality = 'Kardinalitāte';
$strCarriage = 'Rindas nobeiguma simbols: \\r';
$strChange = 'Labot';
$strChangePassword = 'Mainīt paroli';
$strCheckAll = 'Iezīmēt visu';
$strCheckDbPriv = 'Pārbaudīt privilēģijas uz datubāzi';
$strCheckTable = 'Pārbaudīt tabulu';
$strColumn = 'Kolonna';
$strColumnNames = 'Kolonnu nosaukumi';
$strCompleteInserts = 'Pilnas INSERT izteiksmes';
$strConfirm = 'Vai Jūs tiešām gribat to darīt?';
$strCookiesRequired = 'Šī lapa nestrādās korekti, ja \'Cookies\' ir atslēgtas jūsu pārlūkprogrammas konfigurācijā.';
$strCopyTable = 'Kopēt tabulu uz (datubāze<b>.</b>tabula):';
$strCopyTableOK = 'Tabula %s tika pārkopēta uz %s.';
$strCreate = 'Izveidot';
$strCreateIndex = 'Izveidot indeksu uz&nbsp;%s&nbsp;laukiem';
$strCreateIndexTopic = 'Izveidot jaunu indeksu';
$strCreateNewDatabase = 'Izveidot jaunu datubāzi';
$strCreateNewTable = 'Izveidot jaunu tabulu datubāzē %s';
$strCriteria = 'Kritērijs';

$strData = 'Dati';
$strDatabase = 'Datubāze ';
$strDatabaseHasBeenDropped = 'Datubāze %s tika izdzēsta.';
$strDatabases = 'datubāzes';
$strDatabasesStats = 'Datubāzu statistika';
$strDatabaseWildcard = 'Datubāze (var lietot aizstājējzīmes):';
$strDataOnly = 'Tikai dati';
$strDefault = 'Noklusēts';
$strDelete = 'Dzēst';
$strDeleted = 'Ieraksts tika dzēsts';
$strDeletedRows = 'Ieraksti dzēsti:';
$strDeleteFailed = 'Dzēšana nenotika!';
$strDeleteUserMessage = 'Jūs nodzēsāt lietotāju %s.';
$strDescending = 'Dilstošā secībā';
$strDisplay = 'Attēlot';
$strDisplayOrder = 'Attēlošanas secība:';
$strDoAQuery = 'Izpildīt "vaicājumu pēc parauga" (aizstājējzīme: "%")';
$strDocu = 'Dokumentācija';
$strDoYouReally = 'Vai Jūs tiešām gribat ';
$strDrop = 'Likvidēt';
$strDropDB = 'Likvidēt datubāzi %s';
$strDropTable = 'Likvidēt tabulu';
$strDumpingData = 'Dati tabulai';
$strDynamic = 'dinamisks';

$strEdit = 'Labot';
$strEditPrivileges = 'Mainīt privilēģijas';
$strEffective = 'Efektīvs';
$strEmpty = 'Iztukšot';
$strEmptyResultSet = 'MySQL atgrieza tukšo rezultātu (0 rindas).';
$strEnd = 'Beigas';
$strEnglishPrivileges = ' Piezīme: MySQL privilēģiju apzīmējumi tiek rakstīti angļu valodā ';
$strError = 'Kļūda';
$strExtendedInserts = 'Paplašinātās INSERT izteiksmes';
$strExtra = 'Ekstras';

$strField = 'Lauks';
$strFieldHasBeenDropped = 'Lauks %s tika izdzēsts';
$strFields = 'Lauku skaits';
$strFieldsEmpty = ' Lauku skaits ir nulle! ';
$strFieldsEnclosedBy = 'Lauki iekļauti iekš';
$strFieldsEscapedBy = 'Glābjošā (escape) rakstzīme ir';
$strFieldsTerminatedBy = 'Lauki atdalīti ar';
$strFixed = 'fiksēts';
$strFlushTable = 'Atsvaidzināt tabulu ("FLUSH")';
$strFormat = 'Formats';
$strFormEmpty = 'Formā trūkst vērtību!';
$strFullText = 'Pilni teksti';
$strFunction = 'Funkcija';

$strGenTime = 'Izveidošanas laiks';
$strGo = 'Aiziet!';
$strGrants = 'Tiesības';
$strGzip = 'saarhivēts ar gzip';

$strHasBeenAltered = 'tika modificēta.';
$strHasBeenCreated = 'tika izveidota.';
$strHome = 'Sākumlapa';
$strHomepageOfficial = 'Oficiālā phpMyAdmin mājaslapa';
$strHomepageSourceforge = 'phpMyAdmin lejuplādes lapa iekš Sourceforge';
$strHost = 'Hosts';
$strHostEmpty = 'Hosts nav norādīts!';

$strIdxFulltext = 'Pilni teksti';
$strIfYouWish = 'Ja Jūs vēlaties ielādēt tikai dažas tabulas kolonnas, norādiet to nosaukumus, atdalot tos ar komatu.';
$strIgnore = 'Ignorēt';
$strIndex = 'Indekss';
$strIndexes = 'Indeksi';
$strIndexHasBeenDropped = 'Indekss %s tika izdzēsts';
$strIndexName = 'Indeksa nosaukums&nbsp;:';
$strIndexType = 'Indeksa tips&nbsp;:';
$strInsert = 'Pievienot';
$strInsertAsNewRow = 'Ievietot kā jaunu rindu';
$strInsertedRows = 'Rindas pievienotas:';
$strInsertNewRow = 'Pievienot jaunu rindu';
$strInsertTextfiles = 'Ievietot tabulā datus no teksta faila';
$strInstructions = 'Instrukcijas';
$strInUse = 'lietošanā';
$strInvalidName = '"%s" ir rezervēts vārds, Jūs nevarat lietot to kā datubāzes/tabulas/lauka nosaukumu.';

$strKeepPass = 'Nemainīt paroli';
$strKeyname = 'Atslēgas nosaukums';
$strKill = 'Nogalināt';

$strLength = 'Garums';
$strLengthSet = 'Garums/Vērtības*';
$strLimitNumRows = 'Rindu skaits vienā lapā';
$strLineFeed = 'Rindas beigu simbols: \\n';
$strLines = 'Rindas';
$strLinesTerminatedBy = 'Rindas atdalītas ar';
$strLocationTextfile = 'Teksta faila atrašanās vieta';
$strLogin = 'Ieiet';
$strLogout = 'Iziet';
$strLogPassword = 'Parole:';
$strLogUsername = 'Lietotājvārds:';

$strModifications = 'Grozījumi tika saglabāti';
$strModify = 'Modificēt';
$strModifyIndexTopic = 'Modificēt indeksu';
$strMoveTable = 'Pārvietot tabulu uz (datubāze<b>.</b>tabula):';
$strMoveTableOK = 'Tabula %s tika pārvietota uz %s.';
$strMySQLReloaded = 'MySQL serveris tika pārlādēts.';
$strMySQLSaid = 'MySQL teica: ';
$strMySQLServerProcess = 'MySQL %pma_s1% strādā uz %pma_s2% kā %pma_s3%';
$strMySQLShowProcess = 'Parādīt procesus';
$strMySQLShowStatus = 'Parādīt MySQL izpildes laika informāciju';
$strMySQLShowVars = 'Parādīt MySQL sistēmas mainīgos';

$strName = 'Nosaukums';
$strNext = 'Nākamais';
$strNo = 'Nē';
$strNoDatabases = 'Nav datubāzu';
$strNoDropDatabases = '"DROP DATABASE" komanda ir aizliegta.';
$strNoFrames = 'phpMyAdmin ir vairāk draudzīgs <b>freimu atbalstošu</b> pārlūkprogrammu.';
$strNoIndex = 'Nav definēti indeksi!';
$strNoIndexPartsDefined = 'Nav definēto indeksa daļu!';
$strNoModification = 'Netika labots';
$strNone = 'Nekas';
$strNoPassword = 'Nav paroles';
$strNoPrivileges = 'Nav privilēģiju';
$strNoQuery = 'Nav SQL vaicājuma!';
$strNoRights = 'Jums nav pietiekoši tiesību, lai atrastos šeit tagad!';
$strNoTablesFound = 'Tabulas nav atrastas šajā datubāzē.';
$strNotNumber = 'Tas nav numurs!';
$strNotValidNumber = ' nav derīgs lauku skaits!';
$strNoUsersFound = 'Lietotāji netika atrasti.';
$strNull = 'Nulle';

$strOftenQuotation = 'Parasti pēdiņas. NEOBLIGĀTS nozīmē, ka tikai \'char\' un \'varchar\' tipa lauki tiek norobežoti ar šo simbolu.';
$strOptimizeTable = 'Optimizēt tabulu';
$strOptionalControls = 'Neobligāts. Nosaka, kā rakstīt vai lasīt speciālās rakstzīmes.';
$strOptionally = 'NEOBLIGĀTS';
$strOr = 'Vai';
$strOverhead = 'Pārtēriņš';

$strPartialText = 'Daļēji teksti';
$strPassword = 'Parole';
$strPasswordEmpty = 'Parole nav norādīta!';
$strPasswordNotSame = 'Paroles nesakrīt!';
$strPHPVersion = 'PHP Versija';
$strPmaDocumentation = 'phpMyAdmin dokumentācija';
$strPmaUriError = '<tt>$cfg[\'PmaAbsoluteUri\']</tt> direktīvai ir JĀBŪT nodefinētai Jūsu konfigurācijas failā!';
$strPos1 = 'Sākums';
$strPrevious = 'Iepriekšējie';
$strPrimary = 'Primārā';
$strPrimaryKey = 'Primārā atslēga';
$strPrimaryKeyHasBeenDropped = 'Primārā atslēga tika izdzēsta';
$strPrimaryKeyName = 'Primārās atslēgas nosaukumam jābūt... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>jābūt</b> tikai un <b>vienīgi</b> primārās atslēgas indeksa nosaukumam!)';
$strPrintView = 'Izdrukas versija';
$strPrivileges = 'Privilēģijas';
$strProperties = 'Īpašības';

$strQBE = 'Vaicājums pēc parauga';
$strQBEDel = 'Dzēst';
$strQBEIns = 'Ielikt';
$strQueryOnDb = 'SQL-vaicājums uz datubāzes <b>%s</b>:';

$strRecords = 'Ieraksti';
$strReferentialIntegrity = 'Pārbaudīt referenciālo integritāti:';
$strReloadFailed = 'Nesanāca pārlādēt MySQL serveri.';
$strReloadMySQL = 'Pārlādēt MySQL serveri';
$strRememberReload = 'Neaizmirstiet pārlādēt serveri.';
$strRenameTable = 'Pārsaukt tabulu uz';
$strRenameTableOK = 'Tabula %s tika pārsaukta par %s';
$strRepairTable = 'Restaurēt tabulu';
$strReplace = 'Aizvietot';
$strReplaceTable = 'Aizvietot tabulas datus ar datiem no faila';
$strReset = 'Atcelt';
$strReType = 'Atkārtojiet';
$strRevoke = 'Atsaukt';
$strRevokeGrant = 'Atņemt \'Grant\' tiesības';
$strRevokeGrantMessage = 'Jūs atņēmāt \'Grant\' tiesības lietotājam %s';
$strRevokeMessage = 'Jūs atņēmāt privilēgijas lietotājam %s';
$strRevokePriv = 'Atņemt privilēģijas';
$strRowLength = 'Rindas garums';
$strRows = 'Rindas';
$strRowsFrom = 'rindas sākot no';
$strRowSize = ' Rindas izmērs ';
$strRowsModeHorizontal = 'horizontālā';
$strRowsModeOptions = '%s skatā un atkārtot virsrakstus ik pēc %s rindām';
$strRowsModeVertical = 'vertikālā';
$strRowsStatistic = 'Rindas statistika';
$strRunning = 'atrodas uz %s';
$strRunQuery = 'Izpildīt vaicājumu';
$strRunSQLQuery = 'Izpildīt SQL-vaicājumu(s) uz datubāzes %s';

$strSave = 'Saglabāt';
$strSelect = 'Atlasīt';
$strSelectADb = 'Lūdzu izvēlieties datubāzi';
$strSelectAll = 'Iezīmēt visu';
$strSelectFields = 'Izvēlieties laukus (kaut vienu):';
$strSelectNumRows = 'vaicājumā';
$strSend = 'Saglabāt kā failu';
$strServerChoice = 'Servera izvēle';
$strServerVersion = 'Servera versija';
$strSetEnumVal = 'Ja lauka tips ir "enum" vai "set", lūdzu ievadiet vērtības atbilstoši šim formatam: \'a\',\'b\',\'c\'...<br />Ja Jums vajag ielikt atpakaļējo slīpsvītru (\) vai vienkāršo pēdiņu (\') kādā no šīm vērtībām, lieciet tās priekšā atpakaļējo slīpsvītru (piemēram, \'\\\\xyz\' vai \'a\\\'b\').';
$strShow = 'Rādīt';
$strShowAll = 'Rādīt visu';
$strShowCols = 'Rādīt kolonnas';
$strShowingRecords = 'Parādu rindas';
$strShowPHPInfo = 'Parādīt PHP informāciju';
$strShowTables = 'Rādīt tabulas';
$strShowThisQuery = ' Rādīt šo vaicājumu šeit atkal ';
$strSingly = '(vienkārši)';
$strSize = 'Izmērs';
$strSort = 'Kārtošana';
$strSpaceUsage = 'Diska vietas lietošana';
$strSQLQuery = 'SQL-vaicājums';
$strStatement = 'Parametrs';
$strStrucCSV = 'CSV dati';
$strStrucData = 'Struktūra un dati';
$strStrucDrop = 'Pievienot tabulu dzēšanas komandas';
$strStrucExcelCSV = 'CSV dati MS Excel formātā';
$strStrucOnly = 'Tikai struktūra';
$strSubmit = 'Nosūtīt';
$strSuccess = 'Jūsu SQL-vaicājums tika veiksmīgi izpildīts';
$strSum = 'Kopumā';

$strTable = 'Tabula';
$strTableComments = 'Komentārs tabulai';
$strTableEmpty = 'Tabulas nosaukums nav norādīts!';
$strTableHasBeenDropped = 'Tabula %s tika izdzēsta';
$strTableHasBeenEmptied = 'Tabula %s tika iztukšota';
$strTableHasBeenFlushed = 'Tabula %s tika atsvaidzināta';
$strTableMaintenance = 'Tabulas apkalpošana';
$strTables = '%s tabula(s)';
$strTableStructure = 'Tabulas struktūra tabulai';
$strTableType = 'Tabulas tips';
$strTextAreaLength = ' Sava garuma dēļ,<br /> šis lauks var būt nerediģējams ';
$strTheContent = 'Jūsu faila saturs tika ievietots.';
$strTheContents = 'Faila saturs aizvieto izvēlētās tabulas saturu rindiņām ar identisko primārās vai unikālās atslēgas vērtību.';
$strTheTerminator = 'Lauku atdalītājs.';
$strTotal = 'kopā';
$strType = 'Tips';

$strUncheckAll = 'Neiezīmēt neko';
$strUnique = 'Unikālais';
$strUnselectAll = 'Neiezīmēt neko';
$strUpdatePrivMessage = 'Jūs modificējāt privilēģijas objektam %s.';
$strUpdateProfile = 'Modificēt profilu:';
$strUpdateProfileMessage = 'Profils tika modificēts.';
$strUpdateQuery = 'Modificēšanas vaicājums';
$strUsage = 'Aizņem';
$strUseBackquotes = 'Lietot apostrofa simbolu [`] tabulu un lauku nosaukumiem';
$strUser = 'Lietotājs';
$strUserEmpty = 'Lietotāja vārds nav norādīts!';
$strUserName = 'Lietotājvārds';
$strUsers = 'Lietotāji';
$strUseTables = 'Lietot tabulas';

$strValue = 'Vērtība';
$strViewDump = 'Apskatīt tabulas dampu (shēmu)';
$strViewDumpDB = 'Apskatīt datubāzes dampu (shēmu)';

$strWelcome = 'Laipni lūgti %s';
$strWithChecked = 'Ar iezīmēto:';
$strWrongUser = 'Kļūdains lietotājvārds/parole. Pieeja aizliegta.';

$strYes = 'Jā';

$strZip = 'arhivēts ar zip';
// To translate

$strAllTableSameWidth = 'display all Tables with same width?';  //to translate

$strBeginCut = 'BEGIN CUT';  //to translate
$strBeginRaw = 'BEGIN RAW';  //to translate

$strCantLoadRecodeIconv = 'Can not load iconv or recode extension needed for charset conversion, configure php to allow using these extensions or disable charset conversion in phpMyAdmin.';  //to translate
$strCantUseRecodeIconv = 'Can not use iconv nor libiconv nor recode_string function while extension reports to be loaded. Check your php configuration.';  //to translate
$strChangeDisplay = 'Choose Field to display';  //to translate
$strCharsetOfFile = 'Character set of the file:'; //to translate
$strChoosePage = 'Please choose a Page to edit';  //to translate
$strColComFeat = 'Displaying Column Comments';  //to translate
$strComments = 'Comments';  //to translate
$strConfigFileError = 'phpMyAdmin was unable to read your configuration file!<br />This might happen if php finds a parse error in it or php cannot find the file.<br />Please call the configuration file directly using the link below and read the php error message(s) that you recieve. In most cases a quote or a semicolon is missing somewhere.<br />If you recieve a blank page, everything is fine.'; //to translate
$strConfigureTableCoord = 'Please configure the coordinates for table %s';  //to translate
$strCreatePage = 'Create a new Page';  //to translate
$strCreatePdfFeat = 'Creation of PDFs';  //to translate

$strDisabled = 'Disabled';  //to translate
$strDisplayFeat = 'Display Features';  //to translate
$strDisplayPDF = 'Display PDF schema';  //to translate
$strDumpXRows = 'Dump %s rows starting at row %s.'; //to translate

$strEditPDFPages = 'Edit PDF Pages';  //to translate
$strEnabled = 'Enabled';  //to translate
$strEndCut = 'END CUT';  //to translate
$strEndRaw = 'END RAW';  //to translate
$strExplain = 'Explain SQL';  //to translate
$strExport = 'Export';  //to translate
$strExportToXML = 'Export to XML format'; //to translate

$strGenBy = 'Generated by'; //to translate
$strGeneralRelationFeat = 'General relation features';  //to translate

$strHaveToShow = 'You have to choose at least one Column to display';  //to translate

$strLinkNotFound = 'Link not found';  //to translate
$strLinksTo = 'Links to';  //to translate

$strMissingBracket = 'Missing Bracket';  //to translate
$strMySQLCharset = 'MySQL Charset';  //to translate

$strNoDescription = 'no Description';  //to translate
$strNoExplain = 'Skip Explain SQL';  //to translate
$strNoPhp = 'without PHP Code';  //to translate
$strNotOK = 'not OK';  //to translate
$strNotSet = '<b>%s</b> table not found or not set in %s';  //to translate
$strNoValidateSQL = 'Skip Validate SQL';  //to translate
$strNumSearchResultsInTable = '%s match(es) inside table <i>%s</i>';//to translate
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> match(es)';//to translate

$strOK = 'OK';  //to translate
$strOperations = 'Operations';  //to translate
$strOptions = 'Options';  //to translate

$strPageNumber = 'Page number:';  //to translate
$strPdfDbSchema = 'Schema of the the "%s" database - Page %s';  //to translate
$strPdfInvalidPageNum = 'Undefined PDF page number!';  //to translate
$strPdfInvalidTblName = 'The "%s" table does not exist!';  //to translate
$strPdfNoTables = 'No tables';  //to translate
$strPhp = 'Create PHP Code';  //to translate

$strRelationNotWorking = 'The additional Features for working with linked Tables have been deactivated. To find out why click %shere%s.';  //to translate
$strRelationView = 'Relation view';  //to translate

$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';  //to translate
$strSearch = 'Search';//to translate
$strSearchFormTitle = 'Search in database';//to translate
$strSearchInTables = 'Inside table(s):';//to translate
$strSearchNeedle = 'Word(s) or value(s) to search for (wildcard: "%"):';//to translate
$strSearchOption1 = 'at least one of the words';//to translate
$strSearchOption2 = 'all words';//to translate
$strSearchOption3 = 'the exact phrase';//to translate
$strSearchOption4 = 'as regular expression';//to translate
$strSearchResultsFor = 'Search results for "<i>%s</i>" %s:';//to translate
$strSearchType = 'Find:';//to translate
$strSelectTables = 'Select Tables';  //to translate
$strShowColor = 'Show color';  //to translate
$strShowGrid = 'Show grid';  //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate
$strSplitWordsWithSpace = 'Words are seperated by a space character (" ").';//to translate
$strSQL = 'SQL'; //to translate
$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';  //to translate
$strSQLResult = 'SQL result'; //to translate
$strSQPBugInvalidIdentifer = 'Invalid Identifer';  //to translate
$strSQPBugUnclosedQuote = 'Unclosed quote';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate
$strStructPropose = 'Propose table structure';  //to translate
$strStructure = 'Structure';  //to translate

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
$strPrivDescMaxUpdates = 'Limits the number of commands that change any table or database the user may execute per hour.';
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

$strPasswordChanged = 'The Password for %s was changed successfully.'; // to translate

$strDeleteAndFlush = 'Delete the users and reload the privileges afterwards.'; //to translate
$strDeleteAndFlushDescr = 'This is the cleanest way, but reloading the privileges may take a while.'; //to translate
$strDeleting = 'Deleting %s'; //to translate
$strJustDelete = 'Just delete the users from the privilege tables.'; //to translate
$strJustDeleteDescr = 'The &quot;deleted&quot; users will still be able to access the server as usual until the privileges are reloaded.'; //to translate
$strReloadingThePrivileges = 'Reloading the privileges'; //to translate
$strRemoveSelectedUsers = 'Remove selected users'; //to translate
$strRevokeAndDelete = 'Revoke all active privileges from the users and delete them afterwards.'; //to translate
$strRevokeAndDeleteDescr = 'The users will still have the USAGE privilege until the privileges are reloaded.'; //to translate
$strUsersDeleted = 'The selected users have been deleted successfully.'; //to translate

$strAddPrivilegesOnDb = 'Add privileges on the following database'; //to translate
$strAddPrivilegesOnTbl = 'Add privileges on the following table'; //to translate
$strColumnPrivileges = 'Column-specific privileges'; //to translate
$strDbPrivileges = 'Database-specific privileges'; //to translate
$strLocalhost = 'Local';
$strLoginInformation = 'Login Information'; //to translate
$strTblPrivileges = 'Table-specific privileges'; //to translate
$strThisHost = 'This Host'; //to translate
$strUserNotFound = 'The selected user was not found in the privilege table.'; //to translate
$strUserAlreadyExists = 'The user %s already exists!'; //to translate
$strUseTextField = 'Use text field'; //to translate

$strNoUsersSelected = 'No users selected.'; //to translate
$strDropUsersDb = 'Drop the databases that have the same names as the users.'; //to translate
$strAddedColumnComment = 'Added comment for column';  //to translate
$strWritingCommentNotPossible = 'Writing of comment not possible';  //to translate
$strAddedColumnRelation = 'Added relation for column';  //to translate
$strWritingRelationNotPossible = 'Writing of relation not possible';  //to translate
$strImportFinished = 'Import finished';  //to translate
$strFileCouldNotBeRead = 'File could not be read';  //to translate
$strIgnoringFile = 'Ignoring file %s';  //to translate
$strThisNotDirectory = 'This was not a directory';  //to translate
$strAbsolutePathToDocSqlDir = 'Please enter the absolute path on webserver to docSQL directory';  //to translate
$strImportFiles = 'Import files';  //to translate
$strDBGModule = 'Module';  //to translate
$strDBGLine = 'Line';  //to translate
$strDBGHits = 'Hits';  //to translate
$strDBGTimePerHitMs = 'Time/Hit, ms';  //to translate
$strDBGTotalTimeMs = 'Total time, ms';  //to translate
$strDBGMinTimeMs = 'Min time, ms';  //to translate
$strDBGMaxTimeMs = 'Max time, ms';  //to translate
$strDBGContextID = 'Context ID';  //to translate
$strDBGContext = 'Context';  //to translate
$strCantLoad = 'cannot load %s extension,<br />please check PHP Configuration';  //to translate
$strDefaultValueHelp = 'For default values, please enter just a single value, without backslash escaping or quotes, using this format: a';  //to translate
$strCheckPrivs = 'Check Privileges';  //to translate
$strCheckPrivsLong = 'Check privileges for database &quot;%s&quot;.';  //to translate
$strDatabasesStatsHeavyTraffic = 'Note: Enabling the Database statistics here might cause heavy traffic between the webserver and the MySQL one.';  //to translate
$strDatabasesStatsDisable = 'Disable Statistics';  //to translate
$strDatabasesStatsEnable = 'Enable Statistics';  //to translate
$strJumpToDB = 'Jump to database &quot;%s&quot;.';  //to translate
$strDropSelectedDatabases = 'Drop Selected Databases';  //to translate
$strNoDatabasesSelected = 'No databases selected.';  //to translate
$strDatabasesDropped = '%s databases have been dropped successfully.';  //to translate
$strGlobal = 'global';  //to translate
$strDbSpecific = 'database-specific';  //to translate
$strUsersHavingAccessToDb = 'Users having access to &quot;%s&quot;';  //to translate
$strChangeCopyUser = 'Change Login Information / Copy User';  //to translate
$strChangeCopyMode = 'Create a new user with the same privileges and ...';  //to translate
$strChangeCopyModeCopy = '... keep the old one.';  //to translate
$strChangeCopyModeJustDelete = ' ... delete the old one from the user tables.';  //to translate
$strChangeCopyModeRevoke = ' ... revoke all active privileges from the old one and delete it afterwards.';  //to translate
$strChangeCopyModeDeleteAndReload = ' ... delete the old one from the user tables and reload the privileges afterwards.';  //to translate
$strWildcard = 'wildcard';  //to translate
$strRowsModeFlippedHorizontal = 'horizontal (rotated headers)';//to translate
$strQueryTime = 'Query took %01.4f sec';//to translate
$strDumpComments = 'Include column comments as inline SQL-comments';//to translate
$strDBComment = 'Database comment: ';//to translate
$strQueryFrame = 'Query window';//to translate
$strQueryFrameDebug = 'Debugging information';//to translate
$strQueryFrameDebugBox = 'Active variables for the query form:\nDB: %s\nTable: %s\nServer: %s\n\nCurrent variables for the query form:\nDB: %s\nTable: %s\nServer: %s\n\nOpener location: %s\nFrameset location: %s.';//to translate
$strQuerySQLHistory = 'SQL-history';//to translate
$strMIME_MIMEtype = 'MIME-type';//to translate
$strMIME_transformation = 'Browser transformation';//to translate
$strMIME_transformation_options = 'Transformation options';//to translate
$strMIME_transformation_options_note = 'Please enter the values for transformation options using this format: \'a\',\'b\',\'c\'...<br />If you ever need to put a backslash ("\") or a single quote ("\'") amongst those values, backslashes it (for example \'\\\\xyz\' or \'a\\\'b\').';//to translate
$strMIME_transformation_note = 'For a list of available transformation options and their MIME-type transformations, click on %stransformation descriptions%s';//to translate
$strMIME_available_mime = 'Available MIME-types';//to translate
$strMIME_available_transform = 'Available transformations';//to translate
$strMIME_without = 'MIME-types printed in italics do not have a seperate transformation function';//to translate
$strMIME_description = 'Description';//to translate
$strMIME_nodescription = 'No Description is available for this transformation.<br />Please ask the author, what %s does.';//to translate
$strMIME_file = 'Filename';//to translate
$strTransformation_image_jpeg__plain = 'Takes an imagefile and outputs a link for it. First options argument is a possible prepended string like http://...';//to translate
$strTransformation_text_plain__formatted = 'Preserves original formatting of the field. No Escaping is done.';//to translate
$strTransformation_text_plain__unformatted = 'Displays HTML code as HTML entities. No HTML formatting is shown.';//to translate
$strTransformation_image_jpeg__link = 'Displays a link to this image (direct blob download, i.e.).';//to translate
$strTransformation_image_jpeg__inline = 'Displays an image directly in the table (uses wrapper, direct blob download, i.e.).';//to translate
?>
