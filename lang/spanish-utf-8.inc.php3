<?php

/* $Id$ */

$charset = 'utf-8';
$allow_recoding = TRUE;
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Tera, Peta, Exa
$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
$month = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
// Ver http://www.php.net/manual/es/function.strftime.php para definir
// la variable siguiente
$datefmt = '%d-%m-%Y a las %H:%M:%S';


$strAccessDenied = 'Acceso denegado ';
$strAction = 'Acción';
$strAddDeleteColumn = 'Añadir/borrar columna de criterio';
$strAddDeleteRow = 'Añadir/borrar fila de criterio';
$strAddNewField = 'Insertar nuevo campo';
$strAddPriv = 'Agregar nuevo privilegio';
$strAddPrivMessage = 'Ud. ha añadido un nuevo privilegio.';
$strAddSearchConditions = 'Insertar las condiciones de búsqueda (cuerpo de la cláusula "where"):';
$strAddToIndex = 'Añadido al índice &nbsp;%s&nbsp;columna(s)';
$strAddUser = 'Agregar nuevo usuario';
$strAddUserMessage = 'Ud. ha agregado un nuevo usuario.';
$strAffectedRows = 'Filas afectadas: ';
$strAfter = 'Después de %s';
$strAfterInsertBack = 'Volver';
$strAfterInsertNewInsert = 'Insertar un nuevo registro';
$strAllTableSameWidth = '¿Mostrar todas las tablas que tienen el mismo ancho?';
$strAll = 'Todos/as';
$strAlterOrderBy = 'Modificar el "Order By" de la tabla';
$strAnalyzeTable = 'Analizar tabla';
$strAnd = 'Y';
$strAnIndex = 'Se añadió un índice en %s';
$strAnyColumn = 'Cualquier columna';
$strAny = 'cualquiera';
$strAnyDatabase = 'Cualquier base de datos';
$strAnyHost = 'Cualquier servidor';
$strAnyTable = 'Cualquier tabla';
$strAnyUser = 'Cualquier usuario';
$strAPrimaryKey = 'Se añadió una clave primaria en %s';
$strAscending = 'Ascendente';
$strAtBeginningOfTable = 'Al comienzo de la tabla';
$strAtEndOfTable = 'Al final de la tabla';
$strAttr = 'Atributos';

$strBack = 'Volver';
$strBinary = ' Binario ';
$strBinaryDoNotEdit = ' Binario - ¡no editar! ';
$strBookmarkDeleted = 'El "bookmark" ha sido borrado.';
$strBookmarkLabel = 'Etiqueta';
$strBookmarkQuery = 'Consulta guardada en favoritos';
$strBookmarkThis = 'Guardar esta consulta en favoritos';
$strBookmarkView = 'Solamente ver';
$strBrowse = 'Examinar';
$strBzip = '"Comprimido con bzip"';

