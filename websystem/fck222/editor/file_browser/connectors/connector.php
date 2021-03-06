<?php

include('init.php') ;
include('config.php') ;
include('util.php') ;
include('io.php') ;
include('basexml.php') ;
include('commands.php') ;

if ( !$Config['Enabled'] )
    SendError( '203', "" ) ;

// Get the "UserFiles" path.
$GLOBALS["UserFilesPath"] = '' ;

if ( isset( $Config['UserFilesPath'] ) )
    $GLOBALS["UserFilesPath"] = $Config['UserFilesPath'] ;
else if ( isset( $_GET['ServerPath'] ) )
    $GLOBALS["UserFilesPath"] = $_GET['ServerPath'] ;
else
    $GLOBALS["UserFilesPath"] = $Config['UserFilesPath'] ;

if ( ! ereg( '/$', $GLOBALS["UserFilesPath"] ) )
    $GLOBALS["UserFilesPath"] .= '/' ;

if ( strlen( $Config['UserFilesAbsolutePath'] ) > 0 )
{
    $GLOBALS["UserFilesDirectory"] = $Config['UserFilesAbsolutePath'] ;

    if ( ! ereg( '/$', $GLOBALS["UserFilesDirectory"] ) )
        $GLOBALS["UserFilesDirectory"] .= '/' ;
}
else
{
    // Map the "UserFiles" path to a local directory.
    $GLOBALS["UserFilesDirectory"] = GetRootPath() . $GLOBALS["UserFilesPath"] ;
}

DoResponse() ;

function DoResponse()
{
    if ( !isset( $_GET['Command'] ) || !isset( $_GET['Type'] ) || !isset( $_GET['CurrentFolder'] ) )
        return ;

    // Get the main request informaiton.
    $sCommand       = $_GET['Command'] ;
    $sResourceType  = $_GET['Type'] ;
    $sCurrentFolder = $_GET['CurrentFolder'] ;

    // Check if it is an allowed type.
    if ( !in_array( $sResourceType, array('File','Image','Flash','Media') ) )
        return ;

    // Check the current folder syntax (must begin and start with a slash).
    if ( ! ereg( '/$', $sCurrentFolder ) ) $sCurrentFolder .= '/' ;
    if ( strpos( $sCurrentFolder, '/' ) !== 0 ) $sCurrentFolder = '/' . $sCurrentFolder ;

    // Check for invalid folder paths (..)
    if ( strpos( $sCurrentFolder, '..' ) )
        SendError( 102, "" ) ;

    // File Upload doesn't have to Return XML, so it must be intercepted before anything.
    if ( $sCommand == 'FileUpload' )
    {
        FileUpload( $sResourceType, $sCurrentFolder ) ;
        return ;
    }

    CreateXmlHeader( $sCommand, $sResourceType, $sCurrentFolder ) ;

    // Execute the required command.
    switch ( $sCommand )
    {
        case 'GetFolders' :
            GetFolders( $sResourceType, $sCurrentFolder ) ;
            break ;
        case 'GetFoldersAndFiles' :
            GetFoldersAndFiles( $sResourceType, $sCurrentFolder ) ;
            break ;
        case 'CreateFolder' :
            CreateFolder( $sResourceType, $sCurrentFolder ) ;
            break ;
    }

    CreateXmlFooter() ;

    exit ;
}
?>