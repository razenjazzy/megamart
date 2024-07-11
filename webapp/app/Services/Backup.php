<?php
/**
 * Active Ecommerce Backup And Restore manager: ajax/Backup.php
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

namespace App\Services;

use Carbon\Carbon;
use DB;
use Exception;
use File;
use Redirect;
use Symfony\Component\Process\Process;
use ZipArchive;
use App\Utility\PclZip as Zip;
use Illuminate\Filesystem\Filesystem;
use App\Services as IMysqldump;
use Illuminate\Support\Str;

class Backup
{

    protected $file;

    protected $folder;

    public function __construct()
    {
        $this->file = new Filesystem();
    }

    public function createBackupFolderxx($request, $now1, $now2)
    {
        $backupFolder = $this->createFolder(base_path('databasebackups'));
        $this->folder = $this->createFolder($backupFolder . DIRECTORY_SEPARATOR . $now1);
        $file = base_path('databasebackups/backup.json');
        $data = $this->getBackupListxx();
        if (isset($request->name)) {
            $data[$now1] = [
                'name' => $request->name ?? $now1,
                'date' => $now2,
                'klid' => $now1,
                'type' => $request->backup_ids
            ];

        } else {

            $animals = [
                'aardvark', 'albatross', 'alligator', 'alpaca', 'ant', 'anteater', 'antelope', 'ape', 'armadillo', 'donkey',
                'baboon', 'badger', 'barracuda', 'bat', 'bear', 'beaver', 'bee', 'bison', 'boar', 'buffalo', 'galago', 'butterfly',
                'camel', 'caribou', 'cat', 'caterpillar', 'cattle', 'chamois', 'cheetah', 'chicken', 'chimpanzee', 'chinchilla',
                'chough', 'clam', 'cobra', 'cockroach', 'cod', 'cormorant', 'coyote', 'crab', 'crane', 'crocodile', 'crow', 'curlew',
                'deer', 'dinosaur', 'dog', 'dogfish', 'dolphin', 'donkey', 'dotterel', 'dove', 'dragonfly', 'duck', 'dugong', 'dunlin',
                'eagle', 'echidna', 'eel', 'eland', 'elephant', 'elephant-seal', 'elk', 'emu', 'falcon', 'ferret', 'finch', 'fish',
                'flamingo', 'fly', 'fox', 'frog', 'gaur', 'gazelle', 'gerbil', 'giant-panda', 'giraffe', 'gnat', 'gnu', 'goat', 'goose',
                'goldfinch', 'goldfish', 'gorilla', 'goshawk', 'grasshopper', 'grouse', 'guanaco', 'guinea-fowl', 'guinea-pig', 'gull',
                'hamster', 'hare', 'hawk', 'hedgehog', 'heron', 'herring', 'hippopotamus', 'hornet', 'horse', 'human', 'hummingbird', 'hyena',
                'jackal', 'jaguar', 'jay', 'jay, blue', 'jellyfish', 'kangaroo', 'koala', 'komodo-dragon', 'kouprey', 'kudu', 'lapwing',
                'lark', 'lemur', 'leopard', 'lion', 'llama', 'lobster', 'locust', 'loris', 'louse', 'lyrebird', 'magpie', 'mallard', 'manatee',
                'marten', 'meerkat', 'mink', 'mole', 'monkey', 'moose', 'mouse', 'mosquito', 'mule', 'narwhal', 'newt', 'nightingale',
                'octopus', 'okapi', 'opossum', 'oryx', 'ostrich', 'otter', 'owl', 'ox', 'oyster', 'panther', 'parrot', 'partridge', 'peafowl',
                'pelican', 'penguin', 'pheasant', 'pig', 'pigeon', 'pony', 'porcupine', 'porpoise', 'prairie-dog', 'quail', 'quelea', 'rabbit',
                'raccoon', 'rail', 'ram', 'rat', 'raven', 'red-deer', 'red-panda', 'reindeer', 'rhinoceros', 'rook', 'ruff', 'salamander',
                'salmon', 'sand-dollar', 'sandpiper', 'sardine', 'scorpion', 'sea-lion', 'sea-urchin', 'seahorse', 'seal', 'shark', 'sheep',
                'shrew', 'shrimp', 'skunk', 'snail', 'snake', 'spider', 'squid', 'squirrel', 'starling', 'stingray', 'stinkbug', 'stork',
                'swallow', 'swan', 'tapir', 'tarsier', 'termite', 'tiger', 'toad', 'trout', 'turkey', 'turtle', 'vicuna', 'viper', 'vulture',
                'wallaby', 'walrus', 'wasp', 'water-buffalo', 'weasel', 'whale', 'wolf', 'wolverine', 'wombat', 'woodcock', 'woodpecker', 'worm', 'wren', 'yak', 'zebra'
            ];

            $random_key = array_rand($animals);
            $picked_name = $animals[$random_key];
            $random_number = rand(1000, 9999);
            $name = $picked_name . '-' . $random_number;
            $data[$now1] = [
                'name' => $name ?? $now1,
                'date' => $now2,
                'klid' => $now1,
                'type' => $request->backup_ids
            ];
        }

        $this->saveFileData($file, $data);
        return $data;
    }
    public function createBackupFolder($request, $now1, $now2)
    {
        $backupFolder = $this->createFolder(base_path('databasebackups'));
        $this->folder = $this->createFolder($backupFolder . DIRECTORY_SEPARATOR . $now1);
        $file = base_path('databasebackups/backup.json');
        $data = $this->getBackupList();
        if (isset($request->name)) {
            $data[$now1] = [
                'name' => $request->name ?? $now1,
                'date' => $now2,
                'klid' => $now1,
                'type' => $request->backuptype
            ];

        } else {

            $animals = [
                'aardvark', 'albatross', 'alligator', 'alpaca', 'ant', 'anteater', 'antelope', 'ape', 'armadillo', 'donkey',
                'baboon', 'badger', 'barracuda', 'bat', 'bear', 'beaver', 'bee', 'bison', 'boar', 'buffalo', 'galago', 'butterfly',
                'camel', 'caribou', 'cat', 'caterpillar', 'cattle', 'chamois', 'cheetah', 'chicken', 'chimpanzee', 'chinchilla',
                'chough', 'clam', 'cobra', 'cockroach', 'cod', 'cormorant', 'coyote', 'crab', 'crane', 'crocodile', 'crow', 'curlew',
                'deer', 'dinosaur', 'dog', 'dogfish', 'dolphin', 'donkey', 'dotterel', 'dove', 'dragonfly', 'duck', 'dugong', 'dunlin',
                'eagle', 'echidna', 'eel', 'eland', 'elephant', 'elephant-seal', 'elk', 'emu', 'falcon', 'ferret', 'finch', 'fish',
                'flamingo', 'fly', 'fox', 'frog', 'gaur', 'gazelle', 'gerbil', 'giant-panda', 'giraffe', 'gnat', 'gnu', 'goat', 'goose',
                'goldfinch', 'goldfish', 'gorilla', 'goshawk', 'grasshopper', 'grouse', 'guanaco', 'guinea-fowl', 'guinea-pig', 'gull',
                'hamster', 'hare', 'hawk', 'hedgehog', 'heron', 'herring', 'hippopotamus', 'hornet', 'horse', 'human', 'hummingbird', 'hyena',
                'jackal', 'jaguar', 'jay', 'jay, blue', 'jellyfish', 'kangaroo', 'koala', 'komodo-dragon', 'kouprey', 'kudu', 'lapwing',
                'lark', 'lemur', 'leopard', 'lion', 'llama', 'lobster', 'locust', 'loris', 'louse', 'lyrebird', 'magpie', 'mallard', 'manatee',
                'marten', 'meerkat', 'mink', 'mole', 'monkey', 'moose', 'mouse', 'mosquito', 'mule', 'narwhal', 'newt', 'nightingale',
                'octopus', 'okapi', 'opossum', 'oryx', 'ostrich', 'otter', 'owl', 'ox', 'oyster', 'panther', 'parrot', 'partridge', 'peafowl',
                'pelican', 'penguin', 'pheasant', 'pig', 'pigeon', 'pony', 'porcupine', 'porpoise', 'prairie-dog', 'quail', 'quelea', 'rabbit',
                'raccoon', 'rail', 'ram', 'rat', 'raven', 'red-deer', 'red-panda', 'reindeer', 'rhinoceros', 'rook', 'ruff', 'salamander',
                'salmon', 'sand-dollar', 'sandpiper', 'sardine', 'scorpion', 'sea-lion', 'sea-urchin', 'seahorse', 'seal', 'shark', 'sheep',
                'shrew', 'shrimp', 'skunk', 'snail', 'snake', 'spider', 'squid', 'squirrel', 'starling', 'stingray', 'stinkbug', 'stork',
                'swallow', 'swan', 'tapir', 'tarsier', 'termite', 'tiger', 'toad', 'trout', 'turkey', 'turtle', 'vicuna', 'viper', 'vulture',
                'wallaby', 'walrus', 'wasp', 'water-buffalo', 'weasel', 'whale', 'wolf', 'wolverine', 'wombat', 'woodcock', 'woodpecker', 'worm', 'wren', 'yak', 'zebra'
            ];

            $random_key = array_rand($animals);
            $picked_name = $animals[$random_key];
            $random_number = rand(1000, 9999);
            $name = $picked_name . '-' . $random_number;
            $data[$now1] = [
                'name' => $name ?? $now1,
                'date' => $now2,
                'klid' => $now1,
                'type' => $request->backuptype
            ];
        }

        $this->saveFileData($file, $data);
        return $data;
    }

    public function backupDb($now, $checkboxeslist, $tablecount)
    {
        $file = 'database-' . $now;
        $path = $this->folder . DIRECTORY_SEPARATOR . $file;

        $dumpSettings = array(
            'exclude-tables' => json_decode($checkboxeslist, true),
            'add-drop-table' => true,
            'extended-insert' => true
        );


//        You can check database sizes with this query (will return size of all DBs on the server):
//
//SELECT
//    table_schema AS 'Database',
//    SUM(data_length + index_length) / 1024 / 1024 AS 'Size (MB)'
//FROM
//    information_schema.TABLES
//GROUP BY table_schema

        //new for create sql data and work
        try {
            $dump = new IMysqldump\Mysqldump('mysql:host=localhost;dbname=' . env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'), $dumpSettings);
            $dump->start($path . '.sql');
            flash(translate('Database backup was done successfully'))->success();
        } catch (\Exception $e) {
            echo 'mysqldump-php error: ' . $e->getMessage();
            flash(translate('An error occurred while backing up the database') . $e->getMessage())->error();
        }

        //create zip file from backup
        $this->compressFileToZip($path, $file);

        if (file_exists($path . '.zip')) {
            chmod($path . '.zip', 0777);
            flash(translate('Database compression was done successfully'))->success();
        }


        return true;
    }


    public function restoreDb($file, $path)
    {

        //first unzip database file backup
        $this->restore($file, $path);
        $file = $path . DIRECTORY_SEPARATOR . File::name($file) . '.sql';

        if (!file_exists($file)) {
            return false;
        }


        //original method for restore database backup
        try {
            $dump = new IMysqldump\Mysqldump('mysql:host=localhost;dbname=' . env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));
            $dump->restore($file);
            flash(translate('The database was restored successfully'))->success();
            echo 'mysqldump-php ok: ';
        } catch (\Exception $e) {
            flash(translate('There was a problem restoring the database') . $e->getMessage())->error();
            echo 'mysqldump-php error: ' . $e->getMessage();
        }
        $this->deleteFile($file);
        return true;

    }

    public function backupStorage($source, $now, $backuptype = 0)
    {
        if ($backuptype < 3) {
            $file = $this->folder . DIRECTORY_SEPARATOR . 'storage-' . $now . '.zip';
        } else {
            $file = $this->folder . DIRECTORY_SEPARATOR . 'website-' . $now . '.zip';
        }

        // set script timeout value
        ini_set('max_execution_time', 10000);
        ini_set('memory_limit','1024M');

        if (class_exists('ZipArchive', false)) {
            $zip = new ZipArchive();
            // create and open the archive
            if ($zip->open($file, ZipArchive::CREATE) !== true) {
                $this->deleteFolderBackup($this->folder);
            }
        } else {
            $zip = new Zip($file);
        }
        $arr_src = explode(DIRECTORY_SEPARATOR, $source);
        $path_length = strlen(implode(DIRECTORY_SEPARATOR, $arr_src) . DIRECTORY_SEPARATOR);
        // add each file in the file list to the archive
        $this->recurseZip($source, $zip, $path_length);
        if (class_exists('ZipArchive', false)) {
            $zip->close();
        }
        if (file_exists($file)) {
            chmod($file, 0777);
            if ($backuptype == 3) {
                flash(translate('website backup was done successfully'))->success();
            } else {
                flash(translate('Storage backup was done successfully'))->success();
            }
        } else {
            if ($backuptype == 3) {
                flash(translate('Backup from website encountered an error'))->error();
            } else {
                flash(translate('Backup from storage encountered an error'))->error();
            }
        }

        return true;
    }

    public function backupAddonsxxx($now, $backuptype = 0)
    {

        $nowdatetime1 = $now;

        try {
            $addonsdir = opendir(public_path('addons'));

            while (false !== $zipFile = readdir($addonsdir)) {
                // if the extension is '.zip'
                if (strtolower(pathinfo($zipFile, PATHINFO_EXTENSION)) == 'zip') {

////                // do the rename based on the current iteration if file name not equal
////                When a plugin wants to be installed, it is first saved with a name similar to "7al3OaIdFAfDoSab9heFlDx9NuartxV9bPqbkOfQ.zip"
////                in the "/public/addons" folder
////                We need to read the file "config.json" from inside zip file and its informations like name,unique_identifier,version
////                and minimum_item_version and then change the name of this compressed file to complete correct name like
////                "addon-backup_restore_system-v1.0-for-activee-commerce-v7.0.0"

                    $zip = new ZipArchive;
                    $res = $zip->open(public_path('addons/') . $zipFile);
                    $random_dir = Str::random(10);

                    $dir = trim($zip->getNameIndex(0), '/');
                    if ($res === true) {
                        $res = $zip->extractTo(base_path('temp/' . $random_dir . '/addonsx'));
                        $zip->close();
                    } else {
                        dd('could not open');
                    }

                    $str = file_get_contents(base_path('temp/' . $random_dir . '/addonsx/' . $dir . '/config.json'));
                    $json = json_decode($str, true);

                    $unique_identifier = $json['unique_identifier'];
                    $version = $json['version'];
                    $minimum_item_version = $json['minimum_item_version'];

                    $oldfilename = public_path('addons/') . $zipFile;

                    //like==>addon-backup_restore_system-v1.0-for-activee-commerce-v7.0.0"
                    $newfilename = public_path('addons/') . 'addon-' . sprintf('%06d', rand(1, 1000000)) . '-' . $unique_identifier . '-v' . $version . '-for-activee-commerce-v' . $minimum_item_version . '.zip';

                    $this->renameFileaddons($oldfilename, $newfilename);


                }
            }
            $this->deletefolderandfiles(base_path('temp/'));

            $file = $this->folder . DIRECTORY_SEPARATOR . 'addons-' . $nowdatetime1 . '.zip';
            $source = public_path('addons/');
            // set script timeout value
            ini_set('max_execution_time', 10000);

            if (class_exists('ZipArchive', false)) {
                $zip = new ZipArchive();
                // create and open the archive
                if ($zip->open($file, ZipArchive::CREATE) !== true) {
                    $this->deleteFolderBackup($this->folder);
                }
            } else {
                $zip = new Zip($file);

            }
            $arr_src = explode(DIRECTORY_SEPARATOR, $source);
            $path_length = strlen(implode(DIRECTORY_SEPARATOR, $arr_src) . DIRECTORY_SEPARATOR);
            // add each file in the file list to the archive
            $this->recurseZip($source, $zip, $path_length);
            if (class_exists('ZipArchive', false)) {
                $zip->close();
            }
            if (file_exists($file)) {
                chmod($file, 0777);
                flash(translate('addons backup was done successfully'))->success();
            }

        } catch (Exception $error) {
            return Redirect::back()
                ->withError($error->getMessage());
        }


        return true;

    }


    public function backupAddons($source, $now, $backuptype = 5)
    {
        if ($backuptype === 5) {
            $file = $this->folder . DIRECTORY_SEPARATOR . 'addons-' . $now . '.zip';
        }

        // set script timeout value
        ini_set('max_execution_time', 10000);

        if (class_exists('ZipArchive', false)) {
            $zip = new ZipArchive();
            // create and open the archive
            if ($zip->open($file, ZipArchive::CREATE) !== true) {
                $this->deleteFolderBackup($this->folder);
            }
        } else {
            $zip = new Zip($file);

        }
        $arr_src = explode(DIRECTORY_SEPARATOR, $source);
        $path_length = strlen(implode(DIRECTORY_SEPARATOR, $arr_src) . DIRECTORY_SEPARATOR);
        // add each file in the file list to the archive
        $this->recurseZip($source, $zip, $path_length);
        if (class_exists('ZipArchive', false)) {
            $zip->close();
        }
        if (file_exists($file)) {
            chmod($file, 0777);
            if ($backuptype == 5) {
                flash(translate('addons backup was done successfully'))->success();
            }
        } else {
            if ($backuptype == 3) {
                flash(translate('Backup from addons encountered an error'))->error();
            }
        }

        return true;
    }

    public function restoreStorage($fileName, $pathTo)
    {
        if (file_exists($fileName)) {

            if (class_exists('ZipArchive', false)) {
                $zip = new ZipArchive;
                if ($zip->open($fileName) === true) {
                    $zip->extractTo($pathTo);
                    $zip->close();
                    flash(translate('The storage was restored successfully'))->success();
                    return true;
                }
            } else {
                $archive = new Zip($fileName);
                $archive->extract(PCLZIP_OPT_PATH, $pathTo, PCLZIP_OPT_REMOVE_ALL_PATH);
                flash(translate('The storage was restored successfully'))->success();
                return true;
            }
        } else {
            flash(translate('There are no files to restore'))->error();
        }

        return false;
    }

    public function restore($fileName, $pathTo)
    {
        if (class_exists('ZipArchive', false)) {
            $zip = new ZipArchive;
            if ($zip->open($fileName) === true) {
                $zip->extractTo($pathTo);
                $zip->close();
                return true;
            }
        } else {
            $archive = new Zip($fileName);
            $archive->extract(PCLZIP_OPT_PATH, $pathTo, PCLZIP_OPT_REMOVE_ALL_PATH);
            return true;
        }

        return false;
    }


    public function deleteBackupxx($foldername, $deletetypes, $backuptype)
    {

        $path = base_path('databasebackups/') . $foldername;

        $master_arr = $backuptype;
        $delete_arr   = $deletetypes;
        $arr_1 = array_diff($master_arr, $delete_arr);
        $arr_2 = array_diff($delete_arr, $master_arr);
        $final_output = array_merge($arr_1, $arr_2);
        foreach ($deletetypes as $deletetype) {

            switch ($deletetype) {
                case 1:
                    foreach ($this->scanFolder($path) as $file) {
                        if (strpos(basename($file),'database') !== false) {
                            $this->file->delete($path . DIRECTORY_SEPARATOR . $file);
                        }
                    }
                    break;
                case 2:
                    foreach ($this->scanFolder($path) as $file) {
                        if (strpos(basename($file),'storage') !== false) {
                            $this->file->delete($path . DIRECTORY_SEPARATOR . $file);
                        }
                    }
                    break;
                case 4:
                    foreach ($this->scanFolder($path) as $file) {
                        if (strpos(basename($file),'addons') !== false) {
                            $this->file->delete($path . DIRECTORY_SEPARATOR . $file);
                        }
                    }
                    break;
                case 8:
                    foreach ($this->scanFolder($path) as $file) {
                        if (strpos(basename($file),'website') !== false) {
                            $this->file->delete($path . DIRECTORY_SEPARATOR . $file);
                        }
                    }
                    break;
                default:
            }
        }

        if(count($final_output) == 0 && sizeof($final_output) == 0){
            $this->file->deleteDirectory($path);

            $file = base_path('databasebackups/backup.json');
            $data = $this->getBackupListxx();
            if (!empty($data)) {
                $tmp = explode('/', $path);
                unset($data[end($tmp)]);
                $this->saveFileData($file, $data);
            }

        } else {

            //decode my JSON file:
            $json_object = file_get_contents(base_path('databasebackups/backup.json'));
            $data = json_decode($json_object, true);

            //then we changed "type" to new array of reminded backed up files
            $data[$foldername]['type'] = $final_output;
            //means example:
            //    "2024-02-10-15-11-36": {    <=== $foldername
            //    "name": "sand-dollar-4559",
            //    "date": "2024-02-10 15:11:36",
            //    "klid": "2024-02-10-15-11-36",
            //    "type": ["1","2"]           <=== $data[$foldername]['type']

            //Finally rewrite it back on the file (or a newer one):
            $json_object = json_encode($data);
            file_put_contents(base_path('databasebackups/backup.json'), $json_object);

        }
    }

    public function deleteBackup($path, $backuptype, $deletetype)
    {
        if ($backuptype < 3) { //backup type is storage&database or only database or only storage
            switch ($deletetype) {
                case 1: //we want to delete only database from backup
                    foreach ($this->scanFolder($path) as $item) {
                        if (strpos(basename($item), 'database') !== false) {


                            //if $item ==> "database-2023-12-15-11-59-56.zip" then i must get "2023-12-15-11-59-56" because i must find key in json file
                            $datakey = str_replace(
                                array("database-", ".zip"),
                                array("", ""),
                                $item
                            );

                            //decode my JSON:
                            $json_object = file_get_contents(base_path('databasebackups/backup.json'));
                            $data = json_decode($json_object, true);

                            //                        When we delete the database from the backup that includes the database and storage, we must change the backup type to backup storage, which is 2.
//                        then we changed "type": "0" to "type": "2"
                            $data[$datakey]['type'] = '2';

//                        Finally rewrite it back on the file (or a newer one):
                            $json_object = json_encode($data);
                            file_put_contents(base_path('databasebackups/backup.json'), $json_object);
                            $this->file->delete($path . DIRECTORY_SEPARATOR . $item);
                        }
                    }

                    break;
                case 2: //we want to delete only storage from backup
                    foreach ($this->scanFolder($path) as $item) {
                        if (strpos(basename($item), 'storage') !== false) {


                            //if $item ==> "storage-2023-12-15-11-59-56.zip" then i must get "2023-12-15-11-59-56" because i must find key in json file
                            $datakey = str_replace(
                                array("storage-", ".zip"),
                                array("", ""),
                                $item
                            );

                            //decode my JSON:
                            $json_object = file_get_contents(base_path('databasebackups/backup.json'));
                            $data = json_decode($json_object, true);

                            //                        When we delete the storage from the backup that includes the database and storage, we must change the backup type to backup database, which is 1.
//                        then we changed "type": "0" to "type": "1"
                            $data[$datakey]['type'] = '1';

                            //                    Finally rewrite it back on the file (or a newer one):
                            $json_object = json_encode($data);

                            file_put_contents(base_path('databasebackups/backup.json'), $json_object);

                            $this->file->delete($path . DIRECTORY_SEPARATOR . $item);
                        }
                    }


                    break;
                default:
                    foreach ($this->scanFolder($path) as $item) {
                        $this->file->delete($path . DIRECTORY_SEPARATOR . $item);
                    }
                    $this->file->deleteDirectory($path);

                    $file = base_path('databasebackups/backup.json');
                    $data = $this->getBackupList();
                    if (!empty($data)) {
                        $tmp = explode('/', $path);
                        unset($data[end($tmp)]);
                        $this->saveFileData($file, $data);
                    }
            }
        } else if ($backuptype == 5) { //backup type is addons
            foreach ($this->scanFolder($path) as $item) {
                $this->file->delete($path . DIRECTORY_SEPARATOR . $item);
            }
            $this->file->deleteDirectory($path);

            $file = base_path('databasebackups/backup.json');
            $data = $this->getBackupList();
            if (!empty($data)) {
                $tmp = explode('/', $path);
                unset($data[end($tmp)]);
                $this->saveFileData($file, $data);
            }

        } else { //backup type is website&database or only website
            switch ($deletetype) {
                case 1: //we want to delete only database from backup
                    foreach ($this->scanFolder($path) as $item) {
                        if (strpos(basename($item), 'database') !== false) {

                            //if $item ==> "database-2023-12-15-11-59-56.zip" then i must get "2023-12-15-11-59-56" because i must find key in json file
                            $datakey = str_replace(
                                array("database-", ".zip"),
                                array("", ""),
                                $item
                            );

                            //decode my JSON:
                            $json_object = file_get_contents(base_path('databasebackups/backup.json'));
                            $data = json_decode($json_object, true);

//                        When we delete the database from the backup that includes the database and website, we must change the backup type to backup website, which is 4.
//                        then we changed "type": "3" to "type": "4"
                            $data[$datakey]['type'] = '4';

//                        Finally rewrite it back on the file (or a newer one):
                            $json_object = json_encode($data);
                            file_put_contents(base_path('databasebackups/backup.json'), $json_object);

                            $this->file->delete($path . DIRECTORY_SEPARATOR . $item);
                        }
                    }

                    break;
                case 2: //we want to delete only website from backup
                    foreach ($this->scanFolder($path) as $item) {
                        if (strpos(basename($item), 'website') !== false) {


                            //if $item ==> "storage-2023-12-15-11-59-56.zip" then i must get "2023-12-15-11-59-56" because i must find key in json file
                            $datakey = str_replace(
                                array("website-", ".zip"),
                                array("", ""),
                                $item
                            );

                            //decode my JSON:
                            $json_object = file_get_contents(base_path('databasebackups/backup.json'));
                            $data = json_decode($json_object, true);

//                        When we delete the website from the backup that includes the database and website, we must change the backup type to backup database, which is 1.
//                        then we changed "type": "0" to "type": "1"
                            $data[$datakey]['type'] = '1';

//                        Finally rewrite it back on the file (or a newer one):
                            $json_object = json_encode($data);
                            file_put_contents(base_path('databasebackups/backup.json'), $json_object);

                            $this->file->delete($path . DIRECTORY_SEPARATOR . $item);
                        }
                    }


                    break;
                default:
                    foreach ($this->scanFolder($path) as $item) {
                        $this->file->delete($path . DIRECTORY_SEPARATOR . $item);
                    }
                    $this->file->deleteDirectory($path);

                    $file = base_path('databasebackups/backup.json');
                    $data = $this->getBackupList();
                    if (!empty($data)) {
                        $tmp = explode('/', $path);
                        unset($data[end($tmp)]);
                        $this->saveFileData($file, $data);
                    }
            }
        }

    }

    public function createFolder($folder)
    {
        if (!$this->file->isDirectory($folder)) {
            $this->file->makeDirectory($folder);
            chmod($folder, 0777);
        }
        return $folder;
    }

    public function deleteFile($file)
    {
        if ($this->file->exists($file)) {
            $this->file->delete($file);
        }
    }

    public function renameFile($file)
    {
        if ($this->file->exists($file)) {
            rename($file, $file . Carbon::now()->format('Y-m-d-h-i-s'));
        }
    }

    public function renameFileaddons($oldfilename, $newfilename)
    {
        if ($this->file->exists($oldfilename)) {
            rename($oldfilename, $newfilename);
        }
    }

    function deletefolderandfiles($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        $this->deletefolderandfiles($dir . "/" . $object);
                    else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    public function getBackupList()
    {
        $file = base_path('databasebackups/backup.json');
        if (file_exists($file)) {
            return $this->getFileData($file);
        }
        return [];
    }
    public function getBackupListxx()
    {
        $file = base_path('databasebackups/backup.json');
        if (file_exists($file)) {
            return $this->getFileData($file);
        }
        return [];
    }


    public function getsharedLinkRows()
    {
        $share_path = base_path('databasebackups/share');
        $jsonFile = $share_path . DIRECTORY_SEPARATOR . 'shares.json';
        if (file_exists($jsonFile)) {
            $jsonData = file_get_contents($jsonFile);
            $data = json_decode($jsonData, true);
            return !empty($data) ? $data : [];
        }
        return [];
    }


    public function compressFileToZip($path, $name)
    {
        $filename = $path . '.zip';

        if (class_exists('ZipArchive', false)) {
            $zip = new ZipArchive();
            if ($zip->open($filename, ZipArchive::CREATE) == true) {
                $zip->addFile($path . '.sql', $name . '.sql');
                $zip->close();
            }
        } else {
            $archive = new Zip($filename);
            $archive->add($path . '.sql', PCLZIP_OPT_REMOVE_PATH, $filename);
        }
        $this->deleteFile($path . '.sql');
    }

    function saveFileData($path, $data, $json = true)
    {

        try {
            if ($json) {
                $data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            }

            File::put($path, $data);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    function getFileData($file, $convert_to_array = true)
    {
        $file = File::get($file);
        if (!empty($file)) {
            if ($convert_to_array) {
                return json_decode($file, true);
            } else {
                return $file;
            }
        }
        return false;
    }

    public function recurseZip($src, $zip, $pathLength)
    {

        foreach ($this->scanFolder($src) as $file) {

            if (!str_contains($file, 'databasebackups') || !str_contains($src . DIRECTORY_SEPARATOR . $file, 'databasebackups')) {

                if ($this->file->isDirectory($src . DIRECTORY_SEPARATOR . $file)) {
                    $this->recurseZip($src . DIRECTORY_SEPARATOR . $file, $zip, $pathLength);
                } else {
                    if (class_exists('ZipArchive', false)) {
                        $zip->addFile($src . DIRECTORY_SEPARATOR . $file, substr($src . DIRECTORY_SEPARATOR . $file, $pathLength));

                    } else {
                        $zip->add($src . DIRECTORY_SEPARATOR . $file, PCLZIP_OPT_REMOVE_PATH, substr($src . DIRECTORY_SEPARATOR . $file, $pathLength));
                    }
                }
            }


        }

    }


    function scanFolder($path, $ignore_files = [])
    {

        try {
            if (is_dir($path)) {
                $data = array_diff(scandir($path), array_merge(['.', '..'], $ignore_files));
                natsort($data);
                return $data;
            }
            return [];
        } catch (Exception $ex) {
            return [];
        }
    }

    public static function folderSize($dir)
    {
        $size = 0;

        foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : folderSize($each);
        }

        return ($size);
    }

    public static function sizeFormat($bytes, $precision = 2)
    {

        $base = log($bytes, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];

    }

    public static function sizeFormat2($bytes, $precision = 2)
    {

        $base = log($bytes, 1024);
//        dd($base);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];

    }


    function filesize_formatted($path)
    {
        $size = filesize($path);
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }


    /**
     * Simple helper to debug to the console
     *
     * @param $data object, array, string $data
     * @param $context string  Optional a description.
     *
     * @return string
     */
    function debug_to_console($data, $context = 'Debug in Console')
    {

        // Buffering to solve problems frameworks, like header() in this and not a solid return.
        ob_start();

        $output = 'console.info(\'' . $context . ':\');';
        $output .= 'console.log(' . json_encode($data) . ');';
        $output = sprintf('<script>%s</script>', $output);

        echo $output;
    }
}