$strCantLoadMySQL = 'imposible cargar la extensión MySQL,<br />por favor revise la configuración de PHP.';
$strCantLoadRecodeIconv = 'No se puede cargar iconv o recodificar una extensión necesaria para la conversión de juegos de caracteres, configure php para permitir el uso de estas extensiones o desactive la conversión de juegos de caracteres en phpMyAdmin.';
$strCantRenameIdxToPrimary = 'No puede cambiar el nombre del índice a PRIMARY!';
$strCantUseRecodeIconv = 'No se puede utilizar iconv ni libiconv ni la función recode_string mientras se carga la extensión de informes. Comprueba la configuración de php.';
$strCardinality = 'Cardinalidad';
$strCarriage = 'Retorno de carro: \\r';
$strChange = 'Cambiar';
$strChangeDisplay = 'Elija el campo a mostrar';
$strChangePassword = 'Cambio de contraseña';
$strCharsetOfFile = 'Codificación de los caracteres del archivo:';
$strCheckAll = 'Revisar todos/as';
$strCheckDbPriv = 'Revisar privilegios de la base de datos';
$strCheckTable = 'Revisar tabla';
$strChoosePage = 'Elija la página a editar';
$strColComFeat = 'Mostrando los comentarios de la columna';
$strColumn = 'Columna';
$strColumnNames = 'Nombre de las columnas';
$strComments = 'Comentarios';
$strCompleteInserts = 'Completar los "Inserts"';
$strConfigFileError = '¡phpMyAdmin no puede leer el fichero de configuración!<br />Esto puede suceder si php encuentra un error sintáctico en él o bien php no puede encontrar el fichero.<br />Intente acceder al fichero de configuración directamente mediante el siguiente enlace y compruebe el(los) mensaje(s) de error que reciba. En muchas ocasiones falta una coma o punto y coma en algún sitio.<br />Si recibe una página en blanco, todo está correcto.';
$strConfigureTableCoord = 'Configure las coordenadas para la tabla %s';
$strConfirm = '¿Realmente quiere hacerlo?';
$strCookiesRequired = 'Las "cookies" deben estar habilitadas pasado este punto.';
$strCopyTable = 'Copiar la tabla a (base de datos<b>.</b>tabla):';
$strCopyTableOK = 'La tabla %s se copió a %s.';
$strCreate = 'Crear';
$strCreateIndex = 'Crear un índice en&nbsp;%s&nbsp;columnas';
$strCreateIndexTopic = 'Crear un nuevo índice';
$strCreateNewDatabase = 'Crear nueva base de datos';
$strCreateNewTable = 'Crear nueva tabla en base de datos %s';
$strCreatePage = 'Crear una nueva página';
$strCreatePdfFeat = 'Creación de los PDF';
$strCriteria = 'Criterio';

$strDatabase = 'Base de datos ';
$strDatabaseHasBeenDropped = 'La base de datos %s ha sido eliminada.';
$strDatabases = 'Bases de datos';
$strDatabasesStats = 'Estadísticas de la base';
$strDatabaseWildcard = 'Bases de datos (se permiten comodines):';
$strData = 'Datos';
$strDataOnly = 'Solamente datos';
$strDefault = 'Predeterminado';
$strDelete = 'Borrar';
$strDeleted = 'La fila se ha borrado';
$strDeletedRows = 'Filas borradas: ';
$strDeleteFailed = 'La operación de borrado falló!';
$strDeleteUserMessage = 'Ud. ha borrado el usuario %s.';
$strDescending = 'Descendente';
$strDisabled = 'Deshabilitado';
$strDisplayFeat = 'Mostrar los componentes';  //Features = ¿componentes?
$strDisplay = 'Mostrar';
$strDisplayOrder = 'Mostrar en este orden:';
$strDisplayPDF = 'Mostrar esquema PDF';
$strDoAQuery = 'Realizar una "consulta de ejemplo" (comodín: "%")';
$strDocu = 'Documentación';
$strDoYouReally = 'Realmente desea  ';
$strDropDB = 'Eliminar base de datos %s';
$strDrop = 'Eliminar';
$strDropTable = 'Borrar tabla';
$strDumpingData = 'Volcar la base de datos para la tabla';
$strDumpXRows = 'Volcar %s filas empezando por la fila %s.';
$strDynamic = 'dinámico/a';

$strEdit = 'Editar';
$strEditPDFPages = 'Editar páginas PDF';
$strEditPrivileges = 'Editar Privilegios';
$strEffective = 'Efectivo/a';
$strEmptyResultSet = 'MySQL ha devuelto un valor vacío (i.e. cero columnas).';
$strEmpty = 'Vaciar';
$strEnabled = 'Habilitado';
$strEnd = 'Fin';
$strEnglishPrivileges = ' Nota: Los nombres de privilegios de MySQL están expresados en inglés ';
$strError = 'Error';
$strExplain = 'Explicar el SQL';
$strExport = 'Exportar';
$strExportToXML = 'Exportar a formato XML';
$strExtendedInserts = '"Inserts" extendidos';
$strExtra = 'Extra';

