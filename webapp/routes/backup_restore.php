<?php

/**
 * Active Ecommerce Backup And Restore manager: ajax/backup_restore.php . this is rout file
 *
 * Generate short sharing link
 *
 * PHP version >= 5.3
 *
 * @category  PHP
 * @package   Active Ecommerce Backup And Restore manager Addon
 * @author    Reza Kia <kia@aryaclub.com>
 * @copyright 2023 Reza Kia
 * @license   Apache 2.0
 * @link      http://aryaclub.com/
 */

use App\Http\Controllers\BackupController;

//Admin

//Route::controller(BackupController::class)->group(function () {
//    Route::get('/backups', 'index')->name('backups')->middleware(['auth', 'admin', 'prevent-back-history']);;
//    Route::post('/backups', 'store')->name('backups.store');
//    Route::post('/backups/storeaddons', 'storeaddons')->name('backups.storeaddons');
//    Route::get('/backups/download/database/{key}', 'downloadDatabase')->name('backups.download.database');
//    Route::get('/backups/download/storage/{key}/{backuptype}', 'downloadStorage')->name('backups.download.storage');
//    Route::post('/backups/restore', 'restore')->name('backups.restore');
//    Route::delete('/backups/destroy', 'destroy')->name('backups.destroy');
//    Route::post('/backups/shorten', 'shorten')->name('backups.shorten');
//    Route::post('/backups/sendfilestoemail', 'sendfilestoemail')->name('backups.sendfilestoemail');
//    Route::get('/backups/viewfilefromlink/{linkkey}', 'viewfilefromlink')->name('backups.viewfilefromlink');
//
//    Route::get('/backups/pelpelak0/{myfile}', 'downloadFileFromLink0')->name('backups.pelpelak0');
//    Route::get('/backups/pelpelak1/{countfiles_sh_share_myfile}', 'downloadFileFromLink1')->name('backups.pelpelak1');
//
//
//    Route::post('/backups/editsharelink', 'editBackupsShareLinkInfo')->name('backups.editsharelink');
//    Route::get('/backups/deletesharelink/{idfilename}', 'deleteBackupsShareLinkInfo')->name('backups.deletesharelink');
//});


Route::controller(BackupController::class)->group(function () {
    Route::get('/backups', 'index')->name('backups')->middleware(['auth', 'admin', 'prevent-back-history']);;
    Route::post('/backups/storexx', 'storexx')->name('backups.storexx');
    Route::post('/backups/download/backups', 'downloadBackups')->name('backups.download.backups');
    Route::post('/backups/download/restore', 'restoreBackups')->name('backups.download.restore');
    Route::delete('/backups/download/delete', 'deleteBackups')->name('backups.download.delete');
    Route::post('/backups/shorten', 'shorten')->name('backups.shorten');
    Route::post('/backups/sendfilestoemail', 'sendfilestoemail')->name('backups.sendfilestoemail');
    Route::get('/backups/viewfilefromlink/{linkkey}', 'viewfilefromlink')->name('backups.viewfilefromlink');
    Route::get('/backups/captcha/{tmp}', 'captcha')->name('backups.captcha');
    Route::get('/backups/pelpelak1/{countfiles_sh_share_myfile}', 'downloadFileFromLink1')->name('backups.pelpelak1');
    Route::post('/backups/editsharelink', 'editBackupsShareLinkInfo')->name('backups.editsharelink');
    Route::post('/backups/share_modal', 'share_modal')->name('backups.share_modal');
});
