<?php

/* $Id$ */

/**
 * Translation made by: Sime Essert <sime@nofrx.org>
 */

$charset = 'iso-8859-2';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Tera, Peta, Exa
$byteUnits = array('Byteova', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('Ned', 'Pon', 'Uto', 'Sri', '�et', 'Pet', 'Sub');
$month = array('Sij', 'Vel', 'O�u', 'Tra', 'Svi', 'Lip', 'Srp', 'Kol', 'Ruj', 'Lis', 'Stu', 'Pro');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d. %B %Y. u %H:%M';


$strAccessDenied = 'Pristup odbijen';
$strAction = 'Akcija';
$strAddDeleteColumn = 'Dodaj/izbri�i stupac';
$strAddDeleteRow = 'Dodaj/izbri�i polje za kriterij';
$strAddNewField = 'Dodaj novi stupac';
$strAddPriv = 'Dodaj novu privilegiju';
$strAddPrivMessage = 'Privilegija je dodana';
$strAddSearchConditions = 'Dodaj uvjete pretra�ivanja (dio "where" upita):';
$strAddToIndex = 'Dodaj klju�';
$strAddUser = 'Dodaj novog korisnika';
$strAddUserMessage = 'Korisnik dodan';
$strAffectedRows = 'Promijenjeno redaka:';
$strAfterInsertBack = 'Natrag na prethodnu stranicu';
$strAfterInsertNewInsert = 'Dodaj jo� jedan red';
$strAfter = 'Nakon %s';
$strAll = 'Sve';
$strAlterOrderBy = 'Promijeni redoslijed u tablici';
$strAnalyzeTable = 'Analiziraj tablicu';
$strAnd = 'i';
$strAnIndex = 'Klju� je upravo dodan %s';
$strAny = 'Bilo koji';
$strAnyColumn = 'Bilo koji stupac';
$strAnyDatabase = 'Bilo koja baza podataka';
$strAnyHost = 'Bilo koji server';
$strAnyTable = 'Bilo koja tablica';
$strAnyUser = 'Bilo koji korisnik';
$strAPrimaryKey = 'Primarni klju� je upravo dodan %s';
$strAscending = 'Rastu�i';
$strAtBeginningOfTable = 'Na po�etku tablice';
$strAtEndOfTable = 'Na kraju tablice';
$strAttr = 'Svojstva';

$strBack = 'Nazad';
$strBinary = 'Binarno';
$strBinaryDoNotEdit = 'Binarno - ne mijenjaj';
$strBookmarkDeleted = 'Oznaka je upravo izbrisana.';
$strBookmarkLabel = 'Naziv';
$strBookmarkQuery = 'Ozna�eni SQL-upit';
$strBookmarkThis = 'Ozna�i SQL-upit';
$strBookmarkView = 'Vidi samo';
$strBrowse = 'Pregled';
$strBzip = '"bzip-ano"';

$strCantLoadMySQL = 'Ne mogu u�itati MySql ekstenziju,<br /> molim provjerite PHP konfiguraciju.';
$strCantRenameIdxToPrimary = 'Ne mogu promijeniti klju� u PRIMARY (primarni) !';
$strCardinality = 'Kardinalnost';
$strCarriage = 'Novi red (carriage return): \\r';
$strChangePassword = 'Promijeni �ifru';
$strChange = 'Promijeni';
$strCheckAll = 'Ozna�i sve';
$strCheckDbPriv = 'Provjeri privilegije baze podataka';
$strCheckTable = 'Provjeri tablicu';
$strColumnNames = 'Imena stupaca';
$strColumn = 'Stupac';
$strCompleteInserts = 'Kompletan INSERT (sa imenima polja)';
$strConfirm = 'Da li stvarno to �elite u�initi?';
$strCookiesRequired = '<i>Cookies</i> moraju biti omogu�eni.';
$strCopyTable = 'Kopiram tablicu u (baza<b>.</b>tablica):';
$strCopyTableOK = 'Tablica %s je upravo kopirana u %s.';
$strCreateIndex = 'Napravi klju� sa&nbsp;%s&nbsp;stupcem(aca)';
$strCreateIndexTopic = 'Napravi novi klju�';
$strCreate = 'Napravi';
$strCreateNewDatabase = 'Napravi bazu podataka';
$strCreateNewTable = 'Napravi novu tablicu u bazi ';
$strCriteria = 'Kriterij';

$strDatabase = 'Baza podataka ';
$strDatabaseHasBeenDropped = 'Baza %s je izbrisana.';
$strDatabases = 'baze';
$strDatabasesStats = 'Statistika baze';
$strDatabaseWildcard = 'Baza (<i>wildcard</i> znakovi dozvoljeni):';
$strDataOnly = 'Samo podaci';
$strData = 'Podaci';
$strDefault = 'Default';
$strDeleted = 'Red je izbrisan';
$strDeletedRows = 'Izbrisani redovi:';
$strDeleteFailed = 'Brisanje nije uspjelo!';
$strDelete = 'Izbri�i';
$strDeleteUserMessage = 'Upravo ste izbrisali korisnika: %s.';
$strDescending = 'Opadaju�i';
$strDisplayOrder = 'Redoslijed prikaza:';
$strDisplay = 'Prika�i';
$strDoAQuery = 'Napravi "upit po primjeru" (<i>wildcard</i>: "%")';
$strDocu = 'Dokumentacija';
$strDoYouReally = 'Da li stvarno �elite ';
$strDropDB = 'Izbri�i bazu %s';
$strDrop = 'Izbri�i';
$strDropTable = 'Izbri�i tablicu';
$strDumpingData = 'Izvoz <i>(dump)</i> podataka tablice';
$strDynamic = 'dinami�no';

$strEditPrivileges = 'Promijeni privilegije';
$strEdit = 'Promijeni';
$strEffective = 'Efektivno';
$strEmpty = 'Isprazni';
$strEmptyResultSet = 'MySQL je vratio prazan rezultat (nula redaka).';
$strEnd = 'Kraj';
$strEnglishPrivileges = 'Opaska: MySQL imena privilegija moraju biti engleskom ';
$strError = 'Gre�ka';
$strExtendedInserts = 'Pro�ireni INSERT';
$strExtra = 'Dodatno';

$strFieldHasBeenDropped = 'Polje %s izbrisano';
$strField = 'Polje';
$strFields = 'Broj polja';
$strFieldsEmpty = ' Broj polja je nula! ';
$strFieldsEnclosedBy = 'Podaci ogra�eni sa';
$strFieldsEscapedBy = '<i>Escape</i> znak &nbsp; &nbsp; &nbsp;';
$strFieldsTerminatedBy = 'Podaci razdvojeni sa';
$strFixed = 'sre�eno';
$strFlushTable = 'Osvje�i tablicu';
$strFormat = 'Format';
$strFormEmpty = 'Nedostaje vrijednost u formi !';
$strFullText = 'Pun tekst';
$strFunction = 'Funkcija';

$strGenTime = 'Vrijeme podizanja';
$strGo = 'Kreni';
$strGrants = 'Omogu�i';
$strGzip = '"gzip-ano"';

$strHasBeenAltered = 'je promijenjen.';
$strHasBeenCreated = 'je kreiran/a.';
$strHomepageOfficial = 'phpMyAdmin WEB site';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Download Stranica';
$strHome = 'Po�etna stranica';
$strHostEmpty = 'Ime domene je prazno!';
$strHost = 'Host (domena)';

$strIdxFulltext = 'Puni tekst';
$strIfYouWish = 'Ukoliko �elite pregledati samo neke stupce u tablici, navedite ih razdvojene zarezom';
$strIgnore = 'Ignoriraj';
$strIndexes = 'Klju�evi';
$strIndexHasBeenDropped = 'Klju� %s je izbrisan';
$strIndex = 'Klju�';
$strIndexName = 'Ime klju�a :';
$strIndexType = 'Vrsta klju�a :';
$strInsertAsNewRow = 'Unesi kao novi redak';
$strInsertedRows = 'Uneseni reci:';
$strInsertNewRow = 'Unesi novi redak';
$strInsert = 'Novi redak';
$strInsertTextfiles = 'Ubaci podatke iz tekstualne datoteke';
$strInstructions = 'Uputstva';
$strInUse = 'se koristi';
$strInvalidName = '"%s" je rezervirana rije�, \nne mo�e se koristiti kao ime polja, tablice ili baze.';

$strKeepPass = 'Ne mijenjaj lozinku';
$strKeyname = 'Ime Klju�a';
$strKill = 'Zaustavi';

$strLength = 'Du�ina';
$strLengthSet = 'Du�ina/Vrijednost*';
$strLimitNumRows = 'Broj redaka po stranici';
$strLineFeed = '<i>Linefeed</i>: \\n';
$strLines = 'Linije';
$strLinesTerminatedBy = 'Linije zavr�avaju na';
$strLinksTo = 'Links to';
$strLocationTextfile = 'Lokacija tekstualne datoteke';
$strLogin = 'Prijava';
$strLogout = 'Odjava';
$strLogPassword = 'Lozinka:';
$strLogUsername = 'Korisni�ko ime:';

$strModifications = 'Izmjene su spremljene';
$strModifyIndexTopic = 'Promijeni klju�';
$strModify = 'Promijeni';
$strMoveTableOK = 'Tablica %s se sada zove %s.';
$strMoveTable = 'Preimenuj tablicu u (baza<b>.</b>tablica):';
$strMySQLReloaded = 'MySQL je ponovno pokrenut (<i>reload</i>).';
$strMySQLSaid = 'MySQL poruka: ';
$strMySQLServerProcess = 'MySQL %pma_s1% pokrenut na %pma_s2%, prijavljen kao %pma_s3%';
$strMySQLShowProcess = 'Prika�i listu procesa';
$strMySQLShowStatus = 'Prika�i MySQL runtime informacije';
$strMySQLShowVars = 'Prika�i MySQL sistemske varijable';

$strName = 'Ime';
$strNext = 'Sljede�i';
$strNoDatabases = 'Baza ne postoji';
$strNoDropDatabases = '"DROP DATABASE" naredba je onemogu�ena.';
$strNoFrames = 'phpMyAdmin preferira preglednike koji podr�avaju frame-ove.';
$strNoIndex = 'Klju� nije definiran!';
$strNoIndexPartsDefined = 'Dijelovi klju�a nisu definirani!';
$strNoModification = 'Nema nikakvih promjena';
$strNo = 'Ne';
$strNone = 'Ni�ta';
$strNoPassword = 'Nema lozinke';
$strNoPrivileges = 'Nema privilegija';
$strNoQuery = 'Nema SQL upita!';
$strNoRights = 'Nemate dovoljno prava za ovo podru�je!';
$strNoTablesFound = 'Tablica nije prona�ena u bazi.';
$strNotNumber = 'To nije broj!';
$strNotValidNumber = ' nije odgovaraju�i broj redaka!';
$strNoUsersFound = 'Korisnik(ci) nije prona�en.';
$strNull = 'Null';

$strOftenQuotation = 'Navodnici koji se koriste. OPCIONO se misli da neka polja mogu, ali ne moraju biti pod navodnicima.';
$strOptimizeTable = 'Optimiziraj tablicu';
$strOptionalControls = 'Opciono. Znak koji prethodi specijalnim znakovima.';
$strOptionally = 'OPCIONO';
$strOr = 'ili';
$strOverhead = 'Prekora�enje';

$strPartialText = 'Dio teksta';
$strPasswordEmpty = 'Lozinka je prazna!';
$strPassword = 'Lozinka';
$strPasswordNotSame = 'Lozinka se ne podudara!';
$strPHPVersion = 'verzija PHP-a';
$strPmaDocumentation = 'phpMyAdmin dokumentacija';
$strPmaUriError = '<tt>$cfg[\'PmaAbsoluteUri\']</tt> dio mora biti namje�ten u konfiguracijskoj datoteci (config.inc.php)!';
$strPos1 = 'Po�etak';
$strPrevious = 'Prethodna';
$strPrimaryKeyHasBeenDropped = 'Primarni klju� je izbrisan';
$strPrimaryKeyName = 'Ime primarnog klju�a mora biti... PRIMARY!';
$strPrimaryKey = 'Primarni klju�';
$strPrimaryKeyWarning = '("PRIMARY" <b>mora</b> biti ime i <b>samo</b> ime primarnog klju�a!)';
$strPrimary = 'Primarni';
$strPrintView = 'Sa�etak';
$strPrivileges = 'Privilegije';
$strProperties = 'Svojstva';

$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQBE = 'Upit po primjeru';
$strQueryOnDb = 'SQL upit na bazi <b>%s</b>:';

$strRecords = 'Reci';
$strReferentialIntegrity = 'Provjeri ispravnost veza:';
$strReloadFailed = 'ponovno pokretanje MySQL-a nije uspjelo.';
$strReloadMySQL = 'Ponovo pokreni MySQL (<i>reload</i>)';
$strRememberReload = 'Ne zaboravite ponovo pokrenuti (<i>reload</i>) server.';
$strRenameTableOK = 'Tablici %s promjenjeno ime u %s';
$strRenameTable = 'Promijeni ime tablice u ';
$strRepairTable = 'Popravi tablicu';
$strReplaceTable = 'Zamijeni podatke u tablici sa datotekom';
$strReplace = 'Zamijeni';
$strReset = 'Resetiraj';
$strReType = 'Ponovite unos';
$strRevokeGrantMessage = 'Opozvali ste Grant privilegije za  %s';
$strRevokeGrant = 'Opozovi Grant';
$strRevokeMessage = 'Opozvali ste privilegije za %s';
$strRevoke = 'Opozovi';
$strRevokePriv = 'Opozovi privilegije';
$strRowLength = 'Du�ina retka';
$strRowsFrom = ' redaka po�ev�i od retka';
$strRowSize = ' Veli�ina retka ';
$strRowsModeHorizontal = 'horizontalnom';
$strRowsModeOptions = 'u %s na�inu i ispi�i zaglavlje poslije svakog %s retka';
$strRowsModeVertical = 'vertikalnom';
$strRows = 'Redaka';
$strRowsStatistic = 'Statistika redaka';
$strRunning = 'pokrenuto na %s';
$strRunQuery = 'Izvr�i SQL upit';
$strRunSQLQuery = 'Izvr�i SQL upit(e) na bazi ';

$strSave = 'Spremi';
$strSelectADb = 'Izaberite bazu';
$strSelectAll = 'Ozna�i sve';
$strSelectFields = 'Izaberite polja (najmanje jedno)';
$strSelectNumRows = 'u upitu';
$strSelect = 'Ozna�i';
$strSend = 'Spremi u datoteku';
$strServerChoice = 'Izbor servera';
$strServerVersion = 'Verzija servera';
$strSetEnumVal = 'Ako je polje "enum" ili "set", unesite vrijednosti u formatu: \'a\',\'b\',\'c\'...<br />Ako vam zatreba <i>backslash</i> ("\") ili jednostruki navodnik ("\'") navedite ih koriste�i <i>backslash</i> (npr. \'\\\\xyz\' ili \'a\\\'b\').';
$strShowAll = 'Prika�i sve';
$strShowCols = 'Prika�i stupce';
$strShowingRecords = 'Prikaz redaka';
$strShowPHPInfo = 'Prika�i informacije o PHP-u';
$strShow = 'Prika�i';
$strShowTables = 'Prika�i tablice';
$strShowThisQuery = ' Prika�i ovaj upit ponovo ';
$strSingly = '(po jednom polju)';
$strSize = 'Veli�ina';
$strSort = 'Sortiranje';
$strSpaceUsage = 'Zauze�e';
$strSQLQuery = 'SQL-upit';
$strStatement = 'Ime';
$strStrucCSV = 'CSV format';
$strStrucData = 'Struktura i podaci';
$strStrucDrop = 'Dodaj \'drop table\'';
$strStrucExcelCSV = 'CSV za Ms Excel';
$strStrucOnly = 'Samo struktura';
$strSubmit = 'Pokreni';
$strSuccess = 'Va� SQL upit je uspje�no izvr�en';
$strSum = 'Ukupno';

$strTableComments = 'Komentar tablice';
$strTableEmpty = 'Ime tablice je prazno!';
$strTableHasBeenDropped = 'Tablica %s je izbrisana';
$strTableHasBeenEmptied = 'Tablica %s je ispra�njena';
$strTableHasBeenFlushed = 'Tablica %s je osvje�ena';
$strTableMaintenance = 'Radnje na tablici';
$strTables = '%s tablica/e';
$strTableStructure = 'Struktura tablice';
$strTable = 'tablica ';
$strTableType = 'Vrsta tablice';
$strTextAreaLength = ' Zbog veli�ine ovog polja,<br /> polje mo�da ne�ete mo�i mijenjati ';
$strTheContent = 'Sadr�aj datoteke je stavljen u bazu.';
$strTheContents = 'Sadr�aj tablice zamijeni sa sadr�ajem datoteke sa identi�nim primarnim i jedinstvenim (unique) klju�em.';
$strTheTerminator = 'Znak za odjeljivanje polja u datoteci.';
$strTotal = 'ukupno';
$strType = 'Vrsta';

$strUncheckAll = 'Makni oznake';
$strUnique = 'Jedinstveni klju�';
$strUnselectAll = 'Makni oznake';
$strUpdatePrivMessage = 'Promijenili ste privilegije za %s.';
$strUpdateProfileMessage = 'Profil je promijenjen.';
$strUpdateProfile = 'Promijeni profil:';
$strUpdateQuery = 'Promijeni SQL-upit';
$strUsage = 'Zauze�e';
$strUseBackquotes = 'Koristi \' za ograni�avanje imena polja';
$strUserEmpty = 'Ime korisnika je prazno!';
$strUser = 'Korisnik';
$strUserName = 'Ime korisnika';
$strUsers = 'Korisnici';
$strUseTables = 'Koristi tablice';

$strValue = 'Vrijednost';
$strViewDumpDB = 'Prika�i dump (shemu) baze';
$strViewDump = 'Prika�i dump (shemu) tablice';

$strWelcome = 'Dobrodo�li u %s';
$strWithChecked = 'Ozna�eno:';
$strWrongUser = 'Pogre�no korisni�ko ime/lozinka. Pristup odbijen.';

$strYes = 'Da';

$strZip = '"zip-ano"';
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
$strSearchFormTitle = 'Search in database';//to translate
$strSearchInTables = 'Inside table(s):';//to translate
$strSearchNeedle = 'Word(s) or value(s) to search for (wildcard: "%"):';//to translate
$strSearchOption1 = 'at least one of the words';//to translate
$strSearchOption2 = 'all words';//to translate
$strSearchOption3 = 'the exact phrase';//to translate
$strSearchOption4 = 'as regular expression';//to translate
$strSearchResultsFor = 'Search results for "<i>%s</i>" %s:';//to translate
$strSearch = 'Search';//to translate
$strSearchType = 'Find:';//to translate
$strSelectTables = 'Select Tables';  //to translate
$strShowColor = 'Show color';  //to translate
$strShowGrid = 'Show grid';  //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate
$strSplitWordsWithSpace = 'Words are seperated by a space character (" ").';//to translate
$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';  //to translate
$strSQLResult = 'SQL result'; //to translate
$strSQL = 'SQL'; //to translate
$strSQPBugInvalidIdentifer = 'Invalid Identifer';  //to translate
$strSQPBugUnclosedQuote = 'Unclosed quote';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate
$strStructPropose = 'Propose table structure';  //to translate
$strStructure = 'Structure';  //to translate

$strValidateSQL = 'Validate SQL';  //to translate

?>