$strField = 'Campo';
$strFieldHasBeenDropped = 'Se eliminó el campo %s';
$strFields = 'Campos';
$strFieldsEmpty = ' El número de campos esta vacío! ';
$strFieldsEnclosedBy = 'Campos encerrados por';
$strFieldsEscapedBy = 'Campos escapados por';
$strFieldsTerminatedBy = 'Campos terminados en';
$strFixed = 'fijo';
$strFlushTable = 'Vaciar el caché de la tabla ("FLUSH")';
$strFormat = 'Formato';
$strFormEmpty = '¡Falta un valor en el formulario!';
$strFullText = 'Textos completos';
$strFunction = 'Función';

$strGenBy = 'Generado por';
$strGeneralRelationFeat = 'Componentes de relación general';  //Features = ¿componentes?
$strGenTime = 'Tiempo de generación';
$strGo = 'Continúe';
$strGrants = 'Permisos';
$strGzip = '"Comprimido con gzip"';

$strHasBeenAltered = 'se modificó.';
$strHasBeenCreated = 'se creó.';
$strHaveToShow = 'Debe elegir al menos una columna para mostrar';
$strHomepageOfficial = 'Página oficial de phpMyAdmin';
$strHomepageSourceforge = 'Descargar phpMyAdmin de Sourceforge';
$strHome = 'Página de inicio';
$strHostEmpty = '¡¡El nombre del servidor está vacío!!';
$strHost = 'servidor';

$strIdxFulltext = 'Texto completo';
$strIfYouWish = 'Si desea cargar solamente una de las columnas de la tabla, especifíquelo, separando los campos con una coma.';
$strIgnore = 'Ignorar';
$strIndexes = 'índices';
$strIndexHasBeenDropped = 'El índice %s ha sido eliminado';
$strIndex = 'índice';
$strIndexName = 'Nombre del índice&nbsp;:';
$strIndexType = 'Tipo del índice&nbsp;:';
$strInsertAsNewRow = 'Insertar como una nueva fila';
$strInsertedRows = 'Filas insertadas:';
$strInsert = 'Insertar';
$strInsertNewRow = 'Insertar nueva fila';
$strInsertTextfiles = 'Insertar archivo de texto en la tabla';
$strInstructions = 'Instrucciones';
$strInUse = 'en uso';
$strInvalidName = '"%s" es una palabra reservada, no puede usarla como nombre de /Base de datos/tabla/campo.';

$strKeepPass = 'No cambiar la contraseña';
$strKeyname = 'Nombre de la clave';
$strKill = 'Matar proceso';

$strLength = 'Longitud';
$strLengthSet = 'Longitud/Valores*';
$strLimitNumRows = 'registros por página';
$strLineFeed = 'Retorno de carro: \\n';
$strLines = 'Líneas';
$strLinesTerminatedBy = 'Líneas terminadas en';
$strLinkNotFound = 'Enlace no encontrado';
$strLinksTo = 'Enlaces a';
$strLocationTextfile = 'Localización del archivo de texto';
$strLogin = 'Identificación';
$strLogout = 'Salir';
$strLogPassword = 'Contraseña:';
$strLogUsername = 'Usuario:';

$strMissingBracket = 'Falta una llave (\{ o \})';
$strModifications = 'Se han guardado las modificaciones';
$strModifyIndexTopic = 'Modificar un índice';
$strModify = 'Modificar';
$strMoveTable = 'Mover tabla a (Base de datos<b>.</b>tabla):';
$strMoveTableOK = 'La tabla %s ha sido movida a %s.';
$strMySQLCharset = 'Juegos de caracteres de MySQL';
$strMySQLReloaded = 'Reinicio de MySQL.';
$strMySQLSaid = 'MySQL ha dicho: ';
$strMySQLServerProcess = 'MySQL %pma_s1% ejecutándose en %pma_s2% como %pma_s3%';
$strMySQLShowProcess = 'Mostrar procesos';
$strMySQLShowStatus = 'Mostrar información de marcha de MySQL';
$strMySQLShowVars = 'Mostrar las variables del sistema MySQL';

$strName = 'Nombre';
$strNext = 'Próxima';
$strNoDatabases = 'No hay bases de datos';
$strNoDescription = 'Sin descripción';
$strNoDropDatabases = '"DROP DATABASE" las frases están deshabilitadas.';
$strNoExplain = 'Saltarse la explicacisn del SQL';
$strNoFrames = 'phpMyAdmin funciona mejor con un navegador que <b>soporte marcos (frames)</b>.';
$strNoIndex = 'No se ha definido el índice!';
$strNoIndexPartsDefined = 'No se han definido las partes del índice!';
$strNoModification = 'Sin cambios';
$strNone = 'Ninguna';
$strNo = 'No';
$strNoPassword = 'Sin contraseña';
$strNoPhp = 'Sin código PHP';
$strNoPrivileges = 'Sin privilegios';
$strNoRights = 'Usted no tiene suficientes privilegios para estar aquí ahora!';
$strNoTablesFound = 'No se han encontrado tablas en la base de datos.';
$strNotNumber = 'Esto no es un número!';
$strNotOK = 'no recibió el OK';
$strNotSet = 'Tabla <b>%s</b> no encontrada o no definida en %s';
$strNotValidNumber = '¡no es un número de fila válido!';
$strNoUsersFound = 'Usuario(s) no encontrado(s).';
$strNoValidateSQL = 'Saltarse la validacisn del SQL';
$strNull = 'Nulo';
$strNumSearchResultsInTable = '%s resultado(s) en la tabla <i>%s</i>';
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> resultado(s)';

$strOftenQuotation = 'A menudo comillas. OPCIONALMENTE significa que únicamente los campos char y varchar están encerrados por el caracter "enclosed by".';
$strOK = 'OK';
$strOperations = 'Operaciones';
$strOptimizeTable = 'Optimizar tabla';
$strOptionalControls = 'Opcional. Controla el modo de escribir o leer caracteres especiales.';
$strOptionally = 'OPCIONALMENTE';
$strOptions = 'Opciones';
$strOr = 'O';
$strOverhead = 'Desperdicio de ancho de banda';

$strPageNumber = 'Número de página:';
$strPartialText = 'Textos parciales';
$strPassword = 'Contraseña';
$strPasswordEmpty = '¡La contraseña está vacía!';
$strPasswordNotSame = '¡Las contraseñas no coinciden!';
$strPdfDbSchema = 'Esquema de la base de datos "%s" - Página %s';
$strPdfInvalidPageNum = '¡No se ha definido el número de página PDF!';
$strPdfInvalidTblName = '¡La tabla "%s" no existe!';
$strPdfNoTables = 'No existen tablas';
$strPhp = 'Crear código PHP';
$strPHPVersion = 'Versión de PHP';
$strPmaDocumentation = 'Documentación de phpMyAdmin';
$strPmaUriError = 'La directiva <tt>$cfg[\'PmaAbsoluteUri\']</tt> DEBE constar en el fichero de configuración!';
$strPos1 = 'Empezar';
$strPrevious = 'Previo';
$strPrimaryKey = 'Clave Primaria';
$strPrimaryKeyHasBeenDropped = 'La clave primaria ha sido eliminada';
$strPrimaryKeyName = 'El nombre de la clave primaria debe ser... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>debe</b> ser el nombre de y <b>únicamente de</b> una clave primaria!)';
$strPrimary = 'Primaria';
$strPrintView = 'Vista de impresión';
$strPrivileges = 'Privilegios';
$strProperties = 'Propiedades';

$strQBE = 'Consulta de ejemplo';
$strQBEDel = 'Borrar';
$strQBEIns = 'Insertar';
$strQueryOnDb = 'Consulta en la base de datos <b>%s</b>:';

$strRecords = 'Campos';
$strReferentialIntegrity = 'Compruebe la integridad referencial:';
$strRelationNotWorking = 'Los componentes adicionales para trabajar con tablas vinculadas fueron desactivados. Para saber porqué, dé clic %saquí%s.';  //Features = ¿componentes?
$strRelationView = 'Vista de relaciones';
$strReloadFailed = 'El reinicio de MySQL ha fallado.';
$strReloadMySQL = 'Reinicio de MySQL';
$strRememberReload = 'Recuerde reiniciar el servidor.';
$strRenameTable = 'Cambiar el nombre de la tabla a';
$strRenameTableOK = 'Tabla %s ahora se llama %s';
$strRepairTable = 'Reparar la tabla';
$strReplace = 'Reemplazar';
$strReplaceTable = 'Reemplazar los datos de la tabla con archivo';
$strReset = 'Reset';
$strReType = 'Re-escriba';
$strRevokeGrantMessage = 'Ud. ha revocado el privilegio "Grant" para %s';
$strRevokeGrant = 'Revocar privilegios "Grant"';
$strRevokeMessage = 'Ud. ha revocado los privilegios para %s';
$strRevokePriv = 'Revocar los privilegios';
$strRevoke = 'Revocar';
$strRowLength = 'Longitud de la fila';
$strRows = 'Filas';
$strRowsFrom = 'filas empezando de';
$strRowSize = ' Tamaño de la fila ';
$strRowsModeHorizontal = 'horizontal';
$strRowsModeOptions = 'en modo %s y repite encabezados cada %s celdas';
$strRowsModeVertical = 'vertical';
$strRowsStatistic = 'Estadísticas de la fila';
$strRunning = 'ejecutándose en %s';
$strRunQuery = 'Ejecutar la consulta';
$strRunSQLQuery = 'Ejecute la/s consulta/s SQL en la base de datos %s';

$strSave = 'Grabar';
$strScaleFactorSmall = 'El factor de la escala es demasiado pequeño para poner el esquema en una página';
$strSearch = 'Buscar';
$strSearchFormTitle = 'Buscar en la base de datos';
$strSearchInTables = 'En la(s) tabla(s):';
$strSearchNeedle = 'Palabra(s) o valor(es) a buscar (comodín: "%"):';
$strSearchOption1 = 'al menos una de estas palabras';
$strSearchOption2 = 'Todas las palabras';
$strSearchOption3 = 'La frase exacta';
$strSearchOption4 = 'como expresión regular';
$strSearchResultsFor = 'Resultados de la búsqueda por "<i>%s</i>" %s:';
$strSearchType = 'Encontrado:';
$strSelectADb = 'Seleccione una base de datos';
$strSelectAll = 'Seleccione todo';
$strSelectFields = 'Seleccionar campos (al menos uno):';
$strSelectNumRows = 'en la consulta';
$strSelect = 'Seleccionar';
$strSelectTables = 'Seleccionar tablas';
$strSend = 'enviar';
$strServerChoice = 'Elección del servidor';
$strServerVersion = 'Versión del servidor';
$strSetEnumVal = 'Si el tipo de campo es "enum" o "set", por favor ingrese los valores usando este formato: \'a\',\'b\',\'c\'...<br />Si alguna vez necesita poner una barra invertida("\") o una comilla simple ("\'") entre esos valores, siempre ponga una barra invertida. (Por ejemplo \'\\\\xyz\' or \'a\\\'b\').';
$strShowAll = 'Mostrar todo';
$strShowColor = 'Mostrar color';
$strShowCols = 'Mostrar columnas';
$strShowGrid = 'Mostrar cuadrícula';
$strShowingRecords = 'Mostrando campos ';
$strShow = 'Mostrar';
$strShowPHPInfo = 'Mostrar información de PHP';
$strShowTableDimension = 'Mostrar la dimensión de las tablas';
$strShowTables = 'Mostrar las tablas';
$strShowThisQuery = ' Mostrar esta consulta otra vez ';
$strSingly = '(solo)';
$strSize = 'Tamaño';
$strSort = 'Ordenar';
$strSpaceUsage = 'Espacio utilizado';
$strSplitWordsWithSpace = 'Palabras separadas por un espacio (" ").';
$strSQLQuery = 'consulta SQL';
$strSQLResult = 'Resultado SQL';
$strSQL = 'SQL';
$strStatement = 'Frases';
$strStrucCSV = 'Datos CSV ';
$strStrucData = 'Estructura y datos';
$strStrucDrop = 'Añadir \'drop table\'';
$strStrucExcelCSV = 'CSV para datos de MS Excel';
$strStrucOnly = 'Únicamente la estructura ';
$strStructPropose = 'Planteamiento de una estructura de tabla';
$strStructure = 'Estructura';
$strSubmit = 'Enviar';
$strSuccess = 'Su consulta ha sido ejecutada con éxito';
$strSum = 'Tamaño de las tablas';

$strTableComments = 'Comentarios de la tabla';
$strTableEmpty = 'El nombre de la tabla está vacío!';
$strTableHasBeenDropped = 'Se ha eliminado la tabla %s';
$strTableHasBeenEmptied = 'Se ha vaciado la tabla %s';
$strTableHasBeenFlushed = 'Se ha vaciado el caché de la tabla %s';
$strTableMaintenance = 'Mantenimiento de la tabla';
$strTables = '%s tabla(s)';
$strTableStructure = 'Estructura de tabla para la tabla';
$strTable = 'tabla ';
$strTableType = 'Tipo de tabla';
$strTextAreaLength = ' Debido a su longitud,<br /> este campo puede no ser editable ';
$strTheContent = 'El contenido de su archivo ha sido insertado.';
$strTheContents = 'El contenido del archivo reemplaza el contenido de la tabla seleccionada para las columnas idénticas primarias o únicas.';
$strTheTerminator = 'El terminador de los campos.';
$strTotal = 'total';
$strType = 'Tipo';

$strUncheckAll = 'Desmarcar todos';
$strUnique = 'Único';
$strUnselectAll = 'Deselecciona todo';
$strUpdatePrivMessage = 'Ud. ha actualizado los privilegios para %s.';
$strUpdateProfile = 'Actualiza el perfil:';
$strUpdateProfileMessage = 'Se ha actualizado el perfil.';
$strUpdateQuery = 'Modificar la consulta';
$strUsage = 'Uso';
$strUseBackquotes = 'Usar backquotes con tablas y nombres de campo';
$strUserEmpty = 'El nombre de usuario está vacío!';
$strUserName = 'Nombre de usuario';
$strUsers = 'Usuarios';
$strUser = 'Usuario';
$strUseTables = 'Usar tablas';

$strValidateSQL = 'Validar el SQL';
$strValue = 'Valor';
$strViewDumpDB = 'Ver volcado esquema de la base de datos';
$strViewDump = 'Mostrar volcado esquema de la tabla';

$strWelcome = 'Bienvenido a %s';
$strWithChecked = 'Con marca:';
$strWrongUser = 'Usuario/contraseña equivocado. Acceso denegado.';

$strYes = 'Sí';

$strZip = '"comprimido con zip"';
// To translate


$strBeginCut = 'BEGIN CUT';  //to translate
$strBeginRaw = 'BEGIN RAW';  //to translate

$strEndCut = 'END CUT';  //to translate
$strEndRaw = 'END RAW';  //to translate

$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';  //to translate
$strSQPBugInvalidIdentifer = 'Invalid Identifer';  //to translate
$strSQPBugUnclosedQuote = 'Unclosed quote';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate

?>
